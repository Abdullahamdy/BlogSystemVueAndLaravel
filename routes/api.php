<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;

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
Route::post('login', [UserController::class,'login']);
Route::post('register', [UserController::class,'register']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('posts',PostController::class);
Route::apiResource('categories',CategoryController::class);
Route::get('category/{slug}/posts',[PostController::class,'categoryPost']);
Route::get('getpost/{query}',[PostController::class,'getPost']);
Route::middleware('auth:api')->group(function () {
    Route::get('user', [UserController::class,'details']);

});
