<template>
    <div>
        <div class="my-4">
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

export default {
    components: {
        HomeListItem,
        Loading,
        ListItem,
    },
    data() {
        return {}
    },
    computed: {
        articles: function () {
            return this.$store.state.blog.articles;
        }
    },
    beforeCreate() {
        this.$store.dispatch('blog/loadHomeArticles');
    },
    mounted() {
        window.onscroll = () => {
            let bottomOfWindow = Math.max(window.pageYOffset, document.documentElement.scrollTop, document.body.scrollTop) + window.innerHeight === document.documentElement.offsetHeight

            if (bottomOfWindow) {
                this.$store.dispatch('blog/loadHomeArticles');
            }
        }
    },
    methods: {
        loadArticles: function () {
            this.$store.dispatch('blog/loadHomeArticles');
        }
    }
}

</script>

<style>

</style>
