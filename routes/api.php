<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/todos', [TodoController::class, 'index']);
Route::post('/todos', [TodoController::class, 'store']);
Route::put('/todos/{id}', [TodoController::class, 'update']);
Route::get('/todos/{id}', [TodoController::class, 'show']);
Route::delete('/todos/{id}', [TodoController::class, 'destroy']);
