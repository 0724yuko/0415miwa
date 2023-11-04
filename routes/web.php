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
    // items
    Route::get('/', [App\Http\Controllers\ItemController::class, 'list']);//一覧表示
    Route::POST('/', [App\Http\Controllers\ItemController::class, 'list']);//一覧表示
   // Route::get('/mnitems/{id}', [App\Http\Controllers\ItemController::class, 'mnitems'])->name('items.mnitems');//管理者用一覧表示
    Route::get('/handle/', [App\Http\Controllers\ItemController::class, 'handle'])->name('items.handle');//対応日で並べ替え
    // items/add
    //Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);//新規登録画面表示⇒adminlte.phpで新規登録のボタンに顧客idを'new'で設定したため、不要になった。
    Route::get('/add/{client_id}', [App\Http\Controllers\ItemController::class, 'add'])->name('items.add');//特定顧客新規登録画面表示
    Route::post('/store', [App\Http\Controllers\ItemController::class, 'store']);//登録内容保存
    Route::get('/itemcard/{id}', [App\Http\Controllers\ItemController::class, 'itemcard']);//対応カード表示
    Route::post('/update/{id}', [App\Http\Controllers\ItemController::class, 'update']);//抽出した対応カードを保存
    Route::get('/index/{id}', [App\Http\Controllers\ItemController::class, 'useritem'])->name('items.useritem');//抽出した担当者の対応カードを表示
    // Route::get('/useritem_handle/{id}', [App\Http\Controllers\ItemController::class, 'useritem_handle'])->name('items.useritem_handle');//対応日で並べ替え
    Route::get('/clientitems/{id}', [App\Http\Controllers\ItemController::class, 'clientitems']);//抽出した顧客の対応カードを表示
    Route::get('/delete/{id}/', [App\Http\Controllers\ItemController::class, 'delete']);//特定IDを削除
    
});

Route::prefix('clients')->group(function () {
    Route::get('/', [App\Http\Controllers\ClientController::class, 'index']);//一覧表示
    Route::get('/clientcard/{id}', [App\Http\Controllers\ClientController::class, 'clientcard'])->name('clientcard');//顧客カード表示
    Route::post('/update/{id}', [App\Http\Controllers\ClientController::class, 'update']);//抽出した顧客カードを保存
    Route::get('/list', [App\Http\Controllers\ClientController::class, 'list']);//顧客検索//非使用
    Route::get('/add', [App\Http\Controllers\ClientController::class, 'add']);//新規登録画面表示
    Route::post('/store', [App\Http\Controllers\ClientController::class, 'store']);//登録内容保存
    Route::get('/delete/{id}/', [App\Http\Controllers\ClientController::class, 'delete']);//特定IDを削除
});

Route::prefix('users')->group(function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index']);//担当者一覧表示
});