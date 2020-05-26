/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('../../node_modules/paper-kit-2/assets/js/bootstrap-switch.min.js');
require('../../node_modules/paper-kit-2/assets/js/paper-kit.js');


window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('role-permission', require('./components/Users/RolePermission.vue').default);
Vue.component('upload-image', require('./components/Image/Upload.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


//import MaskedInput from 'vue-masked-input';

/*
import UploadImage from 'vue-upload-image';

// register globally
Vue.component('upload-image', UploadImage)
*/



import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'

Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)

import 'vue-bootstrap-selectpicker/dist/css/vue-bootstrap-selectpicker.min.css'
import SelectPicker from 'vue-bootstrap-selectpicker'

Vue.use(SelectPicker)

require('es6-promise').polyfill();
window.axios = require('axios');

let token = $('meta[name="csrf-token"]').attr('content');
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': token
};

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);




import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './components/App'
import Hello from './components/Hello'
import Home from './components/Home'
import About from './components/About'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/who',
            name: 'who',
            component: About,
        },
        {
            path: '/hi',
            name: 'hi',
            component: Hello,
        },
    ],
});


const app = new Vue({
    el: '#app',
    components: {
        App
    },
    router,
});
