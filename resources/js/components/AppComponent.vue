<template>
    <div>
        <sidebar-component></sidebar-component>
        <router-view></router-view>
    </div>
</template>

<script>
    import SidebarComponent from "./SidebarComponent";

    export default {
        name: "AppComponent",
        components: {
            SidebarComponent,
        },
    }
</script>

<style scoped>

</style>
