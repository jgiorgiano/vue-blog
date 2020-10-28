window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

axios.defaults.withCredentials = true;
axios.defaults.timeout = 2000;

/**
 * Set the Default Headers for the API
 */
window.axios.defaults.headers.common['Content-Type'] = 'application/json';
window.axios.defaults.headers.common['Accept'] = 'application/json';

/**
 * Interceptor for responses
 * if unauthenticated (401), clean the credentials on storage and redirect to login page
 */
axios.interceptors.response.use(
    function (response) {
        return response;
    },

    function (error) {
        if (error.response.status === 401) {
            localStorage.clear();
            window.location = "#/login";
        }

        return Promise.reject(error);
    }
);


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
