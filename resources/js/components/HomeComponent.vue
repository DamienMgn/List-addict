<template>
    <div class="dashboard-container">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Tableau de bord</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th class="head-dashboard">#</th>
                            <th class="head-dashboard">Projet</th>
                            <th class="head-dashboard">Date Création</th>
                            <th class="head-dashboard">Cartes</th>
                            <th class="head-dashboard">Progression</th>
                        </tr>
                        <tr v-for="category in categories">
                            <td>{{ category.id }}</td>
                            <td>
                                <router-link :to="{name: 'categorie', params: {id: category.id}}" class="dashboard-link">
                                    {{ category.name }}
                                </router-link>
                            </td>
                            <td>{{ new Date(category.created_at).getDate() }}/{{ new Date(category.created_at).getMonth() + 1 }}/{{ new Date(category.created_at).getFullYear() }}</td>
                            <td class="dashboard-cards-container">
                                <div class="dashboard-card" v-for="card in category.cards" :keys="card.id" :style="{backgroundColor: card.color}">
                                    {{ Object.keys(card.tasks).length }}
                                </div>
                            </td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger" :style="{width: calulatePercentage(category.id)}"></div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "HomeComponent",
        computed: {
            ...mapGetters(['categories']),
        },
        mounted: async function () {
            let response = await axios.get('api/categories')
            response.data.categories.forEach(el => this.$store.dispatch('loadCards', el.id))
        },
        methods: {
            calulatePercentage: function (id) {

                if (this.newCategories !== undefined) {

                    let tasks = []

                    Object.values(this.newCategories[id].cards).forEach(card => card.tasks.forEach(task => tasks.push(task)))

                    if (tasks.length > 0) {
                        let tasksTrue = tasks.filter(el => el.status === 1)

                        let percentage = Math.floor(tasksTrue.length / tasks.length * 100) + '%'

                        return percentage
                    } else {
                        return ''
                    }
                }
            }
        }
    }
</script>
