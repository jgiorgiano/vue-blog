import LoginService from '../services/loginService';
import loginService from "../services/loginService";

export default {
    state: {
        logged: false,
        user: ''
    },
    mutations: {

    },
    actions: {
        postLogin(context, credentials) {
            return new Promise((resolve, reject) => {
                loginService.postLogin(credentials).then((response) => {

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
