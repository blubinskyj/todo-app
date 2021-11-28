<?php

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

Route::group(['middleware' => ['auth']], function (){
    Route::group(['prefix' => 'todo-lists', 'as' => 'todoLists'], function (){
        Route::get('', [TodoListController::class,'index'])->name('.index');
        Route::get('/create', [TodoListController::class,'create'])->name('.create');
        Route::post('', [TodoListController::class,'store'])->name('.store');
        Route::get('/{id}', [TodoListController::class,'show'])->name('.show');
        Route::get('/{id}', [TodoListController::class,'edit'])->name('.edit');
        Route::patch('/{id}', [TodoListController::class,'update'])->name('.update');
        Route::delete('/{id}', [TodoListController::class,'destroy'])->name('.destroy');
    });
});



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
