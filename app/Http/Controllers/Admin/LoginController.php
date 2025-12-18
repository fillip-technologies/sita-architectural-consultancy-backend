<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ProductCustomization;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }
        return back()->with('error','Invalid credentials.',);
    }
    public function store(Request $request)
    {

        $user = User::create([
            'name'     => 'Admin',
            'email'    => 'admin2@gmail.com',
            'password' => Hash::make('admin@1275'),
        ]);


    }


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('admin');
    }



    public function productCustomoze(Request $request){
    $validated = $request->validate([
        'product_id'   => 'required|exists:products,id',
        'message'      => 'nullable|string|max:1000',
        'images.*'     => 'nullable|image|mimes:jpeg,png,jpg,webp',
        'theme-color'  => 'nullable|string|max:20',
        'color-picker' => 'nullable|string|max:20',
        'notes'        => 'nullable|string|max:1000',
        'gift-wrap'    => 'nullable|in:on',
    ]);

    $uploadedImages = [];
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/customizations');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $image->move($destinationPath, $imageName);
            $uploadedImages[] = 'uploads/customizations/' . $imageName;
        }
    }

    $customization = new ProductCustomization();
    $customization->user_id = Auth::check() ? Auth::id() : 0 ;
    $customization->product_id = $validated['product_id'];
    $customization->message = $validated['message'] ?? null;
    $customization->images = !empty($uploadedImages) ? json_encode($uploadedImages) : null;
    $customization->theme_color = $validated['theme-color'] ?? null;
    $customization->color_code = $validated['color-picker'] ?? null;
    $customization->notes = $validated['notes'] ?? null;
    $customization->gift_wrap = isset($validated['gift-wrap']) ? 1 : 0;
    $customization->save();
    return redirect()->back()->with('success', 'Your customization has been saved successfully!');

    }


    public function allproductCustomoze(){
         $customizations = ProductCustomization::with(['user', 'product'])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('admin.pricesetting.productCustomoze',compact('customizations'));
    }
}

