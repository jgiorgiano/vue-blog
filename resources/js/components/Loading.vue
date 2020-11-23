<template>
    <div class="flex w-full justify-center">
        <p v-if="loading" class="my-6 text-2xl text-blue-600 text-center" v-bind="$attrs">
           Loading <v-icon class="mx-1" name="spinner" spin/>
        </p>
    </div>
</template>

<script>

export default {
    props: {
        loading: {
            Boolean,
            required: true,
            default: 'false'
        }
    }
}
</script>
