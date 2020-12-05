<template>
    <router-link :to="{ name: 'article-show', params: { id: item.id }}"
                 class="flex h-full bg-white rounded-2xl p-4 my-4 mx-4 hover:shadow-md">
        <dl class="block md:flex">
            <div class="flex justify-center md:items-center">
                <img class="w-56 h-56 md:mx-4 rounded" src="img/undraw_Modern_life_re_8pdp.svg" alt="user image">
            </div>
            <div class="flex-1 flex flex-col justify-between px-4">
                <div>
                    <dt class="sr-only">Title</dt>
                    <dd class="text-3xl text-gray-800 md:text-4xl pt-4 md:pt-0">
                       {{ item.title }}
                    </dd>
                    <dt class="sr-only">Title</dt>
                    <dd class="text-md py-1 text-gray-700">
                        <!-- @todo Change for the Short Description when implemented -->
                        {{ item.content.slice(0, 200) }}{{ parseInt(item.content.length) > 200 ? '...'
                        : '' }}
                    </dd>
                </div>
                <div class="justify-self-end">
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
