<template>
    <div>
        <FeaturedArticlesCarrousel></FeaturedArticlesCarrousel>

        <div class="my-8 container mx-auto">

            <h3 class="text-2xl text-gray-800 pb-4">Best results for: <b class="text-3xl">{{ searchText }}</b></h3>
            <div class="text-md text-gray-600 border-t border-b p-2 flex justify-between">
                <span>Results found: {{ this.$store.state.blog.search.pagination.total }}</span>
                <span>Page:  {{ this.$store.state.blog.search.pagination.current_page }} / {{ this.$store.state.blog.search.pagination.last_page }}</span>
            </div>


            <loading :loading="searching"></loading>

            <ul>
                <li v-for="article in this.articles" :key="article.id">
                    <home-list-item :item="article"></home-list-item>
                </li>
            </ul>

            <h3>paginator</h3>

        </div>


    </div>
</template>

<script>
import ListItem from "../components/article/list-item";
import Loading from "../components/Loading";
import HomeListItem from "../components/article/home-list-item";
import OutlineIndigoButton from "../components/buttons/OutlineIndigoButton";
import FeaturedArticlesCarrousel from "../components/featuredArticlesCarrousel";
import {router} from "../app";

export default {
    components: {
        HomeListItem,
        Loading,
        ListItem,
        FeaturedArticlesCarrousel,
        OutlineIndigoButton
    },
    data() {
        return {}
    },
    computed: {
        articles() {
            return this.$store.state.blog.search.articles;
        },
        searchText() {
            return this.$store.state.blog.search.word;
        },
        searching() {
            return this.$store.state.blog.search.searching;
        },
        // hasMoreToLoad() {
        //     return this.$store.state.blog.pagination.current_page < this.$store.state.blog.pagination.last_page;
        // }
    },
    mounted() {
        this.searchArticles();
        // window.onscroll = () => {
        //     let bottomOfWindow = Math.max(window.pageYOffset, document.documentElement.scrollTop, document.body.scrollTop) + window.innerHeight === document.documentElement.offsetHeight
        //
        //     if (bottomOfWindow) {
        //         this.loadArticles();
        //     }
        // }
    },
    beforeRouteUpdate(to, from, next) {

        if(to.query.q) {
            this.$store.dispatch('blog/searchArticles', to.query).then(next);
        }

    },
    updated() {
      // console.log('updated', this.$router.currentRoute.query);
        // this.$store.dispatch('blog/loadHomeArticles')
    },
    methods: {
        searchArticles() {
            this.$store.dispatch('blog/searchArticles', this.$router.currentRoute.query);
        },
        // loadMore() {
        //     this.searchArticles();
        // }
    }
}

</script>

<style>



</style>
