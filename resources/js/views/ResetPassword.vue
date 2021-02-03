<template>
    <div class="flex flex-col justify-center items-center container mx-auto">
        <div class="j-card md:w-1/2 lg:w-1/3">
            <div class="j-card-header">
                <h3 class="j-card-title">Reset Password</h3>
            </div>
            <form @submit.prevent="sendResetPassword">

                <InputField
                    label="Email"
                    field="email"
                    :value="reset_data.email"
                    type="email"
                    :errors="errors"
                    disabled="true"
                />

                <InputField
                    label="Password"
                    field="password"
                    v-model="$v.reset_data.password.$model"
                    type="password"
                    :v-errors="$v.password"
                    :errors="errors"
                    @input="delayTouch($v.reset_data.password)"
                />

                <InputField
                    label="Confirm Password"
                    field="password_confirmation"
                    v-model="$v.reset_data.password_confirmation.$model"
                    type="password"
                    :v-errors="$v.password_confirmation"
                    :errors="errors"
                    @input="delayTouch($v.reset_data.password_confirmation)"
                />

                <div class="py-2 text-center">
                    <!--                            <indigo-button :disabled="$v.user.$anyError || !$v.user.$dirty">-->
                    <indigo-button>
                        <process-status :status="processStatus">Send</process-status>
                    </indigo-button>
                </div>
            </form>
            <error-message class="mt-2 -mb-3" :errorMessage="error"></error-message>
        </div>
    </div>
</template>

<script>

import InputField from "@/components/forms/InputField";
import IndigoButton from "@/components/buttons/IndigoButton";
import processStatus from "@/components/buttons/processStatus";
import ErrorMessage from "@/components/buttons/ErrorMessage";
import {required, email, minLength, sameAs} from 'vuelidate/lib/validators';
import Axios from "axios";

const touchMap = new WeakMap();

export default {
    components: {
        InputField,
        IndigoButton,
        processStatus,
        ErrorMessage
    },
    data() {
        return {
            processStatus: 0,
            reset_data: {
                token: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            success: '',
            errors: {},
            error: '',
        }
    },
    validations: {
        reset_data: {
            token: {},
            email: {required, email},
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
        sendResetPassword() {
            this.$v.$touch()
            this.error = '';

            if (!this.$v.$invalid) {
                this.processStatus = 1;

                Axios.post('v1/reset-password', this.reset_data )
                    .then((response) => {
                        this.$router.push({name: 'login'});
                    }).catch((error) => {
                        console.log(error.response);
                    this.errors = error.response.data.errors ? error.response.data.errors : {};
                    this.error = error.response.data.msg;
                }).finally(() => {
                    this.processStatus = 0;
                });
            }
        },
    },
    mounted() {
        this.reset_data.token = this.$route.params.token;
        this.reset_data.email = this.$route.query.email;
    }
}
</script>

<style>

</style>
