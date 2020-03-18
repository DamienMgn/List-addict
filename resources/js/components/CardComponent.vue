<template>
    <div class="card-container">
        <header class="card-header">
            <h5 class="card-title">{{card.name}}</h5>
            <div class="dropdown manage-card-container">
                <button class="btn btn-secondary btn-sm btn-dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="../../img/more-options.svg"/>
                </button>
                <div class="dropdown-menu">
                    <button class="dropdown-item btn-delete" @click="deleteCard" :data-card="card.id" :data-category="card.category_id">Delete</button>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Couleur</a>
                </div>
            </div>
        </header>
        <div class="card-body">
            <ul class="card-body-ul">
                <li v-for="task in card.tasks" class="card-body-li">{{ task.name }}</li>
            </ul>
        </div>
        <button class="btn btn-add-task" @click="toggleFormTask" type="button" data-target="#add-card-modal" v-if="!isVisible">New</button>
        <form class="form-add-task" v-if="isVisible" @submit="addTask" :data-card="card.id" :data-category="card.category_id">
            <div class="form-add-task-input-container">
                <input class="form-add-task-input" type="text" name="task" id="task" v-bind:value="name">
            </div>
            <div class="form-add-task-buttons">
                <button class="form-add-task-button" type="button" data-target="#add-card-modal" @click="toggleFormTask">Annuler</button>
                <input class="form-add-task-button"type="submit">
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "CardComponent",
        props: ['card'],
        data() {
            return {
                isVisible: false,
                name: ''
            }
        },
        methods:{
            deleteCard: function (e) {
                this.$store.dispatch('deleteCard', {cardId: e.target.dataset.card, categoryId: e.target.dataset.category})
            },
            toggleFormTask: function () {
                if (this.isVisible) {
                    this.isVisible = false
                } else {
                    this.isVisible = true
                }
            },
            addTask: function (e) {
                e.preventDefault()
                this.$store.dispatch('insertTask', {
                    taskName: e.target.task.value,
                    categoryId: e.target.dataset.category,
                    cardId: e.target.dataset.card
                })
            }
        }
    }
</script>
