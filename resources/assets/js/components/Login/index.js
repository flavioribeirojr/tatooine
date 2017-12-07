const Vue = require('vue')

import VeeValidate from 'vee-validate'

Vue.use(VeeValidate)
Vue.component('login-form', require('./Login'))

const app = new Vue({
    el: '#login'
})