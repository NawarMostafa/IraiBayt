//require('bootstrap');
window.Vue = require('vue');
Vue.component('pagination', require('laravel-vue-pagination'));
require('@fortawesome/fontawesome-free/js/all');
//window.$=window.jQuery=require('jquery/dist/jquery.min')
window.axios = require('axios');
import { Form, HasError, AlertError } from 'vform'
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
window.Form=Form;

import Swal from 'sweetalert2';
window.Swal=Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
window.Toast=Toast;

String.prototype.trimRight = function(charlist) {
    if (charlist === undefined)
        charlist = "\s";

    return this.replace(new RegExp("[" + charlist + "]+$"), "");
};

let base_site=$('meta[name="base_site"]').attr('content');
let base_storage=$('meta[name="base_storage"]').attr('content');
window.base_site=base_site;
window.base_storage=base_storage;
window.Fire=new Vue();
Vue.component('weather-component', require('./components/site/WeatherComponent').default);
Vue.component('exchange-component', require('./components/site/ExchangeComponent').default);
Vue.component('search-component', require('./components/site/SearchComponent').default);
Vue.component('advanced-search-component', require('./components/site/AdvancedSearchComponent').default);
Vue.component('result-component', require('./components/site/ResultComponent').default);
Vue.component('special-component', require('./components/site/SpecialComponent').default);
Vue.component('latest-component', require('./components/site/LatestComponent').default);
Vue.component('contact-us-component', require('./components/site/ContactUsComponent').default);
Vue.component('site-add-post-component', require('./components/site/AddPostComponent.vue').default);
Vue.component('site-edit-post-component', require('./components/site/EditPostComponent.vue').default);
Vue.component('depart-component', require('./components/site/DepartsComponent').default);
Vue.component('quizz-component', require('./components/site/QuizzComponent').default);
Vue.component('about-iraq-component', require('./components/site/AboutIraqComponent').default);
Vue.component('photo-swip-component', require('./components/site/PhotoSwipComponent').default);
Vue.component('add-comment-component', require('./components/site/AddCommentComponent').default);
Vue.component('add-comment-component', require('./components/site/AddCommentComponent').default);
Vue.component('price-less-component', require('./components/site/PriceLessComponent').default);
Vue.component('system-component', require('./components/site/SystemIraqComponent').default);
Vue.component('info-component', require('./components/site/InfoComponent').default);
Vue.component('tip-component', require('./components/site/TipComponent.vue').default);

const app = new Vue({
    el: '#app',
});

/*
navigator.geolocation.getCurrentPosition((pos)=>{
    console.log(pos);
})*/
