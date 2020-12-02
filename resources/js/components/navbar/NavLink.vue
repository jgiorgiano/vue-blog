<template>
    <div @click="btnClick" class="py-1 mx-2 my-1 hover:bg-gray-300 hover:bg-opacity-25 border-rounded rounded focus:text-indigo-500 text-lg font-medium text-indigo-600 hover:text-indigo-900 transition duration-150 ease-in-out px-2">
        <slot></slot>
    </div>
</template>

<script>
export default {
    methods: {
        btnClick: function () {
            //Close menu
            this.$store.commit('MENU_CHANGE', false);
        }
    }
}
</script>
