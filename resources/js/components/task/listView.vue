<template>
    <div class="mt-5 overflow-y-auto" style="max-height: 27rem">
        <div v-if="tasks.length > 0">
            <div v-for="(task, key) in tasks" :key="key">
                <list-task :task="task" v-on:taskModified="$emit('reloadList')" />
            </div>
        </div>
        <div v-else class="mt-4 text-center">
            <span>No task available</span>
        </div>
    </div>
</template>

<script>
import listTask from './listTask.vue'

export default {
    props: ['tasks'],
    components: {
        listTask
    }
}
</script>