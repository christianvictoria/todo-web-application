<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [TasksController::class, 'index']);

// End points 
Route::get('/tasks', [TasksController::class, 'index']); // This is home 
Route::get('/tasks/create', [TasksController::class, 'create']); // This is home 
Route::post('/tasks', [TasksController::class, 'store']); // This is route for creating
Route::get('/tasks/{task}/edit', [TasksController::class, 'edit']); // This is edit page 

Route::delete('/tasks/{task}', [TasksController::class, 'destroy'])->name('tasks.destroy');
Route::put('/tasks/{task}/{important}', [TasksController::class, 'update']); // This is route for editing specific task
Route::put('/tasks/{task}/{unpinned}', [TasksController::class, 'update']); // This is route for editing specific task



