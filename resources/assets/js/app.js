
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('listingsform', require('./components/ListingsForm.vue'));
Vue.component('jooblelistings', require('./components/JoobleListings.vue'));
Vue.component('templisting', require('./components/TempListing.vue'));
Vue.component('listings', require('./components/Listings.vue'));
Vue.component('listing', require('./components/Listing.vue'));
Vue.component('createlisting', require('./components/createListing.vue'));
Vue.component('rssform', require('./components/RssForm.vue'));
Vue.component('rsslistings', require('./components/RssListings.vue'));


export const eventBus = new Vue();

export var store = {
    state: {
        joobleListings: [],
        rssListings: []
    }
};

const app = new Vue({
    el: '#app'
});

