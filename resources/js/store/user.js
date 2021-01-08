import loginService from "../services/loginService";
import Axios from "axios";

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
        LOGOUT(state) {
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
            state.user = event;
        },
    },
    actions: {
        postLogin({commit}, credentials) {
            return new Promise((resolve, reject) => {
                Axios.post('v1/login', credentials).then((response) => {

                    commit('LOGIN_SUCCESS', response.data);

                    localStorage.setItem('__user', JSON.stringify({
                        name: response.data.name,
                        profile_image_path: response.data.profile_image_path
                    }));

                    resolve(response);
                }).catch((error) => {
                    reject(error);
                });
            });
        },
        logout({commit}) {
            return Axios.post('v1/logout')
                .then((response) => {
                    commit('LOGOUT');
                    localStorage.clear();

                }).catch((error) => {
                    console.log(error);
                })
        },
        registerNewUser({commit}, payload) {
            return new Promise((resolve, reject) => {
                Axios.post('v1/register', payload)
                    .then((response) => {
                        commit('REGISTER_SUCCESS', response.data);
                        resolve(response);
                    }).catch((error) => reject(error))
            })
        },
        updateUserAccount({commit}, payload) {

            let formData = new FormData();

            formData.append('profile_image', payload.profile_image);
            formData.append('name', payload.name);
            formData.append('subscribe', payload.subscribe);

            return Axios.post('v1/user', formData, {
                headers: {
                    'content-type': 'multipart/form-data',
                }
            })
                .then((response) => {

                    commit('ACCOUNT_UPDATED', response.data);

                    localStorage.setItem('__user', JSON.stringify({
                        name: response.data.name,
                        profile_image_path: response.data.profile_image_path
                    }));

                }).catch((error) => {
                    console.log(error);
                })
        },
        isAuth({commit}) {
            return Axios.get('v1/test').then(() => {
            }).catch((error) => {
                commit('LOGOUT');
                localStorage.clear();
            });
        }

    },
    getters: {}
}
