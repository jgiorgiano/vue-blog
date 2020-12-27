<template>
    <button
            class="z-50 fixed right-0 bottom-0 mb-12 mr-8 text-indigo-500 focus:outline-none hover:animate-bounce"
            @click="scrollToTop">
        <v-icon name="arrow-circle-up" scale="2"></v-icon>
    </button>
</template>

<script>
import {gsap} from "gsap";
import { ScrollToPlugin } from "gsap/ScrollToPlugin";

gsap.registerPlugin(ScrollToPlugin);

export default {
    methods: {
        scrollToTop() {
            gsap.to(window, { duration: 0.5, scrollTo: 0, ease: "circ" })
        }
    }
}
</script>
