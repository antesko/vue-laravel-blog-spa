<template>
    <div>
        <div class="form-group">
            <label>Write a comment:</label>
            <textarea
                    class="form-control"
                    rows="5"
                    v-model="message"
            ></textarea>
        </div>

        <button
                @click="validateAndPost"
                class="btn btn-primary pull-right"
        >
            Post it
        </button>

        <div class="clearfix"></div>

        <div class="text-center result">
            <loader v-if="loading"></loader>

            <div
                    v-if="errors"
                    v-html="errors"
                    class="alert alert-danger error-msg">
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: [
            'postId'
        ],

        data() {
            return {
                loading: false,
                error: null,
                message: '',
            }
        },

        methods: {
            validateAndPost() {
                this.loading = true
                this.error = null

                if (this.validateComment()) {
                    this.postComment()
                } else {
                    this.error = 'Comment must be at least 3 characters long'
                    this.loading = false
                }
            },

            postComment() {
                axios.post('/api/comments', {
                    post_id: this.postId,
                    user_id: 4, // TODO change to real authenticated user
                    body: this.message
                }).then((response) => {
                    this.successAlert('Comment posted!')
                    this.message = ''
                    this.$emit('commentPosted')
                }).catch((error) => {
                    this.error = error.response.data || 'Error occurred'
                }).then(() => {
                    this.loading = false
                });
            },

            validateComment() {
                return this.message.length >= 3
            }
        }
    }
</script>

<style scoped>
    .result {
        margin-top: 20px;
    }
</style>