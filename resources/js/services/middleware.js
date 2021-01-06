import store from '../store';

export default {
    redirectIfNotAuthenticated(to, from, next) {
        const authenticated = store.state.user.authenticated;

        if (!authenticated) {
            next({ name: 'login' });
        }

        next();
    },

    redirectIfAuthenticated(to, from, next) {
        const authenticated = store.state.user.authenticated;

        if (authenticated) {
            next({ name: 'home' });
        }

        next();
    },
};
