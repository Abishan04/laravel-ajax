<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ImageController;
Route::get('/', function () {
    return view('welcome');
});



Route::resource('employees', EmployeeController::class);
Route::view('/image', 'image');
Route::post('/image-upload', [ImageController::class, 'upload'])->name('image.upload');