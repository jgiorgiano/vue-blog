<template>
    <div @click="open(item)" class="flex h-full bg-white rounded-2xl p-4 my-4 mx-4 hover:shadow-md transition ease-in duration-75 cursor-pointer">
            <dl class="block md:flex">
                <div class="flex justify-center md:items-center">
                    <img class="w-40 h-40 md:mx-4 rounded" :src="item.images || 'img/article-placeholder.svg'" alt="article image">
                </div>
                <div class="flex-1 flex flex-col justify-between px-4">
                    <div>
                        <dt class="sr-only">Title</dt>
                        <dd class="text-xl text-gray-800 md:text-2xl font-medium pt-4 md:pt-0">
                           {{ item.title }}
                        </dd>
                        <dt class="sr-only">Description</dt>
                        <dd class="text-md py-1 text-gray-700">
                            {{ getDescription(item) }}
                        </dd>
                    </div>
                    <div class="justify-self-end">
                        <div>
                            <dt class="sr-only">Created By</dt>
                            <dd class="text-sm text-gray-600">
                                <div v-if="item.type === 1">
                                    <span>By: {{ item.user.name }} @ {{ $dayjs(item.created_at).toString() }}</span>
                                </div>
                                <div v-else>
                                    <span class="text-indigo-600">
                                        Link to: {{ item.external_link }} @ {{ $dayjs(item.created_at).toString() }}
                                    </span>
                                </div>
                            </dd>
                        </div>
                    </div>
                </div>
            </dl>
    </div>
</template>

<script>
export default {
    props: {
        item: {
            type: [Object, Array],
            required: true
        }
    },
    methods: {
        getDescription(article) {

            if(article.description) {
                return article.description;
            }

           return article.content.slice(0, 200) + ((parseInt(article.content.length) > 200) ? '...' : '');
        },
        open(article) {
            if(article.type === 1) {
                this.$router.push({name: 'article-show', params: { id: article.id }})
            } else {
                window.open(article.external_link);
            }
        }
    }
}
</script>
