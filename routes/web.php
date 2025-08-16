<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/orders', [DashboardController::class, 'orders'])->middleware(['auth', 'verified'])->name('dashboard.orders');

require __DIR__.'/auth.php';
