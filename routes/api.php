<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/news', [\App\Http\Controllers\API\IndexController::class, 'index']);

Route::prefix('admin')->group(function () {
    Route::get('/news', [\App\Http\Controllers\API\Admin\NewsController::class, 'index']);
    Route::get('/news/one/{id}', [\App\Http\Controllers\API\Admin\NewsController::class, 'one']);
    Route::post('/news/save', [\App\Http\Controllers\API\Admin\NewsController::class, 'save']);
    Route::delete('/news/{id}', [\App\Http\Controllers\API\Admin\NewsController::class, 'delete']);
});
