<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PaymentController;

Route::middleware('throttle:api')->group(function () {
    Route::get('/endpoints', function () {
        $routes = collect(\Illuminate\Support\Facades\Route::getRoutes())->map(function ($route) {
            return [
                'method' => implode('|', $route->methods()),
                'uri' => '/' . $route->uri(),
            ];
        })->filter(function ($route) {
            return str_starts_with($route['uri'], '/api');
        })->values();

        return response()->json([
            'message' => 'Available API Endpoints',
            'endpoints' => $routes
        ]);
    });

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::apiResource('projects', ProjectController::class);
        Route::apiResource('contractors', ContractorController::class);
        Route::get('/contractors/near/{location}', [ContractorController::class, 'nearLocation']);
        
        Route::apiResource('expenses', ExpenseController::class);
        Route::get('/expenses/project/{projectId}', [ExpenseController::class, 'byProject']);
        
        Route::apiResource('payments', PaymentController::class);
        Route::get('/payments/project/{projectId}', [PaymentController::class, 'byProject']);
    });
});
