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
                    {name: '#F39C12'},
                    {name: '#8E44AD'},
                    {name: '#2980B9'},
                    {name: '#C0392B'},
                ]
            }
        }
    }
</script>

<style scoped>

</style>
