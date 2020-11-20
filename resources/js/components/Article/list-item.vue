<template>
    <router-link
        :to="{ name: 'article-edit', params: { id: item.id }}"
         class="bg-gray-100 border border-l-8 hover:bg-indigo-100 hover:shadow-lg group block rounded-lg p-4"
        :class="borderColor(item.status)">
        <dl class="block lg:grid xl:block grid-cols-2 grid-rows-2 items-center">
            <div>
<!--                <dt class="sr-only">Title</dt>-->
                <dd class="text-lg">
                    Title: {{ item.title }}
                </dd>
            </div>
            <div class="col-start-1 row-start-2 row-end-3">
<!--                <dt class="sr-only">Tags</dt>-->
                <dd>
                    Tags: {{ item.tags }}
                </dd>
            </div>
            <div class="col-start-1 row-start-3 row-end-4">
<!--                <dt class="sr-only">Created By</dt>-->
                <dd class="text-sm text-gray-600">
                    Created by: {{ item.user.name }} @ {{ item.created_at }}
                </dd>
            </div>
            <div class="col-start-2 row-start-2 row-end-3">
                <!--                <dt class="sr-only">Actions</dt>-->
                <dd class="flex justify-end">
                    <span>Status: {{ loadStatus(item.status) }} | </span>
                    <span v-if="item.featured"> Featured | </span>
                    <span> Position: {{ item.position }}</span>

                    <IndigoButton class="mx-2">Preview</IndigoButton>
                    <!--                                <img x-for="user in item.users" :src="user.avatar" :alt="user.name" width="48" height="48" class="w-7 h-7 rounded-full bg-gray-100 border-2 border-white" />-->
                </dd>
            </div>
        </dl>
    </router-link>

</template>

<script>

import IndigoButton from "../../components/buttons/IndigoButton";

export default {
    components: {
        IndigoButton
    },
    props: {
        item: {
            type: [Object, Array],
            required: true
        }
    },
    methods:{
        borderColor: function (status) {
            switch (status) {
                case 0:
                    return 'border-orange-400';
                case 1:
                    return 'border-green-400';
                case 2:
                    return 'border-red-400';
                case 3:
                    return 'border-yellow-400';
            }
        },
        loadStatus: function (statusId) {
           return this.$store.getters["article/getStatusById"](statusId).description;
        }
    }
}
</script>
