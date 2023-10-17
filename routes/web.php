<?php

use App\Http\Controllers\Admin\TransparencyController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginDo'])->name('login-do');


// Website
Route::group([], function () {
    Route::get('', [HomeController::class, 'index'])->name('home');
});


// Web Cliente.
Route::prefix('meu-espaco')->as('client.')->middleware('auth:client')->group(function () {
    Route::get('', function () {
        return 'bem vindo cliente';
    })->name('index');
});


// Web Admin.
Route::prefix('admin')->as('admin.')->middleware('auth:web')->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('index');
    Route::prefix('users')->resource('users', UsersController::class);

    // Gerenciamento de rotas para portal da transparencia.
    Route::prefix('transparency')->as('transparency.')->group(function () {
        Route::get('', [TransparencyController::class, 'index'])->name('index');
        Route::get('/create-folder-session/{folderYearId}', [TransparencyController::class, 'createFolderSession'])->name('create-folder-session');
        Route::post('/create-folder-year', [TransparencyController::class, 'createFolderYear'])->name('create-folder-year');
    });

    // Efetua a alteração do tema.
    Route::put('ui-theme', [SettingsController::class, 'iThemes'])->name('iThemes');
});