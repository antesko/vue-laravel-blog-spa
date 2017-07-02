export default {
    computed: {
        formattedDate() {
            return moment(this.post.created_at).format('MMM Do YYYY, h:mm A')
        },

        commentsText() {
            // Appends plural 's' if needed
            let str = this.post.comments_count == 1 ? 'Comment' : 'Comments'
            return this.post.comments_count + ' ' + str;
        }
    }
}