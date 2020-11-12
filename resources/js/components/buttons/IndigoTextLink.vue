<template>
    <router-link :to="{ name: routeName }"
                 class="mt-4 flex-shrink-0 border-transparent border-4 text-indigo-500 hover:text-indigo-800 text-sm py-1 px-2 rounded transition ease-in duration-75"
    >
        <slot></slot>
    </router-link>
</template>

<script>
export default {
    inheritAttrs: false,
    props: {
        routeName: {
            type: String,
            required: true
        },
    }
}
</script>
