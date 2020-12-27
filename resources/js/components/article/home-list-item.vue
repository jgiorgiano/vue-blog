<template>
    <ul>
        <li v-for="article in this.articles" :key="article.id">
            <home-item :item="article"></home-item>
        </li>
    </ul>
</template>

<script>

import homeItem from './home-item';

export default {
    components: {
        homeItem
    },
    computed: {
        articles() {
            return this.$store.state.blog.articles;
        },
    }
}
</script>
