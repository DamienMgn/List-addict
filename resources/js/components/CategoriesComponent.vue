<template>
    <div class="categories-container">
        <div class="categories-form-container">
            <form @submit="checkForm" method="post" class="categories-form">
                <input type="text" class="categories-form-input" id="name" name="name" v-bind:value="name">
                <input type="submit" class="btn categories-form-btn" value="Ajouter">
            </form>
        </div>
        <div class="categories-scroll-container">
            <div class="category-link-container" v-for="categorie in categories">
                <router-link class="link category-link" :to="{name: 'categorie', params: {id: categorie.id}}">
                            {{categorie.name}}
                </router-link>
                <i class="icon-trash"></i>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        data() {
            return {
                name: ''
            }
        },
        computed: {
            ...mapGetters(['categories'])
        },
        mounted() {
            this.$store.dispatch('loadCategories')
        },
        methods:{
            checkForm: function (e) {
                e.preventDefault()
                this.$store.dispatch('insertCategory', e.target.name.value)
            }
        }
    }
</script>
