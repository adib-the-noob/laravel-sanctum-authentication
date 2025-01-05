<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;    

// Route::get("/get-all-products", [ProductController::class,"index"]);
// Route::post("/add-product", [ProductController::class,"store"]);

Route::post("/create-user", [AuthController::class,"create_user"]);
Route::post("/login", [AuthController::class,"login"]);

// single route
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/products', ProductController::class);
    Route::get('/products/search', [ProductController::class, 'search']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
