<template>
    <div class="mb-8">
        <form @submit.prevent="createTask">
            <div class="relative">
                <input id="task"
                    class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Enter task" v-model="task.name">

                <button type="submit"
                    class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                        class="fa-solid fa-lg fa-plus"></i></button>
            </div>
            <div v-if="errors.name">
                <span class="text-sm text-red-400 ml-2">{{ errors.name[0] }}</span>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: 'create-task',

    data() {
        return {
            task: {
                name: ''
            },
            errors: []
        }
    },
    methods: {
        async createTask() {
            const token = localStorage.getItem('token');
            await this.axios.post('/api/todo', this.task, {
                headers: {
                    Authorization: `Bearer ${token}`,
                    "Content-Type": "application/json",
                    "x-access-token": token
                },
            }).then(response => {
                this.task.name = "";
                this.errors = "";
                this.$emit('newTask');
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
            })
        },
    }
}
</script>