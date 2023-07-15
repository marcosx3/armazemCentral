<?php

use App\Http\Controllers\Api\V1\CompanyController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('v1')->group(function(){
    // COMPANY ROUTE
    Route::apiResource('company',CompanyController::class);
    
    // USER ROUTE
    Route::apiResource('user',UserController::class);

    //PRODUCT ROUTE
    Route::apiResource('product',ProductController::class);
});