<template>
    <div class="flex py-1 px-2 mx-2">
        <input v-model="searchText"
               class="py-1 px-2 appearance-none w-full bg-transparent rounded border-b-2 border-indigo-800 focus:border-indigo-900 focus:bg-gray-300 focus:bg-opacity-25 text-indigo-800 leading-tight focus:outline-none placeholder-indigo-700 transition duration-150 ease-in-out"
               type="text" placeholder="Search" aria-label="search">
        <button @click.prevent="search()"
                type="button"
                class="px-3 py-1 rounded focus:outline-none hover:bg-gray-300 hover:bg-opacity-25">
            <v-icon name="search"></v-icon>
        </button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            searchText: ''
        }
    },
    methods: {
        search() {
            if(this.searchText.length > 0) {
                this.$router.push({name: 'search', query: {q: this.searchText}})
                this.searchText = '';
            }
        }
    }
}
</script>
