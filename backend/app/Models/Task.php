<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * Поля, доступные для массового заполнения
     *
     * @var array
     */
    protected $fillable = [
        'title',       // Название задачи
        'description', // Описание задачи
        'completed',   // Статус выполнения (true/false)
    ];

    /**
     * Преобразование типов атрибутов
     *
     * @var array
     */
    protected $casts = [
        'completed' => 'boolean', // Преобразуем в boolean при получении
    ];
}