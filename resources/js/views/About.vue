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
                            Hello, my name is Jhonathan and I am a full-stack self-taught web developer. <br>
                            I've started my professional career in web development on March 2019 in a company working on an
                            application created using PHP, Laravel, MySQL, Jquery, and Bootstrap.
                            My role in the company involves maintaining the code base and building new
                            features for the application.
                        </p>
                        <div class="flex justify-center md:justify-start">
                            <router-link :to="{ name: 'curriculum'}">
                                <IndigoButton class="mt-4">Curriculum</IndigoButton>
                            </router-link>
                        </div>
                    </div>
                </section>

                <section class="text-gray-800 leading-7">
                    <p>
                        This is my personal blog where I want to share some of the articles and knowledge used on my
                        daily
                        work, learning path, and used as a laboratory for applying new techs and knowledge.
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
import IndigoButton from "../components/buttons/IndigoButton";
import IndigoTextLink from "../components/buttons/IndigoTextLink";

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
                    'content' : ['PHP 7.4', 'Laravel 8.0', 'MySQL']
                },
                {
                    'title' : 'Front-end',
                    'content' : ['Javascript', 'VueJs 2', 'Vuex', 'Vue Router', 'GSAP', 'tailwind Css 1.9']
                },
                {
                    'title' : 'Server',
                    'content' : ['AWS Lightsail', 'linux - Ubuntu 20.04', 'Nginx', 'HTTPS']
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
