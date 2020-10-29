<template>
    <div>
        <ul>
            <li>Email SENT</li>
            <li>Confirm email view</li>
            <li>click to resend email confirmation after 60 sec</li>
        </ul>
        {{ user }}
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: this.$store.state.user.user,
        }
    },
    mounted() {


    }
}
</script>

<style>

</style>
