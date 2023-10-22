<?php

use App\Http\Controllers\Admin\TransparencyController;
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


/**
 * Rotas para recursos internos protegidos pelo Gaurdian Web.
 */
Route::post('file/{folderSession}', [TransparencyController::class, 'createFileSessionStore'])->name('createFileSessionStore');
