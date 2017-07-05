<script>
    import postForm from '../../mixins/postForm'

    export default {
        mixins: [
            postForm
        ],

        data() {
            return {
                post: {
                    user_id: 7, // TODO replace this ID with real authenticated user
                }
            }
        },

        methods: {
            save() {
                this.loading = true
                this.error = null

                axios.post(`/api/posts/`, this.post).then((response) => {
                    this.successAlert('Post created!')
                    this.$router.push({name: 'editPost', params: {id: response.data.id}})
                }).catch((error) => {
                    this.error = error.response.data || 'Error occurred'
                }).then(() => {
                    this.loading = false
                });
            }
        }
    }
</script>

<style>
    .radio label {
        margin-right: 5%;
    }

    .bootstrap-tagsinput {
        width: 100%;
        display: block;
    }

    .vue-html5-editor .content {
        max-height: 500px;
    }
</style>