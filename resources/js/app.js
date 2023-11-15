import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

// Import components
import App from './components/App.vue';
import LogBook from './components/LogBooks/LogBook.vue';
import LogBookForm from './components/LogBooks/LogBookForm.vue';
import LogBookView from './components/LogBooks/LogBookView.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/logbooks', component: LogBook },
        { path: '/logbooks/create', component: LogBookForm },
        { path: '/logbooks/:id', component: LogBookView },
        { path: '/logbooks/:id/edit', component: LogBookForm },
    ]
});

const app = createApp(App);
app.use(router);
app.mount('#app');