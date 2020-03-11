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
        loadCards: async function (context, id) {
            let response = await get('/api/cards/' + id)
            console.log(response)
        }
    }
})