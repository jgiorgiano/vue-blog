<template>
    <div>
        <Carrousel></Carrousel>
        <div class="my-4 container mx-auto">
            <ul>
                <li v-for="article in this.articles" :key="article.id">
                    <home-list-item :item="article"></home-list-item>
                </li>
            </ul>
        </div>

        <loading :loading="this.$store.state.blog.loading"></loading>
    </div>
</template>

<script>
import ListItem from "../components/article/list-item";
import Loading from "../components/Loading";
import HomeListItem from "../components/article/home-list-item";
import Carrousel from "../components/carrousel";

export default {
    components: {
        HomeListItem,
        Loading,
        ListItem,
        Carrousel
    },
    data() {
        return {}
    },
    computed: {
        articles: function () {
            return this.$store.state.blog.articles;
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
        loadArticles: function () {
            this.$store.dispatch('blog/loadHomeArticles');
        }
    }
}

</script>

<style>
.gradient {
    /*background: linear-gradient(90deg, #5a67d8 0%, #E9D8FD 100%);*/
    /*background: linear-gradient(90deg, #5a67d8 0%, #FED7E2 100%);*/
    background: linear-gradient(90deg, #5a67d8 0%, #fbb6ce 100%);
    /*background: linear-gradient(90deg, #5a67d8 0%, #E2E8F0 100%);*/
    /*background: linear-gradient(90deg, #5a67d8 0%, #EBF8FF 100%);*/
}
</style>
