<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->get('/allCategory', [TestController::class, 'allCategory']);
Route::middleware('auth:sanctum')->post('/store', [TestController::class, 'storeCategory']);
Route::middleware('auth:sanctum')->post('/findCategory', [TestController::class, 'findCategory']);
Route::middleware('auth:sanctum')->delete('/deleteCategory/{id}', [TestController::class, 'deleteCategory']);
Route::middleware('auth:sanctum')->post('/updateCategory', [TestController::class, 'updateCategory']);

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

