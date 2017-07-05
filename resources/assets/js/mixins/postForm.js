import FileUpload from '../components/helpers/FileUpload.vue'
import 'bootstrap-tagsinput/dist/bootstrap-tagsinput.css'

export default {
    template: `

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
    `,

    components: {
        FileUpload
    },

    data() {
        return {
            post: {
                image: '/images/noimage.jpg',
                tags: [],
                featured: 0
            }
        }
    },

    mounted() {
        let tagsInput = $('#tags-input')

        tagsInput.tagsinput()
        tagsInput.on('itemAdded itemRemoved', (e) => {
            this.post.tags = $('#tags-input').val()
        });
    },

    methods: {
        changeImageSrc(path) {
            this.post.image = path
        },

        updatePostBody(value) {
            this.post.body = value
        }
    }
}