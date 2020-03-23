<template>
    <div>
        <ul class="card-body-ul">
            <li v-for="task in card.tasks" >
                <ModalTask @update="updateTask" :card="card.id" :category="card.category_id" :task="task.id"></ModalTask>
                <div class="card-body-li" v-bind:style="{borderColor: task.color}">
                    <div class="task-header">
                        <p class="task-name">{{ task.name }}</p>
                        <dropdown @delete="deleteTask" :card="card.id" :category="card.category_id" :task="task.id" :color="'black'" :type="'task'"></dropdown>
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
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    import Dropdown from "./partials/Dropdown";
    import ModalTask from "./partials/ModalTask";
    
    export default {
        name: "TaskComponent",
        components: {Dropdown, ModalTask},
        props: ["card"],
        methods:{
            deleteTask: function (value) {
                this.$store.dispatch('deleteTask',
                    {
                        cardId: value.cardId,
                        categoryId: value.categoryId,
                        taskId: value.taskId})
            },
            updateTask: function (value) {
                this.$store.dispatch('updateTask',
                    {
                        taskColor: value.taskColor,
                        cardId: value.cardId,
                        categoryId: value.categoryId,
                        taskId: value.taskId,
                        taskName: value.taskName
                    })
            },
            updateTaskStatus: function (e) {
                this.$store.dispatch('updateTask',
                    {
                        checkbox: e.target.checked,
                        cardId: e.target.dataset.card,
                        categoryId: e.target.dataset.category,
                        taskId: e.target.dataset.task
                    })
            }
        }
    }
</script>
