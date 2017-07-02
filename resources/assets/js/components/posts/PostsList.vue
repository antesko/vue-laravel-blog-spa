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

        <div class="col-md-9" v-if="!loading && !error">

            <posts-list-item
                    v-for="post in posts"
                    :key="post.id"
                    :post="post"
            >
            </posts-list-item>

            <pagination
                    :current-page="data.current_page"
                    :last-page="data.last_page"
                    :filters="filters"
                    :route-name="$route.name"
            ></pagination>

        </div>
    </div>
</template>

<script>
    export default {
        components: {
            PostsListItem: require('./PostsListItem.vue'),
            Pagination: require('../helpers/Pagination.vue')
        },

        props: [
            'filters'
        ],

        data() {
            return {
                loading: false,
                error: null,
                data: {}
            }
        },

        created() {
            this.loadData()
        },

        watch: {
            '$route': 'loadData' // fetch again if the route changes
        },

        methods: {
            loadData() {
                if (_.has(this.allFilters, 'user')) {
                    this.fetch(`/api/users/${this.allFilters.user}/posts?page=${this.page}`)
                } else {
                    this.fetch(`/api/posts?page=${this.page}`)
                }
            },

            fetch(url) {
                this.loading = true

                axios.get(url).then((response) => {
                    this.data = response.data
                }).catch((error) => {
                    this.error = error.response.data || 'Error occurred'
                }).then(() => {
                    if (this.data && this.data.current_page > this.data.last_page) {
                        this.$router.push({name: 'postsList'})
                    }
                    this.loading = false
                })
            }
        },

        computed: {
            posts() {
                // Note: the second 'data' property is added by
                // Laravel's pagination (check the PostController@index)
                return this.data.data
            },

            allFilters() {
                // Merges query and props filters
                return _.assign({}, this.filters, this.$route.query)
            },

            page() {
                return this.$route.query.page || 1
            }
        }
    }
</script>