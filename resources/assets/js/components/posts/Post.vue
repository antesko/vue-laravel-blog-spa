<template>
    <div class="row">

        <div class="text-center">
            <loader v-if="loading"></loader>

            <div
                    v-if="errors"
                    v-html="errors"
                    class="alert alert-danger error-msg">
            </div>
        </div>

        <div class="col-md-12" v-if="!loading && !error">

            <div class="col-md-4">
                <img
                        :src="post.image"
                        :alt="post.title"
                        class="img-thumbnail"
                >
            </div>

            <div class="col-md-8 post-header">

                <h3>{{ post.title }}</h3>

                <div class="post-header-line">

                    <span class="glyphicon glyphicon-user"></span> by
                    <router-link
                            :to="{ name: 'user', params: { id: post.user.id }}"
                            class="username"
                    >
                        {{ post.user.name }}
                    </router-link>

                    <span class="separator"></span>

                    <span class="glyphicon glyphicon-calendar"></span>
                    {{ formattedDate }}

                    <h4 v-if="post.featured" class="featured-label pull-right">
                        <span class="label label-warning">
                            Featured
                        </span>
                    </h4>

                    <div class="pull-right">
                        <router-link
                                :to="{ name: 'editPost', params: { id: post.id }}"
                                tag="button"
                                class="btn btn-default btn-sm edit-btn"
                                v-if="userIsAuthor"
                        >
                            Edit Post
                        </router-link>
                    </div>
                </div>
            </div>

            <div class="post-body" v-html="post.body">
            </div>

            <div class="col-md-12 tags pull-right">
                Tags :
                <a href="#" v-for="tag in post.tags">
                    <span class="label label-info tag">{{ tag }}</span>
                </a>
            </div>

        </div>

        <comments
                :post-id="post.id"
                :author-id="post.user_id"
        ></comments>
    </div>
</template>

<script>
    import post from '../../mixins/post'

    import Comments from './comments/Comments.vue'

    export default {
        components: {
            Comments
        },

        props: [
            'id'
        ],

        mixins: [
            post
        ],

        data() {
            return {
                post: {},
                user: {}
            }
        },

        created() {
            this.loading = true

            this.fetchPost()
            this.fetchUser()
        },

        methods: {
            fetchPost() {
                return axios.get(`/api/posts/${this.id}`).then((response) => {
                    this.post = response.data
                }).catch((error) => {
                    this.error = error.response.data || 'Error occurred'
                }).then(() => {
                    this.loading = false
                })
            }
        }
    }
</script>

<style lang="scss" rel="stylesheet/scss" scoped>
    h3 {
        margin-top: 10px;
    }

    .featured-label {
        margin: 0;

        span {
            display: inline-block;
            vertical-align: top;
        }
    }

    .post-header {
        padding-left: 0;
    }

    .post-body {
        padding: 20px;
        margin-top: 100px;

        &::first-letter {
            color: #D8335B;
            float: left;
            font-family: Georgia, sans-serif;
            font-size: 75px;
            line-height: 60px;
            padding: 4px 8px 0 3px;
        }
    }

    .tags {
        .tag {
            font-size: 12px;
            margin: 0 4px;
        }
    }

    .edit-btn {
        padding: 0 10px;
    }
</style>