<script setup>
import { ref } from 'vue'
import TaskForm from './TaskForm.vue'

const props = defineProps({
  task: {
    type: Object,
    required: true
  }
})

const emit = defineEmits(['delete', 'update', 'close'])

const isEditing = ref(false)

const handleDelete = () => {
  if (confirm('Вы уверены, что хотите удалить эту задачу?')) {
    emit('delete', props.task.id)
    emit('close')
  }
}

const handleUpdate = (updatedTask) => {
  Object.assign(props.task, updatedTask);
  emit('update', updatedTask);
  isEditing.value = false;
}

const cancelEdit = () => {
  isEditing.value = false
}
</script>

<template>
  <div class="bg-white shadow overflow-hidden rounded-lg">
    <div class="px-4 py-5 sm:px-6">
      <div v-if="!isEditing">
        <div class="space-y-3">
          <!-- Заголовок и кнопка "Закрыть" в одной линии -->
          <div class="flex justify-between items-start">
            <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
              <span :class="{ 'line-through text-gray-500': task.completed }">{{ task.title }}</span>
              <span v-if="task.completed" class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                Выполнено
              </span>
            </h3>
            <button
              @click="emit('close')"
              class="text-gray-600 hover:text-gray-900"
            >
              Закрыть
            </button>
          </div>

          <!-- Описание задачи -->
          <p class="text-sm text-gray-500">{{ task.description }}</p>

          <!-- Кнопки "Редактировать" и "Удалить" в одной линии -->
          <div class="flex space-x-3 pt-2">
            <button
              @click="isEditing = true"
              class="text-indigo-600 hover:text-indigo-900"
            >
              Редактировать
            </button>
            <button
              @click="handleDelete"
              class="text-red-600 hover:text-red-900"
            >
              Удалить
            </button>
          </div>
        </div>
      </div>
      
      <div v-else>
        <TaskForm
          :task="task"
          :is-editing="true"
          @submit="handleUpdate"
          @cancel="cancelEdit"
        />
      </div>
    </div>
  </div>
</template>