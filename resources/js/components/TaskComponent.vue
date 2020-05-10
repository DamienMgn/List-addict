<template>
    <div class="task-container" :class="{'checked' : task.status}" :style="{borderLeftColor: task.color}">
        <div class="task-header">
            <p class="task-name">{{ task.name }}</p>
            <div class="dropdown dropdown-category-main" >
                <a class="btn-dropdown dropdown-toggle" data-toggle="modal" :data-target="'#modal-update-task' + task.id" role="menuitem" tabindex="-1" href="#">
                    <i class="fa fa-ellipsis-v"></i>
                </a>
            </div>
        </div>
        <div class="task-footer">
            <p class="task-date">
            </p>
            <input @change="updateTaskStatus" class="task-form-checkbox" type="checkbox" v-model="task.status" :data-task="task.id" :data-card="card.id" :data-category="card.category_id">
        </div>
    </div>
</template>

<script>

    export default {
        name: "TaskComponent",
        components: {},
        props: ['task', 'card'],
        data () {
            return {
                dropdownStatus: false
            }
        },
        methods:{
            updateTaskStatus: function (e) {
                this.$store.dispatch('updateTask',
                    {
                        checkbox: e.target.checked,
                        cardId: e.target.dataset.card,
                        categoryId: e.target.dataset.category,
                        taskId: e.target.dataset.task
                    })
            },
        }
    }
</script>
