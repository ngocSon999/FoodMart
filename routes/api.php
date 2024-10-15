<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TradeMarkController;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\CategoryController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('/category', [CategoryController::class, 'index']);
//Route::post('/category/create', [CategoryController::class, 'store']);
//Route::get('/category/renderPdf', [CategoryController::class, 'renderPdf']);

Route::apiResource('category', CategoryController::class);
Route::apiResource('product', ProductController::class);

Route::post('/upload', [UploadController::class, 'uploadFile']);

Route::apiResource('/trademark', TradeMarkController::class);
