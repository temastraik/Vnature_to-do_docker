<script setup>
import { ref, onMounted } from 'vue'
import { useTaskStore } from '@/stores/taskStore'
import TaskForm from '@/components/TaskForm.vue'
import TaskList from '@/components/TaskList.vue'

const taskStore = useTaskStore()
const showForm = ref(false)

// Загружаем задачи при монтировании компонента
onMounted(() => {
  taskStore.fetchTasks()
})

// Создаем новую задачу
const createTask = async (taskData) => {
  try {
    await taskStore.createTask(taskData)
    showForm.value = false
  } catch (error) {
    console.error('Ошибка при создании задачи:', error)
  }
}

// Обновляем задачу
const updateTask = async (taskData) => {
  try {
    await taskStore.updateTask(taskData.id, taskData);
  } catch (error) {
    console.error('Ошибка при обновлении задачи:', error);
  }
}

// Удаляем задачу
const deleteTask = async (id) => {
  try {
    await taskStore.deleteTask(id)
    await taskStore.fetchTasks()
  } catch (error) {
    console.error('Ошибка при удалении задачи:', error)
  }
}
</script>

<template>
  <div class="space-y-8">
    <div class="flex justify-between items-center">
      <h2 class="text-2xl font-bold">Мои задачи</h2>
      <button
        @click="showForm = true"
        v-if="!showForm"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
      >
        Добавить задачу
      </button>
    </div>
    
    <!-- Форма создания задачи -->
    <div v-if="showForm">
      <h2 class="text-xl font-semibold mb-4">Новая задача</h2>
      <TaskForm 
        @submit="createTask" 
        @cancel="showForm = false" 
      />
    </div>
    
    <!-- Список задач -->
    <TaskList
      :tasks="taskStore.tasks"
      :loading="taskStore.loading"
      :error="taskStore.error"
      :is-creating="showForm"
      @delete="deleteTask"
      @update="updateTask"
    />
  </div>
</template>