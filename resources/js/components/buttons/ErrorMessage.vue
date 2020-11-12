<template>
    <div class="flex w-full justify-center">
        <small v-if="errorMessage" class="text-red-600 text-center" v-bind="$attrs">
            {{ errorMessage }}
        </small>
    </div>
</template>

<script>
export default {
    props: {
        errorMessage: {
            String,
            required: true,
            default: ''
        }
    }
}
</script>
