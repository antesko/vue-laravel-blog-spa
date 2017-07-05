
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Router from './routes.js'

// Plugins
import 'font-awesome/css/font-awesome.min.css'
import vue_html5_editor_options from './options/vue-html5-editor-options'
Vue.use(require('vue-html5-editor'), vue_html5_editor_options)

// Global mixins
import global from './mixins/global'
Vue.mixin(global);

// Global components
Vue.component('loader', require('./components/helpers/Loader.vue'));

const app = new Vue({
    el: '#app',
    router: Router
});
