<?php

use App\Http\Controllers\Web\ApaeGalleryController;
use App\Http\Controllers\Web\HomeController;

use Illuminate\Support\Facades\Route;


// Website Home Page
Route::get('', [HomeController::class, 'index'])->name('home');

Route::get('galeria', [ApaeGalleryController::class, 'index'])->name('photo-gallery');