<template>
    <div>
        Dashboard Logged User
        <router-link :to="{ name: 'article-new'}"><indigo-button>Create a new Article</indigo-button></router-link>
    </div>
</template>

<script>
import IndigoButton from "../components/buttons/IndigoButton";

export default {
    components: {
        IndigoButton
    },
    data() {
        return {
            'test': ''
        }
    },
    mounted() {
        // window.axios.get('api/test').then((response) => {
        //     this.test = response.data;
        // });
    }
}
</script>

<style>

</style>
