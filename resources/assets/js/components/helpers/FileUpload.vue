<template>
    <div class="text-center">
        <button
                @click="clickOnInput"
                class="btn btn-sm btn-default"
                id="upload-btn"
        >
            Select Image
        </button>

        <input
                type="file"
                :disabled="savingImage"
                @change="onFileChange"
                accept="image/*"
                class="form-control hidden"
                id="img-input"
        >

        <div class="text-center">
            <loader v-if="savingImage"></loader>
            <p v-if="savingImage">
                Uploading file...
            </p>

            <div
                    v-if="errors"
                    v-html="errors"
                    class="alert alert-danger error-msg"
            ></div>
        </div>
    </div>
</template>

<script>
    import FormData from 'form-data'

    export default{
        data(){
            return {
                savingImage: false,
                error: null,
                image: null
            }
        },

        methods: {
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length) {
                    return;
                }

                let data = new FormData();
                data.append('image', files[0]);
                this.image = data

                this.savingImage = true
                this.error = null

                this.uploadImage().then(() => {
                    this.savingImage = false
                })
            },

            uploadImage(){
                return axios.post('/api/upload/image', this.image, {
                    headers: {
                        'Content-Type': `multipart/form-data`,
                    }
                }).then((response) => {
                    this.$emit('imageUploaded', response.data.path)
                }).catch((error) => {
                    this.error = error.response.data || 'Error occurred'
                });
            },

            clickOnInput() {
                $('#img-input').click()
            }
        }
    }
</script>

<style scoped>
    #upload-btn {
        margin-top: 10px;
        margin-bottom: 10px;
    }
</style>