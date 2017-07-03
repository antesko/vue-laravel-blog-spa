<template>

    <div class="row user">

        <div class="text-center">
            <loader v-if="loading"></loader>

            <div
                    v-if="errors"
                    class="alert alert-danger error-msg"
                    v-html="errors">
            </div>
        </div>

        <div v-if="!loading && !error">
            <div class="col-md-3">
                <img
                        :src="user.avatar"
                        :alt="user.name"
                        class="img-thumbnail"
                >
            </div>
            <div class="col-md-9">
                <h2>{{ user.name }}</h2>

                <p>
                    <strong>Member since: </strong>
                    {{ registeredDate }}
                </p>
                <p>
                    <strong>Posts created: </strong>
                    {{ user.posts.length }}
                </p>
                <p>
                    <strong>Comments posted: </strong>
                    {{ user.comments.length }}
                </p>
            </div>
        </div>

        <div class="col-md-12 posts-list">
            <h4>Posts by {{ user.name }}</h4>

            <post-list
                    v-if="user.posts && user.posts.length > 0"
                    :filters="{user: id}"
            ></post-list>

            <p v-else>User hasn't published any posts yet.</p>
        </div>

    </div>

</template>

<script>
    import PostList from '../posts/PostsList.vue'

    export default {
        props: [
            'id'
        ],

        components: {
            PostList
        },

        data() {
            return {
                user: {}
            }
        },

        created() {
            this.fetch()
        },

        methods: {
            fetch() {
                this.loading = true

                axios.get(`/api/users/${this.id}`).then((response) => {
                    this.user = response.data
                }).catch((error) => {
                    this.error = error.response.data || 'Error occurred'
                }).then(() => {
                    this.loading = false
                })
            }
        },

        computed: {
            registeredDate() {
                return moment(this.user.created_at).format("MMMM Do YYYY")
            }
        }
    }
</script>

<style lang="scss" rel="stylesheet/scss" scoped>
    .user {
        h2 {
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .posts-list {
            margin-top: 30px;
        }
    }
</style>