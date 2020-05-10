<template>
    <div class="modal fade" :id="id" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-modal" v-if="this.type === 'updateTask'" @submit="deleteTask">
                    <div class="form-group delete-form">
                        <label class="form-modal-label">Supprimer la tâche</label>
                        <input type="submit" class="btn delete form-control" value="Supprimer">
                    </div>
                </form>
                <form class="form-modal" @submit="actionToDo">
                    <div class="form-group">
                        <label class="form-modal-label">Nom</label>
                        <input autocomplete="off" class="form-control" type="text" placeholder="Nom" :name="type" v-bind:value="name">
                    </div>
                    <div class="form-group" v-if="isNotTask && isNotTaskUpdate">
                        <label class="form-modal-label">Définir une couleur</label>
                        <ColorPicker></ColorPicker>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn cancel" data-dismiss="modal">Annuler</button>
                        <input type="submit" class="btn submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

    import ColorPicker from './ColorPicker'

    export default {
        name: "modal",
        components: {ColorPicker},
        props: ['title', 'card', 'category', 'task', 'type', 'id'],
        data () {
            return {
                name: '',
            }
        },
        computed: {
            isNotTask: function () {
                return this.type !== 'task'
            },
            isNotTaskUpdate: function () {
                return this.type !== 'updateTask'
            },
        },
        methods: {
            actionToDo: function (e) {
                e.preventDefault()

                if (this.id === 'modal-add-card') {
                    this.$emit('add', {
                        cardName: e.target.card.value,
                        cardColor: e.target.color.value,
                        categoryId: this.category})
                }

                if (this.type === 'task') {
                    this.$emit('add', {
                        cardId: this.card,
                        categoryId: this.category,
                        taskName: e.target.task.value,
                        taskColor: '#FFFFFF'
                    })
                }

                if (this.id === 'modal-add-category') {
                    this.$emit('add', {
                        categoryName: e.target.category.value,
                        categoryColor: e.target.color.value})
                }

                if (this.type === 'updateCategory') {
                    this.$emit('update', {
                        categoryName: e.target.updateCategory.value,
                        categoryColor: e.target.color.value,
                        categoryId: this.category
                    })
                }

                if (this.type === 'updateCard') {
                    this.$emit('update', {
                        cardName: e.target.updateCard.value,
                        cardColor: e.target.color.value,
                        categoryId: this.category,
                        cardId: this.card
                    })
                }

                if (this.type === 'updateTask') {
                    this.$emit('update', {
                        taskName: e.target.updateTask.value,
                        taskColor: '#FFFFFF',
                        categoryId: this.category,
                        cardId: this.card,
                        taskId: this.task
                    })
                }

                $('#' + this.id).modal('toggle');
                $('.modal-backdrop').remove();
            },
            deleteTask: function(e) {
                e.preventDefault();
                this.$emit('delete', {
                    categoryId: this.category,
                    cardId: this.card,
                    taskId: this.task
                })
                $('#' + this.id).modal('toggle');
                $('.modal-backdrop').remove();
            }
        }
    }
</script>

<style scoped>

</style>
