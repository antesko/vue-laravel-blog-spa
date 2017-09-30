import FileUpload from '../components/helpers/FileUpload.vue'
import 'bootstrap-tagsinput/dist/bootstrap-tagsinput.css'

export default {
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