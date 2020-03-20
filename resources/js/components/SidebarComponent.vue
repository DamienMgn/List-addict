<template>
    <div class="categories-container">
        <h2 class="sidebar-brand">List Addict</h2>
        <div>
            <ul class="sidebar-title-ul">
                <li class="sidebar-title-li">
                    <img class="sidebar-title-img" alt="multiple-choices" src="../../img/home-icon.svg"/>
                    <router-link class="sidebar-link-title" :to="{name: 'home'}">
                        <h5 class="sidebar-title">Accueil</h5>
                    </router-link>
                </li>
                <li class="sidebar-title-li">
                    <img class="sidebar-title-img" alt="multiple-choices" src="../../img/list.svg"/>
                    <router-link class="sidebar-link-title" :to="{name: 'home'}">
                        <h5 class="sidebar-title">Tâches</h5>
                    </router-link>
                </li>
                <li>
                    <div class="sidebar-title-li">
                        <img class="sidebar-title-img" alt="multiple-choices" src="../../img/light.svg"/>
                        <router-link class="sidebar-link-title" :to="{name: 'home'}">
                            <h5 class="sidebar-title">Projets</h5>
                        </router-link>
                    </div>
                    <div class="categories-form-container">
                        <form v-if="isVisible" @submit="addCategory" method="post" class="categories-form">
                            <input type="text" class="categories-form-input" id="name" name="name" v-bind:value="name">
                            <div class="btn-add-category">
                                <button class="btn cancel" type="button" @click="toggleFormCategory">Annuler</button>
                                <input class="btn submit"type="submit">
                            </div>
                        </form>
                        <button v-if="!isVisible" @click="toggleFormCategory" class="btn categories-form-btn">+ projet</button>
                    </div>
                    <ul class="categories-scroll-container">
                        <li class="category-link-container" v-for="categorie in categories">
                            <router-link class="link category-link" :to="{name: 'categorie', params: {id: categorie.id}}">
                                {{categorie.name}}
                            </router-link>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm btn-dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="category-manage-btn"><img alt="multiple-choices" src="../../img/more-options.svg"/></span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item btn-delete" href="#" @click="deleteCategory" :data-id="categorie.id">Delete</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Couleur</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        name: "SidebarComponent",
        data() {
            return {
                name: '',
                isVisible: false
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
                this.toggleFormCategory()
                this.$store.dispatch('insertCategory', e.target.name.value)
            },
            deleteCategory: function (e) {
                this.$store.dispatch('deleteCategory', e.toElement.dataset.id)
                this.$router.push({name: 'home'})
            },
            toggleFormCategory: function () {
                if (this.isVisible) {
                    this.isVisible = false
                } else {
                    this.isVisible = true
                }
            },
        }
    }
</script>
