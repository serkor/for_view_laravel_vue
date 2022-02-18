/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *npm install --save @fullcalendar/vue @fullcalendar/daygrid
 * Eg. ./components/AppealsComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));


//account
Vue.component('calendar-component', require('./components/account/CalendarComponent.vue').default);

//executor
Vue.component('executor-count-review-profile', require('./components/account/executor/ExecutorCountReviewProfile.vue').default);
Vue.component('executor-list-review-profile', require('./components/account/executor/ExecutorListReviewProfile.vue').default);
Vue.component('executor-categories-profile', require('./components/account/executor/ExecutorCategoriesProfile.vue').default);
Vue.component('executor-review', require('./components/account/executor/ExecutorReview.vue').default);
Vue.component('executor-schedule-profile', require('./components/account/executor/ExecutorScheduleProfile.vue').default);
Vue.component('executor-payment-types-profile', require('./components/account/executor/ExecutorPaymentTypesProfile.vue').default);
Vue.component('executor-additional-services-profile', require('./components/account/executor/ExecutorAdditionalServicesProfile.vue').default);
Vue.component('executor-favorite-profile', require('./components/account/executor/ExecutorFavoriteProfile.vue').default);
Vue.component('executor-bid-profile', require('./components/account/executor/bids/ExecutorBidProfile.vue').default);
Vue.component('executor-bid-questions-profile', require('./components/account/executor/bids/ExecutorBidQuestionsProfile.vue').default);
Vue.component('executor-bids-profile', require('./components/account/executor/bids/ExecutorBidsListProfile.vue').default);
Vue.component('executor-bid-offers-profile', require('./components/account/executor/bids/ExecutorBidOffersProfile.vue').default);
Vue.component('executor-bid-table', require('./components/account/executor/bids/ExecutorBidTable.vue').default);
Vue.component('executor-bid-comments-profile', require('./components/account/executor/bids/ExecutorBidCommentsProfile.vue').default);
Vue.component('executor-orders-profile', require('./components/account/executor/orders/ExecutorOrdersListProfile.vue').default);
Vue.component('executor-page-help', require('./components/account/executor/pages/ExecutorHelp.vue').default);
Vue.component('executor-offer-template', require('./components/account/executor/bids/ExecutorOfferTemplate.vue').default);
Vue.component('executor-add-offer-template', require('./components/account/executor/offer_templates/ExecutorAddOfferTemplate.vue').default);
Vue.component('executor-get-list-offer-template', require('./components/account/executor/offer_templates/ExecutorListOfferTemplate.vue').default);

//site
Vue.component('city-select', require('./components/site/CitySelect.vue').default);
Vue.component('site-city-catalog', require('./components/site/catalog/City.vue').default);
Vue.component('site-catalog-for-executor', require('./components/site/catalog/CatalogForExecutor.vue').default);
Vue.component('site-catalog-for-customer', require('./components/site/catalog/CatalogForCustomer.vue').default);
Vue.component('site-category-catalog', require('./components/site/catalog/Category.vue').default);
Vue.component('rate', require('./components/site/Rate.vue').default);
Vue.component('customer-create-bid-catalog', require('./components/site/catalog/CustomerCreateBidCatalog.vue').default);
Vue.component('site-review-home', require('./components/site/ReviewHome.vue').default);
Vue.component('site-notifications-count', require('./components/site/NotificationsCount.vue').default);
Vue.component('executor-register', require('./components/auth/ExecutorRegister.vue').default);
Vue.component('customer-register', require('./components/auth/CustomerRegister.vue').default);
Vue.component('all-register', require('./components/auth/allRegister.vue').default);

Vue.component('notifications', require('./components/account/all/Notifications.vue').default);

//admin
Vue.component('category-parent-select', require('./components/admin/CategoryParentSelect.vue').default);
Vue.component('marks-select', require('./components/admin/MarksSelect.vue').default);
Vue.component('payment-types-profile', require('./components/admin/PaymentTypesProfile.vue').default);
Vue.component('additional-services-profile', require('./components/admin/AdditionalServicesProfile.vue').default);
Vue.component('categories-profile', require('./components/admin/CategoriesProfile.vue').default);

//customer
Vue.component('customer-cars-profile', require('./components/account/customer/cars/CustomerCarsListProfile.vue').default);
Vue.component('customer-bids-profile', require('./components/account/customer/bids/CustomerBidsListProfile.vue').default);
Vue.component('customer-bid-profile', require('./components/account/customer/bids/CustomerBidProfile.vue').default);
Vue.component('customer-bid-questions-profile', require('./components/account/customer/bids/CustomerBidQuestionsProfile.vue').default);
Vue.component('customer-bid-offers-profile', require('./components/account/customer/bids/CustomerBidOffersProfile.vue').default);
Vue.component('customer-add-bid-profile', require('./components/account/customer/bids/CustomerAddBidProfile.vue').default);
Vue.component('customer-add-car-profile', require('./components/account/customer/cars/CustomerAddCarProfile.vue').default);
Vue.component('customer-favorite-catalog', require('./components/account/customer/CustomerFavoriteList.vue').default);
Vue.component('customer-bid-table', require('./components/account/customer/bids/CustomerBidTable.vue').default);
Vue.component('customer-bid-comments-profile', require('./components/account/customer/bids/CustomerBidCommentsProfile.vue').default);
Vue.component('customer-orders-profile', require('./components/account/customer/orders/CustomerOrdersListProfile.vue').default);
Vue.component('customer-page-help', require('./components/account/customer/pages/CustomerHelp.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueLuxon from "vue-luxon";
Vue.use(VueLuxon);

import store from './store'

import '@mdi/font/css/materialdesignicons.css';
import Buefy from 'buefy';
import 'buefy/dist/buefy.css';
Vue.use(Buefy);

import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store: store,
});

