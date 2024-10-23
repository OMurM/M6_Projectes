<?php

use App\Http\Controllers\PingController;

Route::get('/', function () {
    return view('home');
});

Route::resource('pings', PingController::class);
