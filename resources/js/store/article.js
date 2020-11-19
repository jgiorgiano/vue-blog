export default  {
    namespaced: true,
    state:{
        articles: [],
    },
    mutations: {
        INCLUDE_ARTICLE(state, event) {
            state.articles = [ ...state.articles, event ];
        },
        UPDATE_ARTICLE(state, event) {
            state.articles = [ ...state.articles.filter(article => article.id !== parseInt(event.id)), event ];
        }
    },
    actions: {
        create({commit}, payload) {
            return new Promise((resolve, reject) => {
                window.axios.post('api/article', payload)
                    .then((response) => {

                        commit('INCLUDE_ARTICLE', response.data);

                        resolve(response.data);
                    }).catch((error) => {
                    console.log(error);
                    reject(error);
                })
            });
        },
        loadArticle({commit}, id) {
            return new Promise((resolve, reject) => {
                window.axios.get(`api/article/${id}`)
                    .then((response) => {
                        commit('INCLUDE_ARTICLE', response.data);
                        resolve(response.data);
                    })
                    .catch((error) => {
                    console.log(error);
                    reject(error);
                })
            })
        },
        update({commit}, payload) {
            return new Promise((resolve, reject) => {
                console.log(payload);
                window.axios.put(`api/article/${payload.id}`, payload)
                    .then((response) => {

                        commit('UPDATE_ARTICLE', response.data);

                        resolve(response.data);
                    }).catch((error) => {
                    console.log(error);
                    reject(error);
                })
            });
        },
    },
    getters: {
        getArticleById: (state, getters, actions) => (id) => {
            return state.articles.filter(article => article.id === parseInt(id))[0];
        }
    }
}
