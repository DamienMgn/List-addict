<template>
    <div class="account-container">
        <form class="form-account">
            <div class="form-group">
                <label for="update-mail">Modification adresse email</label>
                <input type="email" class="form-control" id="update-mail" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="update-password">Modification mot de passe</label>
                <input type="password" class="form-control" id="update-password">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "AccountComponent",
    }
</script>
