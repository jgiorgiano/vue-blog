<template>
    <button
        class="border border-indigo-600  py-1 mx-2 my-1  border-rounded rounded focus:text-indigo-500 text-lg font-medium text-indigo-600 transition duration-150 ease-in-out px-2"
        :class="{ 'opacity-25 cursor-not-allowed':$attrs.disabled, 'hover:border-indigo-900 hover:bg-gray-300 hover:bg-opacity-25 hover:text-indigo-900':!$attrs.disabled }"
        :disabled="$attrs.disabled"
        :type="type"
        v-bind="$attrs"
        @click="clicked($attrs)">
        <slot></slot>
    </button>
</template>

<script>
export default {
    inheritAttrs: false,

    props: {
        type: {
            type: String,
            default: 'submit'
        },
    },
    methods: {
        clicked(atr) {
            this.$emit('clicked');
        }
    }
}
</script>
