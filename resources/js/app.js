import './bootstrap';

import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import App from './layouts/App.vue'
import PostsIndex from './components/Posts/Index.vue'

const routes = [
    { path: '/', component: PostsIndex },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

createApp(App)
    .use(router)
    .mount('#app')
