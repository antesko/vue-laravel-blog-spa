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

        <div class="col-md-8">
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

                <vue-html5-editor
                        :content="post.body"
                        @change="updatePostBody"
                ></vue-html5-editor>
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
    import postForm from '../../mixins/postForm'

    export default {
        mixins: [
            postForm
        ],

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
                })
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