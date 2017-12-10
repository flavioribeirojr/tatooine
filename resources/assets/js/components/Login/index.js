const Vue = require('vue')

Vue.prototype.$url = process.env.MIX_BASE_ROUTE;

import VeeValidate from 'vee-validate'

Vue.use(VeeValidate)
Vue.component('login-form', require('./Login'))

const app = new Vue({
    el: '#login'
})