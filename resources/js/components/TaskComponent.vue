<template>
    <div class="task-container" :class="{'checked' : task.status}" :style="{borderLeftColor: task.color}">
        <div class="task-header">
            <p class="task-name">{{ task.name }}</p>
            <div class="dropdown dropdown-category-main" >
                <a class="btn-dropdown dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true" @click="toggleDropdown">
                    <i class="fa fa-ellipsis-v"></i>
                </a>
                <ul class="dropdown-menu" v-if="dropdownStatus">
                    <li role="presentation">
                        <form @submit="deleteTask">
                            <input type="hidden" name="task" :value="task.id">
                            <input type="hidden" name="card" :value="card.id">
                            <input type="hidden" name="category" :value="card.category_id">
                            <button class="btn-delete-task btn btn-box-tool" data-widget="remove">Supprimer</button>
                        </form>
                    </li>
                    <li role="presentation" @click="toggleDropdown">
                        <a data-toggle="modal" :data-target="'#modal-update-task' + task.id" role="menuitem" tabindex="-1" href="#">Modifier</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="task-footer">
            <p class="task-date">
                {{ new Date(task.created_at).getDate() }}/{{ new Date(task.created_at).getMonth() + 1 }}/{{ new Date(task.created_at).getFullYear() }}
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
            deleteTask: function (e) {
                this.toggleDropdown()
                e.preventDefault()
                this.$store.dispatch('deleteTask',
                    {
                        cardId: e.target.card.value,
                        categoryId: e.target.category.value,
                        taskId: e.target.task.value
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
            },
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
