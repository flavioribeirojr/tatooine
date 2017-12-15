
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')

Vue.prototype.$baseUrl = process.env.MIX_BASE_ROUTE

Vue.component('action', require('./components/Action.vue'))
Vue.component('data-grid', require('./components/DataGrid.vue'))
Vue.component('t-menu', require('./components/Menu.vue'))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    methods: {
        logout (url) {
            localStorage.clear()

            window.location.replace(url)            
        }
    }
});
