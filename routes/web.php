<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InventoryMovementController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\DashboardController; // <--- Añadido
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Modificada la ruta del dashboard para usar DashboardController
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // La ruta duplicada del dashboard dentro de este grupo se eliminará o se comentará si ya está cubierta arriba.
    // Route::get('/dashboard', function () { // <--- Esta es la duplicada
    //     return view('dashboard');
    // })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('warehouse',WarehouseController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('im',InventoryMovementController::class);
    Route::resource('order',OrderController::class);
    Route::resource('role',RoleController::class);
    Route::resource('customer',CustomerController::class);

    // Eliminada la ruta duplicada del dashboard de aquí, ya que se definió arriba con el controlador.
    
});

require __DIR__.'/auth.php';
