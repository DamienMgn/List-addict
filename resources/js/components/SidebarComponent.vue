<template>
    <div class="categories-container">
        <div class="categories-form-container">
            <form @submit="addCategory" method="post" class="categories-form">
                <input type="text" class="categories-form-input" id="name" name="name" v-bind:value="name">
                <input type="submit" class="btn categories-form-btn" value="Ajouter">
            </form>
        </div>
        <div class="categories-scroll-container">
            <div class="category-link-container" v-for="categorie in categories">
                <router-link class="link category-link" :to="{name: 'categorie', params: {id: categorie.id}}">
                            {{categorie.name}}
                </router-link>
                <div class="dropdown">
                    <button class="btn btn-secondary btn-sm btn-dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="../../img/more-options.svg"/>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item btn-delete" href="#" @click="deleteCategory" :data-id="categorie.id">Delete</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Couleur</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        name: "SidebarComponent",
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
            addCategory: function (e) {
                e.preventDefault()
                this.$store.dispatch('insertCategory', e.target.name.value)
            },
            deleteCategory: function (e) {
                this.$store.dispatch('deleteCategory', e.toElement.dataset.id)
                this.$router.push({name: 'home'})
            }
        }
    }
</script>
