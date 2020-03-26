<template>
    <div class="modal fade" :id="'modal-add-task' + card" tabindex="-1" role="dialog" aria-labelledby="updateCardModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit="update">
                    <div class="modal-body">
                        <input class="form-control" type="text" placeholder="Nom de la carte" name="task" v-bind:value="cardName">
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
        props: ['title', 'card', 'category'],
        data () {
            return {
                cardName: ''
            }
        },
        computed: {
            modalId: function () {
                let id = 'task' + this.task + this.card + this.category
                return id
            }
        },
        methods: {
            update: function (e) {
                e.preventDefault()
                this.$emit('add', {
                    cardId: this.card,
                    categoryId: this.category,
                    taskName: e.target.task.value,
                    taskColor: e.target.color.value
                    })
                $('#modal-add-task' + this.card).modal('toggle')
                $('.modal-backdrop').remove()
            },
            destroy: function () {
                this.$destroy();
            }
        }
    }
</script>

<style scoped>

</style>
