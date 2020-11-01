<template>
    <div class="flex w-full justify-center">
        <small v-if="processing" class="text-blue-600 text-center" v-bind="$attrs">
            Processing
        </small>
    </div>
</template>

<script>
export default {
    props: {
        processing: {
            Boolean,
            required: true,
            default: 'false'
        }
    }
}
</script>
