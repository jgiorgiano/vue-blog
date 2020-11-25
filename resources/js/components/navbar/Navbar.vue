<template>

    <div>
        <nav class="relative p-5 flex items-center justify-between">

            <nav-logo />

            <div v-if="!authenticated" class="hidden md:flex">
               <!-- (Home|Archive|Code snippets|Contact|Search)-->
                <router-link :to="{ name: 'login'}">
                    <nav-link>Login</nav-link>
                </router-link>
                <router-link :to="{ name: 'register'}">
                    <nav-link>Sign up</nav-link>
                </router-link>
                <router-link :to="{ name: 'about'}">
                    <nav-link>About</nav-link>
                </router-link>
                <small class="text-gray-400">v1.2</small>
            </div>

            <div v-if="!authenticated" class="md:hidden">
                <button type="button" @click="showMenu=!showMenu"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-indigo-900 hover:bg-gray-100 focus:outline-none focus:bg-gray-200 focus:text-indigo-500 transition duration-150 ease-in-out"
                        id="main-menu" aria-label="Main menu" aria-haspopup="true">

                    <svg v-if="!showMenu" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>

                    <svg v-if="showMenu"  class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>
            </div>
            <div v-else>
                <button type="button" @click="showMenu=!showMenu"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-indigo-900 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 focus:text-indigo-500 transition duration-150 ease-in-out"
                        id="auth-main-menu" aria-label="Main menu" aria-haspopup="true">

                    <div class="flex items-center ml-8 opacity-100 hover:opacity-75 transition duration-150 ease-in-out">
                        <p class="text-gray-900 hover:text-indigo-900 "> {{ user.name }}</p>
                        <img class="w-10 h-10 rounded-full ml-2" :src=" user.profile_image_path || 'img/user-placeholder.png'" alt="user image">
                    </div>

                </button>
            </div>
            <div class="absolute top-0 inset-x-0 p-3 mt-16 transition-opacity transform origin-top-right"
                 :class="[authenticated ? 'block' : ' md:hidden' ]">
                <div  class="border rounded w-full max-w-md p-2 shadow-inner float-right bg-gray-100"
                      :class="[showMenu ? 'block' : 'hidden' ]">

                    <div v-if="!authenticated" class="flex flex-col content-end">
                        <router-link :to="{ name: 'register'}"><nav-link>Sign up</nav-link></router-link>
                        <router-link :to="{ name: 'about'}"><nav-link>About</nav-link></router-link>
                        <router-link :to="{ name: 'login'}" class="text-center"><nav-link>Login</nav-link></router-link>
                    </div>
                    <div v-else class="flex flex-col content-end">
                        <router-link :to="{ name: 'my-account'}">
                            <nav-link>My Account</nav-link>
                        </router-link>
                        <router-link :to="{ name: 'dashboard'}">
                            <nav-link>Dashboard</nav-link>
                        </router-link>
                        <router-link :to="{ name: 'about'}">
                            <nav-link>About</nav-link>
                        </router-link>
                        <button @click="logout" class="focus:outline-none">
                            <nav-link>Sign out</nav-link>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
import navLink from './NavLink';
import navLogo from './NavLogo';

export default {
    components: {
        navLink,
        navLogo
    },
    data() {
        return {
            showMenu: false,
        }
    },
    computed: {
        user: function () {
            return this.$store.state.user.user;
        },
        authenticated: function () {
            return this.$store.state.user.authenticated;
        }
    },
    methods: {
        logout: function () {
            this.$store.dispatch('logout')
                .then(() => this.$router.push('/'))
                .catch(err => console.log(err))
        }
    }
}
</script>

<style>

</style>
