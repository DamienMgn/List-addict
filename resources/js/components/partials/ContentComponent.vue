<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 page-title">
                        <h1 class="m-0 text-dark">{{title}}</h1>
                        <button class="btn-add-card btn btn-box-tool" data-toggle="modal" data-target="#modal-add-card">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Starter Page</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
</template>

<script>
    export default {
        name: "ContentComponent",
        props: ['title']
    }
</script>

<style scoped>

</style>
