import Vue from 'vue';

require('./bootstrap');

/**
 * Include used Plugins
 */
require('./plugins/Axios');
require('./plugins/Vuelidate');
require('./plugins/VueDayjs');
require('./plugins/VueCompositionAPI');
require('./plugins/VueAwesome');

import store from './store';
import router from './router';


/**
 * Include Global Components
 */
require('./components/global');


/**
 * @type {Vue}
 */
const app = new Vue({
    router,
    store,
    el: '#app',
});
