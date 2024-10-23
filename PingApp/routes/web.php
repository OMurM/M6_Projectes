<?php

use App\Http\Controllers\PingController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('pings', PingController::class);
Route::get('/ping', [PingController::class, 'validate_ping'])->name('ping.validate');
Route::delete('/pings/{id}', [PingController::class, 'delete_ping'])->name('pings.delete');
