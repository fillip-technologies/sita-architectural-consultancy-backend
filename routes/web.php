<?php


use Illuminate\Support\Facades\Route;
require base_path('routes/admin.php');
Route::get('/',function(){
    return view('welcome');
});
