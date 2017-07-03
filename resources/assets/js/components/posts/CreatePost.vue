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

    export default {
        components: {
            FileUpload
        },

        data() {
            return {
                userId: 7, // TODO replace this ID with real authenticated user
                post: {
                    image: '/images/noimage.jpg'
                }
            }
        },

        methods: {
            save() {

            },

            changeImageSrc() {

            }
        }
    }
</script>