<template>
        <div class="container mx-auto px-4">
            <breadcrumb :link="{ 'description': article.title }"></breadcrumb>
            <div class="j-card p-6">
                <h3 class="text-xl md:text-3xl text-gray-800 pb-4">{{ article.title }}</h3>
                <p class="text-md text-gray-600 border-t border-b p-4">
                    By: {{ article.user ? article.user.name : '' }} IN {{ article.tags }} @ {{ $date(article.created_at).toString() }}
                </p>
                <p class="first-char text-gray-800 py-4">
                    {{ article.content }}
                </p>
                <p class="text-md text-gray-600 pt-4 flex justify-end">
                    By: {{ article.user ? article.user.name : '' }} @ {{ $date(article.created_at).toString() }}
                </p>
            </div>
        </div>
</template>

<script>

export default {
    data() {
        return {
            article: {
                title: '',
                content: '',
                tags: '',
                featured: 0,
                status: 0,
                position: 0,
                images: null,
            },
            errors: {}
        }
    },
    methods: {},
    computed: {},
    created() {
        let article = this.$store.getters["article/getArticleById"](this.$route.params.id);

        if (article) {
            return this.article = article;
        }

        this.$store.dispatch('article/loadArticle', this.$route.params.id).then(response => {
            this.article = response;
        }).catch(error => console.log(error));
    }

}
</script>

<style>
.first-char::first-letter {
    font-size: 3rem;
    padding-left: 1rem;
    padding-right: 2px;
}
</style>
