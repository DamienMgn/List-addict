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

        </div>
    </div>
</template>

<script>
    export default {
        name: "CardComponent",
        props: ['card'],
        methods:{
            deleteCard: function (e) {
                this.$store.dispatch('deleteCard', {cardId: e.target.dataset.card, categoryId: e.target.dataset.category})
            }
        }
    }
</script>
