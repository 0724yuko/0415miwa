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
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::get('/itemcard/{id}', [App\Http\Controllers\ItemController::class, 'itemcard']);//対応カード表示
    Route::post('/update/{id}', [App\Http\Controllers\ItemController::class, 'update']);//抽出した対応カードを保存
});

Route::prefix('clients')->group(function () {
    Route::get('/', [App\Http\Controllers\ClientController::class, 'index']);
    Route::get('/list', [App\Http\Controllers\ClientController::class, 'list']);
    Route::get('/add', [App\Http\Controllers\ClientController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ClientController::class, 'add']);
});