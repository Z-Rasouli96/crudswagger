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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('post')->group(function () {
    Route::post('/insert', [App\Http\Controllers\PostController::class,'create']);
    Route::get('/list', [App\Http\Controllers\PostController::class,'list']);
    Route::prefix('{post}')->group(function () {
        Route::get('/get', [App\Http\Controllers\PostController::class,'get']);
        Route::put('/update', [App\Http\Controllers\PostController::class,'update']);
        Route::delete('/delete', [App\Http\Controllers\PostController::class,'delete']);
    });
});
