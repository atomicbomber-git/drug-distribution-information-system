require('./bootstrap');

import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';

// loads the Icon plugin
UIkit.use(Icons);

// Datatable
window.$ = window.jQuery = require('jquery');

// Load datatables
require('datatables.net-dt');
