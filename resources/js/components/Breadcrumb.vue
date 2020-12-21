<template>
    <div class="text-sm md:text-base text-gray-600 -mt-3 mb-2 p-2 flex">

        <router-link
            :to="{ name: 'home'}"
            class="hover:text-gray-800 transition duration-150 ease-in-out "
        >
            <p>Home</p>
        </router-link>

        <span class="px-2">|</span>
        <p>{{ link.description }}</p>
    </div>
</template>

<script>
export default {
    data() {
        return {}
    },
    props: ['link'],
}

</script>
