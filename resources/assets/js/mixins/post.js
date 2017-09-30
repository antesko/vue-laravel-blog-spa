export default {
    methods: {
        fetchUser() {
            return axios.get('/api/user').then((response) => {
                this.user = response.data
            }).catch((error) => {
                this.error = error.response.data || 'Error occurred'
            })
        }
    },

    computed: {
        formattedDate() {
            return moment(this.post.created_at).format('MMM Do YYYY, h:mm A')
        },

        commentsText() {
            // Appends plural 's' if needed
            let str = this.post.comments_count == 1 ? 'Comment' : 'Comments'
            return this.post.comments_count + ' ' + str;
        },

        userIsAuthor() {
            if(this.user.id) {
                return this.post.user.id === this.user.id
            }
        }
    }
}