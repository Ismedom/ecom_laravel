<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User Authentication Routes
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function () {
  
    Route::post('login', [UserController::class, 'signIn']);
    Route::post('register', [UserController::class, 'register']);
    Route::middleware('auth:sanctum')->post('logout', [UserController::class, 'logout']);
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

Route::prefix('shop/{shop_id}')->group(function () {
    
    Route::get('/', [ProductController::class, 'index']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [ProductController::class, 'store']); 
        Route::get('{product_id}', [ProductController::class, 'show']); 
        Route::put('{product_id}', [ProductController::class, 'update']); 
        Route::delete('{product_id}', [ProductController::class, 'destroy']); 
    });
});

Route::prefix('shop/{shop_id}/{product_id}/rating')->group(function () {
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
| Fallback Route for Undefined Endpoints
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()->json(['message' => 'Route not found.'], 404);
});