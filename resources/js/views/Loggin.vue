<template>
    <div class="flex flex-col justify-center items-center test">
        <div class="j-card md:w-1/2 lg:w-1/3 mt-48">
            <div class="pb-2 flex justify-center">
                <h3 class="text-2xl font-medium text-indigo-500">Sign In</h3>
            </div>
            <form @submit.prevent="login">
                <div class="mb-2">
                    <p class="text-sm text-gray-600">Email</p>
                    <input v-model="credentials.email"
                           class="appearance-none bg-transparent border-b-2 border-gray-500 focus:border-indigo-500 w-full text-gray-800 mr-3 mb-3 p-1 px-2 leading-tight focus:outline-none"
                           type="text" placeholder="" aria-label="Email">
                </div>
                <div class="mb-2">
                    <p class="text-sm text-gray-600">Password</p>
                    <input v-model="credentials.password"
                           class="appearance-none bg-transparent border-b-2 border-gray-500 focus:border-indigo-500 w-full text-gray-800 mr-3 mb-3 p-1 px-2 leading-tight focus:outline-none"
                           type="password" placeholder="" aria-label="Password">
                </div>

                <div class="py-2 flex justify-center">
                    <button
                        class="flex-shrink-0 bg-indigo-500 hover:bg-indigo-700 border-indigo-500 focus:border-0 hover:border-indigo-700 text-sm border-4 text-white py-1 px-2 rounded transition ease-in duration-75"
                        type="submit">
                        Login
                    </button>
                </div>
            </form>
        </div>

        <router-link :to="{ name: 'register'}"
                     class="mt-4 flex-shrink-0 border-transparent border-4 text-indigo-500 hover:text-indigo-800 text-sm py-1 px-2 rounded transition ease-in duration-75"
        >
            Don't have an Account. Register
        </router-link>

    </div>
</template>

<script>
export default {
    data() {
        return {
            credentials: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        login() {
            this.$store.dispatch('postLogin', this.credentials);
        }
    }
}
</script>

<style>

</style>
