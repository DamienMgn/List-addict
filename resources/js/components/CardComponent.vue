<template>
    <div :key="card.id">
        <div class="card-container">
            <div class="card-header" :style="{backgroundColor: card.color}">
                <h4 class="card-title">{{ card.name }}</h4>
                <div class="card-form-delete">
                    <a class="btn-dropdown dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true" @click="toggleDropdown">
                        <i class="fa fa-ellipsis-v"></i>
                    </a>
                    <ul class="dropdown-menu" v-if="dropdownStatus">
                        <li role="presentation" >
                            <form @submit="deleteCard">
                                <input type="hidden" name="card" :value="card.id">
                                <input type="hidden" name="category" :value="card.category_id">
                                <button type="submit" class="btn-delete-task btn btn-box-tool">Supprimer</button>
                            </form>
                        </li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation">
                            <a class="btn btn-box-tool" data-toggle="modal" :data-target="'#modal-update-card' + card.id" @click="toggleDropdown">Modifier</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <draggable
                    :list="newTasksOrder.tasks"
                    class="tasks-container"
                    :animation="200"
                    :group="'status'"
                    :tag="'ul'"
                    v-on:change="updateTasksOrder"
                    v-on:add="updateTaskCard($event, card.id)">
                        <li v-for="task in newTasksOrder.tasks" :key="task.id" :data-id="task.id">
                            <TaskComponent :task="task" :card="card"></TaskComponent>
                        </li>
                </draggable>
            </div>
            <div class="card-footer">
                <div class="box-add-task box-header with-border">
                    <button type="button" class="btn btn-box-tool add-task" data-toggle="modal" :data-target="'#modal-add-task' + card.id">
                        <h4 class="box-title">Nouvelle tâche</h4>
                        <i class="fa fa-plus"></i>
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
                @delete="deleteTask"
                :card="card.id"
                :category="card.category_id"
                :task="task.id"
                :taskStatus="task.status"
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
                newTasksOrder: this.card,
                dropdownStatus: false
            }
        },
        watch: {
            card: function (newVal) {
                this.newTasksOrder = newVal
            }
        },
        methods:{
            deleteTask: function (value) {
                this.$store.dispatch('deleteTask', {value})
            },
            updateCard: function (value) {
                this.$store.dispatch('updateCard', {value})
            },
            addTask: function (value) {
                this.$store.dispatch('insertTask', {value});
                $('#modal-add-task').find("input[type=text]").val('');
            },
            updateTask: function (value) {
                this.$store.dispatch('updateTask', {value})
            },
            updateTasksOrder: async function () {
                let tasks = {}
                this.newTasksOrder.tasks.forEach((element, index) => tasks[element.id] = {id: element.id, order: index + 1})
                let response = await axios.post('/api/update/tasks/order/' + this.card.id + '/' + this.card.category_id, {
                    tasks : tasks
                })
            },
            deleteCard: function (e) {
                e.preventDefault();
                this.toggleDropdown();
                this.$store.dispatch('deleteCard', {
                    cardId: e.target.card.value,
                    categoryId: e.target.category.value
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

