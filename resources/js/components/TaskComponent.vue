<template>
    <div>
        <ul class="card-body-ul">
            <li v-for="task in card.tasks" class="card-body-li">
                <p class="task-name">{{ task.name }}</p>
                <span class="task-img-container"><img alt="multiple-choices" src="../../img/more-options-black.svg"/></span>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "TaskComponent",
        props: ["card"],
    }
</script>
