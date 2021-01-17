<template>
    <div class="container mx-auto" id="curriculum">
        <div id="cv" class="text-gray-900 antialiased leading-tight">
            <div class="mx-auto max-w-a4 p-6 md:p-12 bg-white">

                <header class="uppercase text-gray-800 mb-6">
                    <p class="text-3xl font-bold">
                        Jhonathan Marchi Giorgiano
                    </p>
                    <p>Full-Stack Web Developer</p>
                </header>

                <section class="border-b-4 border-t-4 px-4 py-2 flex flex-col md:flex-row print:flex-row justify-between text-gray-800">
                    <a href="tel:+4407490115036" class="py-1 hover:text-indigo-600 transition-all ease-in duration-75">
                        <v-icon name="phone-volume"></v-icon>
                        07490 115036
                    </a>
                    <a href="mailto: jgiorgiano@gmail.com" class="py-1 hover:text-indigo-600 transition-all ease-in duration-75">
                        <v-icon name="at"></v-icon>
                        jgiorgiano@gmail.com
                    </a>
                    <a href="https://goo.gl/maps/swoysnCxaNFWX7XS7" rel="noopener" target="_blank" class="py-1 hover:text-indigo-600 transition-all ease-in duration-75">
                        <v-icon name="map-marker-alt"></v-icon>
                        Liverpool - UK
                    </a>
                </section>

                <div class="w-full flex flex-col lg:flex-row my-5 leading-snug">

                    <div class="w-full lg:w-1/3 p-3 pb-0 lg:pb-3">

                        <section class="mb-8">
                            <h5 class="text-xl text-gray-800 font-bold uppercase mb-3">About me</h5>
                            <div class="mt-2 text-gray-800 leading-normal">
                                <p>
                                    A Responsible, flexible, and self-motivated full-stack developer who drives for
                                    best results, continuous improvement, and loves learning.
                                </p>
                                <p>
                                    I have started my professional career in March 2019 working on an application built
                                    on MVC, Laravel, PHP, MySql, Javascript, Bootstrap.
                                </p>
                            </div>
                        </section>

                        <section class="mb-8">
                            <h5 class="text-xl text-gray-800 font-bold uppercase mb-3">Education</h5>
                            <div>
                                <h3 class="text-gray-800 font-semibold mb-1">
                                    Bachelor in Business Administration
                                </h3>
                                <p class="text-gray-700 mb-1">
                                   University Centro Herminio Ometto - FHO | 2008 – 2012
                                </p>
                                <p>
                                    The Business Administration degree gave me knowledge of various aspects of a
                                    company such as project management, team-working and problem-solving.
                                </p>
                            </div>
                        </section>

                        <section class="mb-8 hidden lg:block">
                            <h5 class="text-xl text-gray-800 font-bold uppercase mb-3">Social</h5>
                            <div class="mt-2 text-gray-800 leading-normal">
                                <ul>
                                    <li>Linkedin</li>
                                    <li>Tweeter</li>
                                    <li>Github</li>
                                    <li>Gitlab</li>
                                </ul>
                            </div>
                        </section>

                    </div>


                    <div class="w-full lg:w-2/3 p-3">


                        <section class="mb-8">
                            <h5 class="text-xl text-gray-800 font-bold uppercase mb-3">Career</h5>
                            <section class="mb-4 col-break-avoid">
                                <header>
                                    <h3 class="text-lg text-gray-800 font-semibold leading-snug inline">eGov Solutions</h3><a
                                    href="https://epep.tv/" target="_blank" class="text-xs text-gray-600 ml-1">(epep.tv)</a>
                                    <p class="text-gray-700 leading-normal mb-2">
                                        Mar 2019 - Present | Full-Stack Web Developer
                                    </p>
                                </header>
                                <div class="text-gray-800 leading-normal ml-4">
                                    <p>
                                        Responsible for developing new features for the application, understand customers
                                        requirements, maintaining and refactor code using best practices.
                                    </p>
                                    <ul class="list-inside list-disc">
                                        <li>Involved with the team on brainstorm for solutions and features for the
                                            application.</li>
                                        <li>Working on the full-cycle of features frontend, backend and database.</li>
                                        <li>Customization of existing features.</li>
                                        <li>Involved on server migration to AWS Linux server.</li>
                                        <li>Involved on updating php and laravel version for the application.</li>
                                    </ul>
                                </div>
                            </section>
                        </section>

                        <section class="mb-8">
                            <h5 class="text-xl text-gray-800 font-bold uppercase mb-3">Skills</h5>
                            <div class="col-break-avoid mb-4 border-gray-200" v-for="(skill, i) in skills"
                                 :class="i !== skills.length - 1 ? 'border-b-2' : ''">
                                <section class="mb-4 col-break-avoid">
                                    <header>
                                        <div class="flex items-center">
                                            <h3 class="inline text-lg text-gray-800 font-semibold">{{ skill.title }}</h3>
                                        </div>
                                        <p class="text-gray-700 leading-normal mb-2">{{ skill.sub_title }}</p>
                                    </header>
<!--                                    <p class="mt-1 text-gray-700">{{ skill.description }}</p>-->
                                    <ul class="mt-1 mb-6 flex flex-wrap leading-normal">
                                        <li v-for="(tag, index) in skill.tags" key="index"
                                            class="px-3 mr-1 mt-1 text-base text-gray-700 leading-relaxed print:bg-white print:border-inset bg-gray-200">
                                            <v-icon name="caret-right"></v-icon>
                                            <span class="ml-1">{{ tag }}</span>
                                        </li>
                                    </ul>
                                </section>
                            </div>
                        </section>

                    </div>

                </div>




            </div>

        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            skills: [
                {
                    title: 'PHP - Laravel',
                    sub_title: 'Middle Level',
                    description: 'Familiarity with OOP design principles strong understands of Laravel environment as the MVC life cycle. Able to Maintain coding standards and follow good practices. On my studies projects, I have used TDD.',
                    tags: [
                        'OOP', 'MVC', 'API', 'Laravel', 'Eloquent', 'Query Builder'
                    ]
                },
                {
                    title: 'JavaScript, HTML, and CSS',
                    sub_title: 'Middle Level',
                    description: 'I keep learning new technologies like Vue.js, Vuex, NPM, Webpack and TailwindCSS.',
                    tags: ['Vue.js', 'jQuery', 'Tailwind CSS', 'Bootstrap']
                },
                {
                    title: 'MySQL',
                    sub_title: 'Middle Level',
                    description: 'Even in my no-Development jobs, I was able to discuss relational integrity with developers helping them to analyse the data.',
                    tags: ['MySQL', 'MySQLWorkbench']
                },
                {
                    title: 'Others',
                    sub_title: 'Middle Level',
                    description: 'Great knowledge using Git, git-flow a UNIX Terminal. Even using MacOS all the time I\'m familiar with LINUX commands as basic DevOps configuration.',
                    tags: ['GIT', 'MacOS', 'Linux', 'PHPStorm', 'Docker']
                },
                {
                    title: 'Server',
                    sub_title: 'Entry Level',
                    description: 'Familiar with AWS basic configuration and CI/CD used on my study projects.',
                    tags: ['AWS', 'lightsail', 'EC2', 'IAM', 'RDS', 'Github', 'Gitlab']
                },
            ]
        }
    },
}
</script>

<style>

@media print {

    #footer, #navbar {
        display: none;
    }

    #curriculum {
        margin: -30px -20px;
    }
}


</style>
