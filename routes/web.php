<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('home/list', [App\Http\Controllers\HomeController::class, 'list']);


Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);//一覧表示
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);//新規登録画面表示
    Route::post('/store', [App\Http\Controllers\ItemController::class, 'store']);//登録内容保存
    Route::get('/itemcard/{id}', [App\Http\Controllers\ItemController::class, 'itemcard']);//対応カード表示
    Route::post('/update/{id}', [App\Http\Controllers\ItemController::class, 'update']);//抽出した対応カードを保存
    Route::get('/index/{id}', [App\Http\Controllers\ItemController::class, 'useritem']);//抽出した担当者の対応カードを表示
    Route::get('/clientitems/{id}', [App\Http\Controllers\ItemController::class, 'clientitems']);//抽出した顧客の対応カードを表示
});

Route::prefix('clients')->group(function () {
    Route::get('/', [App\Http\Controllers\ClientController::class, 'index']);//一覧表示
    Route::get('/clientcard/{id}', [App\Http\Controllers\ClientController::class, 'clientcard']);//顧客カード表示
    Route::post('/update/{id}', [App\Http\Controllers\ClientController::class, 'update']);//抽出した顧客カードを保存
    // Route::get('/list', [App\Http\Controllers\ClientController::class, 'list']);//顧客検索//非使用
    Route::get('/add', [App\Http\Controllers\ClientController::class, 'add']);//新規登録画面表示
    Route::post('/store', [App\Http\Controllers\ClientController::class, 'store']);//登録内容保存
});

Route::prefix('users')->group(function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index']);//担当者一覧表示
});