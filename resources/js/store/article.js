export default  {
    namespaced: true,
    state:{
        articles: [],
        statusOptions: [
            {id: 0, description: 'Waiting Approval'},
            {id: 1, description: 'Published'},
            {id: 2, description: 'Not Published'},
            {id: 3, description: 'Waiting amendment'},
        ],
        typeOptions: [
            {id: 1, description: 'Article'},
            {id: 2, description: 'External Link'},
        ]
    },
    mutations: {
        INCLUDE_ARTICLE(state, event) {
            state.articles = [ ...state.articles, event ];
        },
        UPDATE_ARTICLE_LIST(state, event) {
            state.articles = event;
        },
        UPDATE_ARTICLE(state, event) {
            state.articles = [ ...state.articles.filter(article => article.id !== parseInt(event.id)), event ];
        }
    },
    actions: {
        loadAllArticles({commit}) {
            return this._vm.$axios.get(`v1/article`)
                    .then((response) => {

                        commit('UPDATE_ARTICLE_LIST', response.data);

                    })
                    .catch((error) => {
                        console.log(error);

                    })

        },
        create({commit}, payload) {
            return new Promise((resolve, reject) => {
                this._vm.$axios.post('v1/article', payload)
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
                this._vm.$axios.get(`v1/article/${id}`)
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

                this._vm.$axios.put(`v1/article/${payload.id}`, payload)
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
        getArticleById: (state) => (id) => {
            return state.articles.find(article => article.id === parseInt(id));
            // return state.articles.filter(article => article.id === parseInt(id))[0];
        },
        getStatusById: (state) => (id) => {
            return state.statusOptions.find(status => status.id === parseInt(id));
        }
    }
}
