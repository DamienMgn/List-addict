<template>
    <div v-if="tasks !== undefined">
        <ContentComponent></ContentComponent>
        <div class="plannings-container">
            <div class="planning-container">
                <h3 class="planning-title">En retard</h3>
                <ul class="planning-container">
                    <li v-for="task in tasks.past" :key="task.id" :data-id="task.id">
                        <TaskComponent :task="task"></TaskComponent>
                    </li>
                </ul>
            </div>
            <div class="planning-container">
                <h3 class="planning-title">Aujourd'hui</h3>
                <ul class="planning-container last">
                    <li v-for="task in tasks.today" :key="task.id" :data-id="task.id">
                        <TaskComponent :task="task"></TaskComponent>
                    </li>
                </ul>
            </div>
            <div class="planning-container">
                <h3 class="planning-title">Demain</h3>
                <ul class="planning-container last">
                    <li v-for="task in tasks.tomorrow" :key="task.id" :data-id="task.id">
                        <TaskComponent :task="task"></TaskComponent>
                    </li>
                </ul>
            </div>
            <div class="planning-container">
                <h3 class="planning-title">A venir</h3>
                <ul class="planning-container last">
                    <li v-for="task in tasks.next" :key="task.id" :data-id="task.id">
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
            ...mapGetters(['tasks', 'errors']),
        },
        mounted () {
            //this.$store.dispatch('loadTasks');
            console.log('mounted')
        },
    }
</script>
