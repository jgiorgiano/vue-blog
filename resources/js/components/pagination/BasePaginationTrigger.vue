<template>
    <div class="flex self-stretch">
      <span class="px-3 hover:bg-gray-300 border-rounded rounded text-indigo-600 hover:text-indigo-800 transition duration-150 ease-in-out px-2" @click="onClick">
        {{ pageNumber }}
      </span>
    </div>
</template>

<script>
export default {
    props: {
        pageNumber: {
            type: Number,
            required: true
        }
    },

    methods: {
        onClick() {
            this.$emit("loadPage", this.pageNumber);
        }
    }
};
</script>
