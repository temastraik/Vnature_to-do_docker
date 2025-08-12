import axios from 'axios'

export default axios.create({
  baseURL: process.env.VUE_APP_API_URL || 'http://localhost:8000/api',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
})

axios.interceptors.response.use(response => response, error => {
  console.error('API Error:', error.config.method, error.config.url)
  return Promise.reject(error)
})