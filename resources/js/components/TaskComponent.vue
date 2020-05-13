<template>
    <div class="task-container" :class="{'checked' : task.status}" :style="{borderLeftColor: task.color}">
        <div class="task-header">
            <p class="task-name">{{ task.name }}</p>
            <div class="dropdown dropdown-category-main" >
                <a class="btn-dropdown dropdown-toggle" data-toggle="modal" :data-target="'#modal-update-task' + task.id" role="menuitem" tabindex="-1" href="#">
                    <i class="fa fa-ellipsis-v"></i>
                </a>
            </div>
        </div>
        <div class="task-footer">
            <p class="task-date" v-if="task.deadline">
                {{date}}
            </p>
        </div>
    </div>
</template>

<script>

    export default {
        name: "TaskComponent",
        components: {},
        props: ['task', 'card'],
        computed: {
            date: function () {
                let date = this.formatDate(new Date(this.task.deadline).getDate()) + '/' + this.formatDate((new Date(this.task.deadline).getMonth() + 1)) + '/' + new Date(this.task.deadline).getFullYear()
                return date
            },
        },
        methods: {
            formatDate: function (nbr) {
                if (nbr <= 9) {
                    let newNbr = '0' + nbr
                    return newNbr
                } else {
                    return nbr
                }
            }
        }
    }
</script>
