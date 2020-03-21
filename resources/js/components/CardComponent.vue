<template>
    <div class="card-container">
        <header class="card-header">
            <h5 class="card-title">{{card.name}}</h5>
            <dropdown @delete="deleteCard" :card="card.id" :category="card.category_id" :color="'black'"></dropdown>
        </header>
        <div class="card-body">
            <tasks-component v-bind:card="card"></tasks-component>
        </div>
        <div class="form-add-task-container">
            <button class="btn btn-add-task" @click="toggleFormTask" type="button" data-target="#add-card-modal" v-if="!isVisible">+ Tâche</button>
            <form class="form-add-task" v-if="isVisible" @submit="addTask" :data-card="card.id" :data-category="card.category_id">
                <div class="form-add-task-input-container">
                    <input autocomplete="off" class="form-add-task-input" type="text" name="task" id="task" v-bind:value="name">
                </div>
                <div class="buttons-add-task">
                    <button class="btn cancel" type="button" data-target="#add-card-modal" @click="toggleFormTask">Annuler</button>
                    <input class="btn submit"type="submit">
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import TasksComponent from "./TasksComponent";
    import Dropdown from "./layout/dropdown";
    export default {
        name: "CardComponent",
        components: {Dropdown, TasksComponent},
        props: ['card'],
        data() {
            return {
                isVisible: false,
                name: ''
            }
        },
        methods:{
            deleteCard: function (value) {
                this.$store.dispatch('deleteCard', {cardId: value.cardId, categoryId: value.categoryId})
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
