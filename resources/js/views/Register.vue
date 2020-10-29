<template>
    <div class="flex flex-col justify-center items-center test">
        <div class="j-card lg:w-1/2 mt-48">
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

                <div class="flex justify-between">
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

                <div class="py-2 flex justify-center">
                    <indigo-button :disabled="$v.newUser.$anyError || !$v.newUser.$dirty">Create Account</indigo-button>
                </div>
            </form>

        </div>

        <indigo-text-link route-name="login">Already have an Account. Sign up</indigo-text-link>

    </div>
</template>

<script>

import InputField from "../components/forms/InputField";
import IndigoButton from "../components/buttons/IndigoButton";
import IndigoTextLink from "../components/buttons/IndigoTextLink";
import {required, minLength, email, alpha, sameAs} from 'vuelidate/lib/validators';

const touchMap = new WeakMap()

export default {
    components: {
        InputField,
        IndigoButton,
        IndigoTextLink
    },
    data() {
        return {
            newUser: {
                email: '',
                name: '',
                password: '',
                password_confirmation: '',
                errors: {},
            },
            errors: {}
        }
    },
    validations: {
        newUser: {
            name: { required, alpha, minLength: minLength(5) },
            email: { required, email, minLength: minLength(5) },
            password: { required, minLength: minLength(8) },
            password_confirmation: { required, minLength: minLength(8), sameAsPassword: sameAs('password') }
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
            this.$store.dispatch('registerNewUser', this.newUser)
                .then((response) => {
                    this.$router.push({name: 'email-verification'})
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        }
    }
}
</script>

<style>

</style>
