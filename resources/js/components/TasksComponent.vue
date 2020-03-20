<template>
    <div>
        <ul class="card-body-ul">
            <li v-for="task in card.tasks" class="card-body-li">
                <div class="task-header">
                    <p class="task-name">{{ task.name }}</p>
                    <div class="dropdown manage-task-container">
                        <button class="btn-sm btn-dropdown task-manage-btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class=""><img alt="multiple-choices" src="../../img/more-options-black.svg"/></span>
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item btn-delete" @click="deleteTask" :data-task="task.id" :data-card="card.id" :data-category="card.category_id">Delete</button>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Couleur</a>
                        </div>
                    </div>
                </div>
                <div class="task-footer">
                    <p class="task-date">création : {{ new Date(task.created_at).getDate() }}/{{ new Date(task.created_at).getMonth() + 1 }}/{{ new Date(task.created_at).getFullYear() }}</p>
                    <input @change="updateTaskStatus" class="task-form-checkbox" type="checkbox" v-model="task.status" :data-task="task.id" :data-card="card.id" :data-category="card.category_id" >
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "TaskComponent",
        props: ["card"],
        methods:{
            deleteTask: function (e) {
                this.$store.dispatch('deleteTask',
                    {
                        cardId: e.target.dataset.card,
                        categoryId: e.target.dataset.category,
                        taskId: e.target.dataset.task})
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
