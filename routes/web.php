<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/phpinfo', function () {
    phpinfo();
});

Route::get('/', [App\Http\Controllers\StartController::class, 'mainpage']);
Route::get('page/{id}', [App\Http\Controllers\ContMisController::class, 'makedata']);
Route::get('/kadr', [App\Http\Controllers\OkController::class, 'showOkFiles']);
Route::get('/sec', [App\Http\Controllers\SecController::class, 'showSecFiles']);
Route::get('/medform', [App\Http\Controllers\MedformController::class, 'showMedformFiles']);
Route::get('/apt', [App\Http\Controllers\AptController::class, 'showAptFiles']);
Route::get('/tfoms', [App\Http\Controllers\TfomsController::class, 'showTfomsFiles']);
Route::post('/listph', [App\Http\Controllers\TestController::class, 'find_phones']);
Route::get('/test', [App\Http\Controllers\TestController::class, 'test']);
Route::get('/phone', [App\Http\Controllers\PhoneController::class, 'phone']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
});

Route::middleware('auth')->group(function (){
    Route::delete('/delete_doc_row', [App\Http\Controllers\DelrowController::class, 'deldata']);
    Route::delete('/delete_news', [App\Http\Controllers\StartController::class, 'delnews']);
    Route::delete('/delete_phone', [App\Http\Controllers\DelphoneController::class, 'delphone']);
    Route::delete('/delete_org', [App\Http\Controllers\OrgtechController::class, 'delOrg']);
    Route::post('/modal_phone', [App\Http\Controllers\TestController::class, 'modalphone']);
    Route::get('/pc', [App\Http\Controllers\ListPcController::class, 'pcpanel']);

    Route::prefix('cartridge')->group(function () {
        Route::get('/list', [App\Http\Controllers\CartStorageController::class, 'index']);
        Route::get('/form/{type?}', [App\Http\Controllers\CartStorageController::class, 'show']);
        Route::post('/', [App\Http\Controllers\CartStorageController::class, 'save']);
        Route::get('/act', [App\Http\Controllers\CartStorageController::class, 'act']);
        Route::post('/act/clear', [App\Http\Controllers\CartStorageController::class, 'clearAct']);
        Route::get('/on-storage', [App\Http\Controllers\CartStorageController::class, 'onStorage']);
        Route::get('/history', [App\Http\Controllers\CartStorageController::class, 'history']);
        Route::get('/history/get', [App\Http\Controllers\CartStorageController::class, 'getHistory'])->name('history.get');
        Route::post('/download', [App\Http\Controllers\CartStorageController::class, 'download']);
    });

    Route::get('/org', [App\Http\Controllers\OrgtechController::class, 'orgpanel']);
    Route::post('/orglist', [App\Http\Controllers\OrgtechController::class, 'orglist']);
    Route::get('/cart_list', [App\Http\Controllers\OrgtechController::class, 'cart_list']);
    Route::post('/add_cart', [App\Http\Controllers\OrgtechController::class, 'add_cartrige']);
    Route::get('/model_list', [App\Http\Controllers\OrgtechController::class, 'model_list']);
    Route::post('/orgmodal', [App\Http\Controllers\OrgtechController::class, 'addorgModal']);
    Route::post('/alltech', [App\Http\Controllers\OrgtechController::class, 'allTech']);
    Route::post('/edit_tech', [App\Http\Controllers\OrgtechController::class, 'editTech']);
    Route::post('/disloc_tech', [App\Http\Controllers\OrgtechController::class, 'editDisloc']);
    Route::post('/find_tech', [App\Http\Controllers\OrgtechController::class, 'findTech']);
    Route::post('/show_repair', [App\Http\Controllers\OrgtechController::class, 'showRepair']);
    Route::post('/show_detail_tech', [App\Http\Controllers\OrgtechController::class, 'showDetail']);
    Route::post('/list_tech', [App\Http\Controllers\OrgtechController::class, 'showTech']);
    Route::post('/add_otd', [App\Http\Controllers\TestController::class, 'add_otd']);
    Route::post('/add_news', [App\Http\Controllers\StartController::class, 'add_news']);
    Route::post('/add_phone', [App\Http\Controllers\TestController::class, 'add_phone']);
    Route::post('/pcl', [App\Http\Controllers\ListPcController::class, 'makepclist']);
    Route::post('/add_fio', [App\Http\Controllers\ListPcController::class, 'addfio']);
    Route::post('/ipl', [App\Http\Controllers\ListPcController::class, 'ffip']);
    Route::get('/move', [App\Http\Controllers\TechMoveController::class, 'techmove']);
    Route::post('/ttable', [App\Http\Controllers\TechMoveController::class, 'techtable']);
    Route::post('/allwork', [App\Http\Controllers\TechMoveController::class, 'allwork']);
    Route::get('/adm', [App\Http\Controllers\AdmController::class, 'admpage']);
    Route::post('/append', [App\Http\Controllers\AdmController::class, 'app_data']);
});

