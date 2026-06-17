<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LabourContractorController;
use App\Http\Controllers\LabourBillController;
use App\Http\Controllers\LabourPaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApiDocsController;

Route::middleware('throttle:api')->group(function () {
    Route::get('/endpoints', [ApiDocsController::class, 'index']);

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::apiResource('projects', ProjectController::class);
        Route::apiResource('vendors', VendorController::class);
        Route::apiResource('bills', BillController::class);
        Route::apiResource('payments', PaymentController::class);
        Route::apiResource('labour-contractors', LabourContractorController::class);
        Route::apiResource('labour-bills', LabourBillController::class);
        Route::apiResource('labour-payments', LabourPaymentController::class);
    });
});
