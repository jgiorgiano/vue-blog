import store from '../store';

export default {
    redirectIfNotAuthenticated(to, from, next) {
        const authenticated = store.state.user.authenticated;

        if (!authenticated) {
            next({ name: 'login' });
        } else {
            next();
        }
    },

    redirectIfAuthenticated(to, from, next) {
        const authenticated = store.state.user.authenticated;

        if (authenticated) {
            next({ name: 'home' });
        } else {
            next();
        }
    },

    redirectIfNotUserSet(to, from, next) {

        const user = store.state.user.user;
console.log(user);
        if (user.name) {
            next();
        } else {
            next({ name: 'login' });
        }
    }
};
