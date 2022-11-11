<template>
    <navbar />

    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div
                class="w-full bg-gray-200 rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Sign in to your account
                    </h1>
                    <span v-if="errors">{{ errors }}</span>
                    <form class="space-y-4 md:space-y-6" @submit.prevent="login">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                email</label>
                            <div v-if="errors.email">
                                <span class="text-sm text-red-400 ml-2">{{ errors.email[0] }}</span>
                            </div>
                            <input type="email" name="email" id="email" v-model="user.email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@company.com">
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <div v-if="errors.password">
                                <span class="text-sm text-red-400 ml-2">{{ errors.password[0] }}</span>
                            </div>
                            <input type="password" name="password" id="password" v-model="user.password"
                                placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" aria-describedby="remember" type="checkbox"
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                                </div>
                            </div>
                            <RouterLink to="#"
                                class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">Forgot
                                password?</RouterLink>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign
                            in</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Don’t have an account yet? <RouterLink to="/register"
                                class="font-medium text-blue-600 hover:underline dark:text-blue-500">Sign up
                            </RouterLink>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script>

import navbar from "../../components/navbar.vue"

export default {
    name: "Login form",

    data() {
        return {
            user: {
                email: '',
                password: ''
            },
            errors: '',
            isLoggedIn: false
        }

    },
    components: {
        navbar
    },

    methods: {
        async login() {
            await this.axios.post('/api/login', this.user).then(response => {
                localStorage.setItem('token', response.data.data.token);
                this.$router.push({ name: 'index' });
                isLoggedIn = true;
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
            });
        }
        // async login() {
        //     try {
        //         await this.axios.post('/api/login', this.user);
        //         localStorage.setItem('token', response.data.data.token);
        //         this.$router.push({ name: 'index' });
        //         this.errors = ''
        //     } catch (error) {
        //         if (error.response.status === 422) {
        //             this.errors = error.response.data.errors;
        //         }
        //     }
        // }
    }
}
</script>