// Options object for vue-html-editor package. We're handling the image upload.
// More info here: https://www.npmjs.com/package/vue-html5-editor

export default {
    image: {
        upload: {
            url: '/api/upload/image',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            params: {},
            fieldName: 'image'
        },

        uploadHandler(responseText)
        {
            var json = JSON.parse(responseText)
            if (json.error) {
                alert(json.error)
            } else {
                return json.path
            }
        }
    }
}