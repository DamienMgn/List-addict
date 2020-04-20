<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 page-title">
                        <div class="dropdown dropdown-category-main" >
                            <a class="btn-dropdown dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true" @click="toggleDropdown">
                                <i class="nav-icon fas fa-th"></i>
                            </a>
                            <ul class="dropdown-menu" v-if="dropdownStatus" @click="toggleDropdown">
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="#" @click="$emit('delete', {categoryId: category})">Supprimer</a>
                                </li>
                                <li role="presentation">
                                    <a data-toggle="modal" :data-target="'#modal-update-category' + category" role="menuitem" tabindex="-1" href="#">Modifier</a>
                                </li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation">
                                    <a data-toggle="modal" data-target="#modal-add-card" role="menuitem" tabindex="-1" href="#">Ajouter une carte</a>
                                </li>
                            </ul>
                        </div>
                        <h1 class="m-0 text-dark">{{title}}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="alert alert-warning alert-dismissible" v-if="Object.entries(errors).length !== 0" v-for="(error, index) in errors">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{error[0]}}
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
</template>

<script>

    import {mapGetters} from 'vuex'

    export default {
        name: "ContentComponent",
        props: ['title', 'color', 'category'],
        data () {
            return {
                dropdownStatus: false
            }
        },
        computed: {
            ...mapGetters(['errors'])
        },
        methods: {
            toggleDropdown: function () {
                if (!this.dropdownStatus) {
                    this.dropdownStatus = true
                } else {
                    this.dropdownStatus = false
                }
            }
        }
    }
</script>

<style scoped>


</style>
