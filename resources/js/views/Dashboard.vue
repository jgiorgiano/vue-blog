<template>
    <div>
        <div class="flex justify-between m-4">
            <h3 class="inline-block">Dashboard Logged User</h3>

            <router-link :to="{ name: 'article-create'}">
                <indigo-button>Create a new Article</indigo-button>
            </router-link>
        </div>

        <div>
            <ul class="grid grid-cols-1 xl:grid-cols-2 gap-4">
                <li v-for="article in this.articles" :key="article.id">
                    <list-item :item="article"></list-item>
                </li>
            </ul>
        </div>



    </div>
</template>

<script>
import IndigoButton from "../components/buttons/IndigoButton";
import ListItem from "../components/article/list-item";

export default {
    components: {
        ListItem,
        IndigoButton
    },
    data() {
        return {}
    },
    computed: {
        articles: function () {
            return this.$store.state.article.articles;
        }
    },
    mounted() {
        this.$store.dispatch('article/loadAllArticles');
    }
}
</script>

<style>

</style>
