<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FormDataController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\VenueController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('admin/login', [AdminController::class, 'login_admin'])->name('admin');
Route::post('login', [LoginController::class, 'login'])->name('admin.login');
Route::get('admin/store', [LoginController::class, 'store'])->name('login.store');
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::middleware(['admin'])->group(function () {
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('category', [ProductController::class, 'show_cate'])->name('category');
    Route::delete('category/delete/{id}', [ProductController::class, 'category_delete'])->name('category.delete');
    Route::get('category/edit/{id}', [ProductController::class, 'category_edit'])->name('category.edit');
    Route::post('category/update/{id}', [ProductController::class, 'category_update'])->name('category.update');
    Route::get('list/category', [ProductController::class, 'category_list'])->name('category.listing');
    Route::post('add/product/category', [ProductController::class, 'category_add'])->name('admin.categories.store');
    Route::get('products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('products/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::post('products/update/{id}', [ProductController::class, 'product_update'])->name('admin.product.update');
    Route::get('/product/list', [ProductController::class, 'product_list'])->name('poducts.listing');
    Route::get('/products/add', [ProductController::class, 'create'])->name('admin.venue.add');
    Route::get('product/edit/{id}', [ProductController::class, 'edit_product'])->name('product.edit');
    Route::delete('product/delete/{id}', [ProductController::class, 'delete_product'])->name('product.delete');
    Route::get('/venue/{id}/edit', [VenueController::class, 'edit'])->name('admin.venue.edit');
    Route::put('/venue/{id}', [VenueController::class, 'update'])->name('admin.update');
    Route::delete('/venue/{id}', [VenueController::class, 'destroy'])->name('admin.venue.destroy');
    Route::get('/vendors/create', [VendorController::class, 'create'])->name('admin.vendors.create');
    Route::post('/vendors/add', [VendorController::class, 'store'])->name('admin.vendors.store');
    Route::get('/vendors', [VendorController::class, 'index'])->name('admin.vendors.index');
    Route::get('/vendors/{vendor}/edit', [VendorController::class, 'edit'])->name('admin.vendors.edit');
    Route::put('/vendors/{vendors}', [VendorController::class, 'update'])->name('admin.vendors.update');
    Route::get('/vendorsRegistration', [FormDataController::class, 'indexVendors'])->name('admin.vendorsreg.index');
    Route::get('/contacts', [FormDataController::class, 'indexContacts'])->name('admin.contacts.index');
    Route::get('/meetings', [FormDataController::class, 'indexMeetings'])->name('admin.meetings.index');
    Route::get('/list/users', [ProductController::class, 'listUsers']);
    Route::get('/list/order', [ProductController::class, 'listOrder']);
    Route::get('offer', [ProductController::class, 'offer']);
    Route::get('offer/list', [ProductController::class, 'offer_list'])->name('list.cupon');
    Route::post('add/offer', [HomeController::class, 'addOffer'])->name('admin.coupons.store');

    // product setting prices

    // Admin Dashboard
    // Route::get('admin/dashboard', function () {
    //     return view('admin.dashboard');
    // })->name('dashboard');

    // Users List
    Route::get('/users', function () {
        return 'This is the admin users list';
    })->name('users');

    // Settings Page
    Route::get('/settings', function () {
        return 'Admin settings page';
    })->name('settings');
});
