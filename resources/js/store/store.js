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
        categories: {},
        errors: {}
    },
    getters: {
        categories: function (state) {
            return state.categories
        },
        errors: function (state) {
            return state.errors
        }
    },
    mutations: {
        handleErrors: function(state, {errors}) {
            state.errors = errors
            console.log(state.errors)          
        },
        addCategories: function (state, {categories}) {
            let obj = {}
            categories.forEach(element => {
                obj[element.id] = element
                obj[element.id].cards = {}
            });
            state.categories = obj
            state.errors = {}
        },
        addCategory: function (state, {category}) {
            let obj = {}
            obj[category.id] = category
            state.categories = {...state.categories, ...obj}
            state.errors = {}
        },
        removeCategory: function (state, id) {
            let newState = state.categories
            delete newState[id]
            state.categories = {...newState}
            state.errors = {}
        },
        addCards: function (state, {id, cards}) {
            let category = state.categories[id] || {}
            if (cards.length > 0) {
                cards.forEach(el => {
                    category.cards[el.id] = el
                })
            } else {
                category.cards = {}
            }
            state.categories = {...state.categories, ...{[id]: category}}
            state.errors = {}
        },
        addCard: function (state, {card}) {
            let category = state.categories[card.category_id] || {}
            category.cards[card.id] = card
            state.categories = {...state.categories, ...{[card.category_id]: category}}
            state.errors = {}
        },
        removeCard: function (state, {card}) {
            let newState = state.categories
            delete newState[card.category_id].cards[card.id]
            state.categories = {...newState}
            state.errors = {}
        },
    },
    actions: {
        loadCategories: async function (context) {
            let response = await get('/api/categories')
            context.commit('addCategories', {categories: response.data.categories})
        },
        insertCategory: async function (context, dataCategory) {
            let response = await axios.post('/api/add-category', {
                name: dataCategory.categoryName,
                color: dataCategory.categoryColor
            }).catch(error => {
                context.commit('handleErrors', {errors: error.response.data.errors})
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
        },
        insertCard: async function (context, cardData) {
            let response = await axios.post('/api/add-card/' + cardData.categoryId, {
               cardName: cardData.cardName,
               cardColor: cardData.cardColor
            }).catch(error => {
                context.commit('handleErrors', {errors: error.response.data.errors})
            })
            context.commit('addCard', {card: response.data.card})
        },
        updateCard: async function (context, cardData) {
            let response = await axios.post('/api/update/card/' + cardData.cardId + '/' + cardData.categoryId, {
               cardName: cardData.cardName,
               cardColor: cardData.cardColor
            }).catch(error => {
                context.commit('handleErrors', {errors: error.response.data.errors})
            })
            context.commit('addCard', {card: response.data.card})
        },
        deleteCard: async function (context, cardData) {
            let response = await axios.post('/api/delete/card/' + cardData.cardId + '/' + cardData.categoryId)
            context.commit('removeCard', {card: response.data.card})
        },
        insertTask: async function (context, taskData) {
            let response = await axios.post('/api/add-task/' + taskData.cardId + '/' + taskData.categoryId, {
                taskName: taskData.taskName
            }).catch(error => {
                context.commit('handleErrors', {errors: error.response.data.errors})
            })
            context.commit('addCard', {card: response.data.card})
        },
        deleteTask: async function (context, taskData) {
            let response = await axios.post('/api/delete/task/' + taskData.taskId + '/' + taskData.cardId + '/' + taskData.categoryId)
            context.commit('addCard', {card: response.data.card})
        },
        updateTask: async function (context, taskData) {
            let response = await axios.post('/api/update/task/' + taskData.taskId + '/' + taskData.cardId + '/' + taskData.categoryId, {
                status: taskData.checkbox,
                taskColor: taskData.taskColor,
                taskName: taskData.taskName
            }).catch(error => {
                context.commit('handleErrors', {errors: error.response.data.errors})
            })
            context.commit('addCard', {card: response.data.card})
        }
    }
})
