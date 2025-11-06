<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\VirementController;

Route::get('/', function () {
    return view('welcome');
});

// Clients - toutes les routes
Route::resource('clients', ClientController::class);
Route::resource('virements', VirementController::class);

// Comptes - toutes les routes
Route::resource('comptes', CompteController::class);

// Virements
Route::get('virements', [VirementController::class, 'index'])->name('virements.index');
Route::get('virements/create', [VirementController::class, 'create'])->name('virements.create');
Route::post('virements', [VirementController::class, 'store'])->name('virements.store');

Route::get('/virements/create', [VirementController::class, 'create'])->name('virement.create');
