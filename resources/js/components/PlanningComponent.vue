<template>
    <div>
        <ContentComponent></ContentComponent>
        <div class="project-container">
            Planning-Container
        </div>
    </div>
</template>

<script>
    import ContentComponent from './partials/ContentComponent';

    export default {
        components: {
            ContentComponent,
        },
        mounted () {
            this.$store.dispatch('loadTasks')
        },
    }
</script>
