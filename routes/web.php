<?php

use App\Http\Controllers\GoodController;
use App\Http\Controllers\ImportController;
use App\Imports\GoodsImport;
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

Route::get('upload_file', [GoodController::class, 'uploadFile'])->name('upload.file');
Route::get('goods', [GoodController::class,'index'])->name('goods');
Route::get('good/{id}', [GoodController::class, 'show'])->name('good');
Route::post('import', [ImportController::class, 'importExcel'])->name('import.file');
