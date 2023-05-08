import './bootstrap';

import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import PostsIndex from './components/Posts/Index.vue'

const routes = [
    { path: '/', component: PostsIndex },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

createApp({})
    .use(router)
    .mount('#app')
