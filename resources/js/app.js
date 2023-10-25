import './bootstrap';

import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

window.Vue = Vue;
import Ratings from './components/Ratings.vue';
Vue.component('ratings', Ratings);

Vue.use(VueSweetalert2);

const app = new Vue({
    el: '#app',
});
