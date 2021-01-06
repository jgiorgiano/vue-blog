import Vue from'vue';

import VueRouter from 'vue-router';

Vue.use(VueRouter)

/**
 * Vue Router
 */
import routes from './routes';

const router = new VueRouter({
    mode: 'history',
    routes,
    scrollBehavior (to, from, savedPosition) {
        return { x: 0, y: 0 }
    }
})

export default router;
