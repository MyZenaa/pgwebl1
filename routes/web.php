<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\PolylinesController;

use function PHPSTORM_META\map;

Route::get('/table',[TableController::class, 'index'])->name('table');
Route::get('/', [PointsController::class,'index'])->name('map');

// Route::post('/points-store', [PointsController::class,'store'])->name('points.store');
Route::resource('points', PointsController::class);
Route::resource('polylines', PolylinesController::class);
