<template>
    <div class="min-h-screen flex flex-col bg-gray-100">
        <v-navbar></v-navbar>
        <transition name="fade" mode="out-in">
            <router-view class="flex-1"></router-view>
        </transition>
        <v-footer></v-footer>
    </div>
</template>

<script>

</script>

<style>

</style>
