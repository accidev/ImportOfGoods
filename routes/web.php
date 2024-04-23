<?php

use App\Http\Controllers\GoodController;
use App\Http\Controllers\ImportController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home', ['title' => 'Home']);
})->name('home');

// Страница загрузки файла
Route::get('upload_file', [GoodController::class, 'uploadFile'])->name('upload.file');

// Импорт файла
Route::post('import', [ImportController::class, 'importFile'])->name('import.file');

// Все товары
Route::get('goods', [GoodController::class,'index'])->name('goods');

// Карточка товара
Route::get('good/{id}', [GoodController::class, 'show'])->name('good');

