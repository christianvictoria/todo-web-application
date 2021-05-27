<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\ShareTasksController;
use App\Http\Controllers\AssignController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
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
    return view('auth/login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [TasksController::class, 'index']);

// End points 
Route::get('/tasks', [TasksController::class, 'index'])->name('tasks.index'); // This is home 
Route::get('/tasks/create', [TasksController::class, 'create']); // This is home 
Route::post('/tasks', [TasksController::class, 'store']); // This is route for creating

Route::delete('/tasks/{task}', [TasksController::class, 'destroy'])->name('tasks.destroy');
Route::put('/tasks/{task}/{pinned}', [TasksController::class, 'update']); // This is route for editing specific task

Route::get('/tasks/{task}/edit', [TasksController::class, 'edit']); // This is edit page 

Route::get('/share/{task}', [TasksController::class, 'share']);
// Route::get('/sendbasicemail', [MailController:: class, 'basic_email']);
Route::post('/sendhtmlemail/{title}/{content}/{name}', [MailController:: class, 'html_email']);
Route::get('/sendattachmentemail', [MailController:: class,'attachment_email']);
