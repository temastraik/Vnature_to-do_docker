import { defineStore } from 'pinia'
import api from '@/api'

function getCSRFToken() {
  return document.querySelector('meta[name="csrf-token"]')?.content || ''
}

api.interceptors.request.use(config => {
  if (['post', 'put', 'patch', 'delete'].includes(config.method.toLowerCase())) {
    config.headers['X-CSRF-TOKEN'] = getCSRFToken()
  }
  return config
}, error => {
  return Promise.reject(error)
})

export const useTaskStore = defineStore('task', {
  state: () => ({
    tasks: [],
    loading: false,
    error: null
  }),
  
  actions: {
    async fetchTasks() {
      this.loading = true
      this.error = null
      try {
        const response = await api.get('/tasks')
        this.tasks = response.data || []
      } catch (err) {
        this.error = err.response?.data?.message || 'Ошибка при загрузке задач'
        this.tasks = []
        throw err
      } finally {
        this.loading = false
      }
    },
    
    async fetchTask(id) {
      try {
        const response = await api.get(`/tasks/${id}`)
        return response.data
      } catch (err) {
        throw err
      }
    },
    
    async createTask(taskData) {
      this.loading = true
      try {
        const response = await api.post('/tasks', taskData)
        this.tasks.push(response.data)
        return response.data
      } catch (err) {
        this.error = err.response?.data?.message || 'Ошибка при создании задачи'
        throw err
      } finally {
        this.loading = false
      }
    },
    
    async updateTask(id, taskData) {
      this.loading = true
      try {
        const response = await api.put(`/tasks/${id}`, taskData)
        const index = this.tasks.findIndex(task => task.id === id)
        if (index !== -1) {
          this.tasks[index] = response.data
        }
        return response.data
      } catch (err) {
        this.error = err.response?.data?.message || 'Ошибка при обновлении задачи'
        throw err
      } finally {
        this.loading = false
      }
    },
    
    async deleteTask(id) {
      this.loading = true
      try {
        await api.delete(`/tasks/${id}`)
        this.tasks = this.tasks.filter(task => task.id !== id)
      } catch (err) {
        this.error = err.response?.data?.message || 'Ошибка при удалении задачи'
        throw err
      } finally {
        this.loading = false
      }
    }
  }
})