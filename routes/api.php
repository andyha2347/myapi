<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\product\ProductController;
use App\Http\Controllers\api\user\UserController;

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
Route::prefix('/user')->group(function (){
    Route::post('/login',[LoginController::class, 'login']);
    Route::post('/register',[LoginController::class, 'register']);
    Route::post('/logout',[UserController::class, 'logout']);
    Route::put('/address',[UserController::class, 'updateAddress']);
    Route::get('/{id}/address',[UserController::class, 'userAddress']);
    Route::get('/current',[UserController::class, 'currentUser']);
    Route::get('/all',[UserController::class, 'index']);
    Route::get('/{id}',[UserController::class, 'show']);
    //Route::middleware('auth:api')->get('/all',[UserController::class, 'index']);
});
Route::prefix('/product')->group(function (){
    Route::get('/all',[ProductController::class, 'index']);
    Route::post('/products',[ProductController::class, 'store']);
    Route::get('/{id}',[ProductController::class, 'show']);
    Route::put('/{id}',[ProductController::class, 'update']);
});
Route::get('{all}', function () {
    return response(['error' => 'invalid request']);
})->where('all', '^((?!api).)*');

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
