<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    /**
     * Получение списка всех задач
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $tasks = Task::all();
            return response()->json($tasks, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ошибка при получении задач: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Создание новой задачи
     *
     * @param TaskRequest $request
     * @return JsonResponse
     */
    public function store(TaskRequest $request): JsonResponse
    {
        try {
            $task = Task::create($request->validated());
            return response()->json($task, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ошибка при создании задачи: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Обновление существующей задачи
     *
     * @param TaskRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(TaskRequest $request, int $id): JsonResponse
    {
        try {
            $task = Task::find($id);
            
            if (!$task) {
                return response()->json([
                    'message' => 'Задача не найдена'
                ], 404);
            }
            
            $task->update($request->validated());
            return response()->json($task, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ошибка при обновлении задачи: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Удаление задачи
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $task = Task::find($id);
            
            if (!$task) {
                return response()->json([
                    'message' => 'Задача не найдена'
                ], 404);
            }
            
            $task->delete();
            return response()->json([
                'message' => 'Задача успешно удалена'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ошибка при удалении задачи: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Получение конкретной задачи по ID
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $task = Task::find($id);
            
            if (!$task) {
                return response()->json([
                    'message' => 'Задача не найдена'
                ], 404);
            }
                
            return response()->json($task, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ошибка при получении задачи: ' . $e->getMessage()
            ], 500);
        }
    }
}