<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CustomerController as APICustomerController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::post('logout', [AuthController::class, 'logout']);
});


Route::apiResource('customers', APICustomerController::class);

Route::post('/transaction/start', [TransactionController::class, 'startTransaction']);
Route::post('/transaction/update-status', [TransactionController::class, 'updateTransactionStatus']);
Route::get('/transaction', [TransactionController::class, 'getTransaction']);
Route::post('/transaction/complete', [TransactionController::class, 'completeTransaction']);
Route::post('/transaction/cancel', [TransactionController::class, 'cancelTransaction']);

Route::apiResource('projects', ProjectController::class);

// Route::apiResource('tasks', TaskController::class);

Route::get('/projects/{id}/tasks', [TaskController::class, 'getTask']);
Route::post('/projects/{id}/tasks', [TaskController::class, 'store']);
Route::get('/projects/{id}/tasks/{taskId}', [TaskController::class, 'show']);
Route::put('/projects/{id}/tasks/{taskId}', [TaskController::class, 'update']);
Route::delete('/projects/{id}/tasks/{taskId}', [TaskController::class, 'destroy']);
