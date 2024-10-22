<?php

use App\Http\Controllers\PingController;
use Illuminate\Support\Facades\Route;

// Ruta para la página de inicio
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/pings', [PingController::class, 'index'])->name('pings.index');
Route::get('/pings/create', [PingController::class, 'create'])->name('pings.create'); // Crear nuevo ping
Route::post('/pings', [PingController::class, 'store'])->name('pings.store'); // Almacenar ping
Route::get('/allpings', [PingController::class, 'index'])->name('allpings'); // Asegúrate de que el nombre sea 'allpings'
Route::post('/pings/{id}/validate', [PingController::class, 'validatePing'])->name('pings.validate'); // Validar ping
Route::get('/validate-ping', [PingController::class, 'validate_ping'])->name('validate.ping'); // Hacer ping
