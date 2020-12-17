require('./bootstrap');

import VueRouter from 'vue-router'
import Vuex from 'vuex'
import Vuelidate from 'vuelidate'
import VueCompositionAPI from '@vue/composition-api'


/**
 * V-Icon
 * https://github.com/Justineo/vue-awesome
 */
// only import the icons you use to reduce bundle size
import 'vue-awesome/icons/spinner'
import 'vue-awesome/icons/caret-down'
import 'vue-awesome/icons/envelope'
import 'vue-awesome/icons/check-circle'
import 'vue-awesome/icons/search'
import 'vue-awesome/icons/arrow-left'
import 'vue-awesome/icons/arrow-right'

// or import all icons if you don't care about bundle size
// import 'vue-awesome/icons'

import Icon from 'vue-awesome/components/Icon'

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

Vue.component('v-navbar', require('./components/navbar/Navbar.vue').default);
Vue.component('v-footer', require('./components/Footer.vue').default);
Vue.component('v-main', require('./views/Main.vue').default);

Vue.component('v-icon', Icon);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/**
 * Vue Router
 */
import routes from './routes';

export const router = new VueRouter({
    routes,
    scrollBehavior (to, from, savedPosition) {
        return { x: 0, y: 0 }
    }
})


/**
 * VueX
 */
import user from './store/user';
import blog from './store/blog';
import article from "./store/article";
import { state, mutations, getters, actions } from './store/store';

const store = new Vuex.Store({
        modules: {
            user,
            blog,
            article
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
