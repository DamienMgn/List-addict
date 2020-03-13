<template>
    <div class="cards-container">
        {{ this.$route.params.id }}
        <ul v-for="card in categories[this.$route.params.id].cards">
            <li>{{card.name}}</li>
        </ul>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        
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
        }
    }
</script>
