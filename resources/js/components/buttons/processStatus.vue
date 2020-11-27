<template>
    <div v-bind="$attrs">
        <span v-if="status === 0"><slot></slot></span>
        <span v-if="status === 1">Processing<v-icon class="mx-1" name="spinner" spin/></span>
        <span v-if="status === 2">Complete<v-icon class="mx-1" name="check-circle"/></span>
    </div>
</template>

<script>
export default {
    props: {
        status: {
            required: true,
            type: Number,
            default: 0
        }
    }
}
</script>
