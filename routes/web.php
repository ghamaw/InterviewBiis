<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\PegawaiController::class, 'index'])->name('pegawai.index');
Route::post('/pegawai', [\App\Http\Controllers\PegawaiController::class, 'store'])->name('pegawai.store');
Route::delete('/pegawai/{id}', [\App\Http\Controllers\PegawaiController::class, 'destroy'])->name('pegawai.destroy');
