<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
Route::get('/', [PagesController::class, 'index'])->name('index');
Route::get('/todo',[PagesController::class, 'todo'])->name('todo')->middleware('auth');

Route::prefix('/user')->group(function() {
	Route::get('/register', [RegisterController::class, 'index'])->name('register');
	Route::post('/register', [RegisterController::class, 'create'])->name('register-user');
	Route::get('/login', [LoginController::class, 'index'])->name('login');
	Route::post('/login',[LoginController::class, 'create'])->name('login-user');
	Route::post('/logout',[LoginController::class, 'logout'])->name('logout-user');
});

Route::prefix('/todo')->middleware('auth')->group(function() {
	Route::post('/create',[TodoController::class, 'create']);
	Route::get('/find/{id}', [TodoController::class, 'find']);
	Route::get('/json', [TodoController::class, 'todosJSON']);
	Route::post('/update/{id}', [TodoController::class, 'update']);
	Route::post('/mark-complete/{id}',[TodoController::class, 'markComplete']);
	Route::delete('/delete/{id}', [TodoController::class, 'delete']);
});