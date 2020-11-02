<template>
    <div>
        <input type="checkbox" @change="updateValue" v-bind="$attrs">
        <span class="pl-1 text-gray-800">
            <slot></slot>
            I agree with the terms and conditions.
        </span>
    </div>
</template>
<script>
export default {
    inheritAttrs: false,
    props: {
        value: [String, Number],
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
            console.log(event);
            this.$emit('input', event.target.checked)
        }
    }
}
</script>
