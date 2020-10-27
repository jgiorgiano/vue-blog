<template>
    <div>
        <p class="text-sm text-gray-600"><slot></slot></p>
        <input
            class="appearance-none bg-transparent border-b-2 border-gray-600 focus:border-indigo-500 w-full text-gray-800 mr-3 mb-3 p-1 px-2 leading-tight focus:outline-none"
            type="text" placeholder="" aria-label="Full name">
    </div>
</template>

<script>
export default {
    props: {
        placeholder: {
            String
        },

    }
}
</script>
