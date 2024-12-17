<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\GuestController; 
use App\Http\Controllers\HeadStaffController;



Route::middleware('isNotLogin')->group(function () {
    /* auth router */
    Route::get('/', function () {return view('landing_page');})->name('landing_page');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'authLogin'])->name('login.auth');
});

    
Route::middleware('isLogin')->group(function () {
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
/* guest router */
Route::get('/guest', [GuestController::class, 'index'])->name('guest_page');
Route::get('/guest/create', [GuestController::class, 'createReport'])->name('guest_create_report');
Route::post('/guest/create', [GuestController::class, 'storeReport'])->name('guest_store_report');
Route::post('/vote', [GuestController::class, 'vote'])->name('report.vote');
Route::get('/report/me/show', [GuestController::class, 'monitoringReport'])->name('report_me');
Route::get('/report/{id}/hapus/report', [GuestController::class, 'deleteReport'])->name('report_delete');
Route::get('/report/{reportId}/comment', [GuestController::class, 'comment'])->name('report_comment');
Route::post('/report/{reportId}/comment/store', [GuestController::class, 'storeComment'])->name('report_store_comment');


/* headStaff route */
Route::get('/headstaff', [HeadStaffController::class, 'index'])->name('headstaff_page');
Route::get('/headstaff/create', [HeadStaffController::class, 'createAcc'])->name('headstaff_create_acc');
Route::post('/headstaff/create', [HeadStaffController::class, 'storeAcc'])->name('headstaff_store_acc');

});