<template>
    <div>
        <div class="task-header">
            <p class="task-name">{{ task.name }}</p>
            <form @submit="deleteTask">
                <input type="hidden" name="task" :value="task.id">
                <input type="hidden" name="card" :value="card.id">
                <input type="hidden" name="category" :value="card.category_id">
                <button type="submit" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </form>
        </div>
        <div class="task-footer">
            <p class="task-date">
                {{ new Date(task.created_at).getDate() }}/{{ new Date(task.created_at).getMonth() + 1 }}/{{ new Date(task.created_at).getFullYear() }}
            </p>
        </div>
    </div>
</template>

<script>
    import Dropdown from "./partials/Dropdown";
    import ModalTask from "./partials/ModalTask";

    export default {
        name: "TaskComponent",
        components: {Dropdown, ModalTask},
        props: ['task', 'card'],
        methods:{
            deleteTask: function (e) {
                e.preventDefault()
                this.$store.dispatch('deleteTask',
                    {
                        cardId: e.target.card.value,
                        categoryId: e.target.category.value,
                        taskId: e.target.task.value
                    })
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
