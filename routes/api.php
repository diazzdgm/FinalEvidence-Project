<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\CustomerApiController;
use App\Http\Controllers\Api\InventoryMovementApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\ProfileApiController;
use App\Http\Controllers\Api\RoleApiController;
use App\Http\Controllers\Api\WarehouseApiController;

// Ruta pública para obtener el estado de una orden específica
Route::get('/orders/{order}', [OrderApiController::class, 'show'])->name('api.orders.show');
// Ruta pública TEMPORAL para subir la etiqueta de la orden (para diagnóstico)
Route::post('/orders/{orderId}/label', [OrderApiController::class, 'uploadLabelFromVue'])->name('api.orders.uploadLabel');
// Ruta pública para descargar la etiqueta
Route::get('/orders/{order}/download-label', [OrderApiController::class, 'downloadLabel'])->name('api.orders.downloadLabel');
// Considera si la siguiente ruta es necesaria o es un duplicado y si también debe ser pública
// Route::get('orders/{order}/download', [OrderApiController::class, 'downloadLabel']);


Route::middleware('auth:sanctum')->group(function () {
    // Rutas públicas (si las hubiera) - Se movieron las de show y upload order arriba
    // La ruta de descarga original se mantiene, pero Vue usará el enlace directo por ahora.
    // Si se necesita que la descarga sea vía API y pública, también moverla.
    // Route::get('orders/{order}/download-label', [OrderApiController::class, 'downloadLabel']); // Movida arriba para ser pública
    Route::get('orders/{order}/download', [OrderApiController::class, 'downloadLabel']); // Esta se mantiene aquí, evaluar si es necesaria o si también debe ser pública

    // CRUD Básico para todos los recursos
    // Se excluye 'show' de orders porque se definió como pública arriba.
    Route::apiResource('categories', CategoryApiController::class);
    Route::apiResource('customers', CustomerApiController::class);
    Route::apiResource('inventory-movements', InventoryMovementApiController::class);
    Route::apiResource('orders', OrderApiController::class)->except(['show']); // Excluimos 'show'
    Route::apiResource('products', ProductApiController::class);
    Route::apiResource('profiles', ProfileApiController::class);
    Route::apiResource('roles', RoleApiController::class);
    Route::apiResource('warehouses', WarehouseApiController::class);
});
