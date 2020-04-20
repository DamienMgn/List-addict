<template>
    <div :key="card.id">
        <div class="card-container">
            <div class="card-header" :style="{borderColor: card.color}">
                <h4 class="card-title">{{ card.name }}</h4>
                <form class="card-form-delete" @submit="deleteCard">
                    <input type="hidden" name="card" :value="card.id">
                    <input type="hidden" name="category" :value="card.category_id">
                    <button type="submit" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    <a data-toggle="modal" :data-target="'#modal-update-card' + card.id" class="btn btn-box-tool" ><i class="fas fa-pen"></i></a>
                </form>
            </div>
            <div class="card-body">
                <draggable
                    class="tasks-container"
                    :list="newTasksOrder.tasks"
                    :animation="200"
                    :group="'status'"
                    :tag="'li'"
                    v-on:change="updateTasksOrder"
                    v-on:add="updateTaskCard($event, card.id)">
                    <li v-for="task in newTasksOrder.tasks" :key="task.id" :data-id="task.id">
                        <TaskComponent :task="task" :card="card"></TaskComponent>
                    </li>
                </draggable>
            </div>
            <div class="card-footer">
                <div class="box-add-task box-header with-border">
                    <button type="button" class="btn btn-box-tool" data-toggle="modal" :data-target="'#modal-add-task' + card.id">
                        <h4 class="box-title" :style="{color: card.color}">Nouvelle tâche</h4>
                        <i :style="{color: card.color}" class="fa fa-plus"></i>
                    </button>
                    <!-- /.box-tools -->
                </div>
            </div>
        </div>
        <Modal
            :type="'task'"
            :title="'Ajouter une tâche'"
            :id="'modal-add-task' + card.id"
            @add="addTask"
            :card="card.id"
            :category="card.category_id"
        >
        </Modal>
        <Modal
            :type="'updateCard'"
            :title="'Modifier la carte'"
            :id="'modal-update-card' + card.id"
            @update="updateCard"
            :card="card.id"
            :category="card.category_id"
        >
        </Modal>
        <div v-for="task in card.tasks">
            <Modal
                :type="'updateTask'"
                :title="'Modifier la tâche'"
                :id="'modal-update-task' + task.id"
                @update="updateTask"
                :card="card.id"
                :category="card.category_id"
                :task="task.id"
            >
            </Modal>
        </div>
    </div>
</template>

<script>
    import TaskComponent from "./TaskComponent";
    import Modal from "./partials/Modal";
    import draggable from 'vuedraggable';


    export default {
        name: "CardComponent",
        components: {
            TaskComponent,
            Modal,
            draggable
        },
        props: ['card'],
        data() {
            return {
                isVisible: false,
                name: '',
                newTasksOrder: this.card
            }
        },
        watch: {
            card: function (newVal) {
                this.newTasksOrder = newVal
            }
        },
        methods:{
            deleteCard: function (e) {
                e.preventDefault()
                this.$store.dispatch('deleteCard', {
                    cardId: e.target.card.value,
                    categoryId: e.target.category.value
                })
            },
            updateCard: function (value) {
                this.$store.dispatch('updateCard', {
                    cardId: value.cardId,
                    categoryId: value.categoryId,
                    cardName: value.cardName,
                    cardColor: value.cardColor
                })
            },
            addTask: function (value) {
                this.$store.dispatch('insertTask', {
                    taskName: value.taskName,
                    taskColor: value.taskColor,
                    categoryId: value.categoryId,
                    cardId: value.cardId
                })
                $('#modal-add-task').find("input[type=text]").val('');
            },
            updateTasksOrder: async function () {
                let tasks = {}
                this.newTasksOrder.tasks.forEach((element, index) => tasks[element.id] = {id: element.id, order: index + 1})
                let response = await axios.post('/api/update/tasks/order/' + this.card.id + '/' + this.card.category_id, {
                    tasks : tasks
                })
            },
            updateTask: function (value) {
                this.$store.dispatch('updateTask', {
                        taskColor: value.taskColor,
                        cardId: value.cardId,
                        categoryId: value.categoryId,
                        taskId: value.taskId,
                        taskName: value.taskName
                    })
            },
            updateTaskCard: function (event, card) {
                let task = event.item.getAttribute('data-id');
                this.$store.dispatch('updateTaskCard', {
                        cardId: card,
                        categoryId: this.card.category_id,
                        taskId: task
                    })
            },
        }
    }
</script>

