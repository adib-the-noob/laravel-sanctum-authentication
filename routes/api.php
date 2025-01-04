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

Route::get("/get-all-products", [ProductController::class,"index"]);

// Route::post("/add-product", function(){
//     Product::create([
//         'name' => "product 00",
//         "price"=> 110.99,
//         "description" => "kire mama",
//         "slug"=> "prod00",
//     ]);

// });


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
