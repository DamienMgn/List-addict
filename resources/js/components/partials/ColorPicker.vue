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
                    {name: '#38BF33'},
                    {name: '#A1DC8E'},
                    {name: '#3AAE9B'},
                    {name: '#9C5EF2'},
                    {name: '#883DF2'},
                    {name: '#490C59'},
                    {name: '#FF1D23'},
                    {name: '#D40D12'},
                    {name: '#94090D'},
                    {name: '#F2C53D'},
                    {name: '#BF820F'},
                    {name: '#A65814'},
                    {name: '#9DC8D1'},
                    {name: '#639EA9'},
                    {name: '#24B4F0'},
                ]
            }
        }
    }
</script>

<style scoped>

</style>
