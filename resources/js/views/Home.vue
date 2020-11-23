<template>
    <div>
        <div class="my-4">
            <ul class="grid grid-cols-1 gap-4">
                <li v-for="article in this.articles" :key="article.id">
                    <list-item :item="article"></list-item>
                </li>
            </ul>
        </div>

        <loading :loading="this.$store.state.blog.loading"></loading>
    </div>
</template>

<script>
import ListItem from "../components/article/list-item";
import Loading from "../components/Loading";

export default {
    components: {
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
