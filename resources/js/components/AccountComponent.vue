<template>
    <div class="account-container">
        <form class="form-account" @submit="updateUser">
            <img class="profil-picture" :src="'../storage/' + user.avatar">
            <div class="form-group">
                <label for="profilPicture">Modifier votre photo de profil</label>
                <input type="file" class="form-control-file" id="profilPicture" name="profilPicture" @change="onImageChange">
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
    import {mapGetters} from 'vuex';

    export default {
        name: "AccountComponent",
        data () {
            return {
                email: '',
                name: '',
                image: ''
            }
        },
        computed: {
            ...mapGetters(['user']),
        },
        methods: {
            updateUser: function (e) {
                e.preventDefault();
                this.$store.dispatch('updateUser', {name: this.name, email: this.email, picture: [this.image, e.target.profilPicture.value]})
                this.email = '';
                this.name = '';
            },
            onImageChange: function (e) {
                let file = e.target.files || e.dataTransfer.files;
                if (!file.length)
                    return;
                this.createImage(file[0]);
            },
            createImage: function (file) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
        }
    }
</script>
