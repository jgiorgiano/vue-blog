require('./bootstrap');

/**
 * Include used Plugins
 */
require('./plugins/Vuelidate');
require('./plugins/VueDayjs');
require('./plugins/VueCompositionAPI');
require('./plugins/VueAwesome');

import store from './store';
import router from './router';

window.Vue = require('vue');

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
