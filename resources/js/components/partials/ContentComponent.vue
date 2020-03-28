<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 page-title">
                        <div class="dropdown dropdown-category-main">
                            <a class="btn-dropdown-category dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true" @click="toggleDropdown">
                                <i class="nav-icon fas fa-th"></i>
                            </a>
                            <ul class="dropdown-menu" v-if="dropdownStatus">
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="#" @click="$emit('delete', {categoryId: category})">Supprimer</a>
                                </li>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="#">Another action</a>
                                </li>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="#">Something else here</a>
                                </li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="#">Separated link</a>
                                </li>
                            </ul>
                        </div>
                        <h1 class="m-0 text-dark">{{title}}</h1>
                        <button class="btn-add-card btn btn-box-tool" data-toggle="modal" data-target="#modal-add-card" :style="{backgroundColor: color}">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
</template>

<script>
    export default {
        name: "ContentComponent",
        props: ['title', 'color', 'category'],
        data () {
            return {
                dropdownStatus: false
            }
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
