<template>
    <div>
        <div class="min-h-screen bg-gray-100 pb-24">
            <v-navbar></v-navbar>
            <transition name="fade" mode="out-in">
                 <router-view class="container mx-auto p-2"></router-view>
            </transition>
        </div>
        <v-footer class="h-24 -mt-24 bg-gray-900 text-white"></v-footer>
    </div>
</template>

<script>

</script>

<style>

</style>
