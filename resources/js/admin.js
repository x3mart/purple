import Index from "./components/admin/Index";
import VueRouter from "vue-router";

require('./bootstrap');

window.Vue = require('vue');
Vue.use(Vuex);
Vue.use(VueRouter)

window.flatpickr = require('flatpickr');
window.flatpickrRU = require("flatpickr/dist/l10n/ru.js").default.ru;

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component("index", Index)

const app = new Vue({
    el: '#app',
    store,
    router,
});
