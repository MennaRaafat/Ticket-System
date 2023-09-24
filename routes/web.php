<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/verify',[App\Http\Controllers\OtpFactoryController::class, 'index'])->name('verify');

Route::post('/store',[App\Http\Controllers\OtpFactoryController::class, 'store'])->name('storeOtp');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('otp')->name('home');

Route::get('/tickets/view', [App\Http\Controllers\TicketController::class , 'index']) -> name('index');

Route::get('/tickets/{id}', [App\Http\Controllers\TicketController::class , 'view']) -> name('view');

Route::get('/tickets', [App\Http\Controllers\TicketController::class , 'create']) -> name('create');

Route::post('/tickets/add', [App\Http\Controllers\TicketController::class , 'add']) -> name('addTicket');

Route::get('/ticket/edit/{id}', [App\Http\Controllers\TicketController::class , 'editTicket']) -> name('editTicket');

Route::patch('/ticket/update/{id}', [App\Http\Controllers\TicketController::class , 'update']) -> name('update');

Route::delete('/tickets/delete/{id}', [App\Http\Controllers\TicketController::class , 'destroy']) -> name('delete');

Route::patch('/tickets/status/{id}', [App\Http\Controllers\TicketController::class , 'edit']) -> name('status');

Route::post('/tickets/download/{id}', [App\Http\Controllers\TicketController::class , 'download']) -> name('download');
