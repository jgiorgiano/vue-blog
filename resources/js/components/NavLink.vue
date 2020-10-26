<template>
    <router-link :to="{ name: routeName}"
                 class="text-lg font-medium text-gray-500 hover:text-indigo-900 transition duration-150 ease-in-out px-2">
        <slot></slot>
    </router-link>
</template>

<script>
export default {
    props: {
        routeName: {
            type: String,
            required: true,
        }
    }
}
</script>
