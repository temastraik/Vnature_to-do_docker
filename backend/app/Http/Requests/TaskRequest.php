<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Определение, авторизован ли пользователь для выполнения запроса
     */
    public function authorize(): bool
    {
        return true; // В реальном проекте здесь должна быть проверка авторизации
    }

    /**
     * Правила валидации для задачи
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255', // Обязательное поле, строка, макс 255 символов
            'description' => 'nullable|string',   // Необязательное поле, строка
            'completed' => 'boolean',             // Должно быть boolean
        ];
    }

    /**
     * Сообщения об ошибках валидации
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Название задачи обязательно для заполнения',
            'title.max' => 'Название задачи не должно превышать 255 символов',
            'completed.boolean' => 'Статус выполнения должен быть true или false',
        ];
    }
}