import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import '@/assets/main.css'

// Создаем экземпляр приложения
const app = createApp(App)

app.use(createPinia())

app.use(router)


app.config.errorHandler = (err) => {
  console.error('Глобальная ошибка Vue:', err)
}

app.mount('#app')