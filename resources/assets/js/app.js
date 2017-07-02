
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('bootstrap-notify');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Router from './routes.js'
import globalMixin from './mixins/globalMixin'

Vue.component('loader', require('./components/helpers/Loader.vue'));
Vue.mixin(globalMixin);

const app = new Vue({
    el: '#app',
    router: Router
});
