/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
// view router
import VueRouter from 'vue-router';

//vue progressbar
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar,{
  color:'rgb(143,255,199)',
  failedColor:'red',
  height:'3px'
});


//v form for forms and error handling
import { Form, HasError, AlertError } from 'vform'
window.Form = Form;

window.Fire = new Vue();
//moment for text format
import moment from 'moment';

Vue.component(HasError.name,HasError);
Vue.component(AlertError.name,AlertError);

//vue sweetalert2
import swal from 'sweetalert2'
window.swal = swal;

const Toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.Toast = Toast;

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


Vue.filter('Uppercase',function(text){
  return text.toUpperCase();
});
Vue.component('pagination', require('laravel-vue-pagination'));

Vue.filter('WordUppercase',function(text){
  return text.charAt(0).toUpperCase()+text.slice(1);
});

Vue.filter('DateFormat',function(created){
  return moment(created).format('MMMM Do YYYY')
});

Vue.use(VueRouter);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    mode: 'history',
    routes: [
   {path:"/users",component: require('./components/Users.vue').default},
   {path:"/profile",component: require('./components/Profile.vue').default},
      // {path:"/owners",component: require('./components/Owners.vue').default},
     
    ]
  });
  
  
  const app = new Vue({
    el: '#app',
  router
  });