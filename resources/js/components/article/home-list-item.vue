<template>
    <router-link :to="{ name: 'article-show', params: { id: item.id }}"
                 class="flex h-full bg-gray-100 border hover:bg-indigo-100 hover:shadow-md group block rounded-lg p-4 my-4">
        <dl class="flex items-center">
            <div>
                <img class="w-32 h-32 -m-3 mr-2" src="img/img-placeholder.png" alt="user image">
            </div>
            <div class="flex-1">
                <div>
                    <dt class="sr-only">Title</dt>
                    <dd class="text-lg">
                       {{ item.title }}
                    </dd>
                </div>
                <div class="">
                    <dt class="sr-only">Created By</dt>
                    <dd class="text-sm text-gray-600">
                        By: {{ item.user.name }} @ {{ item.created_at }}
                    </dd>
                </div>
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
}
</script>
