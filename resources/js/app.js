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

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('app-header', require('./components/header.vue').default);

//Nagivation Gard Authentication
function isLoggedIn() {
    return store.getters.getAuthenticated;
}

routes.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!isLoggedIn()) {
            next({
                name: 'login',
            })
        } else {
            next()
        }
    }else if (to.matched.some(record => record.meta.requiresVisitor)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (isLoggedIn()) {
            next({
                name: 'dashboard',
            })
        } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }
});

// check authentication
let auth = localStorage.getItem("auth");
console.log(auth);
if(auth){
    store.dispatch('authUser').then(() => {
        const app = new Vue({
            el: '#app',
            router:routes,
            store,
        });
    });
}else {
    const app = new Vue({
        el: '#app',
        router:routes,
        store,
    });
}

 