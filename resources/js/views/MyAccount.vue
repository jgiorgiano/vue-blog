<template>
    <div class="flex flex-col justify-center items-center container mx-auto">
        <div class="j-card lg:w-1/2 mt-4">
            <div class="j-card-header">
                <h3 class="j-card-title">Account Details</h3>
            </div>
            <form @submit.prevent="submitEditAccount" class="px-6">

                <InputField
                    label="Name"
                    field="name"
                    v-model="$v.user.name.$model"
                    type="text"
                    :errors="errors"
                    :v-errors="$v.user.name"
                />

                <InputField
                    label="Email"
                    field="email"
                    :value="this.user.email"
                    type="email"
                    :errors="errors"
                    :disabled="true"
                />

                <InputField
                    label="Role"
                    field="role"
                    :value="userRole"
                    type="text"
                    :errors="errors"
                    :disabled="true"
                />

                <div class="mb-5">
                    <input type="checkbox" v-model="user.subscribe">
                    <span class="text-gray-800">Subscribed to receive newsletter</span>
                    <small class="block" v-show="user.subscribe">on: {{ user.subscribe_date }}</small>
                </div>

                <div class="mb-5">
                    <p class="text-gray-800">Upload your profile picture</p>
                    <input type="file" ref="file" @change="handleFileUpload()">
                </div>

                <div class="py-2 flex justify-end">
                    <indigo-button :disabled="$v.user.$anyError">
                        <process-status :status="processStatus">Save</process-status>
                        </indigo-button>
                </div>
            </form>

        </div>

    </div>
</template>

<script>

import InputField from "@/components/forms/InputField";
import IndigoButton from "@/components/buttons/IndigoButton";
import IndigoTextLink from "@/components/buttons/IndigoTextLink";
import processStatus from "@/components/buttons/processStatus";
import {required, minLength, helpers }from 'vuelidate/lib/validators';

const touchMap = new WeakMap()

export default {
    components: {
        InputField,
        IndigoButton,
        IndigoTextLink,
        processStatus
    },
    data() {
        return {
            processStatus: 0,
            user: {
                name: '',
                profile_new_image: null,
                subscribe: 0
            },
            errors: {}
        }
    },
    validations: {
        user: {
            name: {required, minLength: minLength(5)},
        }
    },
    methods: {
        delayTouch($v) {
            $v.$reset()
            if (touchMap.has($v)) {
                clearTimeout(touchMap.get($v))
            }
            touchMap.set($v, setTimeout($v.$touch, 300))
        },
        handleFileUpload(){
            var file_type = this.$refs.file.files[0].type;

            if(file_type.indexOf('png') > 0 || file_type.indexOf('jpg') > 0 || file_type.indexOf('jpeg') > 0) {
                this.user.profile_new_image = this.$refs.file.files[0];
            } else {
                alert('File type not valid" (create a modal)')
                console.log(file_type);
            }
        },
        submitEditAccount() {
            this.$v.$touch()

            if(this.$v.$invalid) { return }

            this.processStatus = 1;
            this.$store.dispatch('updateUserAccount', {
                name: this.user.name,
                profile_image: this.user.profile_new_image ?? null,
                subscribe: this.user.subscribe
            }).then((response) => {
                setTimeout(() => this.processStatus = 0, 300);
            })
        }
    },
    computed: {
        userRole: function () {
            switch (this.user.role) {
                case 1:
                    return 'Guest';
                case 2:
                    return 'writer';
                case 3:
                    return 'Administrator';
            }
        }
    },
    mounted() {
        this.$axios.get('v1/user')
            .then((response) => {

                this.user = response.data;

            }).catch((error) => {
            console.log(error);
        })
    }
}
</script>

<style>

</style>
