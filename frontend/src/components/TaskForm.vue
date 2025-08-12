<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
  task: {
    type: Object,
    default: () => ({ title: '', description: '', completed: false })
  },
  isEditing: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits(['submit', 'cancel'])

// Локальная копия задачи для редактирования
const localTask = ref({ ...props.task })

// Обработчик отправки формы
const handleSubmit = () => {
  emit('submit', { ...localTask.value })
}

// Обработчик отмены
const handleCancel = () => {
  emit('cancel')
}

</script>

<template>
  <form @submit.prevent="handleSubmit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
        Название задачи *
      </label>
      <input
        id="title"
        v-model="localTask.title"
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        type="text"
        placeholder="Введите название задачи"
        required
      >
    </div>
    
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
        Описание
      </label>
      <textarea
        id="description"
        v-model="localTask.description"
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        rows="3"
        placeholder="Введите описание задачи"
      ></textarea>
    </div>
    
    <div class="mb-4 flex items-center">
      <input
        id="completed"
        v-model="localTask.completed"
        type="checkbox"
        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
      >
      <label for="completed" class="ml-2 block text-sm text-gray-700">
        Выполнена
      </label>
    </div>
    
    <div class="flex items-center justify-between">
      <button
        type="submit"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
      >
        {{ isEditing ? 'Обновить' : 'Создать' }}
      </button>
      
      <button
        @click="handleCancel"
        type="button"
        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
      >
        Отмена
      </button>
    </div>
  </form>
</template>