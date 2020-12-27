<template>
    <div class="container mx-auto">
        <div id="cv" class="font-sans leading-relaxed text-gray-900 antialiased">
            <div class="mx-auto max-w-a4 md:h-a4 p-6 sm:p-8 md:p-16 bg-white">

                <div class="md:col-2 print:col-2 col-gap-md md:h-a4-col print:h-a4-col col-fill">
                    <header class="flex items-center">
<!--                        <div-->
<!--                            class="initials-container mr-2 text-base leading-none text-white font-medium print:bg-black p-2">-->
<!--                            <img class="h-24 w-24 rounded-full shadow-md" src="images/avatar.jpg" alt="">-->
<!--                        </div>-->
                        <div class="leading-none mb-8">
                            <h1 class="text-2xl font-bold uppercase text-gray-800">Jhonathan Marchi Giorgiano</h1>
                            <small class="uppercase">Full-Stack Developer</small>
                        </div>
                    </header>

                    <section class="mb-8">
                        <div class="col-break-avoid">
                            <h2 class="text-sm text-gray-600 font-bold print:font-normal tracking-widest">ABOUT ME</h2>
                            <div class="h-full border-b-4 mb-4"></div>

                            <section class="mb-2 col-break-avoid">
                                <header>
                                    <h3 class="text-lg text-gray-800 font-semibold leading-snug">Full-Stack PHP
                                        Developer</h3>
                                </header>
                                <p class="mt-2 text-gray-800 leading-normal">
                                        A self-motivated full-stack self-taught developer who is always looking for
                                        continuous improvement and loves learning.
                                        I've Professional experience working in an application built in PHP, Laravel,
                                        MySQL, Jquery, and Bootstrap.
<!--                                    A passionate full-stack self-taught developer that is aways aiming to learn. I’ve-->
<!--                                    commercial experience working in an application built in Laravel, jQuery, Bootstrap-->
<!--                                    and MySQL where I was responsible for making new features from scratch, going-->
<!--                                    through all the areas of the development.-->
                                </p>
                            </section>

                        </div>
                    </section>

                    <div class="col-break-avoid">
                        <h2 class="text-sm text-gray-600 font-bold print:font-normal tracking-widest">EXPERIENCE</h2>
                        <div class="h-full border-b-4 mb-4"></div>
                    </div>

                    <section class="mb-4 col-break-avoid">
                        <header>
                            <h3 class="text-lg text-gray-800 font-semibold leading-snug inline">eGov Solutions</h3><a
                            href="https://epep.tv/" target="_blank" class="text-xs text-gray-600 ml-1">(epep.tv)</a>
                            <p class="text-gray-700 leading-normal mb-2">Mar 2019 | Full-Stack PHP
                                Developer</p>
                        </header>
                        <div class="text-gray-800 leading-normal">
<!--                            Saas for 35 clients-->
<!--                                refactoring code usign good practices-->
<!--                                migration to AWS linux serve-->
<!--                                    attendance collection-->
<!--                                    vs dashboard-->
<!--                                    sections-->
<!--                                    upgrade to laravel 7.4-->

<!--                            <p>Under the guidance of senior developer, I am responsible for analysis issues, design and-->
<!--                                code new features and improvements for an existing web application. Qualified to the-->
<!--                                development from the frontend end to the backend end throughout the Database. Worked in-->
<!--                                a Multitenancy platform for 35 councils.</p>-->
<!--                            <p>Refactored the core of the application reducing class with thousands of lines and-->
<!--                                hundreds of requests to just a few, applying methods as DRY and OOP and clean code,-->
<!--                                making it much easier to maintain and productive to escalate. Restructured the database,-->
<!--                                creating referential integrity between registers running multiples SYNC to fix old-->
<!--                                hardcoding.</p>-->
<!--                            <p>I have worked directly in a creation of a Microservice for reports, wherein a night-->
<!--                                routine all the data are migrated from MYSQL to a MongoDB making the reports much faster-->
<!--                                and the MYSQL free for others requests during the day. I helped to Migrate the server-->
<!--                                from Windows Server to Linux in AWS. Most relevant tools used in this role: Docker,-->
<!--                                Continues Integration, GitLab, SSH.</p>-->

                        </div>
                    </section>

                    <section class="mt-8">
                        <div class="col-break-avoid">

                            <h2 class="text-sm text-gray-600 font-bold print:font-normal tracking-widest">
                                EDUCATION</h2>
                            <div class="h-full border-b-8 mb-4"></div>

                            <section class="mb-4 col-break-avoid">
                                <header>
                                    <h3 class="text-lg text-gray-800 font-semibold leading-snug">Bachelor in Business
                                        Administration</h3>
                                    <p class="text-gray-700 leading-normal mb-2">2008 – 2012 | University Centro Herminio Ometto - FHO</p>
                                    <p>This degree gave me technical skills and knowledge such as
                                        project management, resource management, communication, team-working and
                                        problem-solving.</p>
                                </header>
                            </section>

                        </div>


                    </section>

                    <section class="mt-4 py-2 px-4 bg-gray-100 col-break-avoid">

                        <h2 class="text-2xl text-gray-800 font-extrabold print:font-normal tracking-widest">Key
                            skills</h2>
                        <div class="h-full border-b-2 mb-4"></div>

                        <div class="col-break-avoid mb-4 border-gray-200" v-for="(skill, i) in skills"
                             :class="i !== skills.length - 1 ? 'border-b-2' : ''">
                            <section class="mb-4 col-break-avoid">
                                <header>
                                    <div class="flex items-center">
                                        <h3 class="inline text-lg text-gray-800 font-semibold">@{{ skill.title }}</h3>
                                    </div>
                                    <p class="text-gray-700 leading-normal mb-2">@{{ skill.sub_title }}</p>
                                </header>
                                <p class="mt-1 text-gray-700">@{{ skill.description }}</p>
                                <ul class="mt-1 mb-6 flex flex-wrap leading-normal">
                                    <li v-for="(tag, index) in skill.tags" key="index"
                                        class="px-3 mr-1 mt-1 text-base text-gray-700 leading-relaxed print:bg-white print:border-inset bg-gray-200">
                                        @{{ tag }}
                                    </li>
                                </ul>
                            </section>


                        </div>


                    </section>

                    <section class="mt-8 py-2 px-4">

                        <div class="col-break-avoid">

                            <h2 class="text-sm text-gray-600 font-bold print:font-normal tracking-widest">CONTACT</h2>
                            <div class="h-full border-b-8 mb-4"></div>

                            <section class="mb-4 col-break-avoid">
                                <ul>
                                    <li class="mt-1 pl-6  text-gray-700 leading-normal">
                                        <svg class="w-4 h-4 inline -ml-6" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 24 24">
                                            <path class="text-gray-600 print:text-gray-900 fill-current"
                                                  d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm16 3.38V6H4v1.38l8 4 8-4zm0 2.24l-7.55 3.77a1 1 0 0 1-.9 0L4 9.62V18h16V9.62z"/>
                                        </svg>
                                        jgiorgiano@gmail.com
                                    </li>
                                    <li class="mt-1 pl-6  text-gray-700 leading-normal">
                                        <svg class="w-4 h-4 inline -ml-6" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 24 24">
                                            <path class="text-gray-600 print:text-gray-900 fill-current"
                                                  d="M13.04 14.69l1.07-2.14a1 1 0 0 1 1.2-.5l6 2A1 1 0 0 1 22 15v5a2 2 0 0 1-2 2h-2A16 16 0 0 1 2 6V4c0-1.1.9-2 2-2h5a1 1 0 0 1 .95.68l2 6a1 1 0 0 1-.5 1.21L9.3 10.96a10.05 10.05 0 0 0 3.73 3.73zM8.28 4H4v2a14 14 0 0 0 14 14h2v-4.58l-4.5-1.5-1.12 2.26a1 1 0 0 1-1.3.46 12.04 12.04 0 0 1-6.02-6.01 1 1 0 0 1 .46-1.3l2.26-1.14L8.28 4z"/>
                                        </svg>
                                        07490 115036
                                    </li>
                                    <li class="mt-1 pl-6  text-gray-700 leading-normal">
                                        <svg class="w-4 h-4 inline -ml-6" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 24 24">
                                            <path class="text-gray-600 print:text-gray-900 fill-current"
                                                  d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                                        </svg>
                                        Liverpool - UK
                                    </li>
<!--                                    <li class="mt-1 pl-6 text-gray-700 leading-normal">-->
<!--                                        <a href="https://github.com/fabriciozeferino/billboard" target="_blank"-->
<!--                                           class="group">-->
<!--                                            <svg class="fill-current w-4 h-4 inline -ml-6" viewBox="0 0 20 20"-->
<!--                                                 xmlns="http://www.w3.org/2000/svg">-->
<!--                                                <path-->
<!--                                                    class="text-gray-600 group-hover:text-gray-700 change-color-fast print:text-gray-900 fill-current"-->
<!--                                                    d="m13.18 11.309c-0.718 0-1.3 0.807-1.3 1.799 0 0.994 0.582 1.801 1.3 1.801s1.3-0.807 1.3-1.801c-1e-3 -0.992-0.582-1.799-1.3-1.799zm4.526-4.683c0.149-0.365 0.155-2.439-0.635-4.426 0 0-1.811 0.199-4.551 2.08-0.575-0.16-1.548-0.238-2.519-0.238-0.973 0-1.945 0.078-2.52 0.238-2.741-1.881-4.552-2.08-4.552-2.08-0.789 1.987-0.781 4.061-0.634 4.426-0.928 1.008-1.495 2.219-1.495 3.871 0 7.186 5.963 7.301 7.467 7.301 0.342 0 1.018 2e-3 1.734 2e-3 0.715 0 1.392-2e-3 1.732-2e-3 1.506 0 7.467-0.115 7.467-7.301 0-1.652-0.566-2.863-1.494-3.871zm-7.678 10.289h-0.056c-3.771 0-6.709-0.449-6.709-4.115 0-0.879 0.31-1.693 1.047-2.369 1.227-1.127 3.305-0.531 5.662-0.531h0.029 0.027c2.357 0 4.436-0.596 5.664 0.531 0.735 0.676 1.045 1.49 1.045 2.369 0 3.666-2.937 4.115-6.709 4.115zm-3.207-5.606c-0.718 0-1.3 0.807-1.3 1.799 0 0.994 0.582 1.801 1.3 1.801 0.719 0 1.301-0.807 1.301-1.801 0-0.992-0.582-1.799-1.301-1.799z"/>-->
<!--                                            </svg>-->

<!--                                            github.com/fabriciozeferino/billboard-->
<!--                                        </a>-->
<!--                                    </li>-->
                                </ul>
                            </section>

                        </div>

                    </section>

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
                // {
                //     title: 'PHP - Laravel',
                //     sub_title: 'Middle Level',
                //     description: 'Familiarity with OOP design principles strong understands of Laravel environment as the MVC life cycle. Able to Maintain coding standards and follow good practices. On my studies projects, I have used TDD.',
                //     tags: [
                //         'OOP', 'MVC', 'API', 'Laravel', 'Eloquent', 'Query Builder', 'TDD'
                //     ]
                // },
                // {
                //     title: 'JavaScript, HTML, and CSS',
                //     sub_title: 'Middle Level',
                //     description: 'I\'ve been in love with JS since day one, even using just Vanilla JS and jQuery in my current job I keep learning new technologies like Vue.js, Vuex, NPM, Webpack and TailwindCSS.',
                //     tags: ['Vue.js', 'jQuery', 'Tailwind CSS', 'Bootstrap']
                // },
                // {
                //     title: 'MySQL',
                //     sub_title: 'Middle Level',
                //     description: 'Even in my no-Development jobs, I was able to discuss relational integrity with developers helping them to analyse the data.',
                //     tags: ['MySQL', 'MySQLWorkbench']
                // },
                // {
                //     title: 'Others',
                //     sub_title: 'Middle Level',
                //     description: 'Great knowledge using Git, git-flow a UNIX Terminal. Even using MacOS all the time I\'m familiar with LINUX commands as basic DevOps configuration.',
                //     tags: ['GIT', 'Unix Shell', 'MacOS', 'Linux', 'PHPStorm', 'Docker']
                // },
            ]
        }
    }
}
</script>

<style>

</style>
