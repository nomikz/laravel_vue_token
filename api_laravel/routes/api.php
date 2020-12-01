<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\InsurancePolicyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'me']);
    Route::post('logout', [LoginController::class, 'logout']);
});
Route::get('insurance-policies', [InsurancePolicyController::class, 'index']);
Route::get('insurance-policies/{insurancePolicy}', [InsurancePolicyController::class, 'show']);
Route::put('insurance-policies/{insurancePolicy}', [InsurancePolicyController::class, 'update']);
Route::post('insurance-policies', [InsurancePolicyController::class, 'store']);

