<template>
    <div class="dashboard-container">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Dashboard</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-striped">
                    <tbody><tr>
                        <th style="width: 10px">#</th>
                        <th>Projet</th>
                        <th>Date Création</th>
                        <th>Cartes</th>
                        <th style="width: 40px">Progression</th>
                    </tr>
                    <tr v-for="category in categories">
                        <td>{{ category.id }}</td>
                        <td>{{ category.name }}</td>
                        <td>{{ category.created_at }}</td>
                        <td>{{ category.cards }}</td>
                        <td><span class="badge bg-red">55%</span></td>
                    </tr>
                    </tbody></table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapState} from "vuex";

    export default {
        name: "HomeComponent",
        data () {
            return {
                categoriesToLoad: []
            }
        },
        computed: {
            ...mapGetters(['categories']),
        },
        mounted () {

        },
    }
</script>
