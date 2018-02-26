require('./bootstrap');
import Vue from "vue";
import VueRouter from 'vue-router';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(VueRouter)
Vue.use(ElementUI)

import App from './views/App';
import MoneyCatery from './views/cost/Create';
import UsersIndex from './views/UserIndex';
import TodoCreate from './views/todos/Create';
import TodoIndex from './views/todos/Index';

import ChatIndex from './views/chat/Index';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/users',
            name: 'users.index',
            component: UsersIndex
        },
        {
            path: "/todos/create",
            name: 'todos.create',
            component: TodoCreate
        },
        {
            path: "/todos",
            name: "todos.index",
            component: TodoIndex
        },
        {
            path: "/chat",
            name: "chat",
            component: ChatIndex
        },
        {
            path: "/cost/create",
            name: "cost.create",
            component: MoneyCatery
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router
});
