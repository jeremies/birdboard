<?php

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
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::resource('projects', \App\Http\Controllers\ProjectsController::class);

    Route::post('/projects/{project}/tasks', [\App\Http\Controllers\ProjectTasksController::class, 'store']);
    Route::patch('/projects/{project}/tasks/{task}', [\App\Http\Controllers\ProjectTasksController::class, 'update']);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


Auth::routes();

