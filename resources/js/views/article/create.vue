<template>
    <div class="flex flex-col justify-center items-center">
        <div class="j-card lg:w-3/4 mt-4">
            <div class="j-card-header">
                <h3 class="j-card-title">Create New Article</h3>
            </div>
            <form @submit.prevent="createArticle" class="px-6">

                <InputField
                    label="Title"
                    field="title"
                    v-model="$v.article.title.$model"
                    type="text"
                    :v-errors="$v.article.title"
                    :errors="errors"
                />

                <TextAreaField
                    label="Content"
                    field="content"
                    v-model="$v.article.content.$model"
                    type="text"
                    :v-errors="$v.article.content"
                    :errors="errors"
                />

                <InputField
                    label="Tags"
                    field="tags"
                    v-model="$v.article.tags.$model"
                    type="text"
                    :v-errors="$v.article.tags"
                    :errors="errors"
                />

                <checkbox-field
                    field="featured"
                    v-model="$v.article.featured.$model"
                    :v-errors="$v.article.featured"
                    :errors="errors"
                >
                    Feature the Article
                </checkbox-field>

<!--                <div class="mb-5">-->
<!--                    <p class="text-gray-800">Upload your profile picture</p>-->
<!--                    <input type="file" ref="file" @change="handleFileUpload()">-->
<!--                </div>-->

                <div class="py-2 flex justify-end">
                    <div>
                        <indigo-button :disabled="$v.article.$anyError || !$v.article.$anyDirty || processStatus !== 0">
                            <process-status :status="processStatus">Create</process-status>
                        </indigo-button>
                    </div>
                </div>
            </form>

        </div>

    </div>
</template>

<script>

import InputField from "../../components/forms/InputField";
import IndigoButton from "../../components/buttons/IndigoButton";
import TextAreaField from "../../components/forms/TextAreaField";
import CheckboxField from "../../components/forms/CheckboxField";
import {required, minLength, maxLength} from 'vuelidate/lib/validators';
import ProcessStatus from "../../components/buttons/processStatus";

const touchMap = new WeakMap()

export default {
    components: {
        ProcessStatus,
        InputField,
        IndigoButton,
        TextAreaField,
        CheckboxField
    },
    data() {
        return {
            processStatus: 0,
            article: {
                title: '',
                content: '',
                tags: '',
                featured: 0,
                status: 0,
                position: 0,
                images: null,
            },
            errors: {}
        }
    },
    validations: {
        article: {
            title: {required, minLength: minLength(5), maxLength: maxLength(150)},
            content: {required, minLength: minLength(5)},
            tags: { required, minLength: minLength(3) },
            featured: { }
        }
    },
    methods: {
        // delayTouch($v) {
        //     $v.$reset()
        //     if (touchMap.has($v)) {
        //         clearTimeout(touchMap.get($v))
        //     }
        //     touchMap.set($v, setTimeout($v.$touch, 1000))
        // },
        handleFileUpload() {
            // var file_type = this.$refs.file.files[0].type;
            //
            // if(file_type.indexOf('png') > 0 || file_type.indexOf('jpg') > 0 || file_type.indexOf('jpeg') > 0) {
            //     this.user.profile_new_image = this.$refs.file.files[0];
            // } else {
            //     alert('File type not valid" (create a modal)')
            //     console.log(file_type);
            // }
        },
        createArticle() {
            this.processStatus = 1;

            this.$store.dispatch('article/create', this.article).then((response) => {
                this.processStatus = 2;

                setTimeout(() => this.$router.push({ name: 'article-edit', params: { id: response.id } }), 300);

            }).catch( error => {
                this.errors = error.response.data.errors;
                this.processStatus = 0;
            });
        }
    },
    computed: {},
    mounted() {

    }
}
</script>

<style>

</style>
