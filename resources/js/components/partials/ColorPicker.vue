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
                    {name: '#239B56'},
                    {name: '#B03A2E'},
                    {name: '#B7950B'},
                    {name: '#76448A'},
                    {name: '#2874A6'},
                    {name: '#2ECC71'},
                    {name: '#E74C3C'},
                    {name: '#F1C40F'},
                    {name: '#9B59B6'},
                    {name: '#3498DB'},
                    {name: '#82E0AA'},
                    {name: '#F1948A'},
                    {name: '#F7DC6F'},
                    {name: '#C39BD3'},
                    {name: '#85C1E9'},
                ]
            }
        }
    }
</script>

<style scoped>

</style>
