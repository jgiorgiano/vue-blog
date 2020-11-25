export default  {
    namespaced: true,
    state:{
        articles: [],
        loading: false,
        pagination: {
            current_page: 0,
            last_page: 1,
            per_page: 0,
            total: 0
        }
    },
    mutations: {
        LOAD_ARTICLES(state, event) {

            state.articles = [ ...state.articles, ...event['data'] ];

            state.pagination.current_page = event.current_page;
            state.pagination.last_page = event.last_page;
            state.pagination.per_page = event.per_page;
            state.pagination.total = event.total;
        },
    },
    actions: {

        loadHomeArticles({commit, state}, payload) {
            if(state.loading || state.pagination.current_page >= state.pagination.last_page) {
                return false;
            }

            state.loading = true;

            return window.axios.get(`api/article/published?page=${state.pagination.current_page + 1}`)
                .then((response) => {

                    setTimeout(() => {
                        commit('LOAD_ARTICLES', response.data);
                        state.loading = false
                   } , 500);

                })
                .catch((error) => {
                    console.log(error);

                })
        },
    },
    getters: {}
}
