<template>
    <div class="flex flex-col justify-center items-center container mx-auto">
        <div class="j-card md:w-1/2 lg:w-1/3">
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

                <div class="py-2 text-center">
                    <!--                            <indigo-button :disabled="$v.user.$anyError || !$v.user.$dirty">-->
                    <indigo-button>
                        <process-status :status="processStatus">Login</process-status>
                    </indigo-button>
                </div>

                <div class="flex justify-end -mb-3">
                    <router-link :to="{ name: 'forgot-password'}">
                        <indigo-text-link>Forgot Password</indigo-text-link>
                    </router-link>
                </div>


            </form>

        </div>
        <router-link :to="{ name: 'register'}">
            <indigo-text-link class="mt-4">Don't have an Account. Register</indigo-text-link>
        </router-link>
    </div>
</template>

<script>

import InputField from "@/components/forms/InputField";
import IndigoButton from "@/components/buttons/IndigoButton";
import IndigoTextLink from "@/components/buttons/IndigoTextLink";
import processStatus from "@/components/buttons/processStatus";
import {required, minLength, email} from 'vuelidate/lib/validators';

const touchMap = new WeakMap();

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
                email: '',
                password: '',
            },
            errors: {},
        }
    },
    validations: {
        user: {
            email: {required, email, minLength: minLength(5)},
            password: {required, minLength: minLength(8)}
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
            this.$v.$touch()

            if (!this.$v.$invalid) {
                this.processStatus = 1

                this.$store.dispatch('postLogin', this.user)
                    .then(response => this.$router.push({name: 'home'}))
                    .catch((error) => {
                        this.errors = error.response.data.errors;
                    })
                    .finally(() => {
                        this.processStatus = 0;
                    });
            }
        },
    },
    beforeCreate() {
        // if(this.$store.state.user.authenticated) {
        //     this.$store.dispatch('isAuth').then(() => {
        //         this.$router.push({name: 'home'})
        //     });
        // }
    }
}
</script>

<style>

</style>
