import { router } from "../app.js"

export default  {
    namespaced: true,
    state:{
        articles: {},
    },
    mutations: {
        ARTICLE_CREATED(state, event) {
            state.articles = { ...state.articles, event };
        }
    },
    actions: {
        create({commit}, payload) {
            return new Promise((resolve, reject) => {
                window.axios.post('api/article', payload)
                    .then((response) => {

                        commit('ARTICLE_CREATED', response.data);

                        resolve(response.data);
                    }).catch((error) => {
                    console.log(error);
                    reject(error);
                })
            });
        },
    },
    getters: {

    }
}
