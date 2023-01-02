<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::group(['middleware' => ['role:user', 'auth']], function () {
    Route::get('/', [App\Http\Controllers\EntryController::class, 'index']);
    Route::post('/entry', [App\Http\Controllers\EntryController::class, 'store']);
    Route::post('/entry/{id}/finish', [App\Http\Controllers\EntryController::class, 'finish']);
    Route::post('/entry/{id}/edit', [App\Http\Controllers\EntryController::class, 'update']);
    Route::delete('/entry/{id}', [App\Http\Controllers\EntryController::class, 'destroy']);
    Route::get('/entry', [App\Http\Controllers\EntryController::class, 'getSlsEntried']);
    Route::get('/entry/create', [App\Http\Controllers\EntryController::class, 'create']);
    Route::get('/entry/village/{id}', [App\Http\Controllers\EntryController::class, 'getVillage']);
    Route::get('/entry/{id}/finish', [App\Http\Controllers\EntryController::class, 'recap']);
    Route::get('/entry/{id}/edit', [App\Http\Controllers\EntryController::class, 'edit']);
    Route::get('/entry/sls/{id}', [App\Http\Controllers\EntryController::class, 'getSls']);
    Route::get('/check/sls/{id}', [App\Http\Controllers\EntryController::class, 'checkSls']);
    Route::get('/check/isentry', [App\Http\Controllers\EntryController::class, 'checkIsEntrying']);

    Route::get('/absensi', [App\Http\Controllers\AttendanceController::class, 'index']);
    Route::get('/info', [App\Http\Controllers\InformationController::class, 'index']);

});
