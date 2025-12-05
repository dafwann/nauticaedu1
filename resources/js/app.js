import { createApp } from 'vue'
import router from './router'
import App from './App.vue'

const app = createApp(App)
app.use(router)   // pasang router

// ➜ tambahkan ini supaya bisa diakses dari console / header
window.$router = router;

app.mount('#app') // mount di div id="app"
