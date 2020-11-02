<template>
    <div class="flex flex-col justify-center items-center test">
        <div class="j-card lg:w-1/2 mt-4">
            <div class="j-card-header">
                <h3 class="j-card-title">Account Details</h3>
            </div>
            <form @submit.prevent="register" class="px-6">

                <InputField
                    label="Name"
                    field="name"
                    v-model="$v.user.name.$model"
                    type="text"
                    :v-errors="$v.user.name"
                    :errors="errors"
                    @input="delayTouch($v.user.name)"
                />

                <InputField
                    label="Email"
                    field="email"
                    v-model="user.email"
                    type="email"
                    :errors="errors"
                    :disabled="true"
                />

                <InputField
                    label="Role"
                    field="role"
                    v-model="user.role"
                    type="text"
                    :errors="errors"
                    disabled="true"
                />

<!--                <div class="flex justify-between">-->
<!--                    <InputField-->
<!--                        label="Password"-->
<!--                        field="password"-->
<!--                        v-model="$v.user.password.$model"-->
<!--                        type="password"-->
<!--                        :v-errors="$v.user.password"-->
<!--                        :errors="errors"-->
<!--                        @input="delayTouch($v.user.password)"-->
<!--                    />-->

<!--                    <InputField-->
<!--                        label="Confirm Password"-->
<!--                        field="password_confirmation"-->
<!--                        v-model="$v.user.password_confirmation.$model"-->
<!--                        type="password"-->
<!--                        :v-errors="$v.user.password_confirmation"-->
<!--                        :errors="errors"-->
<!--                        @input="delayTouch($v.user.password_confirmation)"-->
<!--                    />-->
<!--                </div>-->

                <input type="checkbox"> Subscribed to receive newsletter
                    <small>on: 20/10/2020 (save ip and timestamp)</small>

                <h3>upload profile picture</h3>
                <input type="file">


                <div class="py-2 flex justify-end">
                    <indigo-button :disabled="$v.user.$anyError || !$v.user.$dirty">Save</indigo-button>
                </div>
            </form>

        </div>

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
            user: {
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
        user: {
            name: { required, minLength: minLength(5) },
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
            // this.$store.dispatch('registerNewUser', this.user)
            //     .then((response) => {
            //         this.$router.push({name: 'email-verification'})
            //     })
            //     .catch((error) => {
            //         this.errors = error.response.data.errors;
            //     });
        }
    }
}
</script>

<style>

</style>
