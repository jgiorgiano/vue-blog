<template>
    <div class="flex w-full justify-center">
        <small v-if="responseMessage" class="text-green-600 text-center" v-bind="$attrs">
            {{ responseMessage }}
        </small>
    </div>
</template>

<script>
export default {
    props: {
        responseMessage: {
            String,
            required: true,
            default: ''
        }
    }
}
</script>
