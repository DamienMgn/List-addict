<template>
    <div v-if="tasks !== undefined">
        <ContentComponent></ContentComponent>
        <div class="plannings-container">
            <div class="planning-container">
                <h3 class="planning-title">En retard</h3>
                <ul class="planning-container">
                    <li v-for="task in tasks" :key="task.id" :data-id="task.id">
                        <TaskComponent :task="task"></TaskComponent>
                    </li>
                </ul>
            </div>
            <div class="planning-container">
                <h3 class="planning-title">Aujourd'hui</h3>
                <ul class="planning-container last">
                    <li v-for="task in tasks" :key="task.id" :data-id="task.id">
                        <TaskComponent :task="task"></TaskComponent>
                    </li>
                </ul>
            </div>
            <div class="planning-container">
                <h3 class="planning-title">Demain</h3>
                <ul class="planning-container last">
                    <li v-for="task in tasks" :key="task.id" :data-id="task.id">
                        <TaskComponent :task="task"></TaskComponent>
                    </li>
                </ul>
            </div>
            <div class="planning-container">
                <h3 class="planning-title">A venir</h3>
                <ul class="planning-container last">
                    <li v-for="task in tasks" :key="task.id" :data-id="task.id">
                        <TaskComponent :task="task"></TaskComponent>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import ContentComponent from './partials/ContentComponent';
    import TaskComponent from "./TaskComponent";
    import {mapGetters} from 'vuex';

    export default {
        components: {
            ContentComponent,
            TaskComponent
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
