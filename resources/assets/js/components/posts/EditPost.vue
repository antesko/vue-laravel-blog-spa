<script>
    import postForm from '../../mixins/postForm'

    export default {
        props: [
            'id'
        ],

        mixins: [
            postForm
        ],

        created() {
            this.fetch().then(() => {
                this.loading = false
            })
        },

        methods: {
            fetch() {
                return axios.get(`/api/posts/${this.id}`).then((response) => {
                    this.post = response.data
                    this.fillTagsInput()
                }).catch((error) => {
                    this.error = error.response.data || 'Error occurred'
                    this.$router.push({name: 'postsList'})
                })
            },

            save() {
                this.loading = true
                this.error = null

                axios.put(`/api/posts/${this.id}`, this.formData).then((response) => {
                    this.successAlert('Changes saved!')
                }).catch((error) => {
                    this.error = error.response.data || 'Error occurred'
                }).then(() => {
                    this.loading = false
                });
            },

            deletePost() {
                this.loading = true
                this.error = null

                axios.delete(`/api/posts/${this.id}`).then((response) => {
                    this.successAlert('Post deleted!')
                    this.$router.push({name: 'postsList'})
                }).catch((error) => {
                    this.error = error.response.data || 'Error occurred'
                }).then(() => {
                    this.loading = false
                });
            },

            fillTagsInput() {
                if (this.post.tags.length) {
                    $.each(this.post.tags, function (index, value) {
                        $('#tags-input').tagsinput('add', value);
                    });
                } else {
                    $('#tags-input').tagsinput();
                }
            }
        },

        computed: {
            formData() {
                return _.pick(this.post, 'title', 'body', 'tags', 'featured', 'image')
            },

            isEdit(){
                return true
            }
        }
    }
</script>

<style scoped>
    .del-text {
        margin-top: 20px;
        cursor: pointer;
    }
</style>