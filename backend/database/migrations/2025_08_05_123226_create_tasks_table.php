<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Создание таблицы задач
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // Первичный ключ
            $table->string('title'); // Название задачи
            $table->text('description')->nullable(); // Описание (может быть пустым)
            $table->boolean('completed')->default(false); // Статус выполнения
            $table->timestamps(); // created_at и updated_at
        });
    }

    /**
     * Удаление таблицы задач
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
