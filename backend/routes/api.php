<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Группа маршрутов для задач с префиксом /api/tasks
Route::prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index']);    // GET /api/tasks
    Route::post('/', [TaskController::class, 'store']);  // POST /api/tasks

    Route::get('/{id}', [TaskController::class, 'show']); // GET /api/tasks/{id}
    Route::put('/{id}', [TaskController::class, 'update']);    // PUT /api/tasks/{id}
    Route::delete('/{id}', [TaskController::class, 'destroy']); // DELETE /api/tasks/{id}
});