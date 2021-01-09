<template>
    <div class="flex flex-col justify-center items-center container mx-auto">
        <div class="j-card lg:w-1/2">
            <div class="j-card-header">
                <h3 class="j-card-title">Sign Up</h3>
            </div>
            <form @submit.prevent="register" class="px-6">

                <InputField
                    label="Name"
                    field="name"
                    v-model="$v.newUser.name.$model"
                    type="text"
                    :v-errors="$v.newUser.name"
                    :errors="errors"
                    @input="delayTouch($v.newUser.name)"
                />

                <InputField
                    label="Email"
                    field="email"
                    v-model="$v.newUser.email.$model"
                    type="email"
                    :v-errors="$v.newUser.email"
                    :errors="errors"
                    @input="delayTouch($v.newUser.email)"
                />

                <div class="justify-between items-end sm:flex">
                    <InputField
                        label="Password"
                        field="password"
                        v-model="$v.newUser.password.$model"
                        type="password"
                        :v-errors="$v.newUser.password"
                        :errors="errors"
                        @input="delayTouch($v.newUser.password)"
                    />

                    <InputField
                        label="Confirm Password"
                        field="password_confirmation"
                        v-model="$v.newUser.password_confirmation.$model"
                        type="password"
                        :v-errors="$v.newUser.password_confirmation"
                        :errors="errors"
                        @input="delayTouch($v.newUser.password_confirmation)"
                    />
                </div>

                <!--                <checkbox-field-->
                <!--                    field="terms_agreement"-->
                <!--                    v-model="$v.newUser.terms_agreement.$model"-->
                <!--                    :v-errors="$v.newUser.terms_agreement"-->
                <!--                    :errors="errors"-->
                <!--                    required-->
                <!--                >-->
                <!--                    I agree with the terms and conditions.-->
                <!--                </checkbox-field>-->

                <checkbox-field
                    field="subscribe"
                    v-model="newUser.subscribe"
                    :errors="errors"
                >
                    I agree to subscribe to the newsletter and receive the latest articles
                </checkbox-field>

                <div class="py-2 flex justify-center">
                    <!--                    <indigo-button :disabled="$v.newUser.$anyError || !$v.newUser.$dirty">-->
                    <indigo-button>
                        <process-status :status="processStatus">Create Account</process-status>
                    </indigo-button>
                </div>
            </form>

        </div>
        <router-link :to="{ name: 'login'}">
            <indigo-text-link class="mt-4">Already have an Account. Sign up</indigo-text-link>
        </router-link>
    </div>
</template>

<script>

import InputField from "@/components/forms/InputField";
import IndigoButton from "@/components/buttons/IndigoButton";
import IndigoTextLink from "@/components/buttons/IndigoTextLink";
import CheckboxField from "@/components/forms/CheckboxField";
import processStatus from "@/components/buttons/processStatus";
import {required, minLength, email, alpha, sameAs} from 'vuelidate/lib/validators';

const touchMap = new WeakMap()

export default {
    components: {
        InputField,
        IndigoButton,
        IndigoTextLink,
        CheckboxField,
        processStatus
    },
    data() {
        return {
            processStatus: 0,
            newUser: {
                email: '',
                name: '',
                terms_agreement: 1,
                subscribe: false,
                password: '',
                password_confirmation: '',
                errors: {},
            },
            errors: {}
        }
    },
    validations: {
        newUser: {
            name: {required, minLength: minLength(5)},
            email: {required, email, minLength: minLength(5)},
            subscribe: {},
            password: {required, minLength: minLength(8)},
            password_confirmation: {required, minLength: minLength(8), sameAsPassword: sameAs('password')}
        }
    },
    methods: {
        delayTouch($v) {
            $v.$reset()
            if (touchMap.has($v)) {
                clearTimeout(touchMap.get($v))
            }
            touchMap.set($v, setTimeout($v.$touch, 1000))
        },
        register() {
            this.$v.$touch()

            if (this.$v.$invalid) { return }

            this.processStatus = 1;
            this.$store.dispatch('registerNewUser', this.newUser)
                .then(response => this.$router.push({name: 'email-verification'}))
                .catch(error => this.errors = error.response.data.errors)
                .finally(() => { this.processStatus = 0; });
        }
    }
}
</script>

<style>

</style>
