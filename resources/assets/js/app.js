window.Vue = require('vue');

import Auth from './packages/auth/Auth'
Vue.use(Auth)

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Router from './routes.js'

// Plugins
import 'font-awesome/css/font-awesome.min.css'
import vue_html5_editor_options from './packages/vue-html5-editor/options'
Vue.use(require('vue-html5-editor'), vue_html5_editor_options)

// Global mixins
import global from './mixins/global'
Vue.mixin(global);

// Page Components
require('./vue-components')

// Router setup
Router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.public) && Vue.auth.isAuthenticated()) {
        next({
            path: '/posts'
        })
    }
    else if (to.matched.some(record => record.meta.private) && !Vue.auth.isAuthenticated()) {
        next({
            path: '/login'
        })
    }
    else {
        next()
    }
})

const app = new Vue({
    el: '#app',
    router: Router
});
