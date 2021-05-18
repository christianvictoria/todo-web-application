<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// End points 
Route::get('/tasks', [TasksController::class, 'index']); // This is home 
Route::get('/tasks/{task}/edit', [TasksController::class, 'edit']); // This is edit page 
Route::put('/tasks/{task}', [TasksController::class, 'update']); // This is route for editing specific task
Route::post('/tasks', [TasksController::class, 'store']); // This is route for creating
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
