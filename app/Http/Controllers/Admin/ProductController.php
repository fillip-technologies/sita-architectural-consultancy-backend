<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\VariantOption;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::all();

        return view('admin.venue.create', compact('categories'));
    }

    public function product_list()
    {
        $products = Product::with(['variants', 'category'])->paginate(10);

        return view('admin.vendor.index', compact('products'));
    }

    public function edit_product($id)
    {
        $product = Product::with(['variants.options', 'category'])->findOrFail($id);
        $categories = Category::all();

        return view('admin.vendor.edit', compact('product', 'categories'));
    }

    public function getSubcategories($category_id)
    {
        try {
            $subcategories = SubCategory::where('category_id', $category_id)->get(['id', 'name']);

            return response()->json($subcategories);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error: '.$e->getMessage()], 500);
        }
    }

    public function filterProducts(Request $request)
    {
        $query = Product::query();

        if ($request->categories && count($request->categories) > 0) {
            $query->whereIn('category_id', $request->categories);
        }
        if ($request->materials && count($request->materials) > 0) {
            $query->whereIn('material', $request->materials);
        }
        if ($request->stone_types && count($request->stone_types) > 0) {
            $query->whereIn('stone_type', $request->stone_types);
        }
        if ($request->price) {
            $query->where('price', '<=', $request->price);
        }

        $products = $query->get();

        return view('pages.view-product', compact('products'))->render();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'subcategory_id'=>'required',
            'stock' => 'required|integer|min:0',
            'show_product' => 'required',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'discount' => 'nullable|numeric|min:0|max:100',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png',
            'product_id' => 'nullable',
            'variants' => 'nullable|array',
            'variants.*.sku' => 'nullable|string|max:255',
            'variants.*.price' => 'nullable|numeric|min:0',
            'variants.*.stock' => 'nullable|integer|min:0',
            'variants.*.size' => 'nullable|string|max:255',
            'variants.*.image' => 'nullable|image|mimes:jpg,jpeg,png',
            'variants.*.options' => 'nullable|array',
            'variants.*.options.*.name' => 'nullable|string|max:255',
            'variants.*.options.*.value' => 'nullable|string|max:255',
        ]);

        // Generate unique slug
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $i = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug.'-'.$i++;
        }

        // Handle price and discount
        $price = $request->price;
        $discount = $request->discount ?? 0;
        $finalPrice = $discount > 0 ? $price * (1 - $discount / 100) : $price;
        $skuPrefix = strtoupper(substr($request->name, 0, 3));
        $skuCode = $skuPrefix.'-'.strtoupper(Str::random(6));
        // Create product
        $product = new Product;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->slug = $slug;
        $product->show_product = $request->show_product;
        $product->sku = $skuCode;
        $product->original_price = $price;
        $product->price = $finalPrice;
        $product->stock = $request->stock;
        $product->discount = $discount;
        $product->description = $request->description;

        // Main Image Upload
        if ($request->hasFile('image')) {
            $imageName = time().'-'.uniqid().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
            $product->image = 'uploads/products/'.$imageName;
        }

        // Gallery Images Upload
        if ($request->hasFile('gallery_images')) {
            $galleryPaths = [];
            foreach ($request->file('gallery_images') as $galleryImage) {
                $galleryName = time().'-'.uniqid().'.'.$galleryImage->extension();
                $galleryImage->move(public_path('uploads/products/gallery'), $galleryName);
                $galleryPaths[] = 'uploads/products/gallery/'.$galleryName;
            }
            $product->gallery_images = json_encode($galleryPaths);
        }

        $product->save();

        // Handle Variants
        if ($request->has('variants')) {
            foreach ($request->variants as $variantData) {

                $variant = new ProductVariant;
                $variant->product_id = $product->id;

                // SKU unique generation
                $sku = $variantData['sku'] ?? 'SKU-'.strtoupper(Str::random(6));
                $originalSku = $sku;
                $j = 1;
                while (ProductVariant::where('sku', $sku)->exists()) {
                    $sku = $originalSku.'-'.$j++;
                }

                $variant->sku = $sku;
                $variant->price = $variantData['price'] ?? 0;
                $variant->stock = $variantData['stock'] ?? 0;
                $variant->size = $variantData['size'] ?? 0;

                // Variant Image Upload
                if (isset($variantData['image']) && $variantData['image'] instanceof \Illuminate\Http\UploadedFile) {
                    $variantImage = time().'-'.uniqid().'.'.$variantData['image']->extension();
                    $variantData['image']->move(public_path('uploads/variants'), $variantImage);
                    $variant->image = 'uploads/variants/'.$variantImage;
                }

                $variant->save();

                // Variant Options
                if (isset($variantData['options'])) {
                    foreach ($variantData['options'] as $opt) {
                        VariantOption::create([
                            'variant_id' => $variant->id,
                            'name' => $opt['name'] ?? '',
                            'value' => $opt['value'] ?? '',
                        ]);
                    }
                }
            }
        }

        return redirect()->route('poducts.listing')->with('success', 'Product created successfully!');
    }

    public function product_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'show_product' => 'required',
            'subcategory_id'=>'required',
            'description' => 'nullable|string',
            'discount' => 'nullable|numeric|min:0|max:100',
            'purity' => 'nullable|string',
            'mrptext' => 'nullable|string',
            'color' => 'nullable|string',
            'gross_weight' => 'nullable',
            'net_weight' => 'nullable',
            'type' => 'nullable|string',
            'hylighter' => 'nullable|string',
            'hylighter_two' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png',
            'variants' => 'nullable|array',
            'variants.*.id' => 'nullable|exists:product_variants,id',
            'variants.*.sku' => 'nullable|string|max:255',
            'variants.*.price' => 'nullable|numeric|min:0',
            'variants.*.stock' => 'nullable|integer|min:0',
            'variants.*.size' => 'nullable|string',
            'variants.*.image' => 'nullable|image|mimes:jpg,jpeg,png',
            'variants.*.options' => 'nullable|array',
            'variants.*.options.*.id' => 'nullable|exists:variant_options,id',
            'variants.*.options.*.name' => 'nullable|string|max:255',
            'variants.*.options.*.value' => 'nullable|string|max:255',
        ]);

        $product = Product::findOrFail($id);

        $discount = $request->discount ?? $product->discount ?? 0;

        $priceChanged = $request->filled('price') && $request->price != $product->original_price;
        $discountChanged = $request->filled('discount') && $request->discount != $product->discount;

        if ($priceChanged || $discountChanged) {
            $originalPrice = $priceChanged ? $request->price : $product->original_price;
            $discountPrice = $originalPrice * (1 - $discount / 100);

            $product->original_price = $originalPrice;
            $product->price = $discountPrice;
            $product->discount = $discount;
        }

        $skuPrefix = strtoupper(substr($request->name, 0, 3));
        $skuCode = $skuPrefix.'-'.strtoupper(Str::random(6));
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->color = $request->color;
        $product->type = $request->type;
        $product->subcategory_id = $request->subcategory_id;
        $product->show_product = $request->show_product;
        $product->sku = $skuCode;
        $product->stock = $request->stock;
        $product->description = $request->description ?? null;

        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $i = 1;
        while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
            $slug = $originalSlug.'-'.$i++;
        }
        $product->slug = $slug;

        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $imageName = time().'-'.uniqid().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
            $product->image = 'uploads/products/'.$imageName;
        }

        if ($request->hasFile('gallery_images')) {
            $galleryPaths = [];
            foreach ($request->file('gallery_images') as $galleryImage) {
                $galleryName = time().'-'.uniqid().'.'.$galleryImage->extension();
                $galleryImage->move(public_path('uploads/products/gallery'), $galleryName);
                $galleryPaths[] = 'uploads/products/gallery/'.$galleryName;
            }
            $existing = json_decode($product->gallery_images, true) ?? [];
            $product->gallery_images = json_encode(array_merge($existing, $galleryPaths));
        }

        $product->save();

        $existingVariantIds = $product->variants()->pluck('id')->toArray();
        $incomingVariantIds = [];

        if ($request->has('variants')) {
            foreach ($request->variants as $variantData) {
                $variant = ! empty($variantData['id'])
                    ? ProductVariant::find($variantData['id'])
                    : new ProductVariant(['product_id' => $product->id]);

                if (! $variant) {
                    continue;
                }

                $sku = $variantData['sku'] ?? 'SKU-'.strtoupper(Str::random(6));
                $originalSku = $sku;
                $j = 1;
                while (ProductVariant::where('sku', $sku)
                    ->where('id', '!=', $variant->id)
                    ->exists()
                ) {
                    $sku = $originalSku.'-'.$j++;
                }

                $variant->sku = $sku;
                $variant->price = $variantData['price'] ?? $variant->price ?? 0;
                $variant->stock = $variantData['stock'] ?? $variant->stock ?? 0;
                $variant->size = $variantData['size'] ?? $variant->size ?? null;

                if (isset($variantData['image']) && $variantData['image'] instanceof \Illuminate\Http\UploadedFile) {
                    if ($variant->image && file_exists(public_path($variant->image))) {
                        unlink(public_path($variant->image));
                    }
                    $variantImage = time().'-'.uniqid().'.'.$variantData['image']->extension();
                    $variantData['image']->move(public_path('uploads/variants'), $variantImage);
                    $variant->image = 'uploads/variants/'.$variantImage;
                }

                $variant->save();
                $incomingVariantIds[] = $variant->id;

                $existingOptionIds = $variant->options()->pluck('id')->toArray();
                $incomingOptionIds = [];

                if (isset($variantData['options'])) {
                    foreach ($variantData['options'] as $optData) {
                        $option = ! empty($optData['id'])
                            ? VariantOption::find($optData['id'])
                            : new VariantOption(['variant_id' => $variant->id]);

                        if (! $option) {
                            continue;
                        }

                        $option->name = $optData['name'] ?? '';
                        $option->value = $optData['value'] ?? '';
                        $option->save();
                        $incomingOptionIds[] = $option->id;
                    }
                }

                $removeOptionIds = array_diff($existingOptionIds, $incomingOptionIds);
                VariantOption::whereIn('id', $removeOptionIds)->delete();
            }
        }

        $removeVariantIds = array_diff($existingVariantIds, $incomingVariantIds);
        foreach ($removeVariantIds as $rid) {
            $variant = ProductVariant::find($rid);
            if ($variant) {
                if ($variant->image && file_exists(public_path($variant->image))) {
                    unlink(public_path($variant->image));
                }
                $variant->options()->delete();
                $variant->delete();
            }
        }

        return redirect()->route('poducts.listing')->with('success', 'Product updated successfully!');
    }

    public function delete_product($id)
    {
        $product = Product::with(['variants.options'])->findOrFail($id);

        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        if ($product->gallery_name) {
            $galleryImages = json_decode($product->gallery_name, true);
            if ($galleryImages && is_array($galleryImages)) {
                foreach ($galleryImages as $img) {
                    if ($img && file_exists(public_path($img))) {
                        unlink(public_path($img));
                    }
                }
            }
        }
        foreach ($product->variants as $variant) {
            if ($variant->image && file_exists(public_path($variant->image))) {
                unlink(public_path($variant->image));
            }
            foreach ($variant->options as $option) {
                $option->delete();
            }
            $variant->delete();
        }
        $product->delete();

        return redirect()->route('poducts.listing')->with('success', 'Product deleted successfully!');
    }

    public function show_cate()
    {
        return view('admin.vendor.add_category');
    }

    public function category_add(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:categories,name', 'slug' => 'nullable|string|max:255|unique:categories,slug', 'description' => 'nullable|string']);

        $slug = $request->slug ?: Str::slug($request->name);
        Category::create(['name' => $request->name, 'slug' => $slug, 'description' => $request->description]);

        return redirect()->route('category')->with('success', 'Category added successfully!');
    }

    public function category_list()
    {
        $cate_list = Category::paginate(10);

        return view('admin.vendor.category_list', compact('cate_list'));
    }

    public function category_edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.vendor.category_edit', compact('category'));
    }

    public function category_update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate(['name' => 'required|string|max:255|unique:categories,name,'.$id, 'slug' => 'nullable|string|max:255|unique:categories,slug,'.$id, 'description' => 'nullable|string']);
        $category->update(['name' => $request->name, 'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->name), 'description' => $request->description]);

        return redirect()->route('category.listing')->with('success', 'Category updated successfully!');
    }

    public function category_delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.listing')->with('success', 'Category deleted successfully!');
    }

    public function listUsers()
    {
        $userListing = User::all();

        return view('admin.vendor.user_listing', compact('userListing'));
    }

    public function listOrder()
    {
        $orderListing = Order::with(['user', 'items'])->get();

        return view('admin.vendor.order_listing', compact('orderListing'));
    }

    public function offer()
    {
        return view('admin.vendor.offer_cup');
    }

    public function offer_list()
    {
        $cupon = Coupon::paginate(10);

        return view('admin.vendor.offer_cup_list', compact('cupon'));
    }

    public function subcategory()
    {
        return view('admin.subcategory.add_subcategory');
    }

    public function addSubCate(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
        ]);
        $subcat = Subcategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
        ]);

        if ($subcat) {
            return redirect('list/subcate')->with('success', 'Added SubCategory SuccessFully !');
        }
    }

    public function list_subcategory()
    {
        $data_sub = Subcategory::with('category')->get();

        return view('admin.subcategory.subcategory_list', compact('data_sub'));
    }

    public function subcate_delete($id)
    {
        $del = Subcategory::where('id', $id)->delete();
        if ($del) {
            return back()->with('success', 'SubCategory Deleted !');
        }
    }

    public function edit_subCate($id)
    {
        $data = Subcategory::findOrFail($id);

        return view('admin.subcategory.subcategory_edit', compact('data'));
    }

    public function update_subCate(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        $subcategory = Subcategory::findOrFail($id);
        $subcategory->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
        ]);

        return redirect('list/subcate')->with('success', 'Updated SubCategory SuccessFully !');
    }
}
