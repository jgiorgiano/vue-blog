<template>
    <div class="mb-4">
        <p class="text-sm text-gray-600 mb-1" v-if="label">{{ label }}</p>
        <textarea :value="value" @input="updateValue" v-bind="$attrs" :rows="rowsCount"
               class="appearance-none bg-transparent border-2 rounded-md border-gray-500 focus:border-indigo-500 w-full text-gray-800 p-1 px-2 leading-tight focus:outline-none"
               :class="{ 'border-red-500':vErrors.$anyError, 'border-2 rounded bg-gray-200':$attrs.disabled }"
                  :type="type" :placeholder="placeholder" :aria-label="ariaLabel"></textarea>

        <!--Validation Errors-->
        <small v-if="vErrors.$anyError && vErrors.required" class="pl-2 text-red-600">{{ label || 'Field' }} invalid</small>
        <small v-if="vErrors.$anyError && !vErrors.required" class="pl-2 text-red-600">{{ label || 'Field' }} Required</small>

        <!-- Server Return Errors-->
        <small v-if="errors[field]" class="pl-2 text-red-600">{{ errors[field][0] }}</small>
    </div>
</template>


<script>
export default {
    inheritAttrs: false,
    props: {
        field: {
          type: String,
          required: true
        },
        label: {
            type: String,
            default: ''
        },
        value: [String, Number],
        type: {
            type: String,
            default: 'text'
        },
        placeholder: {
            type: String
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
            this.$emit('input', event.target.value)
        }
    },
    computed: {
        rowsCount() {
            let count = (this.value.match(/\n/g) || '').length;

            return count > 10 ? count + 1 : 3;
        }
    }
}
</script>
