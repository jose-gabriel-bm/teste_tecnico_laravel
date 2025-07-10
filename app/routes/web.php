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

    Route::get('', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('', [AuthController::class, 'logar'])->name('logar');

    Route::get('/cadastrar', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/cadastrar', [AuthController::class, 'register'])->name('register');

});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('/signatarios')->group(function () {
    Route::get('/listagem', [SignatoryController::class, 'index'])->name('signatory.index')->middleware('auth');
    Route::post('/cadastro', [SignatoryController::class, 'register'])->name('signatory.register')->middleware('auth');
    Route::delete('/delete/{id}', [SignatoryController::class, 'destroy'])->name('signatory.destroy')->middleware('auth');
    Route::post('/update', [SignatoryController::class, 'update'])->name('signatory.update')->middleware('auth');
});

Route::prefix('/processos')->group(function () {

    Route::get('/listagem', [ProcessesController::class, 'index'])->name('processes.index')->middleware('auth');
    Route::post('/cadastro', [ProcessesController::class, 'register'])->name('processes.register')->middleware('auth');
    Route::delete('/delete/{id}', [ProcessesController::class, 'destroy'])->name('processes.destroy')->middleware('auth');
    Route::post('/update', [ProcessesController::class, 'update'])->name('processes.update')->middleware('auth');
    Route::get('/filtro', [ProcessesController::class, 'filter'])->name('processes.filter')->middleware('auth');


    Route::get('/aprovar', [ProcessesController::class, 'aprovar'])->name('processes.aprovar');
    Route::post('/aprovacoesProcessos', [ProcessesController::class, 'aprovacoesProcessos'])->name('processes.aprovacoesProcessos');
    Route::get('/historico', [ProcessesController::class, 'historico'])->name('processes.historico');

});

Route::get('/relatorios', [ProcessesController::class, 'report'])->name('processes.report')->middleware('auth');
