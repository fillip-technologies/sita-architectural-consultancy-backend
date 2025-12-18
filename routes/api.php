<?php

use App\Http\Controllers\Api\ContactApiController;

use App\Http\Controllers\Api\EstimateApiController;
use Illuminate\Support\Facades\Route;


Route::get('/contact/list',[ContactApiController::class, 'index'])->name('contact');
Route::post('store/contact',[ContactApiController::class, 'store'])->name('contact.store');
Route::delete('/contact/list',[ContactApiController::class, 'delete'])->name('contact.delete');

Route::post('personal/information',[EstimateApiController::class, 'personal_information'])->name('first.store');
Route::post('generat/data',[EstimateApiController::class, 'general_enquery'])->name('general.store');
Route::post('premium/data',[EstimateApiController::class, 'pemiums_enquery'])->name('premium.store');
