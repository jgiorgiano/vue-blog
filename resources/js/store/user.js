import loginService from "../services/loginService";

export default {
    state: {
        authenticated: localStorage.getItem("__user") !== null,
        user: JSON.parse(localStorage.getItem('__user')) || {},
        account: {}
    },
    mutations: {
        LOGIN_SUCCESS(state, event) {
            state.authenticated = true;
            state.user = event;
        },
        LOGOUT_SUCCESS(state, event) {
            state.authenticated = false;
            state.user = {};
        },
        REGISTER_SUCCESS(state, event) {
            state.user = event;
        },
        LOAD_ACCOUNT_DETAILS(state, event) {
            state.account = event;
        },
        ACCOUNT_UPDATED(state, event) {
           console.log(event);
        },
    },
    actions: {
        postLogin({commit}, credentials) {
            return new Promise((resolve, reject) => {
                loginService.postLogin(credentials).then((response) => {

                    commit('LOGIN_SUCCESS', response.data);

                    localStorage.setItem('__user', JSON.stringify({
                        name: response.data.name,
                        profile_image: response.data.profile_image
                    }));

                    resolve(response);
                }).catch((error) => {
                    reject(error);
                });
            });
        },
        logout({commit}) {
            return window.axios.post('api/logout')
                .then((response) => {
                    commit('LOGOUT_SUCCESS');
                    localStorage.clear();

                }).catch((error) => {
                    console.log(error);
            })
        },
        registerNewUser({commit}, payload) {
            return window.axios.post('api/register', payload)
                .then((response) => {

                    commit('REGISTER_SUCCESS', response.data);

                    localStorage.setItem('__new_user', JSON.stringify({
                        name: response.data.name,
                        email: response.data.email
                    }));

                }).catch((error) => {
                    console.log(error);
                })
        },
        updateUserAccount({commit}, payload) {
            return window.axios.put('api/user', payload, { headers: { 'Content-Type': 'multipart/form-data' }})
                .then((response) => {

                    commit('ACCOUNT_UPDATED', response.data);

                    // localStorage.setItem('__new_user', JSON.stringify({
                    //     name: response.data.name,
                    //     email: response.data.email
                    // }));

                }).catch((error) => {
                    console.log(error);
                })
        },

    },
    getters: {
    }
}
