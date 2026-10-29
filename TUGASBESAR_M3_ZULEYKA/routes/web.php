<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GangguanController;

Route::get('/gangguan', [GangguanController::class, 'index']);

Route::post('/gangguan', [GangguanController::class, 'store']);

Route::get('/gangguan/{id}/edit', [GangguanController::class, 'edit']);

Route::put('/gangguan/{id}', [GangguanController::class, 'update']);

Route::delete('/gangguan/{id}', [GangguanController::class, 'destroy']);
