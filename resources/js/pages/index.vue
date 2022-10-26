<template>
    <div class="max-w-md mx-auto p-4 bg-gray-100 shadow-md rounded-md mt-20">
        <h1 class="text-center mb-5">To-do app</h1>
        <form @submit.prevent="createTask">
            <div class="relative">
                <input id="task"
                    class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Enter task" v-model="task.name" required>
                <!-- <div v-if="errors.name">
                    <span class="text-sm text-red-400">{{ errors.name[0] }}</span>
                </div> -->
                <button type="submit"
                    class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                        class="fa-solid fa-lg fa-plus"></i></button>
            </div>
        </form>
        <div v-for="(task, key) in tasks" :key="key">
            <div class="max-w-md mx-auto p-3 bg-white shadow-md rounded-md mt-10">
                <span class="text-dark text-sm">{{ task.name }}</span>
                <button class="float-right hover:text-red-700 text-red-500 rounded ml-3"
                    @click="destroyTask(task.id)"><i class="fa-solid fa-lg fa-trash"></i></button>
                <button class="float-right hover:text-green-700 text-green-500 rounded "><i
                        class="fa-solid fa-lg fa-pencil"></i></button>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: 'tasks',

    data() {
        return {
            tasks: [],
            task: {
                name: ''
            }
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
                this.categories = []
            })
        },
        async createTask() {
            await this.axios.post('/api/todo', this.task).then(response => {
                // this.$router.push({name: "taskList"});
                this.getTasks()
            }).catch(error => {
                console.log(error)
            })
        },
        destroyTask(id) {
            if (confirm('Are you sure you want to ?')) {
                this.axios.delete('/api/todo/' + id).then(response => {
                    this.getTasks()
                }).catch(error => {
                    console.log(error);
                })
            }
        }
    }
}
</script>