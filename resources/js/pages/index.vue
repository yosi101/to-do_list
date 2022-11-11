<template>
    <navbar />

    <div class="max-w-md mx-auto p-4 bg-gray-100 dark:bg-gray-800 shadow-md rounded-md mt-16">
        <h1 class="text-center mb-5 dark:text-white">To-do app</h1>
        <add-task v-on:newTask="getTasks" />
        <list-view :tasks="tasks" v-on:reloadList="getTasks" />
    </div>
</template>

<script>
import addTask from "../components/task/addTask.vue"
import listView from "../components/task/listView.vue"
import navbar from "../components/navbar.vue"

export default {

    name: 'todo-list',

    components: {
        addTask,
        listView,
        navbar
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
            const token = localStorage.getItem('token');
            await this.axios.get('/api/todo', {
                headers: {
                    Authorization: `Bearer ${token}`,
                    "Content-Type": "application/json",
                    "x-access-token": token
                },
            }).then(response => {
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

.maximum-height {
    max-height: 27rem;
}
</style>