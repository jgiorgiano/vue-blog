<template>
    <div>
        Dashboard Logged User
        {{ test }}
    </div>
</template>

<script>
export default {
    data() {
        return {
            'test': ''
        }
    },
    mounted() {
        window.axios.get('api/test').then((response) => {
            this.test = response.data;
        });
    }
}
</script>

<style>

</style>
