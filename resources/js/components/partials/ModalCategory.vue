<template>
      <div class="modal fade" id="modal-add-category">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">{{ title }}</h4>
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
                    let id = 'modal-add-category'

                    if (this.type === 'update') {
                        id = 'category' + this.category
                    }

                    return id
            }
        },
        methods: {
            add: function (e) {
                e.preventDefault()

                if (this.type === 'update') {
                    this.$emit('update', {
                        categoryName: e.target.category.value,
                        categoryColor: e.target.color.value,
                        categoryId: this.category
                        })
                } else {
                    this.$emit('add', {
                        categoryName: e.target.category.value,
                        categoryColor: e.target.color.value})
                }

                $('#' + this.modalId).modal('toggle');
                $('.modal-backdrop').remove();
            }
        }
    }
</script>

<style scoped>

</style>
