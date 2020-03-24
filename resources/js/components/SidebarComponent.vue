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
                        <button class="btn categories-form-btn" type="button" data-toggle="modal" data-target="#modal-add-category">+ Nouveau projet</button>
                    </div>
                    <ul class="categories-scroll-container">
                        <ModalCategory @add="addCategory" :title="'Ajouter un projet'"></ModalCategory>
                        <div class="category-link-container" v-for="category in categories">
                        <ModalCategory @update="updateCategory" :title="'Midifier le projet'" :category="category.id" :type="'update'"></ModalCategory>
                            <router-link class="link category-link" :to="{name: 'categorie', params: {id: category.id}}">
                                {{category.name}}
                            </router-link>
                            <dropdown @delete="deleteCategory" :category="category.id" :color="'white'" :type="'category'"></dropdown>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import Dropdown from "./partials/Dropdown";
    import ModalCategory from "./partials/ModalCategory";

    export default {
        name: "SidebarComponent",
        components: {Dropdown, ModalCategory},
        data() {
            return {
                name: '',
            }
        },
        computed: {
            ...mapGetters(['categories']),
        },
        mounted() {
            this.$store.dispatch('loadCategories')
        },
        methods:{
            addCategory: function (value) {
                this.$store.dispatch('insertCategory', {
                    categoryName: value.categoryName,
                    categoryColor: value.categoryColor
                    })
            },
            deleteCategory: function (value) {
                this.$store.dispatch('deleteCategory', value.categoryId)
                this.$router.push({name: 'home'})
            },
            updateCategory: function (value) {
                this.$store.dispatch('updateCategory', {
                    categoryName: value.categoryName,
                    categoryColor: value.categoryColor,
                    categoryId: value.categoryId
                    })
            }
        }
    }
</script>
