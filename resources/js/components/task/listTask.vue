<template>
    <div class="max-w-md mx-auto p-5 bg-white shadow-sm rounded-md mb-2">
        <input type="checkbox" @change="updateTask" value="{{task.id}}" v-model="task.completed"
            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 mr-3">
        <span :class="[task.completed ? 'completed' : '', 'text-light text-sm']">{{ task.name }}</span>
        <button class="float-right hover:text-red-700 text-red-500 rounded ml-3" @click="destroyTask(task.id)"><i
                class="fa-solid fa-lg fa-trash"></i></button>
    </div>
</template>

<script>
export default {
    name: 'create-list-delete-task',
    props: ['task'],

    methods: {
        updateTask() {
            this.axios.patch('api/todo/' + this.task.id, {item: this.item}).then(response => {
                this.$emit('taskModified');
            }).catch(error => {
                console.log(error);
            })
        },
        destroyTask(id) {
            if (confirm('Are you sure you want to ?')) {
                this.axios.delete('/api/todo/' + id).then(response => {
                    this.$emit('taskModified');
                }).catch(error => {
                    console.log(error);
                })
            }
        }
    }
}
</script>