<?php

use App\Http\Controllers\TodoItemController;
use App\Http\Controllers\TodoListController;
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
require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'todo-lists', 'as' => 'todoLists'], function () {
        Route::get('', [TodoListController::class, 'index'])->name('.index');
        Route::get('/create', [TodoListController::class, 'create'])->name('.create');
        Route::post('', [TodoListController::class, 'store'])->name('.store');
        Route::get('/{todoList}', [TodoListController::class, 'edit'])->name('.edit');
        Route::patch('/{todoList}', [TodoListController::class, 'update'])->name('.update');
        Route::delete('/{todoList}', [TodoListController::class, 'destroy'])->name('.destroy');
    });
    Route::group(['prefix' => 'todo-lists/{todoList}/todo-items', 'as' => 'todoItems'], function () {
        Route::get('', [TodoItemController::class, 'index'])->name('.index');
        Route::get('/create', [TodoItemController::class, 'create'])->name('.create');
        Route::post('', [TodoItemController::class, 'store'])->name('.store');
        Route::get('/{todoItem}', [TodoItemController::class, 'edit'])->name('.edit');
        Route::patch('/{todoItem}', [TodoItemController::class, 'update'])->name('.update');
        Route::patch('/{todoItem}/status', [TodoItemController::class, 'updateStatus'])->name('.updateStatus');
        Route::delete('/{todoItem}', [TodoItemController::class, 'destroy'])->name('.destroy');
    });
});
