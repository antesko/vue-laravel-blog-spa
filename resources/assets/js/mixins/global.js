export default {
    data() {
        return {
            loading: false,
            error: null
        }
    },

    methods: {
        successAlert(msg) {
            $.notify({
                icon: 'glyphicon glyphicon-ok',
                title: 'Success',
                message: msg
            }, {
                delay: 1000,
                type: 'success',
                template: `
                <div data-notify="container" class="col-xs-11 col-sm-3 text-center alert alert-{0}" role="alert">
                    <button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>
                    <span data-notify="icon"></span>
                    <span data-notify="title"><b>{1}</b></span><br>
                    <span data-notify="message">{2}</span>
                </div>
                `
            });
        }
    },

    computed: {
        errors() {
            if (this.error) {
                if (typeof this.error === 'string' || this.error instanceof String) {
                    return this.error
                } else if(_.has(this.error, 'message')) {
                    return this.error.message
                }
                else {
                    let arr = _.flatMap(this.error)
                    let ul = $('<ul>')

                    $.each(arr, function (key, val) {
                        ul.append($('<li>').append(val));
                    });

                    return ul.prop('outerHTML')
                }
            }

            return null
        }
    }
}