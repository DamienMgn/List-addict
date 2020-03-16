<template>
    <div class="card-container">
        <header class="card-title">
            {{card.name}}
        </header>
        <div class="card-body">

        </div>
    </div>
</template>

<script>
    export default {
        name: "CardComponent",
        props: ['card'],
    }
</script>
