import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const router = new VueRouter({
    routes: [
        {
            path: '/login',
            component: require('./components/Login.vue'),
            name: 'login',
            meta: {
                public: true
            }
        },

        {
            path: '/register',
            component: require('./components/Register.vue'),
            name: 'register',
            meta: {
                public: true
            }
        },

        {
            path: '/oauth',
            component: require('./components/passport/Oauth.vue'),
            name: 'oauth',
            meta: {
                private: true
            }
        },

        {
            path: '/posts',
            component: require('./components/posts/PostsList.vue'),
            name: 'postsList',
            props: true,
            meta: {
                private: true
            }
        },

        {
            path: '/posts/:id',
            component: require('./components/posts/Post.vue'),
            name: 'post',
            props: true,
            meta: {
                private: true
            }
        },

        {
            path: '/create',
            component: require('./components/posts/CreatePost.vue'),
            name: 'createPost',
            meta: {
                private: true
            }
        },

        {
            path: '/edit/:id',
            component: require('./components/posts/EditPost.vue'),
            name: 'editPost',
            props: true,
            meta: {
                private: true
            }
        },

        {
            path: '/users/:id',
            component: require('./components/users/User.vue'),
            name: 'user',
            props: true,
            meta: {
                private: true
            }
        },

        {
            path: '/profile',
            component: require('./components/users/Profile.vue'),
            name: 'profile',
            meta: {
                private: true
            }
        }
    ],

    linkActiveClass: 'active',

    mode: 'history'
})

export default router