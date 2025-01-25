<?php
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SaveProductController;
use App\Http\Controllers\SaveShopController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| User Authentication Routes
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function () {
    Route::post('login', [UserController::class, 'signIn']);
    Route::post('register', [UserController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [UserController::class, 'logout']);
        Route::delete('delete', [UserController::class, 'delete_user']);
    });
});

/*
|--------------------------------------------------------------------------
| Shop Routes
|--------------------------------------------------------------------------
*/

Route::prefix('shop')->group(function () {

    Route::get('/', [ShopController::class, 'index']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [ShopController::class, 'store']);
        Route::get('{shop_id}', [ShopController::class, 'show']);
        Route::put('{shop_id}', [ShopController::class, 'update']);
        Route::delete('{shop_id}', [ShopController::class, 'destroy']);
    });
});





/*
|--------------------------------------------------------------------------
| product Routes
|--------------------------------------------------------------------------
*/

Route::prefix('/product')->group(function () {

    Route::get('/', [ProductController::class, 'index']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [ProductController::class, 'store']);
        Route::post('/searching', [ProductController::class, 'filter']);
        Route::get('{product_id}', [ProductController::class, 'show']);
        Route::put('{product_id}', [ProductController::class, 'update']);
        Route::delete('{product_id}', [ProductController::class, 'destroy']);
    });
});

/*
|--------------------------------------------------------------------------
| rating Routes
|--------------------------------------------------------------------------
*/


Route::prefix('/product/{product_id}/rating')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/', [RatingController::class, 'index']);
        Route::post('/', [RatingController::class, 'store']);
        Route::get('/{id}', [RatingController::class, 'show']);
        Route::put('/{id}', [RatingController::class, 'update']);
        Route::delete('/{id}', [RatingController::class, 'destroy']);
    });
});

/*
|--------------------------------------------------------------------------
| save-shop Routes
|--------------------------------------------------------------------------
*/


Route::prefix('save_shop')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/', [SaveShopController::class, 'index']);
        Route::post('/{id}', [SaveShopController::class, 'store']);
        Route::get('/{id}', [SaveShopController::class, 'show']);
        Route::delete('/{id}', [SaveShopController::class, 'destroy']);
    });
});

/*
|--------------------------------------------------------------------------
| save-product Routes
|--------------------------------------------------------------------------
*/


Route::prefix('save_product')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/', [SaveProductController::class, 'index']);
        Route::post('/{id}', [SaveProductController::class, 'store']);
        Route::get('/{id}', [SaveProductController::class, 'show']);
        Route::delete('/{id}', [SaveProductController::class, 'destroy']);
    });
});


/*
|--------------------------------------------------------------------------
| cart Routes
|--------------------------------------------------------------------------
*/


Route::prefix('cart')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/', [CartController::class, 'index']);
        Route::post('/{product_id}', [CartController::class, 'store']);
        Route::get('/{id}', [CartController::class, 'show']);
        Route::delete('/{id}', [CartController::class, 'destroy']);
    });
});


// 

Route::prefix('view')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('get_view/{product_id}', [ViewController::class, 'index']);
        Route::post('/{product_id}', [ViewController::class, 'store']);
        Route::get('/{id}', [ViewController::class, 'show']);
        Route::delete('/{id}', [ViewController::class, 'destroy']);
    });
});


Route::post('/book', function (Request $request) {
    return response()->json([
        'data' => $request->all(), // Corrected the typo
    ]);
});


/*
|--------------------------------------------------------------------------
| Fallback Route for Undefined Endpoints
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()->json(['message' => 'Route not found.'], 404);
});