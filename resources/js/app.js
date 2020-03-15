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
Vue.component('invoice-penjualan-create',require("./components/InvoicePenjualanCreate.vue").default);
Vue.component('penerimaan-create',require("./components/PenerimaanCreate.vue").default);
Vue.component('penerimaan-edit',require("./components/PenerimaanEdit.vue").default);

Vue.mixin({
    methods: {
        get: require("lodash").get,
        currencyFormat: require("./numeralHelper").currencyFormat
    }
});

const app = new Vue({
    el: '#app',
});
