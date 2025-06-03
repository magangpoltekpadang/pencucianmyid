<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\VehicleTypeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.main');
});

Route::get('/', [DashboardController::class, 'index']);
Route::resource('/vehicle-types', controller: VehicleTypeController::class);
Route::put('/vehicle-types/{id}', [VehicleTypeController::class, 'update']);
Route::resource('/service-types', ServiceTypeController::class);
Route::resource('/roles', RoleController::class);
Route::resource('/outlets', OutletController::class);
Route::resource('/staffs', StaffController::class);
Route::resource('/shifts', ShiftController::class);
Route::resource('/services', ServiceController::class);
Route::resource('/expenses', ExpenseController::class);
Route::resource('/transactions', TransactionController::class);
Route::resource('/payment-methodes', PaymentMethodController::class);
