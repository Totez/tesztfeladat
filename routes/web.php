<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|s
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[App\Http\Controllers\ProjectController::class, 'index'])->name('projects');
Route::post('/project/store', [App\Http\Controllers\ProjectController::class, 'store'])->name('project.store');
Route::get('/project/{id}', [App\Http\Controllers\ProjectController::class, 'show'])->name('projects.show');

Route::post('/project-date/{project}', [App\Http\Controllers\ProjectDateController::class, 'storeStart'])->name('project_date.store.start');
Route::put('/project-date/{id}', [App\Http\Controllers\ProjectDateController::class, 'storeFinish'])->name('project_date.store.finish');

Route::get('/summary', [App\Http\Controllers\ProjectController::class, 'summary'])->name('projects.summary');


