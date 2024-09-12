<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes for Product CRUD operations
Route::get('/products', [ProductController::class, 'index'])->name('products.index'); // List all products
Route::post('/products', [ProductController::class, 'store'])->name('products.store'); // Create a new product
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show'); // Show a single product
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update'); // Update an existing product
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
