<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;

// Rota para a página inicial
Route::get('/', [SiteController::class, 'index'])->name('home');

// Rota para processar o agendamento
Route::post('/agendar', [BookingController::class, 'store'])->name('booking.store');

// Rotas de autenticação (geradas pelo laravel/ui)
Auth::routes(['register' => false]);

// Grupo de rotas para o painel administrativo
Route::prefix('admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        // Rotas para gerenciar produtos
        Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
        Route::delete('/products/{product}', [AdminController::class, 'destroyProduct'])->name('products.destroy');

        // Rotas para gerenciar horários
        Route::post('/slots/generate', [AdminController::class, 'generateSlots'])->name('slots.generate'); // NOVA ROTA
        Route::delete('/slots/{slot}', [AdminController::class, 'destroySlot'])->name('slots.destroy');
    });
