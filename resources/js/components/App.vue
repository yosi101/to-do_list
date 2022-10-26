<script>
import { RouterLink, RouterView } from 'vue-router'
</script>
<template>
    <main>
        <header>
            <nav class="max-w-2xl mx-auto">
            <RouterLink class="
            py-3
            px-4
            mr-4
            bg-orange-500
            hover:bg-orange-700
            shadow
            rounded
            text-white" to="/">
                Home
            </RouterLink>

            <RouterLink class="
            py-3
            px-4
            bg-orange-500
            hover:bg-orange-700
            shadow
            rounded
            text-white" to="/todo">
                Task
            </RouterLink>
        </nav>
        </header>
        <div class="container mt-2">
            <RouterView/>
        </div>
    </main>
</template>

<script>

</script>