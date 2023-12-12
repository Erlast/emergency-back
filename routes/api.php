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
Route::get('/user', [\App\Http\Controllers\API\Admin\UserController::class, 'oneCurrent'])->middleware('jwt');
Route::get('/sections', [\App\Http\Controllers\API\IndexController::class, 'sections']);
Route::get('/section/{slug}', [\App\Http\Controllers\API\IndexController::class, 'section']);
Route::post('/download', [\App\Http\Controllers\API\IndexController::class, 'downloadFile']);

Route::get('/news', [\App\Http\Controllers\API\IndexController::class, 'index']);

Route::group(['prefix' => 'admin', 'middleware' => 'jwt'], function () {
    Route::get('/users', [\App\Http\Controllers\API\Admin\UserController::class, 'index']);
    Route::get('/user/{id}', [\App\Http\Controllers\API\Admin\UserController::class, 'one']);
    Route::post('/user', [\App\Http\Controllers\API\Admin\UserController::class, 'save']);
    Route::delete('/user/{id}', [\App\Http\Controllers\API\Admin\UserController::class, 'delete']);

    Route::get('/news', [\App\Http\Controllers\API\Admin\NewsController::class, 'index']);
    Route::get('/news/one/{id}', [\App\Http\Controllers\API\Admin\NewsController::class, 'one']);
    Route::post('/news/save', [\App\Http\Controllers\API\Admin\NewsController::class, 'save']);
    Route::delete('/news/{id}', [\App\Http\Controllers\API\Admin\NewsController::class, 'delete']);

    Route::get('/dictionary/{dictionary}', [\App\Http\Controllers\API\Admin\DictionariesController::class, 'index']);
    Route::post('/dictionary/{dictionary}', [\App\Http\Controllers\API\Admin\DictionariesController::class, 'save']);

    Route::get('/cartridges', [\App\Http\Controllers\API\Admin\CartridgesController::class, 'index']);
    Route::get('/cartridge/{id}', [\App\Http\Controllers\API\Admin\CartridgesController::class, 'one']);
    Route::post('/cartridge', [\App\Http\Controllers\API\Admin\CartridgesController::class, 'save']);

    Route::get('/sections', [\App\Http\Controllers\API\Admin\SectionsController::class, 'get']);
    Route::post('/section', [\App\Http\Controllers\API\Admin\SectionsController::class, 'save']);
    Route::delete('/section/{id}', [\App\Http\Controllers\API\Admin\SectionsController::class, 'delete']);

    Route::post('/document', [\App\Http\Controllers\API\Admin\DocumentsController::class, 'save']);
    Route::delete('/document/{id}', [\App\Http\Controllers\API\Admin\DocumentsController::class, 'delete']);

    Route::get('/workplaces', [\App\Http\Controllers\API\Admin\WorkplacesController::class, 'index']);
    Route::get('/workplace/{id}', [\App\Http\Controllers\API\Admin\WorkplacesController::class, 'get']);
    Route::post('/workplace', [\App\Http\Controllers\API\Admin\WorkplacesController::class, 'save']);
    Route::delete('/workplace/{id}', [\App\Http\Controllers\API\Admin\WorkplacesController::class, 'delete']);

    Route::get('/free-ips', [\App\Http\Controllers\API\Admin\IpsController::class, 'free']);
    Route::post('/free-ip/add', [\App\Http\Controllers\API\Admin\IpsController::class, 'add']);

    Route::get('/persons', [\App\Http\Controllers\API\Admin\PersonsController::class, 'index']);
    Route::post('/person/add', [\App\Http\Controllers\API\Admin\PersonsController::class, 'add']);

    Route::get('/operating-systems', [\App\Http\Controllers\API\Admin\OperatingSystemsController::class, 'index']);
    Route::post('/operating-system/add', [\App\Http\Controllers\API\Admin\OperatingSystemsController::class, 'add']);
});
