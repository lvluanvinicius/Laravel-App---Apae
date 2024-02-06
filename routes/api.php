<?php

use App\Http\Controllers\Api\Website\ComplaintsController;
use App\Http\Controllers\Api\Website\ContactController;
use App\Http\Controllers\Api\Website\PhotoGalleryController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('website')->as('website.')->group(function () {
    Route::get('test', function () {
        return serialize([
            "email" => "noreply@grupocednet.com.br",
            "subject" => "Nova denúncia de " . env('APP_NAME'),
            "mail_settings" => [
                "MAIL_HOST" => "mail.grupocednet.com.br",
                "MAIL_PORT" => 587,
                "MAIL_USERNAME" => "luan@grupocednet.com.br",
                "MAIL_PASSWORD" => "luan@16645266",
                "MAIL_ENCRYPTION" => "ssl",
                "MAIL_EHLO_DOMAIN" => null,
                "MAIL_TIMEOUT" => null,
                "URL" => "",
                "TRANSPORT" => "smtp",
                "MAIL_MAILER" => "smtp"
            ],
        ]);
    })->name('test');


    Route::prefix('photo-gallery')->as('photo-gallery.')->group(function () {
        Route::get('{galleryId}', [PhotoGalleryController::class, 'view'])->name('view');
    });

    Route::prefix('contact')->as('contact.')->group(function () {
        Route::post('', [ContactController::class, 'store'])->name('store');
        Route::post('complaints', [ComplaintsController::class, 'complaints'])->name('complaints');
    });
});