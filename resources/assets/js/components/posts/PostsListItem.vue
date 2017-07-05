<template>
    <div :class="['col-md-12 post', { featured: post.featured }]">

        <div class="row">
            <div class="col-md-12">
                <h4>
                    <strong>
                        <router-link
                                :to="{ name: 'post', params: { id: post.id }}"
                                class="post-title"
                        >
                            {{ post.title }}
                        </router-link>
                    </strong>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 post-header-line">
                <span class="glyphicon glyphicon-user"></span> by
                <router-link
                        :to="{ name: 'user', params: { id: post.user.id }}"
                        class="username"
                >
                    {{ post.user.name }}
                </router-link>
                <span class="separator"></span>

                <span class="glyphicon glyphicon-calendar"></span>
                {{ formattedDate }}
                <span class="separator"></span>

                <span class="glyphicon glyphicon-comment"></span>
                {{ commentsText }}
                <span class="separator"></span>

                Tags :
                <a href="#" v-for="tag in post.tags">
                    <span class="label label-info tag">{{ tag }}</span>
                </a>
            </div>
        </div>

        <div class="row post-content">
            <div class="col-md-3">
                <img :src="post.image"
                     :alt="post.title"
                     class="img-thumbnail"
                >
            </div>
            <div class="col-md-9">
                <p>
                    {{ shortenedText }}
                </p>
                <router-link
                        :to="{ name: 'post', params: { id: post.id }}"
                        class="btn btn-read-more"
                >
                    Read more
                </router-link>
            </div>

        </div>
    </div>
</template>

<script>
    import post from '../../mixins/post'

    export default {
        props: [
            'post'
        ],

        mixins: [
            post
        ],

        computed: {
            shortenedText() {
                // Shortens the post body to 80 words
                return this.post.body.split(" ").slice(0, 80).join(' ') + ' ...'
            }
        }
    }
</script>

<style lang="scss" rel="stylesheet/scss">

    @import "../../../sass/_mixins.scss";

    a:hover {
        text-decoration: none;
    }

    .btn {
        @include transition(all .2s linear);
    }

    .btn-read-more {
        padding: 5px;
        text-align: center;
        border-radius: 0px;
        display: inline-block;
        border: 2px solid #3498db;
        text-decoration: none;
        text-transform: uppercase;
        font-weight: bold;
        font-size: 12px;
        color: #3498db;

        &:hover {
            color: #FFF;
            background: #3498db;
        }
    }

    .post {
        border-bottom: 1px solid #DDD;
        margin-bottom: 40px;

        &.featured {
            background-color: rgba(254, 198, 6, 0.1);
        }

        .glyphicon {
            margin-right: 5px;
        }
    }

    .post-title {
        color: #3498db;
    }

    .post-header-line {
        border-top: 1px solid #DDD;
        border-bottom: 1px solid #DDD;
        padding: 5px 0px 5px 15px;
        font-size: 12px;

        .username {
            color: #d35400;
        }

        .tag {
            font-size: 10px;
            font-weight: 400;
            margin: auto 3px;
        }
    }

    .post-content {
        padding-bottom: 15px;
        padding-top: 15px;
    }

    .separator {
        margin-right: 8px;

        &:before {
            content: "|";
            margin-left: 8px;
        }
    }
</style>