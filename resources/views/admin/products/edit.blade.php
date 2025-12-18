@extends('admin.include.layout')

@section('heading', 'Products')
@section('title', 'Edit Product')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-6">Edit Product</h2>

    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf


        {{-- Product Details --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-semibold">Product Name</label>
                <input type="text" name="name" class="w-full border p-2 rounded"
                       value="{{ old('name', $product->name) }}" required>
                @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-semibold">View Product Section</label>
                <select name="show_product" class="w-full border p-2 rounded">
                    <option value="">-- Select Section --</option>
                    <option value="top" {{ old('show_product', $product->show_product) == 'top' ? 'selected' : '' }}>Top Product</option>
                    <option value="new_arrival" {{ old('show_product', $product->show_product) == 'new_arrival' ? 'selected' : '' }}>New Arrival</option>
                    <option value="offers" {{ old('offers', $product->show_product) == 'offers' ? 'selected' : '' }}>Limited offer</option>
                </select>
                @error('show_product')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-semibold">Category</label>
                <select name="category_id" id="categorySelect" class="w-full border p-2 rounded" required>
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div id="subcategoryDiv" hidden>
                <label class="block mb-1 font-semibold">Subcategory</label>
                <select name="subcategory_id" id="subcategorySelect" class="w-full border p-2 rounded">
                    <option value="">-- Select Subcategory --</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Price</label>
                <input type="number" name="price" step="0.01" class="w-full border p-2 rounded"
                       value="{{ old('price', $product->price) }}" required>
                @error('price')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-semibold">Discount (%)</label>
                <input type="number" name="discount" step="0.01" class="w-full border p-2 rounded"
                       value="{{ old('discount', $product->discount) }}">
                @error('discount')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-semibold">Stock</label>
                <input type="number" name="stock" class="w-full border p-2 rounded"
                       value="{{ old('stock', $product->stock) }}" required>
                @error('stock')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-semibold">Main Image</label>
                <input type="file" name="image" class="w-full border p-2 rounded">
                @if ($product->image)
                    <img src="{{ asset($product->image) }}" class="w-24 mt-2 rounded">
                @endif
                @error('image')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-semibold">Gallery Images</label>
                <input type="file" name="gallery_images[]" multiple class="w-full border p-2 rounded">
                @if ($product->gallery_images)
                    @foreach (json_decode($product->gallery_images ?? '[]', true) as $gImage)
                        <img src="{{ asset($gImage) }}" class="w-24 mt-2 rounded inline-block">
                    @endforeach
                @endif
                @error('gallery_images.*')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Features --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Product Features</label>
                <div id="featuresWrapper">
                    @if($product->features)
                        @foreach(json_decode($product->features, true) as $feature)
                            <div class="feature-item flex gap-2 mb-2">
                                <input type="text" name="features[]" class="w-full border p-2 rounded"
                                       value="{{ $feature }}" placeholder="Enter feature">
                                <button type="button" class="removeFeature bg-red-500 text-white px-3 rounded">X</button>
                            </div>
                        @endforeach
                    @else
                        <div class="feature-item flex gap-2 mb-2">
                            <input type="text" name="features[]" class="w-full border p-2 rounded" placeholder="Enter feature">
                            <button type="button" class="removeFeature bg-red-500 text-white px-3 rounded hidden">X</button>
                        </div>
                    @endif
                </div>
                <button type="button" id="addfeatures" class="bg-green-600 text-white px-3 py-1 mt-2 rounded">+ Add More</button>
                @error('features')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Specifications --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Product Specifications</label>
                <div id="product_specifications">
                    @if($product->specifications)
                        @foreach(json_decode($product->specifications, true) as $spec)
                            <div class="spec-row flex gap-2 mb-2">
                                <input type="text" name="specifications_label[]" class="w-1/2 border p-2 rounded"
                                       value="{{ $spec['label'] ?? '' }}" placeholder="Label">
                                <input type="text" name="specifications_value[]" class="w-1/2 border p-2 rounded"
                                       value="{{ $spec['value'] ?? '' }}" placeholder="Value">
                                <button type="button" class="removeSpec bg-red-500 text-white px-3 rounded">X</button>
                            </div>
                        @endforeach
                    @else
                        <div class="spec-row flex gap-2 mb-2">
                            <input type="text" name="specifications_label[]" class="w-1/2 border p-2 rounded" placeholder="Label">
                            <input type="text" name="specifications_value[]" class="w-1/2 border p-2 rounded" placeholder="Value">
                            <button type="button" class="removeSpec bg-red-500 text-white px-3 rounded hidden">X</button>
                        </div>
                    @endif
                </div>
                <button type="button" id="addSpec" class="bg-green-600 text-white px-3 py-1 mt-2 rounded">+ Add More</button>
                @error('product_specifications')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Product Details --}}
        <div class="mt-4">
            <label class="block mb-1 font-semibold">Product Details</label>
            <textarea name="product_details" id="product_details" rows="6" class="border rounded-md p-2 w-full">{{ old('product_details', $product->product_details) }}</textarea>
            @error('product_details')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Product Description --}}
        <div class="mt-4">
            <label class="block mb-1 font-semibold">Description</label>
            <textarea name="description" id="product_description" rows="6" class="border rounded-md p-2 w-full">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Product Variants --}}
        <div class="mt-6">
            <h3 class="text-xl font-bold mb-2">Product Variants</h3>
            <div id="variants-wrapper">
                @foreach ($product->variants as $vIndex => $variant)
                    <div class="variant border p-4 mb-3 rounded bg-gray-50 relative">
                        <button type="button" class="remove-variant absolute top-2 right-2 text-red-600">✖</button>

                        <label class="block mb-1 font-semibold">SKU</label>
                        <input type="text" name="variants[{{ $vIndex }}][sku]" class="w-full border p-2 rounded" value="{{ old("variants.$vIndex.sku", $variant->sku) }}">

                        <label class="block mt-2 mb-1 font-semibold">Price</label>
                        <input type="number" step="0.01" name="variants[{{ $vIndex }}][price]" class="w-full border p-2 rounded" value="{{ old("variants.$vIndex.price", $variant->price) }}">

                        <label class="block mt-2 mb-1 font-semibold">Stock</label>
                        <input type="number" name="variants[{{ $vIndex }}][stock]" class="w-full border p-2 rounded" value="{{ old("variants.$vIndex.stock", $variant->stock) }}">

                        <label class="block mt-2 mb-1 font-semibold">Size</label>
                        <input type="text" name="variants[{{ $vIndex }}][size]" class="w-full border p-2 rounded" value="{{ old("variants.$vIndex.size", $variant->size) }}">
                            <label class="block mt-2 mb-1 font-semibold">Color</label>
                        <input type="text" name="variants[{{ $vIndex}}][color]" class="w-full border p-2 rounded"value="{{ old("variants.$vIndex.color", $variant->color) }}">

                        <label class="block mt-2 mb-1 font-semibold">Image</label>
                        <input type="file" name="variants[{{ $vIndex }}][image]" class="w-full border p-2 rounded">
                        @if ($variant->image)
                            <img src="{{ asset($variant->image) }}" class="w-16 mt-2 rounded">
                        @endif

                        <div class="mt-3 options-wrapper">
                            <h4 class="font-semibold">Options</h4>
                            @foreach ($variant->options as $oIndex => $option)
                                <div class="option flex gap-2 mb-2 relative">
                                    <input type="text" name="variants[{{ $vIndex }}][options][{{ $oIndex }}][name]" value="{{ old("variants.$vIndex.options.$oIndex.name", $option->name) }}" placeholder="Option Name" class="border p-2 rounded w-1/2">
                                    <input type="text" name="variants[{{ $vIndex }}][options][{{ $oIndex }}][value]" value="{{ old("variants.$vIndex.options.$oIndex.value", $option->value) }}" placeholder="Option Value" class="border p-2 rounded w-1/2">
                                    <button type="button" class="remove-option absolute right-0 top-0 text-red-600">✖</button>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="add-option bg-blue-500 text-white px-2 py-1 mt-2 rounded">+ Add Option</button>
                    </div>
                @endforeach
            </div>

            <button type="button" id="add-variant" class="bg-green-500 text-white px-3 py-2 rounded mt-2">+ Add Variant</button>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Product</button>
        </div>
    </form>
</div>

{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#product_description')).catch(error => console.error(error));
    ClassicEditor.create(document.querySelector('#product_details')).catch(error => console.error(error));
</script>

{{-- jQuery for dynamic fields & subcategories --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Subcategories
    const subDiv = $('#subcategoryDiv');
    const subSelect = $('#subcategorySelect');
    const categorySelect = $('#categorySelect');
    const selectedCategoryId = categorySelect.val();
    const selectedSubcategoryId = "{{ old('subcategory_id', $product->subcategory_id ?? '') }}";

    if (selectedCategoryId) {
        subDiv.removeAttr('hidden');
        loadSubcategories(selectedCategoryId, selectedSubcategoryId);
    }

    categorySelect.on('change', function() {
        const categoryId = $(this).val();
        subSelect.html('<option value="">-- Select Subcategory --</option>');
        subDiv.attr('hidden', true);
        if (!categoryId) return;
        loadSubcategories(categoryId);
    });

    function loadSubcategories(categoryId, selectedSubcategoryId = null) {
        $.ajax({
            url: '/get-subcategories/' + categoryId,
            type: 'GET',
            dataType: 'json',
            beforeSend: function() { subSelect.html('<option>Loading...</option>'); },
            success: function(data) {
                subSelect.html('<option value="">-- Select Subcategory --</option>');
                if (data.length > 0) {
                    $.each(data, function(key, subcat) {
                        const isSelected = selectedSubcategoryId == subcat.id ? 'selected' : '';
                        subSelect.append('<option value="'+subcat.id+'" '+isSelected+'>'+subcat.name+'</option>');
                    });
                } else {
                    subSelect.append('<option value="">No subcategories found</option>');
                }
                subDiv.removeAttr('hidden');
            },
            error: function(xhr, status, error) {
                console.error("Error fetching subcategories:", error);
                alert("Something went wrong while loading subcategories.");
            }
        });
    }

    // Features
    $('#addfeatures').click(function() {
        const wrapper = $('#featuresWrapper');
        const newFeature = $('<div class="feature-item flex gap-2 mb-2">' +
            '<input type="text" name="features[]" class="w-full border p-2 rounded" placeholder="Enter feature">' +
            '<button type="button" class="removeFeature bg-red-500 text-white px-3 rounded">X</button></div>');
        wrapper.append(newFeature);
    });

    $(document).on('click', '.removeFeature', function() {
        $(this).parent().remove();
    });

    // Specifications
    $('#addSpec').click(function() {
        const row = $('<div class="spec-row flex gap-2 mb-2">' +
            '<input type="text" name="specifications_label[]" class="w-1/2 border p-2 rounded" placeholder="Label">' +
            '<input type="text" name="specifications_value[]" class="w-1/2 border p-2 rounded" placeholder="Value">' +
            '<button type="button" class="removeSpec bg-red-500 text-white px-3 rounded">X</button>' +
            '</div>');
        $('#product_specifications').append(row);
        updateRemoveButtons();
    });

    $(document).on('click', '.removeSpec', function() {
        $(this).parent().remove();
        updateRemoveButtons();
    });

    function updateRemoveButtons() {
        const rows = $('.spec-row');
        rows.find('.removeSpec').toggle(rows.length > 1);
    }
    updateRemoveButtons();

    // Variants & Options
    let variantIndex = {{ count($product->variants) }};
    $('#add-variant').click(function() {
        const wrapper = $('#variants-wrapper');
        const firstVariant = wrapper.children('.variant:first').clone();
        firstVariant.find('input').val('');
        firstVariant.find('img').remove();
        firstVariant.find('option').remove();
        firstVariant.find('.option').remove();
        firstVariant.find('.options-wrapper').html('<h4 class="font-semibold">Options</h4>');
        firstVariant.find('[name]').each(function() {
            this.name = this.name.replace(/variants\[\d+\]/, 'variants['+variantIndex+']');
        });
        wrapper.append(firstVariant);
        variantIndex++;
    });

    $(document).on('click', '.add-option', function() {
        const variantBlock = $(this).closest('.variant');
        const optionsWrapper = variantBlock.find('.options-wrapper');
        const optionIndex = optionsWrapper.find('.option').length;
        const variantIdx = variantBlock.find('input[name^="variants"]').first().attr('name').match(/variants\[(\d+)\]/)[1];
        const newOption = $('<div class="option flex gap-2 mb-2 relative">' +
            '<input type="text" name="variants['+variantIdx+'][options]['+optionIndex+'][name]" placeholder="Option Name" class="border p-2 rounded w-1/2">' +
            '<input type="text" name="variants['+variantIdx+'][options]['+optionIndex+'][value]" placeholder="Option Value" class="border p-2 rounded w-1/2">' +
            '<button type="button" class="remove-option absolute right-0 top-0 text-red-600">✖</button>' +
            '</div>');
        optionsWrapper.append(newOption);
    });

    $(document).on('click', '.remove-variant', function() {
        if($('.variant').length > 1) $(this).closest('.variant').remove();
        else alert('At least one variant is required.');
    });

    $(document).on('click', '.remove-option', function() {
        $(this).closest('.option').remove();
    });
});
</script>

{{-- SweetAlert --}}
@if (session('success'))
<script>
    Swal.fire({ icon:'success', title:'Success', text:'{{ session('success') }}', timer:2500, timerProgressBar:true, showConfirmButton:false });
</script>
@elseif ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        html: `<ul style="text-align:center; color:red;">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>`,
        confirmButtonText: 'Ok'
    });
</script>
@endif

@endsection
