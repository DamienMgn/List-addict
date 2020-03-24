<template>
    <div class="color-picker-container">
        <div class="color-container">
            <input v-for="color in colors" type="radio" name="color" :value="color.name" v-bind:style="{backgroundColor: color.name}">
        </div>
    </div>
</template>

<script>
    export default {
        name: "colorpicker",
        data () {
            return {
                colors: [
                    {name: '#27AE60'},
                    {name: '#2ECC71'},
                    {name: '#F1C40F'},
                    {name: '#F39C12'},
                    {name: '#9B59B6'},
                    {name: '#8E44AD'},
                    {name: '#2980B9'},
                    {name: '#3498DB'},
                    {name: '#C0392B'},
                    {name: '#E74C3C'}
                ]
            }
        }
    }
</script>

<style scoped>

</style>
