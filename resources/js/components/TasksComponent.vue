<template>
    <div>
        <ul class="card-body-ul">
            <li v-for="task in card.tasks" class="card-body-li">
                <div class="task-header">
                    <p class="task-name">{{ task.name }}</p>
                    <dropdown @delete="deleteTask" :card="card.id" :category="card.category_id" :task="task.id" :color="'black'"></dropdown>
                </div>
                <div class="task-footer">
                    <p class="task-date">
                        {{ new Date(task.created_at).getDate() }}/{{ new Date(task.created_at).getMonth() + 1 }}/{{ new Date(task.created_at).getFullYear() }}
                    </p>
                    <input
                        @change="updateTaskStatus"
                        class="task-form-checkbox"
                        type="checkbox" v-model="task.status"
                        :data-task="task.id"
                        :data-card="card.id"
                        :data-category="card.category_id"
                    >
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    import Dropdown from "./layout/dropdown";
    export default {
        name: "TaskComponent",
        components: {Dropdown},
        props: ["card"],
        methods:{
            deleteTask: function (value) {
                this.$store.dispatch('deleteTask',
                    {
                        cardId: value.cardId,
                        categoryId: value.categoryId,
                        taskId: value.taskId})
            },
            updateTaskStatus: function (e) {
                this.$store.dispatch('updateTask',
                    {
                        checkbox: e.target.checked,
                        cardId: e.target.dataset.card,
                        categoryId: e.target.dataset.category,
                        taskId: e.target.dataset.task})
            }
        }
    }
</script>
