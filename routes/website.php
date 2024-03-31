<?php

use App\Http\Controllers\Web\AApaeController;
use App\Http\Controllers\Web\ApaeGalleryController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\TransparencyController;
use Illuminate\Support\Facades\Route;

// Website Home Page
Route::get('', [HomeController::class, 'index'])->name('home');

Route::prefix("galeria")->as("photo-gallery.")->group(function () {
    Route::get('', [ApaeGalleryController::class, 'index'])->name('index');
    Route::get('{galleryId}', [ApaeGalleryController::class, 'view'])->name('view');
});

Route::get('contato', [ContactController::class, 'index'])->name('contact.index');
Route::get('ouvidoria', [ContactController::class, 'ombudsman'])->name('ombudsman.index');

Route::prefix("apae")->as("apae.")->group(function () {
    Route::get('institucional', [AApaeController::class, 'institutional'])->name('institutional');
    Route::get('diretoria', [AApaeController::class, 'direction'])->name('direction');
    Route::get('conselho', [AApaeController::class, 'advice'])->name('advice');
    Route::get('estatuto', [AApaeController::class, 'statute'])->name('statute');
});

Route::prefix("apae")->as("apae.")->group(function () {
    Route::get('politicas-de-privacidade', [ApaeGalleryController::class, 'privacyPolicies'])->name('privacy-policies');
    Route::get('termos-de-uso', [ApaeGalleryController::class, 'termsOfUse'])->name('terms-of-use');
});

Route::prefix("transparencia")->as("transparency.")->group(function () {
    Route::get('', [TransparencyController::class, 'index'])->name('index');
    Route::get('mostrar/{transparencyId}', [TransparencyController::class, 'show'])->name('show');
    Route::get('mostrar/{transparencyId}/documentos/{folderId}', [TransparencyController::class, 'showDocuments'])->name('show.documents');
});

Route::view('blog/{path?}', 'components.blog.app')->where('path', '.*')->name('app.blog');
// Route::view('tests/{path?}', 'components.app.tests')->where('path', '.*')->name('app.blog');