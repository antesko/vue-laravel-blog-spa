<template>
    <div class="col-md-4 col-md-offset-4">

        <div class="form-group">
            <label for="email">Email address:</label>
            <input
                    type="email"
                    class="form-control"
                    id="email"
                    v-model="email"
            >
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input
                    type="password"
                    class="form-control"
                    id="pwd"
                    v-model="password"
            >
        </div>

        <div class="text-center">
            <loader v-if="loading"></loader>

            <div
                    v-if="errors"
                    class="alert alert-danger error-msg"
                    v-html="errors">
            </div>
        </div>

        <button
                type="button"
                class="btn btn-primary pull-right"
                @click="submit"
        >
            Login
        </button>

        <div class="clearfix"></div>

        <router-link
                :to="{ name: 'register' }"
                class="pull-right register-link"
        > Don't have an account? Register here
        </router-link>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: '',
                password: ''
            }
        },

        methods: {
            submit() {
                this.loading = true
                this.error = ''
                axios.post(`/api/auth/token`, {
                    username: this.email,
                    password: this.password
                }).then(response => {
                    this.$auth.setToken(response.data.access_token, response.data.expires_in + Date.now());
                    //this.$router.push("/posts");
                    location.replace('/')
                }).catch(error => {
                    this.error = error.response ? error.response.data : 'Error occurred'
                }).then(() => {
                    this.loading = false
                });
            }
        }
    }
</script>

<style scoped>
    .register-link {
        margin-top: 10px;
        color: #999;
    }
</style>