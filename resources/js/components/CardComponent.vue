<template>
    <div class="card-container">
        <header class="card-header">
            <h5 class="card-title">{{card.name}}</h5>
            <div class="dropdown manage-card-container">
                <button class="btn btn-secondary btn-sm dropdown-toggle btn-dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                <div class="dropdown-menu">
                    <button class="dropdown-item btn-delete" @click="deleteCard" :data-card="card.id" :data-category="card.category_id">Delete</button>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Couleur</a>
                </div>
            </div>
        </header>
        <div class="card-body">
            <ul v-for="task in card.tasks">
                <li>{{ task.name }}</li>
            </ul>
        </div>
        <button class="btn btn-add-task" @click="toggleFormTask" type="button" data-target="#add-card-modal" v-if="!isVisible">New</button>
        <form v-if="isVisible" @submit="toggleFormTask">
            <input type="text">
            <input type="submit">
            <button class="" type="button" data-target="#add-card-modal" @click="toggleFormTask">Annuler</button>
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
            }
        }
    }
</script>
