import Vue from 'vue'
import VueRouter from 'vue-router'
import AccountComponent from './components/AccountComponent.vue'
import ProjectComponent from './components/ProjectComponent.vue'
import DailyTasksComponent from './components/DailyTasksComponent.vue'
import PlanningComponent from './components/PlanningComponent.vue'
import HomeComponent from './components/HomeComponent.vue'
import AppComponent from './components/AppComponent.vue'
import store from './store/store'

require('./bootstrap');


Vue.use(VueRouter)

let categories = document.querySelector('#categories')

if (categories) {
    const routes = [
        {path: '/', component: HomeComponent, name: 'home'},
        {path: '/:id', component: ProjectComponent, name: 'categorie'},
        {path: '/planning', component: PlanningComponent, name: 'planning'},
        {path: '/account', component: AccountComponent, name: 'account'},
        {path: '/tasks', component: DailyTasksComponent, name: 'tasks'},
    ]

    const router = new VueRouter({
        mode: 'hash',
        routes,
        base: categories.getAttribute('data-base'),
    })

    new Vue({
        el: '#app',
        components: {
            AppComponent,
        },
        store,
        router
    });
}


