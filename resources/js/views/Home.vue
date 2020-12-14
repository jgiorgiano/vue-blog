<template>
    <div>
        <FeaturedArticlesCarrousel></FeaturedArticlesCarrousel>
        <div class="my-8 container mx-auto">
            <ul>
                <li v-for="article in this.articles" :key="article.id">
                    <home-list-item :item="article"></home-list-item>
                </li>
            </ul>
        </div>

        <loading :loading="blogLoading"></loading>

        <div v-show="!blogLoading" class="flex justify-center">
            <OutlineIndigoButton type="button" @clicked="loadMore()"
                                 :disabled="!hasMoreToLoad"
                                 class="px-8 mx-auto">
                Load More
            </OutlineIndigoButton>
        </div>
    </div>
</template>

<script>
import ListItem from "../components/article/list-item";
import Loading from "../components/Loading";
import HomeListItem from "../components/article/home-list-item";
import OutlineIndigoButton from "../components/buttons/OutlineIndigoButton";
import FeaturedArticlesCarrousel from "../components/featuredArticlesCarrousel";

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
            return this.$store.state.blog.articles;
        },
        blogLoading() {
            return this.$store.state.blog.loading;
        },
        hasMoreToLoad() {
            return this.$store.state.blog.pagination.current_page < this.$store.state.blog.pagination.last_page;
        }
    },
    mounted() {
        this.loadArticles();
        // window.onscroll = () => {
        //     let bottomOfWindow = Math.max(window.pageYOffset, document.documentElement.scrollTop, document.body.scrollTop) + window.innerHeight === document.documentElement.offsetHeight
        //
        //     if (bottomOfWindow) {
        //         this.loadArticles();
        //     }
        // }
    },
    methods: {
        loadArticles() {
            this.$store.dispatch('blog/loadHomeArticles');
        },
        loadMore() {
            this.loadArticles();
        }
    }
}

</script>

<style>
.gradient {
    /*background: linear-gradient(90deg, #5a67d8 0%, #E9D8FD 100%);*/
    /*background: linear-gradient(90deg, #5a67d8 0%, #FED7E2 100%);*/
    background: linear-gradient(90deg, #5a67d8 15%, #fbb6ce 110%);
    /*background: linear-gradient(90deg, #5a67d8 0%, #E2E8F0 100%);*/
    /*background: linear-gradient(90deg, #5a67d8 0%, #EBF8FF 100%);*/
}

@media (max-width: 768px) {
    .gradient {
        background: linear-gradient(90deg, #5a67d8 50%, #f691b4 130%);
    }
}


</style>
