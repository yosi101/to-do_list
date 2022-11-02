<script>
import { RouterLink, RouterView } from 'vue-router'
</script>
<template>
    <main>
        <header>
            <nav class="max-w-2xl mx-auto">
                <!-- <RouterLink class="
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
                </RouterLink> -->
            </nav>

            <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 dark:bg-gray-900">
                <div class="container flex flex-wrap justify-between items-center mx-auto">
                    <a href="/home" class="flex items-center">
                        <img src="data:image/png;base64,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" class="mr-3 h-6 sm:h-9"
                            alt="Flowbite Logo">
                        <span
                            class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
                    </a>
                    <button data-collapse-toggle="navbar-default" type="button"
                        class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="navbar-default" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                        <ul
                            class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                            <li>
                                <RouterLink
                                    class="block py-2 pr-4 pl-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white"
                                    to="/">
                                    Home
                                </RouterLink>
                            </li>
                            <li>
                                <RouterLink
                                    class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                                    to="/todo">
                                    Task
                                </RouterLink>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

        </header>
        <div class="container mt-2">
            <RouterView />
        </div>
    </main>
</template>

<script>

</script>