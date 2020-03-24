<template>
    <div class="dropdown">
        <button class="btn-sm btn-dropdown btn-dropdown-task" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img :src="require(`../../../img/more-options-${color}.svg`)" alt="multiple-choices"/>
        </button>
        <div class="dropdown-menu">
            <button class="dropdown-item btn-delete" @click="$emit('delete', {cardId: card, categoryId: category, taskId: task})">Delete</button>
            <div class="dropdown-divider"></div>
            <button v-if="type === 'card'" class="dropdown-item btn-delete" type="button" data-toggle="modal" :data-target="cardId">Modifier</button>
            <button v-if="type === 'task'" class="dropdown-item btn-delete" type="button" data-toggle="modal" :data-target="taskId">Modifier</button>
            <button v-if="type === 'category'" class="dropdown-item btn-delete" type="button" data-toggle="modal" :data-target="categoryId">Modifier</button>
        </div>
    </div>
</template>

<script>

    export default {
        name: "dropdown",
        props: ['card', 'category', 'task', 'color', 'type'],
        computed: {
            taskId: function () {
                let id = '#task' + this.task + this.card + this.category
                return id 
            },
            cardId: function () {
                let id = '#card' + this.card + this.category
                return id 
            },
            categoryId: function () {
                let id = '#category' + this.category
                return id 
            },
        },        
    }
</script>

<style scoped>

</style>
