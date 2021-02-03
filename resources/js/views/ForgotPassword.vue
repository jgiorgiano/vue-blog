<template>
    <div class="flex flex-col justify-center items-center container mx-auto">
        <div class="j-card md:w-1/2 lg:w-1/3">
            <div class="j-card-header">
                <h3 class="j-card-title">Forgot Password</h3>
            </div>
            <form @submit.prevent="sendForgotPassword">

                <InputField
                    label="Email"
                    field="email"
                    v-model="$v.email.$model"
                    type="email"
                    :v-errors="$v.email"
                    :errors="errors"
                    @input="delayTouch($v.email)"
                />

                <div class="py-2 text-center">
                    <!--                            <indigo-button :disabled="$v.user.$anyError || !$v.user.$dirty">-->
                    <indigo-button>
                        <process-status :status="processStatus">Send</process-status>
                    </indigo-button>
                </div>
            </form>
            <success-message class="mt-3 -mb-3" :responseMessage="success"></success-message>
        </div>
    </div>
</template>

<script>

import InputField from "@/components/forms/InputField";
import IndigoButton from "@/components/buttons/IndigoButton";
import processStatus from "@/components/buttons/processStatus";
import SuccessMessage from "@/components/buttons/SuccessMessage";
import {required, email} from 'vuelidate/lib/validators';
import Axios from "axios";

const touchMap = new WeakMap();

export default {
    components: {
        InputField,
        IndigoButton,
        processStatus,
        SuccessMessage
    },
    data() {
        return {
            processStatus: 0,
            email: '',
            success: '',
            errors: {},
        }
    },
    validations: {
        email: {required, email},
    },
    methods: {
        delayTouch($v) {
            $v.$reset()
            if (touchMap.has($v)) {
                clearTimeout(touchMap.get($v))
            }
            touchMap.set($v, setTimeout($v.$touch, 1000))
        },
        sendForgotPassword() {
            this.$v.$touch()

            this.success = '';

            if (!this.$v.$invalid) {
                this.processStatus = 1;

                Axios.post('v1/forgot-password', {email: this.email})
                    .then((response) => {
                        this.success = response.data.msg;
                    }).catch((error) => {
                        this.errors = error.response.data.errors;
                    }).finally(() => {
                        this.processStatus = 0;
                });
            }
        },
    },
}
</script>

<style>

</style>
