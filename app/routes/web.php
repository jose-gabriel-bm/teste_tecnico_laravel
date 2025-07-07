<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SignatoryController;
use App\Http\Controllers\ProcessesController;


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

Route::prefix('/login')->group(function () {

    Route::get('', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('', [AuthController::class, 'logar'])->name('logar');

    Route::get('/cadastrar', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/cadastrar', [AuthController::class, 'register'])->name('register');

});

Route::prefix('/signatarios')->group(function () {

    Route::get('/listagem', [SignatoryController::class, 'index'])->name('signatory.index');

});

Route::prefix('/processos')->group(function () {

    Route::get('/listagem', [ProcessesController::class, 'index'])->name('processes.index');

});
