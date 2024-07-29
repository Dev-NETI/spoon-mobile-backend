<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/authenticating', [AuthController::class, 'authenticating']);
Route::post('/verify-otp', [AuthController::class, 'verifyOTP']);
Route::get('/checking-status-otp', [AuthController::class, 'checkingStatusOTP']);
Route::post('/check-register-email', [AuthController::class, 'checkRegisterEmail']);
Route::get('/check-status-email', [AuthController::class, 'checkStatusEmail']);

Route::resource('/company', CompanyController::class)->only([
    'index',
]);
Route::resource('/category', CategoryController::class)->only([
    'index',
]);
Route::resource('/rank', RankController::class)->only([
    'index',
]);
Route::resource('/nationality', NationalityController::class)->only([
    'index',
]);

Route::resource('/user', UserController::class)->only([
    'store',
]);
