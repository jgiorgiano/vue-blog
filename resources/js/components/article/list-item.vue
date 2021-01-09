<template>
    <div class="h-full bg-gray-100 border border-l-8 hover:shadow-sm group block rounded-lg p-4"
         :class="borderColor(item.status)">
        <dl class="flex items-center">
            <div class="flex-1 block">
                <div>
                    <dt class="sr-only">Title</dt>
                    <dd class="text-lg">
                       Title: {{ item.title }}
                    </dd>
                </div>
                <div class="">
                    <dt class="sr-only">Tags</dt>
                    <dd>
                        Tags: {{ item.tags }}
                    </dd>
                </div>
                <div class="">
                    <dt class="sr-only">Created By</dt>
                    <dd>
                        <span>Status: {{ loadStatus(item.status) }} | </span>
                        <span v-if="item.featured"> Featured | </span>
                        <span> Position: {{ item.position }}</span>
                    </dd>
                </div>
                <div class="">
                    <dt class="sr-only">Created By</dt>
                    <dd class="text-sm text-gray-600">
                        Created by: {{ item.user ? item.user.name : '' }} @ {{ $date(item.created_at).toString() }}
                    </dd>
                </div>
            </div>
            <div>
                <dt class="sr-only">Actions</dt>
                <dd class="flex flex-col">
                    <router-link :to="{ name: 'article-edit', params: { id: item.id }}" class="flex">
                        <IndigoButton class="m-2 flex-1">Edit</IndigoButton>
                    </router-link>
                    <router-link :to="{ name: 'article-edit', params: { id: item.id }}"  class="flex">
                        <IndigoButton class="m-2 flex-1">Preview</IndigoButton>
                    </router-link>
                    <!--                                <img x-for="user in item.users" :src="user.avatar" :alt="user.name" width="48" height="48" class="w-7 h-7 rounded-full bg-gray-100 border-2 border-white" />-->
                </dd>
            </div>
        </dl>
    </div>

</template>

<script>

import IndigoButton from "@/components/buttons/IndigoButton";

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
    methods: {
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
