<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('addproduct', [ProductController::class, 'add']);
Route::post('updateproduct', [ProductController::class, 'update']);
Route::get('listproduct', [ProductController::class, 'list']);
Route::delete('deleteproduct/{id}', [ProductController::class, 'delete']);
Route::get('getproduct/{id}', [ProductController::class, 'get']);
Route::get('searchproduct/{key}', [ProductController::class, 'search']);