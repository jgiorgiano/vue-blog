<template>
    <div>
        <div class="container mx-auto">

            <div class="mx-2 mb-4">
                <span class="text-2xl text-gray-800 block md:inline">Best results for:</span>
                <span class="text-2xl text-gray-800 font-bold">{{ searchText }}</span>
            </div>
            <div class="text-gray-600 border-t border-b p-2 flex justify-between">
                <span>Results found: {{ this.$store.state.blog.search.pagination.total }}</span>
                <span>Page:  {{ this.$store.state.blog.search.pagination.current_page }} / {{ this.$store.state.blog.search.pagination.last_page }}</span>
            </div>


            <loading :loading="searching"></loading>

            <ul>
                <li v-for="article in this.articles" :key="article.id">
                    <home-list-item :item="article"></home-list-item>
                </li>
            </ul>

            <BasePagination v-if="articles.length"
                :current-page="pagination.current_page"
                :page-count="pagination.last_page"
                class="articles-list__pagination"
                @nextPage="pageChangeHandle('next');"
                @previousPage="pageChangeHandle('previous');"
                @loadPage="pageChangeHandle"
            />

            <div v-if="!searching && !articles.length"
                class="flex justify-center pt-12">
                <h3 class="text-gray-600">Sorry, We couldn't find anything. Try again</h3>
            </div>

        </div>


    </div>
</template>

<script>
import ListItem from "@/components/article/list-item";
import Loading from "@/components/Loading";
import HomeListItem from "@/components/article/home-list-item";
import OutlineIndigoButton from "@/components/buttons/OutlineIndigoButton";
import FeaturedArticlesCarrousel from "@/components/featuredArticlesCarrousel";
import BasePagination from "@/components/pagination/BasePagination";

export default {
    components: {
        HomeListItem,
        Loading,
        ListItem,
        FeaturedArticlesCarrousel,
        OutlineIndigoButton,
        BasePagination
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
        pagination() {
            return this.$store.state.blog.search.pagination;
        }
    },
    mounted() {
        this.searchArticles();
    },
    beforeRouteUpdate(to, from, next) {
        if(to.query.q) {
            next();
            this.searchArticles();
        }
    },
    methods: {
        searchArticles(page = 1) {
           return this.$store.dispatch('blog/searchArticles', {q: this.$router.currentRoute.query.q, page: page, take: 2});
        },
        pageChangeHandle(value) {
            switch (value) {
                case "next":
                    this.searchArticles(this.$store.state.blog.search.pagination.current_page + 1);
                    break;
                case "previous":
                    this.searchArticles(this.$store.state.blog.search.pagination.current_page - 1);
                    break;
                default:
                    this.searchArticles(value);
                    break;
            }
        }
    }
}

</script>

<style>



</style>
