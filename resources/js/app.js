import Vue from 'vue'
import VueRouter from 'vue-router'
import CategoriesComponent from './components/CategoriesComponent.vue'
import CardsComponent from './components/CardsComponent.vue'
import store from './store/store'
import Axios from 'axios'

require('./bootstrap');


Vue.use(VueRouter)

let categories = document.querySelector('#categories')

if (categories) {
    const routes = [
        {path: '/'},
        {path: '/:id', component: CardsComponent, name: 'categorie'},
    ]
    
    const router = new VueRouter({
        mode: 'history',
        routes,
        base: categories.getAttribute('data-base'),
        mode: 'hash'
    })
    
    new Vue({
        el: '#app',
        components: {
            CategoriesComponent,
            CardsComponent
        },
        store,
        router
    });
}


