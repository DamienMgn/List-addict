<template>
    <div class="modal fade" :id="id" tabindex="-1" role="dialog" aria-labelledby="updateCardModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit="actionToDo">
                    <div class="modal-body">
                        <input class="form-control" type="text" placeholder="Nom de la carte" :name="type" v-bind:value="name">
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
        props: ['title', 'card', 'category', 'type', 'id'],
        data () {
            return {
                name: '',
            }
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
                        taskColor: e.target.color.value
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

                $('#' + this.id).modal('toggle');
                $('.modal-backdrop').remove();
            }
        }
    }
</script>

<style scoped>

</style>
