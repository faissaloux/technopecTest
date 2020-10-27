/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Products from './components/ProductsComponent.vue';
import Dashboard from './components/DashboardComponent.vue';
import Create from './components/CreateComponent.vue';
import ProductsStore from './components/stores/ProductsStore';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
  { path: '/create', name: 'create', component: Create },
  { path: '/dashboard', name: 'dashboard', component: Dashboard },
  { path: '/products', name: 'products', component: Products }
]

const router = new VueRouter({
    routes
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('dashboard-component', require('./components/DashboardComponent.vue').default);
Vue.component('products-component', require('./components/ProductsComponent.vue').default);
Vue.component('create-component', require('./components/CreateComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const cart = new Vue({
    router,
    store: ProductsStore,
    el: '#cart'
});

$(() => {
    $(window).scroll(()=>{
        // Fix left menu issue when scrolling
        $(window).scrollTop() > 55
          ? $("div.left").css('marginTop', '-60px')
          : $("div.left").css('marginTop', 0);
      });
})