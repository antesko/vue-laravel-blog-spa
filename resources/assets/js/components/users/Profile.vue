<template>

    <div class="row user">

        <div class="col-md-3">
            <div class="form-group">
                <label>Profile image:</label>

                <img
                        v-if="formData.avatar"
                        :src="formData.avatar"
                        class="img-thumbnail user-avatar"
                >

                <file-upload v-on:imageUploaded="changeAvatarSrc"></file-upload>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="name">Name:</label>
                <input
                        type="text"
                        class="form-control"
                        id="name"
                        v-model="formData.name"
                >
            </div>

            <div class="form-group">
                <label for="email">Email address:</label>
                <input
                        type="email"
                        class="form-control"
                        id="email"
                        v-model="formData.email"
                >
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input
                        type="password"
                        class="form-control"
                        id="password"
                        v-model="formData.password"
                >
            </div>

            <div class="form-group">
                <label for="password_confirmation">Repeat Password:</label>
                <input
                        type="password"
                        class="form-control"
                        id="password_confirmation"
                        v-model="formData.password_confirmation"
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
                    @click="save"
                    class="btn btn-primary pull-right"
            >
                Save
            </button>
        </div>

    </div>

</template>

<script>
    import FileUpload from '../helpers/FileUpload.vue'

    export default {
        components: {
            FileUpload
        },

        data() {
            return {
                userId: 7, // TODO replace this ID with real authenticated user
                user: {},
                formData: {}
            }
        },

        created() {
            this.loading = true
            this.fetch()
        },

        watch: {
            user(value) {
                this.formData = _.pick(value, 'name', 'email', 'avatar')
            }
        },

        methods: {
            fetch() {
                return axios.get(`/api/users/${this.userId}`).then((response) => {
                    this.user = response.data
                }).catch((error) => {
                    this.error = error.response.data || 'Error occurred'
                }).then(() => {
                    this.loading = false
                });
            },

            save() {
                this.loading = true
                this.error = null

                axios.put(`/api/users/${this.userId}`, this.formData).then((response) => {
                    this.successAlert('Profile updated!')
                    delete this.formData.password
                    delete this.formData.password_confirmation
                }).catch((error) => {
                    this.error = error.response.data || 'Error occurred'
                }).then(() => {
                    this.loading = false
                });
            },

            changeAvatarSrc(path) {
                this.formData.avatar = path
            }
        }
    }
</script>