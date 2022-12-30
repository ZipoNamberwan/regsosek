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

Route::get('/', [App\Http\Controllers\EntryController::class, 'index']);
Route::get('/entry/create', [App\Http\Controllers\EntryController::class, 'create']);
Route::get('/entry/village/{id}', [App\Http\Controllers\EntryController::class, 'getVillage']);
Route::get('/entry/sls/{id}', [App\Http\Controllers\EntryController::class, 'getSls']);
