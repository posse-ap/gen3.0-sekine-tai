<?php

// ルーターの設定を記述

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\RecordController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin',function(){
    return view('admin');
})->name('admin');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');


// Route::get('questionsList',QuizzeController::class,'questionsList')->name('questionsList');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('questionsList',[QuestionsController::class,'index']);

Route::get('questionsList/create',[QuestionsController::class,'create']);

Route::post('questionsList',[QuestionsController::class,'store'])->name('questionsList.store');

Route::get('questionsList/create',[QuestionsController::class,'quizzesSelect']);

Route::post('post', [PostController::class,'store'])
->name('post.store');

Route::get('post/create',[PostController::class,'create']);

Route::get('/test',[TestController::class,'test'])
->name('test');

Route::get('/users',[UserController::class,'users'])
->name('users');

Route::get('/top',[TopController::class,'top'])
->name('top');

Route::get('post',[PostController::class,'index']);

Route::get('quizzes',[QuizzeController::class, 'quizzes'])->name('quizzes.index')->middleware('admin');

Route::get('quizzes/show/{quizze}',[QuizzeController::class,'show'])->name('quizze.show')->middleware('admin');

Route::delete('quizzes/{quizze}/questions/{question}/delete', [QuizzeController::class, 'deleteQuestion'])->name('quizze.delete-question')->middleware('admin');


Route::get('quizzes/edit/{quizze}',[QuizzeController::class,'edit'])->name('quizze.edit')->middleware('admin');

Route::patch('quizze/{quizze}',[QuizzeController::class, 'update'])->name('quizze.update')->middleware('admin');

Route::delete('quizze/{quizze}',[QuizzeController::class,'destroy'])->name('quizze.destroy')->middleware('admin');

Route::get('quizzes/create',[QuizzeController::class,'create']);

Route::post('quizzes',[QuizzeController::class,'store'])->name('quizzes.store');


Route::put('quizzes/update-question/{quizze}/{question}', [QuizzeController::class, 'updateQuestion'])
    ->name('quizze.update-question')
    ->middleware('admin');

Route::get('quizzes/show/{quizze}/edit-question/{question}',[QuizzeController::class,'editQuestion'])->name('quizze.edit-question');

// Route::patch('quizees/{quizze}',[QuizzeController::class,'updateQuestion'])->name('quizze.update-question');



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