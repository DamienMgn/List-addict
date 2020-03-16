import Vue from 'vue'
import VueRouter from 'vue-router'
import CategoriesComponent from './components/CategoriesComponent.vue'
import CardsComponent from './components/CardsComponent.vue'
import HomeComponent from './components/HomeComponent.vue'
import store from './store/store'

require('./bootstrap');


Vue.use(VueRouter)

let categories = document.querySelector('#categories')

if (categories) {
    const routes = [
        {path: '/', component: HomeComponent, name: 'home'},
        {path: '/:id', component: CardsComponent, name: 'categorie'},
    ]

    const router = new VueRouter({
        mode: 'hash',
        routes,
        base: categories.getAttribute('data-base'),
    })

    new Vue({
        el: '#app',
        components: {
            CategoriesComponent,
            CardsComponent,
            HomeComponent
        },
        store,
        router
    });
}


