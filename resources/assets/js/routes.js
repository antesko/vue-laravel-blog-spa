import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const router = new VueRouter({
    routes: [
        {
            path: '/login',
            component: require('./components/Login.vue'),
            name: 'login'
        },

        {
            path: '/register',
            component: require('./components/Register.vue'),
            name: 'register'
        },

        {
            path: '/posts',
            component: require('./components/posts/PostsList.vue'),
            name: 'postsList',
            props: true
        },

        {
            path: '/posts/:id',
            component: require('./components/posts/Post.vue'),
            name: 'post',
            props: true
        },

        {
            path: '/create',
            component: require('./components/posts/CreatePost.vue'),
            name: 'createPost',
            props: true
        },

        {
            path: '/users/:id',
            component: require('./components/users/User.vue'),
            name: 'user',
            props: true
        },

        {
            path: '/profile',
            component: require('./components/users/Profile.vue'),
            name: 'profile'
        }
    ],

    linkActiveClass: 'active',

    mode: 'history'
})

export default router