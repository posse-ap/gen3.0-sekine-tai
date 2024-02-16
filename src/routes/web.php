<?php

// ルーターの設定を記述

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\LanguageController;


//user管理系
Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin',function(){
    return view('admin');
})->name('admin');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/users',[UserController::class,'index'])->name('users.index');
Route::get('/users/{user}/edit',[UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/create',[UserController::class,'create'])->name('users.create');
Route::post('/users/store',[UserController::class, 'store'])->name('users.store');

//コンテンツ、言語管理
// routes/web.php

Route::get('/contents', [ContentController::class, 'index'])->name('contents.index');
Route::get('/contents/create', [ContentController::class, 'create'])->name('contents.create');
Route::post('/contents/store', [ContentController::class, 'store'])->name('contents.store');
Route::get('/contents/{content}/edit', [ContentController::class, 'edit'])->name('contents.edit');
Route::put('/contents/{content}', [ContentController::class, 'update'])->name('contents.update');
Route::delete('/contents/{content}', [ContentController::class, 'destroy'])->name('contents.destroy');

Route::get('/languages', [LanguageController::class, 'index'])->name('languages.index');
Route::get('/languages/create', [LanguageController::class, 'create'])->name('languages.create');
Route::post('/languages/store', [LanguageController::class, 'store'])->name('languages.store');
Route::get('/languages/{language}/edit', [LanguageController::class, 'edit'])->name('languages.edit');
Route::put('/languages/{language}', [LanguageController::class, 'update'])->name('languages.update');
Route::delete('/languages/{language}', [LanguageController::class, 'destroy'])->name('languages.destroy');

//論理削除の実装
// routes/web.php

Route::delete('/contents/{content}/delete', [ContentController::class, 'delete'])->name('contents.delete');
Route::post('/contents/{content}/restore', [ContentController::class, 'restore'])->name('contents.restore');

Route::delete('/languages/{language}/delete', [LanguageController::class, 'delete'])->name('languages.delete');
Route::post('/languages/{language}/restore', [LanguageController::class, 'restore'])->name('languages.restore');

//記録投稿
// routes/web.php

use App\Http\Controllers\LearningRecordController;

// ... 他のルートの定義

Route::middleware(['auth'])->group(function () {
    Route::get('/learning_records/create', [LearningRecordController::class, 'create'])->name('learning_records.create');
    Route::post('/learning_records', [LearningRecordController::class, 'store'])->name('learning_records.store');
    Route::get('/learning_records/statistics', [LearningRecordController::class, 'showStatistics'])->name('learning_records.statistics');
});

use App\Http\Controllers\NewsController;

Route::get('/news',[NewsController::class,'index']);
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

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
// ここから下がwebapp

Route::get('/record',function(){
    return view('record');
})->middleware(['auth', 'verified'])->name('record');


Route::get('/record',[RecordController::class,'sumAll','sumToday'])->name('record')->middleware('auth');;

require __DIR__.'/auth.php';

//api呼び出し
use App\Http\Controllers\HomeController;

Route::get('/api', [HomeController::class, 'index']);