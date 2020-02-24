require('./bootstrap');

import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';

// loads the Icon plugin
UIkit.use(Icons);

// Datatable
window.$ = window.jQuery = require('jquery');

// Lodash
window._ = require('lodash');

// Load datatables
require('datatables.net-dt');

window.Vue = require('vue');
Vue.component('invoice-pembelian-create',require("./components/InvoicePembelianCreate.vue").default);

Vue.mixin({
    methods: {
        get: require("lodash").get
    }
});

const app = new Vue({
    el: '#app',
});
