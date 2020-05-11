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
                    {name: '#00FFB3'},
                    {name: '#BF6FB2'},
                    {name: '#92F2DC'},
                    {name: '#30B257'},
                    {name: '#348899'},
                    {name: '#EADF86'},
                    {name: '#FF6257'},
                    {name: '#962D3E'},
                    {name: '#DC7716'},
                    {name: '#FFA68D'},
                    {name: '#CC9586'},
                    {name: '#920DFF'},
                    {name: '#F23D4C'},
                    {name: '#4162A6'},
                    {name: '#F2CB05'},
                ]
            }
        }
    }
</script>

<style scoped>

</style>
