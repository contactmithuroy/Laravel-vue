/***/
import Vue from 'vue';
import routes from './router/index'
require('./bootstrap');
import store from './store/index'





// validation
import Form from 'vform'
// toster notification
import CxltToastr from 'cxlt-vue2-toastr'
import 'cxlt-vue2-toastr/dist/css/cxlt-vue2-toastr.css'
var toastrConfigs = {
    position: 'top right',
    showDuration: 1000,
    timeOut:10000,
    closeButton:true,
    showMethod:'fadeIn',
    showMethod:'fadeOut',
}
// Sweet Alert
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);


Vue.component('app-header', require('./components/header.vue').default);

const app = new Vue({
    el: '#app',
    router:routes,
    store,
});
 