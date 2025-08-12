<script setup>
import { ref } from 'vue'
import TaskItem from './TaskItem.vue'
import { useTaskStore } from '@/stores/taskStore'

const taskStore = useTaskStore()

const props = defineProps({
  tasks: {
    type: Array,
    required: true
  },
  loading: {
    type: Boolean,
    default: false
  },
  error: {
    type: String,
    default: null
  },
  isCreating: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits(['delete', 'update'])

const selectedTask = ref(null)

const showTaskDetails = async (task) => {
  try {
    selectedTask.value = await taskStore.fetchTask(task.id)
  } catch (error) {
    console.error('Ошибка при загрузке задачи:', error)
  }
}

const closeTaskDetails = () => {
  selectedTask.value = null
}

const deleteTask = (id) => {
  if (confirm('Вы уверены, что хотите удалить эту задачу?')) {
    emit('delete', id)
    closeTaskDetails()
  }
}

const updateTask = (updatedTask) => {
  emit('update', updatedTask)
}
</script>

<template>
  <div class="space-y-4">
    <!-- Сообщение об ошибке -->
    <div v-if="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
      <span class="block sm:inline">{{ error }}</span>
    </div>
    
    <!-- Индикатор загрузки -->
    <div v-if="loading" class="flex justify-center items-center py-8">
      <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
    </div>
    
    <!-- Детали задачи -->
    <div v-if="selectedTask">
      <TaskItem
        :task="selectedTask"
        @delete="deleteTask"
        @update="updateTask"
        @close="closeTaskDetails"
      />
    </div>
    
    <!-- Список задач -->
    <div v-if="!isCreating && !selectedTask" class="space-y-4">
      <div v-for="task in tasks" :key="task.id" class="bg-white shadow overflow-hidden rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
          <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
              <span :class="{ 'line-through text-gray-500': task.completed }">{{ task.title }}</span>
              <span v-if="task.completed" class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                Выполнено
              </span>
            </h3>
          </div>
          <button
            @click="showTaskDetails(task)"
            class="text-blue-600 hover:text-blue-900"
          >
            Подробнее
          </button>
        </div>
      </div>
      
      <div v-if="tasks.length === 0 && !loading" class="text-center py-8 text-gray-500">
        Нет задач. Создайте первую задачу!
      </div>
    </div>
  </div>
</template>