<template>
    <div class="container mx-auto px-4">
        <breadcrumb :link="{ 'description': 'About' }"></breadcrumb>
        <div class="j-card p-6">
            <div class="j-card-header">
                <h3 class="j-card-title">About</h3>
            </div>

            <router-link :to="{ name: 'curriculum'}">
                <IndigoButton>My Curriculum</IndigoButton>
            </router-link>
        </div>

    </div>
</template>

<script>
import IndigoButton from "../components/buttons/IndigoButton";

export default {
    components: {
        IndigoButton
    }
}
</script>

<style>

</style>
