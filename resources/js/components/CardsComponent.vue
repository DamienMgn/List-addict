<template>
    <div class="cards-container">
        {{ this.$route.params.id }}
    </div>
</template>

<script>
    export default {
        mounted () {
            this.$store.dispatch('loadCards', this.$route.params.id)
        }
    }
</script>
