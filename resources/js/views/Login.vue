<template>
    <div class="flex flex-col justify-center items-center test">
        <div class="j-card md:w-1/2 lg:w-1/3 mt-48">
            <div class="j-card-header">
                <h3 class="j-card-title">Login</h3>
            </div>
            <form @submit.prevent="login">

                <InputField
                    label="Email"
                    field="email"
                    v-model="$v.user.email.$model"
                    type="email"
                    :v-errors="$v.user.email"
                    :errors="errors"
                    @input="delayTouch($v.user.email)"
                />

                <InputField
                    label="Password"
                    field="password"
                    v-model="$v.user.password.$model"
                    type="password"
                    :v-errors="$v.user.password"
                    :errors="errors"
                    @input="delayTouch($v.user.password)"
                />

                <div class="py-2 flex justify-center">
                    <indigo-button :disabled="$v.user.$anyError || !$v.user.$dirty">Login</indigo-button>
                </div>

            </form>

        </div>

        <indigo-text-link route-name="register">Don't have an Account. Register</indigo-text-link>

    </div>
</template>

<script>

import InputField from "../components/forms/InputField";
import IndigoButton from "../components/buttons/IndigoButton";
import IndigoTextLink from "../components/buttons/IndigoTextLink";
import {required, minLength, email} from 'vuelidate/lib/validators';

const touchMap = new WeakMap();

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
                password: '',
            },
            errors: {},
        }
    },
    validations: {
        user: {
            email: { required, email, minLength: minLength(5) },
            password: { required,  minLength: minLength(8) }
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
        login() {
            this.$store.dispatch('postLogin', this.user)
                .then((response) => {
                    this.$router.push({name: 'dashboard'})
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
    },
    beforeCreate() {
        if(this.$store.state.user.authenticated) {
            this.$router.push({name: 'dashboard'})
        }
    }
}
</script>

<style>

</style>
