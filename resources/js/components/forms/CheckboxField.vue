<template>
    <div>
        <input type="checkbox" :checked="value" @change="updateValue" v-bind="$attrs">
        <span class="pl-1 text-gray-800">
            <slot></slot>
        </span>
    </div>
</template>
<script>
export default {
    inheritAttrs: false,
    props: {
        value: [String, Number, Boolean],
        ariaLabel: {
            type: String,
            default: ''
        },
        vErrors: {
            type: [Object, Boolean],
            default: false
        },
        errors: {
            type: Object
        }
    },
    methods: {
        updateValue(event) {
            this.$emit('input', event.target.checked)
        }
    }
}
</script>
