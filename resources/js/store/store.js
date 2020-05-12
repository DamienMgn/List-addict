import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

const get = async function (url) {
    let response = await axios.get(url)

    return response
}

export const strict = false

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
        upCategory: function (state, {category}) {
            state.categories[category.id].name = category.name
            state.categories[category.id].color = category.color
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
        removeCards: function (state, {id, cards}) {
            cards.forEach(el => {
                state.categories[id].cards[el.id].order = el.order
            })
        }
    },
    actions: {
        loadCategories: async function (context) {
            try {
                let response = await get('/api/categories')
                context.commit('addCategories', {categories: response.data.categories})
            } catch(error) {
                context.commit('handleErrors', {errors: error.response.data.errors})
            }
        },
        insertCategory: async function (context, dataCategory) {
            try {
                let response = await axios.post('/api/add-category', {
                    name: dataCategory.categoryName,
                    color: dataCategory.categoryColor
                })
                context.commit('addCategory', {category: response.data.category})
            } catch(error) {
                context.commit('handleErrors', {errors: error.response.data.errors})
            }
        },
        deleteCategory: async function (context, id) {
            try {
                let response = await axios.post('/api/delete/category/' + id)
                context.commit('removeCategory', response.data.categoryId)
            } catch (error) {
                context.commit('handleErrors', {errors: error.response.data.errors})
            }
        },
        loadCards: async function (context, id) {
            try {
                let response = await get('/api/cards/' + id)
                context.commit('addCards', {id: id, cards: response.data.cards})
            } catch (error) {
                context.commit('handleErrors', {errors: error.response.data.errors})
            }
        },
        insertCard: async function (context, cardData) {
            try {
                let response = await axios.post('/api/add-card/' + cardData.categoryId, {
                    cardName: cardData.cardName,
                    cardColor: cardData.cardColor
                })
                context.commit('addCard', {card: response.data.card})
            } catch (error) {
                context.commit('handleErrors', {errors: error.response.data.errors})
            }
        },
        updateCard: async function (context, data) {
            let cardData = data.value
            try {
                let response = await axios.post('/api/update/card/' + cardData.cardId + '/' + cardData.categoryId, {
                    cardName: cardData.cardName,
                    cardColor: cardData.cardColor
                })
                context.commit('addCard', {card: response.data.card})
            } catch (error) {
                context.commit('handleErrors', {errors: error.response.data.errors})
            }
        },
        deleteCard: async function (context, cardData) {
            try {
                let response = await axios.post('/api/delete/card/' + cardData.cardId + '/' + cardData.categoryId)
                context.commit('removeCard', {card: response.data.card})
            } catch (error) {
                context.commit('handleErrors', {errors: error.response.data.errors})
            }
        },
        insertTask: async function (context, data) {
            let taskData = data.value
            try {
                let response = await axios.post('/api/add-task/' + taskData.cardId + '/' + taskData.categoryId, {
                    taskName: taskData.taskName,
                    taskColor: taskData.taskColor
                })
                context.commit('addCard', {card: response.data.card})
            } catch (error) {
                context.commit('handleErrors', {errors: error.response.data.errors})
            }
        },
        deleteTask: async function (context, data) {
            let taskData = data.value
            try {
                let response = await axios.post('/api/delete/task/' + taskData.taskId + '/' + taskData.cardId + '/' + taskData.categoryId)
                context.commit('addCard', {card: response.data.card})
            } catch (error) {
                context.commit('handleErrors', {errors: error.response.data.errors})
            }
        },
        updateTask: async function (context, data) {
            let taskData = data.value
            try {
                let response = await axios.post('/api/update/task/' + taskData.taskId + '/' + taskData.cardId + '/' + taskData.categoryId, {
                    status: taskData.checkbox,
                    taskColor: taskData.taskColor,
                    taskName: taskData.taskName
                })
                context.commit('addCard', {card: response.data.card})
            } catch (error) {
                context.commit('handleErrors', {errors: error.response.data.errors})
            }
        },
        updateCategory: async function (context, categoryData) {
            try {
                let response = await axios.post('/api/update/category/' + categoryData.categoryId, {
                    color: categoryData.categoryColor,
                    name: categoryData.categoryName
                })
                context.commit('upCategory', {category: response.data.category})
            } catch (error) {
                context.commit('handleErrors', {errors: error.response.data.errors})
            }
        },
        updateTaskCard: async function (context, taskData) {
            try {
                let response = await axios.post('/api/update/task/card/' + taskData.taskId + '/' + taskData.cardId + '/' + taskData.categoryId)
                context.commit('addCard', {card: response.data.oldCard})
                context.commit('addCard', {card: response.data.newCard})
            } catch (error) {
                context.commit('handleErrors', {errors: error.response.data.errors})
            }
        },
        updateCardsOrder: async function (context, cardsData) {
                let cards = {}
                cardsData.newCardsOrder.forEach((element, index) => {cards[element.id] = {id: element.id, order: index + 1}})
                let response = await axios.post('/api/update/cards/order/' + cardsData.categoryId, {
                    cards : cards
                })
                context.commit('removeCards', {id: cardsData.categoryId, cards: response.data.cards})
        }
    }
})
