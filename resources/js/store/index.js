import Vuex from 'vuex';
import Vue from'vue';

Vue.use(Vuex)

/**
 * VueX
 */
import user from './user';
import blog from './blog';
import article from "./article";
import { state, mutations, getters, actions } from './store';

export default new Vuex.Store({
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
