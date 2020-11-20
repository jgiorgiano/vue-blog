<template>
    <div class="min-h-screen px-8 bg-gray-200">
        <div class="container mx-auto">
            <v-navbar></v-navbar>
            <transition name="fade" mode="out-in">
                 <router-view></router-view>
            </transition>
<!--            <v-footer></v-footer>-->
        </div>
    </div>
</template>

<script>

</script>

<style>

</style>
