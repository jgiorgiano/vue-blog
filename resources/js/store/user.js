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

            loginService.postLogin(credentials).then((response) => {
                console.log(response)
            }).catch((error) => {
                console.log(error);
            })

            // console.log(context, credentials);
        }
    },
    getters: {

    }
}
