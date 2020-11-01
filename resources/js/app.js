require('./bootstrap');

import VueRouter from 'vue-router'
import Vuex from 'vuex'
import Vuelidate from 'vuelidate'
import VueCompositionAPI from '@vue/composition-api'

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// import ExampleComponent from "./components/ExampleComponent";

window.Vue = require('vue');

Vue.use(VueRouter)

Vue.use(Vuex)

Vue.use(Vuelidate)

Vue.use(VueCompositionAPI)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('v-navbar', require('./components/Navbar.vue').default);
Vue.component('v-footer', require('./components/Footer.vue').default);
Vue.component('v-main', require('./views/Main.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/**
 * Vue Router
 */
import routes from './routes';

const router = new VueRouter({
    routes
})


/**
 * VueX
 */
import user from './store/user';
import blog from './store/blog';
import { state, mutations, getters, actions } from './store/store';

const store = new Vuex.Store({
        modules: {
            user,
            blog
        },
        state,
        mutations,
        getters,
        actions
    }
);


/**
 * @type {Vue}
 */
const app = new Vue({
    router,
    store,
    el: '#app',
});
