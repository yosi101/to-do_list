<template>
    <div class="max-w-md mx-auto p-4 bg-gray-100 shadow-md rounded-md mt-16 maximum-height">
        <h1 class="text-center mb-5">To-do app</h1>
        <add-task v-on:newTask="getTasks"/>
        <list-view :tasks="tasks" v-on:reloadList="getTasks"/>
    </div>
</template>

<script>
import addTask from "../components/task/addTask.vue"
import listView from "../components/task/listView.vue"

export default {

    name: 'todo-list',

    components: {
        addTask,
        listView
    },

    data() {
        return {
            tasks: [],
        }
    },
    mounted() {
        this.getTasks()
    },
    methods: {
        async getTasks() {
            await this.axios.get('/api/todo').then(response => {
                this.tasks = response.data
            }).catch(error => {
                console.log(error)
            })
        },
    }
}
</script>

<style>
.completed {
    text-decoration: line-through;
    color: #999999
}
.maximum-height{
    max-height: 30rem;
}
</style>