<template>

    <div class="col-sm-8 comments">

        <div class="text-center">
            <loader v-if="loading"></loader>

            <div
                    v-if="errors"
                    v-html="errors"
                    class="alert alert-danger error-msg">
            </div>
        </div>

        <div class="col-md-12">

            <h3>Comments</h3>

            <div class="box-info" v-if="comments && comments.length && !loading">

                <ul class="media-list">

                    <comment
                            v-for="(comment, key) in sortedComments"
                            :comment="comment"
                            :key="comment.id"
                            :author-id="authorId"
                            :class="['media', { hidden: key >= displayLimit }]"
                    ></comment>

                </ul>

                <div class="box-footer" v-if="comments.length >= displayLimit">
                    <p @click="showAll">
                        <i class="fa fa-share"></i>
                        {{ showCommentsText }}
                    </p>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div v-else>
                <p>No comments yet.</p>
            </div>

            <post-comment
                    :post-id="postId"
                    v-on:commentPosted="fetch"
            ></post-comment>
        </div>
    </div>

</template>

<script>
    import Comment from './Comment.vue'
    import PostComment from './PostComment.vue'

    export default {
        props: [
            'postId', 'authorId'
        ],

        components: {
            Comment, PostComment
        },

        data() {
            return {
                comments: [],
                defaultComments: 5,
                displayLimit: 5
            }
        },

        watch: {
            postId() {
                this.fetch()
            }
        },

        methods: {
            fetch() {
                this.loading = true

                return axios.get(`/api/posts/${this.postId}/comments`).then((response) => {
                    this.comments = response.data
                }).catch((error) => {
                    this.error = error.response.data || 'Error occurred'
                }).then(() => {
                    this.loading = false
                })
            },

            showAll() {
                this.displayLimit = this.displayLimit >= this.comments.length ?
                        this.defaultComments : this.comments.length
            }
        },

        computed: {
            sortedComments() {
                return _.orderBy(this.comments, 'created_at', 'desc')
            },

            showCommentsText() {
                return this.displayLimit >= this.comments.length ?
                        "Show less" : "Show all comments"
            }
        }
    }
</script>

<style lang="scss" rel="stylesheet/scss" scoped>

    @import "../../../../sass/_mixins.scss";

    .comments {
        margin-top: 30px;
    }

    .box-info {
        padding: 10px;
        background: #fff;
        color: #5b5b5b;
        margin-bottom: 20px;
        margin-top: 20px;
        @include transition(all 0.4s ease);

        .media-list {
            margin-top: 20px;

            .media {
                padding: 5px 20px;
                border-bottom: 1px solid #eaeaea;
            }
        }

        .box-footer {
            p {
                cursor: pointer;
                color: #216a94;
                float: right;
            }
        }
    }
</style>