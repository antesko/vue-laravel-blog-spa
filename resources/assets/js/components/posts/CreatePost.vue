<template>
    <div class="row">

        <div class="col-md-3">
            <div class="form-group">
                <label>Post image:</label>

                <img
                        v-if="post.image"
                        :src="post.image"
                        class="img-thumbnail user-avatar"
                >

                <file-upload v-on:imageUploaded="changeImageSrc"></file-upload>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Title:</label>
                <input
                        type="text"
                        class="form-control"
                        v-model="post.title"
                >
            </div>

            <div class="form-group">
                <label>Body:</label>
                <textarea
                        class="form-control"
                        cols="30"
                        rows="10"
                        v-model="post.body"
                ></textarea>
            </div>

            <div class="form-group">
                <label>Tags:</label>

                <select
                        multiple
                        id="tags-input"
                        data-role="tagsinput"
                ></select>
            </div>

            <div class="form-group">
                <label class="control-label input-group">Featured:</label>

                <div class="radio">
                    <label>
                        <input
                                type="radio"
                                name="featured"
                                class="radio-inline"
                                value="0"
                                checked="checked"
                                v-model="post.featured"
                        >
                        No
                    </label>

                    <label>
                        <input
                                type="radio"
                                name="featured"
                                class="radio-inline"
                                value="1"
                                v-model="post.featured"
                        >
                        Yes
                    </label>
                </div>
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
    import 'bootstrap-tagsinput/dist/bootstrap-tagsinput.css'

    export default {
        components: {
            FileUpload
        },

        mounted() {
            let tagsInput = $('#tags-input')

            tagsInput.tagsinput()
            tagsInput.on('itemAdded itemRemoved', (e) => {
                this.post.tags = $('#tags-input').val()
            });
        },

        data() {
            return {
                post: {
                    user_id: 7, // TODO replace this ID with real authenticated user
                    image: '/images/noimage.jpg',
                    featured: 0,
                    tags: []
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
            },

            changeImageSrc(path) {
                this.post.image = path
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
</style>