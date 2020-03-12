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
            state.categories = categories
        },
        addCategory: function (state, {category}) {
            state.categories.push(category)
        },
        removeCategory: function (state, id) {
            let index = state.categories.findIndex(el => el.id == id)
            state.categories.splice(index, 1)
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
            console.log(response.data.categoryId)
            context.commit('removeCategory', response.data.categoryId)
        },
        loadCards: async function (context, id) {
            let response = await get('/api/cards/' + id)
            console.log(response)
        }
    }
})