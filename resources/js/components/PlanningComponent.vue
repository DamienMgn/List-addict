<template>
    <div v-if="tasks !== undefined">
        <ContentComponent></ContentComponent>
        <div class="planning-container">
            <div class="planning last">
                <h6>{{pastDays}}</h6>
                <p v-for="task in tasks" v-if="new Date(task.deadline).getTime() < pastDays">{{task.name}} / {{task.deadline}}</p>
            </div>
            <div class="planning today">
                <h6>{{today}}</h6>
                <p v-for="task in tasks" v-if="new Date(task.deadline).getTime() > pastDays && new Date(task.deadline) < tomorrow">{{task.name}} / {{task.deadline}}</p>
            </div>
            <div class="planning tomorrow">
                <h6>{{tomorrow}}</h6>
                <p v-for="task in tasks" v-if="new Date(task.deadline).getTime() > today && new Date(task.deadline) < nextDays">{{task.name}} / {{task.deadline}}</p>
            </div>
            <div class="planning few">
                <h6>{{nextDays}}</h6>
                <p v-for="task in tasks" v-if="new Date(task.deadline).getTime() > nextDays">{{task.name}} / {{task.deadline}}</p>
            </div>
        </div>
    </div>
</template>

<script>
    import ContentComponent from './partials/ContentComponent';
    import {mapGetters} from 'vuex';

    export default {
        components: {
            ContentComponent,
        },
        computed: {
            ...mapGetters(['tasks']),
            ...mapGetters(['errors']),
            today: function () {
                return new Date().getTime();
            },
            pastDays: function () {
                let date = new Date();
                let pastDays = new Date(date.setDate(date.getDate() - 1)).getTime()
                return pastDays
            },
            tomorrow: function () {
                let date = new Date();
                let tomorrow = new Date(date.setDate(date.getDate() + 1)).getTime()
                return tomorrow
            },
            nextDays: function () {
                let date = new Date();
                let nextDays = new Date(date.setDate(date.getDate() + 2)).getTime()
                return nextDays
            }
        },
        mounted () {
            this.$store.dispatch('loadTasks')
        },
    }
</script>
