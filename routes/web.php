<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Orders under dashboard
Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::resource('orders', OrderController::class)->names([
        'index' => 'dashboard.orders',
        'create' => 'dashboard.orders.create',
        'store' => 'dashboard.orders.store',
        'show' => 'dashboard.orders.show',
        'edit' => 'dashboard.orders.edit',
        'update' => 'dashboard.orders.update',
        'destroy' => 'dashboard.orders.destroy',
    ]);
});

require __DIR__.'/auth.php';
