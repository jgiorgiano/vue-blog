
export default {
    postLogin(credentials) {
        return window.axios.post('login', credentials);
    }
}
