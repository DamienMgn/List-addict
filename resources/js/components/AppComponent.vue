<template>
    <div>
        <sidebar-component></sidebar-component>
        <div class="content-wrapper">
            <router-view></router-view>
        </div>
        <!-- /.content-wrapper -->
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
