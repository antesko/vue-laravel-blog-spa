<template>
    <li>
        <img
                class="media-object"
                :src="comment.user.avatar"
                :alt="comment.user.name"
        >

        <div class="media-body">
            <h4 class="media-heading">

                <router-link :to="{ name: 'user', params: { id: comment.user.id }}">
                    {{ comment.user.name }}
                </router-link>

                <span
                        v-if="comment.user.id == authorId"
                        class="label label-primary"
                >
                    Author
                </span>

                <small class="pull-right">
                    {{ createdTime }}
                </small>
            </h4>

            <p>{{ comment.body }}</p>
        </div>
    </li>
</template>

<script>
    export default {
        props: [
            'comment', 'authorId'
        ],

        computed: {
            createdTime() {
                return moment(this.comment.created_at).fromNow()
            }
        }
    }
</script>

<style scoped>
    .media-object {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        float: left;
        margin-right: 12px;
    }

    .media-heading {
        margin-bottom: 10px;
    }
</style>