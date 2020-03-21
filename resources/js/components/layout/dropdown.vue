<template>
    <div class="dropdown manage-card-container">
        <button class="btn-sm btn-dropdown btn-dropdown-task" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img :src="require(`../../../img/more-options-${color}.svg`)" alt="multiple-choices"/>
        </button>
        <div class="dropdown-menu">
            <button class="dropdown-item btn-delete" @click="$emit('delete', {cardId: card, categoryId: category, taskId: task})">Delete</button>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Couleur</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "dropdown",
        props: ['card', 'category', 'task', 'color']
    }
</script>

<style scoped>

</style>
