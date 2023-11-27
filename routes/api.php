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

Route::post('/auth/login', [\App\Http\Controllers\API\Admin\AuthController::class, 'login']);
Route::post('/auth/refresh', [\App\Http\Controllers\API\Admin\AuthController::class, 'refresh']);

Route::get('/news', [\App\Http\Controllers\API\IndexController::class, 'index']);

Route::group(['prefix' => 'admin', 'middleware' => 'jwt'], function () {
    Route::get('/user',[\App\Http\Controllers\API\Admin\UserController::class,'one']);

    Route::get('/news', [\App\Http\Controllers\API\Admin\NewsController::class, 'index']);
    Route::get('/news/one/{id}', [\App\Http\Controllers\API\Admin\NewsController::class, 'one']);
    Route::post('/news/save', [\App\Http\Controllers\API\Admin\NewsController::class, 'save']);
    Route::delete('/news/{id}', [\App\Http\Controllers\API\Admin\NewsController::class, 'delete']);

    Route::get('/dictionary/{dictionary}', [\App\Http\Controllers\API\Admin\DictionariesController::class, 'index']);
    Route::post('/dictionary/{dictionary}', [\App\Http\Controllers\API\Admin\DictionariesController::class, 'save']);

    Route::get('/cartridges', [\App\Http\Controllers\API\Admin\CartridgesController::class, 'index']);
    Route::get('/cartridge/{id}', [\App\Http\Controllers\API\Admin\CartridgesController::class, 'one']);
    Route::post('/cartridge', [\App\Http\Controllers\API\Admin\CartridgesController::class, 'save']);

});
