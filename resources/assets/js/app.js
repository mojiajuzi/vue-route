require('./bootstrap');
import Vue from "vue";
import VueRouter from 'vue-router';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(VueRouter)
Vue.use(ElementUI)

import App from './views/App';
import Hello from  './views/Hello';
import Home from './views/Home';
import UsersIndex from './views/UserIndex';
import TodoCreate from './views/todos/Create'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: "/",
            name: 'home',
            component: Home
        },
        {
            path: '/hello',
            name: 'hello',
            component: Hello
        },
        {
            path: '/users',
            name: 'users.index',
            component: UsersIndex
        },
        {
            path: "/todo",
            name: 'todos.create',
            component: TodoCreate
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router
});
