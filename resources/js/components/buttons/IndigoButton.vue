<template>
    <button
        class="flex-shrink-0 bg-indigo-500 hover:bg-indigo-700 border-indigo-500 focus:border-0 hover:border-indigo-700 text-sm border-4 text-white py-1 px-2 rounded transition ease-in duration-75"
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
