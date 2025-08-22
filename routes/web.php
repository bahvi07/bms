<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterController;
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


// Master routes
Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::resource('masters', MasterController::class)
        ->except(['show']) // 👈 exclude "show" since we don’t need it
        ->names([
            'index'   => 'dashboard.masters',
            'create'  => 'dashboard.masters.create',
            'store'   => 'dashboard.masters.store',
            'edit'    => 'dashboard.masters.edit',
            'update'  => 'dashboard.masters.update',
            'destroy' => 'dashboard.masters.destroy',
        ]);

    // custom route for measurements
    Route::get('/masters/measurements', [MasterController::class, 'measurements'])
        ->name('dashboard.masters.measurements');

    
    Route::post('/masters/import-garments', [MasterController::class, 'importGarments'])
    ->name('dashboard.masters.importGarments');

Route::post('/masters/import-measurements', [MasterController::class, 'importMeasurements'])
    ->name('dashboard.masters.importMeasurements');
Route::delete('/masters/measurement/{id}', [MasterController::class, 'destroyMeasurements'])
    ->name('dashboard.masters.destroyMeasurements');
        Route::post('/masters/create-measurement/', [MasterController::class, 'createMeasurements'])
        ->name('dashboard.masters.createMeasurements');
    Route::put('/masters/update-measurement/{id}', [MasterController::class, 'updateMeasurements'])
        ->name('dashboard.masters.updateMeasurements');
});
require __DIR__.'/auth.php';
