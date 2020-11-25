<template>
    <div class="flex flex-col justify-center items-center">
        <div class="j-card mt-4">
            <div class="mb-8 px-6">
                <h3 class="text-5xl text-gray-800 py-2">{{ article.title }}</h3>
                <div class="text-md text-gray-600 border-t border-b p-2">
                    <span>By: {{ article.user ? article.user.name : '' }} IN {{ article.tags }} @ {{ article.created_at }}</span>
                </div>

            </div>
            <div class="px-6 text-gray-800">
                <p class="first-char">
                    {{ article.content }}
                </p>

<!--                <TextAreaField-->
<!--                    label="Content"-->
<!--                    field="content"-->
<!--                    v-model="$v.article.content.$model"-->
<!--                    type="text"-->
<!--                    :v-errors="$v.article.content"-->
<!--                    :errors="errors"-->
<!--                />-->

<!--                <InputField-->
<!--                    label="Tags"-->
<!--                    field="tags"-->
<!--                    v-model="$v.article.tags.$model"-->
<!--                    type="text"-->
<!--                    :v-errors="$v.article.tags"-->
<!--                    :errors="errors"-->
<!--                />-->

<!--                <SelectField-->
<!--                    class="md:w-1/2"-->
<!--                    label="Status"-->
<!--                    field="status"-->
<!--                    v-model="$v.article.status.$model"-->
<!--                    :v-errors="$v.article.status"-->
<!--                    :errors="errors"-->
<!--                    :options="statusOptions"/>-->

<!--                <checkbox-field class="my-2"-->
<!--                    field="featured"-->
<!--                    v-model="$v.article.featured.$model"-->
<!--                    :v-errors="$v.article.featured"-->
<!--                    :errors="errors"-->
<!--                >-->
<!--                    Feature the Article-->
<!--                </checkbox-field>-->




                <!--                <div class="mb-5">-->
                <!--                    <p class="text-gray-800">Upload your profile picture</p>-->
                <!--                    <input type="file" ref="file" @change="handleFileUpload()">-->
                <!--                </div>-->

                <div class="py-2 flex justify-end">

                </div>
            </div>

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
