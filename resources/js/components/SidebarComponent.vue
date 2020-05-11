<template>
<div>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <div class="brand-link">
      <img src="dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">List Addict</span>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/avatar3.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Name</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview">
            <router-link :to="{name: 'home'}" href="#" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Accueil
              </p>
            </router-link>
          </li>
          <li class="nav-item has-treeview">
            <a class="nav-link">
              <i class="nav-icon fas fa-list-ul"></i>
              <p>
                Projets
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item" v-for="category in categories" :key="category.id">
                <router-link :to="{name: 'categorie', params: {id: category.id}}" class="nav-link">
                  <i class="far fa-circle nav-icon" :style="{color: category.color}"></i>
                  <p>{{ category.name }}</p>
                </router-link>
              </li>
                <li class="nav-item li-add-category">
                    <a class="nav-link" data-toggle="modal" data-target="#modal-add-category">
                        <i class="nav-icon fas fa-plus"></i>
                        <p>Ajouter un projet</p>
                    </a>
                </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
    <Modal
      :type="'category'"
      :title="'Nouveau Projet'"
      @add="addCategory"
      :id="'modal-add-category'">
    </Modal>
    <div v-for="category in categories">
        <Modal
            :category="category.id"
            :type="'updateCategory'"
            :title="'Modifier la catégorie'"
            @update="updateCategory"
            :id="'modal-update-category' + category.id">
        </Modal>
    </div>
</div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import Modal from "./partials/Modal";

    export default {
        name: "SidebarComponent",
        components: {Modal},
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
                $('#modal-add-category').find("input[type=text]").val('');
            },
            updateCategory: function (value) {
                console.log(value)
                this.$store.dispatch('updateCategory', {
                    categoryName: value.categoryName,
                    categoryColor: value.categoryColor,
                    categoryId: value.categoryId
                })
            }
        }
    }
</script>
