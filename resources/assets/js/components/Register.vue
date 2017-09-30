<template>
    <div class="col-md-4 col-md-offset-4">

        <div class="form-group">
            <label for="email">Name:</label>
            <input
                    type="email"
                    class="form-control"
                    id="name"
                    v-model="name"
            >
        </div>
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
            <label for="password">Password:</label>
            <input
                    type="password"
                    class="form-control"
                    id="password"
                    v-model="password"
            >
        </div>
        <div class="form-group">
            <label for="password_confirmation">Repeat Password:</label>
            <input
                    type="password"
                    class="form-control"
                    id="password_confirmation"
                    v-model="password_confirmation"
            >
        </div>

        <div class="text-center">
            <loader v-if="loading"></loader>

            <div
                    v-if="errors"
                    class="alert alert-danger error-msg"
                    v-html="errors">
            </div>

            <div
                    v-if="successMsg"
                    class="alert alert-success"
                    v-html="successMsg"
            >
            </div>
        </div>

        <button
                type="button"
                class="btn btn-primary pull-right"
                @click="submit"
                v-show="!loading && !successMsg"
        >
            Register
        </button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                successMsg: null
            }
        },

        methods: {
            submit() {
                this.loading = true
                this.error = ''
                axios.post(`/api/auth/register`, {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                }).then(response => {
                    this.successMsg = 'You have successfully registered! <br> Redirecting you to login page...'
                    setTimeout(() => {
                        this.$router.push({name: 'login'})
                    }, 3000);
                }).catch(error => {
                    this.error = error.response ? error.response.data : 'Error occurred'
                }).then(() => {
                    this.loading = false
                });
            }
        }
    }
</script>