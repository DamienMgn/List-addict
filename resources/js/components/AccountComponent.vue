<template>
    <div class="account-container">
        <form class="form-account" @submit="updateUser">
            <img class="profil-picture" :src="'../storage/logo.jpg'">
            <div class="form-group">
                <label for="profilPicture">Modifier votre photo de profil</label>
                <input type="file" class="form-control-file" id="profilPicture" name="profilPicture">
            </div>
            <div class="form-group">
                <label for="update-mail">Modifier adresse mail</label>
                <input type="email" class="form-control" id="update-mail" aria-describedby="emailHelp" v-model="email" name="email">
            </div>
            <div class="form-group">
                <label for="update-name">Modifier mon pseudo</label>
                <input type="text" class="form-control" id="update-name" v-model="name" name="name">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "AccountComponent",
        data () {
            return {
                email: '',
                name: ''
            }
        },
        methods: {
            updateUser: function (e) {
                e.preventDefault();
                this.$store.dispatch('updateUser', {name: this.name, email: this.email, picture: e.target.profilPicture.value})

                this.email = '';
                this.name = '';
            }
        }
    }
</script>
