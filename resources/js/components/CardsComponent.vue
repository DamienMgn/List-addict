<template>
    <div>
        <div class="cards-main-container">
            <div class="cards-container-header">
                <h3 class="cards-header-title">{{ categories[this.$route.params.id].name }}</h3>
                <button class="btn btn-add-card" type="button" data-toggle="modal" data-target="#add-card-modal">+ Nouvelle carte</button>
            </div>
            <div class="cards-container">
                <div v-for="card in categories[this.$route.params.id].cards">
                    <CardComponent v-bind:card="card"></CardComponent>
                </div>
            </div>
        </div>
        <button class="btn btn-add-card" type="button" data-toggle="modal" data-target="#add-card-modal">+ Nouvelle carte</button>
        <div class="modal fade" id="add-card-modal" tabindex="-1" role="dialog" aria-labelledby="addCardModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter une carte</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit="addCard" method="post">
                        <div class="modal-body">
                            <input class="form-control" type="text" placeholder="Nom de la carte" id="card" name="card" v-bind:value="cardName">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn cancel" data-dismiss="modal">Annuler</button>
                            <input type="submit" class="btn submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import CardComponent from './CardComponent.vue'

    export default {
        components: {
            CardComponent,
        },
        data() {
            return {
                cardName: ''
            }
        },
        mounted () {
            this.$store.dispatch('loadCards', this.$route.params.id)
        },
        computed: {
            ...mapGetters(['categories'])
        },
        watch: {
            $route(to, from) {
                this.$store.dispatch('loadCards', this.$route.params.id)
            }
        },
        methods: {
            addCard: function(e) {
                e.preventDefault()
                this.$store.dispatch('insertCard', {cardName: e.target.card.value, categoryId: this.$route.params.id})
                $('#add-card-modal').modal('toggle');
            }
        }
    }
</script>
