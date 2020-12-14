import {router} from '../app'

export default {
    namespaced: true,
    state: {
        articles: [],
        featuredArticles: [],
        loading: false,
        pagination: {
            current_page: 0,
            last_page: 1,
            per_page: 0,
            total: 0
        },
        search: {
            searching : false,
            word: '',
            articles: [],
            pagination: {
                current_page: 0,
                last_page: 1,
                per_page: 0,
                total: 0
            }
        },
    },
    mutations: {
        SEARCH_ARTICLES(state, event) {
            state.search.articles = event['data'];

            state.search.pagination.current_page = event.current_page;
            state.search.pagination.last_page = event.last_page;
            state.search.pagination.per_page = event.per_page;
            state.search.pagination.total = event.total;

        },
        SEARCH_WORD(state, event) {
            state.search.word = event;
        },
        LOAD_ARTICLES(state, event) {

            state.articles = [...state.articles, ...event['data']];

            state.pagination.current_page = event.current_page;
            state.pagination.last_page = event.last_page;
            state.pagination.per_page = event.per_page;
            state.pagination.total = event.total;
        },
        LOAD_FEATURED_ARTICLES(state, event) {
            state.featuredArticles = event;
        },
        RESET_ARTICLES(state, event) {
            state.articles = [];
            state.pagination = {
                current_page: 0,
                last_page: 1,
                per_page: 0,
                total: 0
            };
        }
    },
    actions: {
        searchArticles({commit, state}, payload) {
            // if (state.loading || state.pagination.current_page >= state.pagination.last_page) {
            //     return false;
            // }

            commit('SEARCH_WORD', payload.q);

            state.search.searching = true;

            // console.log('search action',payload);

            return window.axios.get(`api/article/published`, {
                params: {
                    // page: state.pagination.current_page + 1,
                    take: 2,
                    search: payload.q
                }
            })
                .then((response) => {

                    setTimeout(() => {
                        state.search.searching = false;

                        commit('SEARCH_ARTICLES', response.data);

                    }, 500);

                })
                .catch((error) => {
                    console.log(error);

                })
        },
        loadHomeArticles({commit, state}, payload) {
            if (state.loading || state.pagination.current_page >= state.pagination.last_page) {
                return false;
            }

            state.loading = true;

            // return window.axios.get(`api/article/published?page=${state.pagination.current_page + 1}&take=5`)
            // Query options -> page, take, tag, search
            return window.axios.get(`api/article/published`, {
                params: {
                    page: state.pagination.current_page + 1,
                    take: 5,
                    // ...router.currentRoute.query
                }
            })
                .then((response) => {

                    setTimeout(() => {
                        commit('LOAD_ARTICLES', response.data);
                        state.loading = false
                    }, 500);

                })
                .catch((error) => {
                    console.log(error);

                })
        },
        loadFeaturedArticles({commit, state}, payload) {
            return window.axios.get(`api/article/featured`)
                .then((response) => {

                    setTimeout(() => {
                        commit('LOAD_FEATURED_ARTICLES', response.data);
                    }, 500);

                })
                .catch((error) => {
                    console.log(error);
                })
        }
    },
    getters: {
        // getFeaturedArticles: (state) => {
        //     return state.articles.filter(article => article.featured === 1);
        // }
    }
}
