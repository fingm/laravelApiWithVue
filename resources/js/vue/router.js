import { createRouter, createWebHashHistory } from "vue-router";

import List from './components/ListComponent.vue';
import Save from './components/SaveComponent.vue';

const routes = [
    {
        name: 'list',
        path: '/',
        component: List
    },
    {
        name: 'save',
        path: '/save',
        component: Save
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes:routes
});

export default router