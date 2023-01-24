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

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['middleware' => ['role:user']], function () {
        Route::get('/home', [App\Http\Controllers\EntryController::class, 'index']);
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

        Route::get('/attendance', [App\Http\Controllers\AttendanceController::class, 'index']);
        Route::post('/attendance', [App\Http\Controllers\AttendanceController::class, 'markAttendance']);
        Route::post('/attendance/noatt', [App\Http\Controllers\AttendanceController::class, 'markNoAttendance']);
        Route::post('/attendance/noatt/cancel', [App\Http\Controllers\AttendanceController::class, 'cancelNoAttendance']);
        Route::get('/attendance/time', [App\Http\Controllers\AttendanceController::class, 'checkTime']);
        Route::get('/attendance/data', [App\Http\Controllers\AttendanceController::class, 'attendanceData']);

        Route::get('/info', [App\Http\Controllers\InformationController::class, 'index']);
    });

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/admin', [App\Http\Controllers\ReportController::class, 'index']);
        Route::get('/mitra', [App\Http\Controllers\MitraController::class, 'index']);
        Route::get('/mitra/create', [App\Http\Controllers\MitraController::class, 'create']);
        Route::post('/mitra', [App\Http\Controllers\MitraController::class, 'store']);
        Route::get('/mitra/data', [App\Http\Controllers\MitraController::class, 'mitraData']);
        Route::get('/mitra/{id}/edit', [App\Http\Controllers\MitraController::class, 'edit']);
        Route::put('/mitra/{id}', [App\Http\Controllers\MitraController::class, 'update']);
        Route::delete('/mitra/{id}', [App\Http\Controllers\MitraController::class, 'destroy']);

        Route::get('/attendance/list', [App\Http\Controllers\ReportController::class, 'attendanceList']);
        Route::get('/attendance/list/data/{id?}', [App\Http\Controllers\ReportController::class, 'attendanceListData']);
        Route::get('/report/user', [App\Http\Controllers\ReportController::class, 'reportEntryByUser']);
        Route::get('/report/sls', [App\Http\Controllers\ReportController::class, 'reportEntry']);
        Route::get('/message/{id}/{type}', [App\Http\Controllers\ReportController::class, 'generateMessage']);
        Route::get('/attendance/change', [App\Http\Controllers\ReportController::class, 'attendanceEdit']);
        Route::post('/attendance/change', [App\Http\Controllers\ReportController::class, 'attendanceUpdate']);

        Route::get('/report/user', [App\Http\Controllers\ReportController::class, 'reportUser']);
        Route::get('/report/user/data', [App\Http\Controllers\ReportController::class, 'reportUserData']);
        Route::get('/report/user/{id}', [App\Http\Controllers\ReportController::class, 'viewReport']);
        Route::get('/report/user/data/{id}', [App\Http\Controllers\ReportController::class, 'viewReportData']);

        Route::get('/report/sls', [App\Http\Controllers\ReportController::class, 'reportSls']);
        Route::get('/report/sls/data', [App\Http\Controllers\ReportController::class, 'reportSlsData']);
    });
});
