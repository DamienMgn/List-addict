import Vue from 'vue'
import VueRouter from 'vue-router'
import SidebarComponent from './components/SidebarComponent.vue'
import ProjectComponent from './components/ProjectComponent.vue'
import CardComponent from './components/CardComponent.vue'
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
    ]

    const router = new VueRouter({
        mode: 'hash',
        routes,
        base: categories.getAttribute('data-base'),
    })

    new Vue({
        el: '#app',
        components: {
            SidebarComponent,
            CardComponent,
            ProjectComponent,
            HomeComponent,
            AppComponent,
        },
        store,
        router
    });
}


