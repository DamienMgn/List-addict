<template>
    <div class="modal fade" id="modal-add-category" tabindex="-1" role="dialog" aria-labelledby="updateCategoryModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier la carte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit="add">
                    <div class="modal-body">
                        <input class="form-control" type="text" placeholder="Nom du projet" name="category" v-bind:value="categoryName">
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
        props: ['title', 'card', 'category', 'type'],
        data () {
            return {
                categoryName: ''
            }
        },
        computed: {
            modalId: function () {
                let id = 'card' + this.card + this.category
                return id
            }
        },
        methods: {
            add: function (e) {
                e.preventDefault()
                this.$emit('add', {categoryName: e.target.category.value, categoryColor: e.target.color.value})
                $('#modal-add-category').modal('toggle');
            }
        }
    }
</script>

<style scoped>

</style>