<template>
    <div class="container mx-auto px-4">
        <breadcrumb :link="{ 'description': 'About' }"></breadcrumb>
        <div class="j-card">
            <div class="j-card-header">
                <h3 class="j-card-title">About</h3>
            </div>
            <div>
                <section class="my-4 block md:flex items-start lg:items-center">

                    <img class="my-4 md:my-0 w-40 rounded-full mx-auto md:mx-16 md:order-2" src="img/jmg.jpeg"
                         alt="user image">

                    <div>
                        <p class="text-gray-800 leading-7">
                            Hi There, I'm Jhonathan, a full-stack web developer.<br>
                            I have started my professional career in March 2019 working on an application built on MVC,
                            Laravel, PHP, MySql, Javascript, Bootstrap.
                        </p>
                        <router-link :to="{ name: 'resume'}" >
                            <p class="text-indigo-600 hover:text-indigo-800">Check my resume</p>
                        </router-link>
                    </div>
                </section>

                <section class="text-gray-800 leading-7">
                    <p>
                        This is my personal blog where I want to share some of the articles and knowledge used on my
                        daily work, learning path, and used as a laboratory for applying new techs and knowledge.
                    </p>
                    <h3 class="mt-4 mb-2 font-medium">Technologies Used on this project:</h3>
                    <div class="block md:flex flex-1 justify-between mx-4">
                        <div class="my-2"
                            v-for="tech in techs" :key="tech.title">
                                <h3 class="font-medium">{{ tech.title }}</h3>
                            <ul class="pl-2">
                                <li v-for="name in tech.content" :key="name"
                                    class="text-gray-800 leading-7">
                                    <v-icon name="caret-right"></v-icon>
                                    <span>{{ name }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

<!--                    <ul>-->
<!--                        <li v-for="tech in techs" :key="tech.title"-->
<!--                            class="text-gray-800 mx-4 leading-7">-->
<!--                            <v-icon name="caret-right"></v-icon>-->
<!--                            <span class="px-2">{{ tech.title }}</span>-->
<!--                        </li>-->
<!--                    </ul>-->
                </section>
            </div>
        </div>
    </div>
</template>

<script>
import IndigoButton from "@/components/buttons/IndigoButton";
import IndigoTextLink from "@/components/buttons/IndigoTextLink";

export default {
    components: {
        IndigoTextLink,
        IndigoButton
    },
    data() {
        return {
            'techs': [
                {
                    'title' : 'Back-end',
                    'content' : ['PHP 7.4', 'Laravel 8.0', 'MySQL', 'PHPUnit Test']
                },
                {
                    'title' : 'Front-end',
                    'content' : ['Javascript', 'VueJs 2', 'Vuex', 'Vue Router', 'GSAP', 'Tailwind CSS']
                },
                {
                    'title' : 'Server',
                    'content' : ['AWS Lightsail', 'Linux - Ubuntu 20.04', 'Nginx', 'HTTPS']
                },
                {
                    'title' : 'Other',
                    'content' : ['Github', 'Github actions (CI/CD)']
                },
            ]
        }
    }
}
</script>

<style>

</style>
