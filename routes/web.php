<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\VirementController;

use App\Http\Controllers\AuthController;

// Route d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Routes d'authentification
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes protégées
Route::middleware(['auth'])->group(function () {
    // Clients
    Route::resource('clients', ClientController::class);

    // Comptes
    Route::resource('comptes', CompteController::class);

    // Virements
    Route::get('virements', [VirementController::class, 'index'])->name('virements.index');
    Route::get('virements/create', [VirementController::class, 'create'])->name('virements.create');
    Route::post('virements', [VirementController::class, 'store'])->name('virements.store');
    Route::get('virements/receipt', [VirementController::class, 'downloadReceipt'])->name('virements.receipt');
    
    // Developer Page
    Route::view('/developer', 'developer')->name('developer');
});
