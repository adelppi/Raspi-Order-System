import { createApp } from 'vue'
import 'budoux/module/webcomponents/budoux-ja';
import './style.css'
import App from './App.vue'
import router from './router'

createApp(App)
    .use(router)
    .mount('#app')
