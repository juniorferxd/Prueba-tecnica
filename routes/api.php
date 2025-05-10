<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;

Route::apiResource('projects', ProjectController::class);
Route::apiResource('tasks', TaskController::class);
