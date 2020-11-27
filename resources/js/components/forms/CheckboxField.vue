<template>
    <div>
        <input type="checkbox" :checked="value" @change="updateValue" v-bind="$attrs">
        <span class="pl-1 text-gray-800">
            <slot></slot>
        </span>
        <div>

            <!--Validation Errors-->
            <small v-if="vErrors.$anyError && vErrors.required" class="pl-2 text-red-600">{{ label || 'Field' }} invalid</small>
            <small v-if="vErrors.$anyError && !vErrors.required" class="pl-2 text-red-600">{{ label || 'Field' }} Required</small>

            <!-- Server Return Errors-->
            <small v-if="errors[field]" class="pl-2 text-red-600">{{ errors[field][0] }}</small>
        </div>
    </div>
</template>
<script>
export default {
    inheritAttrs: false,
    props: {
        value: [String, Number, Boolean],
        field: {
            type: String,
            required: true
        },
        label: {
            type: String,
            default: ''
        },
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
