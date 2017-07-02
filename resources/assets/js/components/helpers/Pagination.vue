<template>
    <ul class="pagination pull-right">

        <li v-if="currentPage > 1">
            <router-link :to="pageLink(currentPage - 1)">
                &laquo; Prev
            </router-link>
        </li>

        <li
                v-for="pageNum in lastPage"
                :class="{ active: pageNum == currentPage }"
        >
            <router-link :to="pageLink(pageNum)">
                {{ pageNum }}
            </router-link>
        </li>

        <li v-if="currentPage < lastPage">
            <router-link :to="pageLink(currentPage + 1)">
                Next &raquo;
            </router-link>
        </li>

    </ul>
</template>

<script>
    export default {
        name: 'pagination',

        props: [
            'currentPage', 'lastPage', 'routeName', 'filters'
        ],

        methods: {
            pageLink(page) {
                let query = _.clone(this.$route.query)
                query.page = page

                return {
                    name: this.routeName,
                    params: this.filters,
                    query: query
                }
            }
        }
    }
</script>