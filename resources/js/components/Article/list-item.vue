<template>
    <router-link :to="{ name: 'article-edit', params: { id: item.id }}" class="bg-gray-100 border border-gray-200 hover:bg-indigo-100 hover:border-transparent hover:shadow-lg group block rounded-lg p-4 ">
        <dl class="block lg:grid xl:block grid-cols-2 grid-rows-2 items-center">
            <div>
                <dt class="sr-only">Title</dt>
                <dd class="leading-6 font-medium text-black">
                    Title: {{ item.title }}
                </dd>
            </div>
            <div class="col-start-1 row-start-2 row-end-3">
                <dt class="sr-only">Tags</dt>
                <dd class="font-medium">
                    Tags: {{ item.tags }}
                </dd>
            </div>
            <div class="col-start-1 row-start-3 row-end-4">
                <dt class="sr-only">Created By</dt>
                <dd class="text-sm font-medium text-gray-600">
                    Created by: {{ item.user_id }} @ {{ item.created_at }}
                </dd>
            </div>
            <div class="col-start-2 row-start-2 row-end-3">
                <dt class="sr-only">Actions</dt>
                <dd class="flex justify-center -space-x-2">
                    <IndigoButton>Position</IndigoButton>
                    <IndigoButton>Featured</IndigoButton>
                    <IndigoButton>Status</IndigoButton>
                    <IndigoButton>Edit</IndigoButton>
                    <IndigoButton>Preview</IndigoButton>
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
    }
}
</script>
