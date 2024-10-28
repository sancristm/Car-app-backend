<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CarController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/cars', [CarController::class, 'index']); // Public car listing
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes (Requires JWT Authentication)
Route::middleware('auth:api')->group(function () {
    Route::post('/cars', [CarController::class, 'store']); // Create a new car
    Route::get('/cars/{car}', [CarController::class, 'show']); // Show a specific car
    Route::put('/cars/{car}', [CarController::class, 'update']); // Update a specific car
    Route::delete('/cars/{car}', [CarController::class, 'destroy']); // Delete a specific car
    Route::post('/logout', [AuthController::class, 'logout']); 
});
















// this routes were for testing purposes
// Route::get('/test', function () {
//     return response()->json(['message' => 'API route is working']);
// });

// Route::get('/cars',[CarController::class,'index']);

// Route::post('/cars',[CarController::class,'store']);

// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);


// Route::prefix('auth')->group(function () {
//     Route::post('register', [AuthController::class, 'register']);
//     Route::post('login', [AuthController::class, 'login']);
// });

// Route::middleware('auth:api')->group(function () {
//     Route::apiResource('cars', CarController::class);
// });

