<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

    export default {
        mounted() {

            axios.get('api/test').then((response) => {
                console.log(response);

            }).catch((error) => {
                console.log(error);
            })

            console.log(this.$store.state.user.name);

        }
    }
</script>
