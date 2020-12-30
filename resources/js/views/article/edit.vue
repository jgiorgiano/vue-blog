<template>
    <div class="flex flex-col justify-center items-center">
        <div class="j-card lg:w-3/4 mt-4">
            <div class="j-card-header">
                <h3 class="j-card-title">Edit</h3>
            </div>
            <form @submit.prevent="updateArticle" class="px-6">

                <InputField
                    label="Title"
                    field="title"
                    v-model="$v.article.title.$model"
                    type="text"
                    :v-errors="$v.article.title"
                    :errors="errors"
                    maxlength="150"
                />

                <TextAreaField
                    label="Description"
                    field="description"
                    v-model="$v.article.description.$model"
                    type="text"
                    :v-errors="$v.article.description"
                    :errors="errors"
                    maxlength="200"
                />

                <SelectField
                    label="Type"
                    field="type"
                    v-model="$v.article.type.$model"
                    :v-errors="$v.article.type"
                    :errors="errors"
                    :options="typeOptions"/>

                <InputField v-if="article.type === 2"
                    label="External Link"
                    field="external_link"
                    v-model="$v.article.external_link.$model"
                    type="text"
                    :v-errors="$v.article.external_link"
                    :errors="errors"
                    maxlength="255"
                />

                <TextAreaField v-if="article.type === 1"
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
                    maxlength="100"
                />

                <div class="justify-between items-end sm:flex">
                    <SelectField
                        class="md:w-1/2"
                        label="Status"
                        field="status"
                        v-model="$v.article.status.$model"
                        :v-errors="$v.article.status"
                        :errors="errors"
                        :options="statusOptions"/>

                    <InputField
                        class="md:w-1/2"
                        label="Position"
                        field="position"
                        v-model="$v.article.position.$model"
                        type="number"
                        :v-errors="$v.article.position"
                        :errors="errors"
                    />
                </div>


                <checkbox-field class="my-2"
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
<!--                        <indigo-button :disabled="$v.article.$anyError || processStatus !== 0">-->
                        <indigo-button>
                            <process-status :status="processStatus">Save</process-status>
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
import {required, minLength, maxLength, requiredIf} from 'vuelidate/lib/validators';
import ProcessStatus from "../../components/buttons/processStatus";
import SelectField from "../../components/forms/SelectField";

const touchMap = new WeakMap()

export default {
    components: {
        SelectField,
        ProcessStatus,
        InputField,
        IndigoButton,
        TextAreaField,
        CheckboxField
    },
    data() {
        return {
            processStatus: 0,
            statusOptions: this.$store.state.article.statusOptions,
            typeOptions: this.$store.state.article.typeOptions,
            article: {
                title: '',
                description: '',
                type: '',
                external_link: '',
                content: '',
                tags: '',
                featured: 0,
                status: 0,
                position: '',
                images: null,
            },
            errors: {}
        }
    },
    validations: {
        article: {
            title: {required, minLength: minLength(10), maxLength: maxLength(150)},
            description: {required, maxLength: maxLength(200)},
            type: {required},
            external_link: { required: requiredIf(function (model) {
                    return model.type === 2;
                }), maxLength: maxLength(200)},
            content: {required: requiredIf(function (model) {
                    return model.type === 1;
                }), minLength: minLength(100)},
            tags: { required, minLength: minLength(3), maxLength: maxLength(100) },
            status: { required },
            featured: {},
            position: {}
        }
    },
    methods: {
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
        updateArticle() {
            this.$v.$touch()

            if(!this.$v.$invalid) {
                this.processStatus = 1;

                this.$store.dispatch('article/update', this.article).then((response) => {
                    this.processStatus = 2;

                    setTimeout(() => this.processStatus = 0, 300);
                }).catch(error => {
                    this.errors = error.response.data.errors;
                    this.processStatus = 0;
                });
            }
        }
    },
    computed: {},
    created() {
        let article = this.$store.getters["article/getArticleById"](this.$route.params.id);

        if (article) {
            return this.article = article;
        }

        this.$store.dispatch('article/loadArticle', this.$route.params.id).then(response => {
            this.article = response;
        }).catch(error => console.log(error));
    }

}
</script>

<style>

</style>
