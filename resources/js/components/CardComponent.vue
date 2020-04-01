<template>
    <div>
        <div class="card-container">
            <div class="card-header" :style="{backgroundColor: card.color}">
                <h4 class="card-title">{{ card.name }}</h4>
                <form class="card-form-delete" @submit="deleteCard">
                    <input type="hidden" name="card" :value="card.id">
                    <input type="hidden" name="category" :value="card.category_id">
                    <button type="submit" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    <a data-toggle="modal" :data-target="'#modal-update-card' + card.id" class="btn btn-box-tool" ><i class="fas fa-pen"></i></a>
                </form>
            </div>
            <div class="card-body">
                <ul class="tasks-container">
                    <li v-for="task in card.tasks">
                        <TaskComponent :task="task" :card="card"></TaskComponent>
                    </li>
                </ul>
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

    export default {
        name: "CardComponent",
        components: {
            TaskComponent,
            Modal
        },
        props: ['card'],
        data() {
            return {
                isVisible: false,
                name: ''
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
            },
            updateTask: function (value) {
                console.log('hihihihii')
                console.log(value)
                this.$store.dispatch('updateTask',
                    {
                        taskColor: value.taskColor,
                        cardId: value.cardId,
                        categoryId: value.categoryId,
                        taskId: value.taskId,
                        taskName: value.taskName
                    })
            },
        }
    }
</script>

