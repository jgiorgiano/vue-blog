import Axios from "axios";
import Vue from "vue";

Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Axios.defaults.withCredentials = true;
Axios.defaults.timeout = 60000; //1min

/**
 * Set the Default Headers for the API
 */
Axios.defaults.headers.common['Content-Type'] = 'application/json';
Axios.defaults.headers.common['Accept'] = 'application/json';
Axios.defaults.baseURL = '/api';

/**
 * Interceptor for responses
 * if unauthenticated (401), clean the credentials on storage and redirect to login page
 */
Axios.interceptors.response.use(
    function (response) {
        return response;
    },

    function (error) {

        if (error.response.status === 401) {
            localStorage.clear();
            window.location = "/login";
        }

        if (error.response.status === 403) {
            window.location = "/email-verification";
        }

        return Promise.reject(error);
    }
);

Vue.prototype.$axios = Axios;
