<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SearchHistoryController;
use App\Http\Controllers\AuthController;
use App\Models\Product;
use App\Models\SearchHistory;
use Illuminate\Support\Facades\Route;

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

/*User Authentication*/
Route::controller(AuthController::class)
->group(function () {
    Route::post('/register', 'signUp');
    Route::post('/login', 'signIn');
    Route::middleware('auth:api')->post('/logout', 'signOut');
});

Route::middleware('auth:api')->group(function () {
    Route::prefix('/products')
    ->controller(ProductController::class)
    ->group(function () {
        Route::post('/', 'store')->can('create', Product::class);
    });

    Route::prefix('/search-histories')
    ->controller(SearchHistoryController::class)
    ->group(function () {
        Route::post('/', 'store')->can('createSearchHistory', SearchHistory::class);
        Route::get('/buyer', 'getBuyerSearchHistory')->can('viewBuyerSearchHistory', SearchHistory::class);
        Route::get('/salesman', 'getSalesmanSearchHistory')->can('viewSalesmanSearchHistory', SearchHistory::class);
    });
});
