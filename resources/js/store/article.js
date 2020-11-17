import { router } from "../app.js"

export default  {
    namespaced: true,
    state:{
        article: '',
    },
    mutations: {
        ARTICLE_CREATED(state, event) {
            state.article = event;
            router.push({ name: 'article-edit'});
        }
    },
    actions: {
        create({commit}, payload) {
            return window.axios.post('api/article', payload)
                .then((response) => {

                    commit('ARTICLE_CREATED', response.data);

                }).catch((error) => {
                    console.log(error);
                })
        },
    },
    getters: {

    }
}
