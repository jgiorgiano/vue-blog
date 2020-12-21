<template>
    <div class="gradient z-50 fixed w-full">
        <nav id="top-nav" class="container mx-auto relative p-5 flex items-center justify-between">
            <nav-logo />
            <div v-if="!authenticated" class="hidden md:flex">
                <router-link :to="{ name: 'home'}">
                    <nav-link>Home</nav-link>
                </router-link>
                <router-link :to="{ name: 'about'}">
                    <nav-link>About</nav-link>
                </router-link>
                <router-link :to="{ name: 'login'}">
                    <nav-link>Login</nav-link>
                </router-link>
                <router-link :to="{ name: 'register'}">
                    <nav-link class="border border-indigo-800 hover:border-indigo-900">Subscribe</nav-link>
                </router-link>

                <nav-search class="w-48"></nav-search>
            </div>

            <div v-if="!authenticated" class="md:hidden">
                <button type="button" @click="menuOpen=!menuOpen"
                        class="inline-flex items-center justify-center p-2 rounded-md text-indigo-800 hover:text-indigo-900 hover:bg-gray-300 hover:bg-opacity-25 focus:outline-none focus:bg-gray-300 focus:bg-opacity-25 focus:text-indigo-900 transition duration-150 ease-in-out"
                        id="main-menu" aria-label="Main menu" aria-haspopup="true">

                    <svg v-if="!menuOpen" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>

                    <svg v-if="menuOpen"  class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>
            </div>
            <div v-else>
                <button type="button" @click="menuOpen=!menuOpen"
                        class="inline-flex items-center justify-center p-1 rounded-md focus:outline-none transition duration-150 ease-in-out"
                        id="auth-main-menu" aria-label="Main menu" aria-haspopup="true">

                    <div class="flex items-center ml-8">
                        <p class="text-gray-900 hover:text-indigo-800">{{ user.name }} <v-icon class="mx-1" name="caret-down"></v-icon></p>
                        <img class="w-10 h-10 rounded-full ml-2" :src=" user.profile_image_path || 'img/user-placeholder.png'" alt="user image">
                    </div>

                </button>
            </div>

            <div class="absolute top-0 inset-x-0 p-3 mt-16 transition-opacity transform origin-top-right"
                 :class="[authenticated ? 'block' : ' md:hidden' ]">
                <div  class="border rounded w-full max-w-sm p-2 shadow-inner float-right bg-gray-100"
                      :class="[menuOpen ? 'block' : 'hidden' ]">

                    <div v-if="!authenticated" class="flex flex-col content-end">

                        <nav-search class="w-full py-4"></nav-search>

                        <router-link :to="{ name: 'home'}">
                            <nav-link>Home</nav-link>
                        </router-link>
                        <router-link :to="{ name: 'about'}">
                            <nav-link>About</nav-link>
                        </router-link>
                        <router-link :to="{ name: 'register'}">
                            <nav-link>Subscribe</nav-link>
                        </router-link>
                        <router-link :to="{ name: 'login'}" class="text-center">
                            <nav-link class="border border-indigo-600 hover:border-indigo-900">Login</nav-link>
                        </router-link>
                    </div>
                    <div v-else class="flex flex-col content-end">

                        <nav-search class="w-full py-4"></nav-search>

                        <router-link :to="{ name: 'home'}">
                            <nav-link>Home</nav-link>
                        </router-link>
                        <router-link :to="{ name: 'about'}">
                            <nav-link>About</nav-link>
                        </router-link>
                        <router-link :to="{ name: 'my-account'}">
                            <nav-link>My Account</nav-link>
                        </router-link>
                        <router-link :to="{ name: 'dashboard'}">
                            <nav-link>Dashboard</nav-link>
                        </router-link>
                        <button @click="logout" class="focus:outline-none">
                            <nav-link class="border border-indigo-600 hover:border-indigo-900">Sign out</nav-link>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <ScrollToTop v-if="showGoToTop"></ScrollToTop>

    </div>
</template>

<script>
import navLink from './NavLink';
import navLogo from './NavLogo';
import navSearch from './NavSearch'
import ScrollToTop from "./ScrollToTop";

import { gsap } from 'gsap';

export default {
    components: {
        navLink,
        navLogo,
        navSearch,
        ScrollToTop
    },
    data() {
        return {
            searchText: '',
            showGoToTop: false
        }
    },
    computed: {
        menuOpen: {
            get: function () {
                return this.$store.state.menuOpen;
        },
            set: function (value) {
                return this.$store.commit('MENU_CHANGE', value);
            }
        },
        user: function () {
            return this.$store.state.user.user;
        },
        authenticated: function () {
            return this.$store.state.user.authenticated;
        }
    },
    methods: {
        logout: function() {
            this.$store.dispatch('logout')
                .then(() => this.$router.push('/'))
                .catch(err => console.log(err))
        },
        scrollToTop() {
            gsap.to(window, { duration: 0.5, scrollTo: 0, ease: "circ" })
        }
    },
    mounted() {
        window.onscroll = () => {
            if(window.pageYOffset > 30) {
                gsap.to("#top-nav", {scale: 0.90, paddingTop:"4px", paddingBottom:"4px", duration: 0.5});
            } else {
                gsap.to("#top-nav", {scale: 1, paddingTop:"16px", paddingBottom:"16px", duration: 0.5});
            }

            if(window.pageYOffset > 400) {
                this.showGoToTop = true;
            } else {
                this.showGoToTop = false;
            }
        }
    },
}
</script>

<style>

</style>
