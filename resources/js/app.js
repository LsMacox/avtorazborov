
require('./bootstrap');
require('./script');

window.Vue = require('vue');

import VueLaroute from 'vue-laroute';
import routes from './laroute.js';

Vue.use(VueLaroute, {
    routes,
    accessor: '$routes', // Optional: the global variable for accessing the router
});

// Components
Vue.component('user-chat-app', require('./components/User/ChatApp.vue').default);
Vue.component('shop-chat-app', require('./components/Shop/ChatApp.vue').default);
Vue.component('admin-chat-app', require('./components/Admin/ChatApp.vue').default);

const app = new Vue({
    el: '#app'
});
