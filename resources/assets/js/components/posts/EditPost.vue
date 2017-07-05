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
            }
        }
    }
</script>