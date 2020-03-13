import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

const get = async function (url) {
    let response = await axios.get(url)

    return response
}

export default new Vuex.Store({
    strict: true,
    state: {
        categories: {}
    },
    getters: {
        categories: function (state) {
            return state.categories
        }
    },
    mutations: {
        addCategories: function (state, {categories}) {
            let obj = {}
            categories.forEach(element => {
                obj[element.id] = element
            });
            state.categories = obj
        },
        addCategory: function (state, {category}) {
            let obj = {}
            obj[category.id] = category
            state.categories = {...state.categories, ...obj}
        },
        removeCategory: function (state, id) {
            let newState = state.categories
            delete newState[id]
            state.categories = {...newState}
        },
        addCards: function (state, {id, cards}) {
            let category = state.categories[id] || {}
            category.cards = cards
            state.categories = {...state.categories, ...{[id]: category}}
        }
    },
    actions: {
        loadCategories: async function (context) {
            let response = await get('/api/categories')
            context.commit('addCategories', {categories: response.data.categories})
        },
        insertCategory: async function (context, name) {
            let response = await axios.post('/api/add-category', {
                name: name
            })
            context.commit('addCategory', {category: response.data.category})
        },
        deleteCategory: async function (context, id) {
            let response = await axios.post('/api/delete/category/' + id)
            context.commit('removeCategory', response.data.categoryId)
        },
        loadCards: async function (context, id) {
            let response = await get('/api/cards/' + id)
            context.commit('addCards', {id: id, cards: response.data.cards})
        }
    }
})