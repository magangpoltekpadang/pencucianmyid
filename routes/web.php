<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\VehicleTypeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.main');
});

Route::get('/', [DashboardController::class, 'index']);
Route::resource('/vehicle-types', controller: VehicleTypeController::class);
Route::resource('/service-types', ServiceTypeController::class);
Route::resource('/roles', RoleController::class);
