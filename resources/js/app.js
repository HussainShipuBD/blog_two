require('./bootstrap');
window.Vue = require('vue');
// import routes 
import router from './router'
// initial components for loading vue app


// IMPORT THE STORE 

import store from './store';
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
import locale from 'view-design/dist/locale/en-US';
Vue.use(ViewUI, {locale: locale});

// Vue.use(VueRouter);
Vue.use(ViewUI);

import common from './common'
Vue.mixin(common)


// Vue.component('mainapp', { './components/mainapp.vue' })

Vue.component('mainapp', require('./layout/admin.vue').default);
// Vue.component('pagination', require('laravel-vue-pagination'));


const app = new Vue({
    el: '#app', 
    router,
    store
});
