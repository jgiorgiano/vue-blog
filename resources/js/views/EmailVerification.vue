<template>
    <div class="flex flex-col justify-center items-center container mx-auto">
        <div class="j-card md:w-1/2">
            <div class="j-card-header">
                <h3 class="j-card-title">Email Verification</h3>
            </div>

            <div class="p-3">
                <p class="text-xl">Hi {{ user.name }}</p>

                <p class="text-lg py-2">We're Happy you signed up for our blog. <br>
                    Please confirm your email to continue.
                </p>

                <div v-if="isAuth">
                    <p class="text-lg">Haven't received our email?</p>

                    <div class="pt-6 flex justify-center">
                        <IndigoButton type="button"
                                      :disabled="processing"
                                      @clicked="resendEmail">
                            click here to re-send Confirmation Email
                        </IndigoButton>
                    </div>
                </div>
            </div>
            <processing :processing="processing"></processing>
            <error-message :errorMessage="error"></error-message>
            <success-message :responseMessage="success"></success-message>

        </div>
    </div>
</template>

<script>
import IndigoButton from "../components/buttons/IndigoButton";
import ErrorMessage from "../components/buttons/ErrorMessage";
import SuccessMessage from "../components/buttons/SuccessMessage";
import Processing from "../components/buttons/Processing";

export default {
    components: {
        SuccessMessage,
        IndigoButton,
        ErrorMessage,
        Processing
    },
    data() {
        return {
            user: this.$store.state.user.user,
            error: '',
            success: '',
            processing: false,
        }
    },
    computed: {
        isAuth() {
            return this.$store.state.user.authenticated;
        }
    },
    methods: {
        resendEmail: function () {
            if(!this.processing) {

                this.processing = true;
                this.error = '';
                this.success = '';

                this.$axios.get('v1/email/send')
                    .then((response) => {
                        this.success = response.data.msg;
                    })
                    .catch((error) => {
                        this.error = error.response.data.message;

                        if(error.response.data.message === 'Email Already Verified') {
                            this.error = this.error + '. You are being redirected to home.';

                            setTimeout( () => { this.$router.push({name: 'home'}) }, 2800);
                        }

                    }).finally(() => { this.processing = false; });
            }
        }
    },
}
</script>

<style>

</style>
