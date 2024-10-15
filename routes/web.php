<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\TradeMarkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
 * Giao dien admin
 */
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index']); // Route cho "/admin"

    Route::get('/{any}', [AdminController::class, 'index'])
        ->where('any', '.*'); // Route cho các đường dẫn con
});


/*
 * Giao dien web
 */
Route::get('/{trademark}/{slug}', [TradeMarkController::class, 'getBySlug'])->name('web.trademark.slug');

Route::prefix('users')->group(function() {
    Route::get('/', [UserController::class, 'index']);
});

Route::prefix('category')->group(function() {
    Route::get('/', [CategoryController::class, 'index']);
});
Route::get('/{slug?}', [HomeController::class, 'index'])->name('web.home');
Route::post('/product/search', [ProductController::class, 'search'])->name('web.product.search');
