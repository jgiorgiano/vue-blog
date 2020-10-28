import LoginService from '../services/loginService';
import loginService from "../services/loginService";

export default {
    state: {
        authenticated: false,
        user: ''
    },
    mutations: {
        LOGIN_SUCCESS(state, event) {
            state.authenticated = true;
            state.user = event;
        }
    },
    actions: {
        postLogin({ commit }, credentials) {
            return new Promise((resolve, reject) => {
                loginService.postLogin(credentials).then((response) => {

                    commit('LOGIN_SUCCESS', response.data);

                    resolve(response);
                }).catch((error) => {
                    reject(error);
                });
            });
        }
    },
    getters: {

    }
}
