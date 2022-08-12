/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');



import CKEditor from 'ckeditor4-vue';
import Swal from 'sweetalert2';

require("@fortawesome/fontawesome-free/js/all.min");

require('admin3-rtl/dist/js/adminlte.min');
require('admin3-rtl/plugins/ckeditor/ckeditor')
import {Form, HasError, AlertError} from 'vform'

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

window.Form = Form;
window.Swal = Swal;
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

String.prototype.trimRight = function(charlist) {
    if (charlist === undefined)
        charlist = "\s";

    return this.replace(new RegExp("[" + charlist + "]+$"), "");
};

Vue.use( CKEditor );
Vue.filter('cutString', function (value, limit) {
    if (value.length > limit) {
        value = value.substring(0, (limit - 3)) + '...';
    }

    return value
})
window.Fire = new Vue();
let base_site = $('meta[name="base_site"]').attr('content');
let base_storage = $('meta[name="base_storage"]').attr('content');
let csrf = $('meta[name="csrf"]').attr('content');

function getParameterByName(name) {
    var  url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}
Vue.filter('active',(v)=>{
    if(v==0){
        return "غير مفعل"
    }else {
        return "مفعل"
    }
})
var funcnum=getParameterByName('CKEditorFuncNum');
$('#fileBrowse').on('click','img',function(){
    var fileUrl=$(this).attr('src');
    window.opener.CKEDITOR.tools.callFunction(funcnum,fileUrl);
    //alert(fileUrl);
    window.close()
}).hover(()=>{
    $(this).css('cursor','pointer');
});

//alert(base_storage)
window.base_site = base_site;
window.base_storage = base_storage;
window.Toast = Toast;
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('country-component', require('./components/admin/CountryComponent.vue').default);
Vue.component('city-component', require('./components/admin/CityComponent.vue').default);
Vue.component('region-component', require('./components/admin/RegionComponent.vue').default);
Vue.component('category-component', require('./components/admin/CategoryComponent.vue').default);
Vue.component('sub-category-component', require('./components/admin/SubCategoryComponent.vue').default);
Vue.component('post-component', require('./components/admin/PostComponent.vue').default);
Vue.component('post-component-region', require('./components/admin/PostComponentRegion.vue').default);
Vue.component('add-post-component', require('./components/admin/AddPostComponent.vue').default);
Vue.component('edit-post-component', require('./components/admin/EditPostComponent.vue').default);
Vue.component('img-component', require('./components/admin/InputImgComponent.vue').default);
Vue.component('unit-component', require('./components/admin/UnitComponent.vue').default);
Vue.component('currancy-component', require('./components/admin/CurrancyComponent.vue').default);
Vue.component('tag-component', require('./components/admin/TagComponent.vue').default);
Vue.component('category-quiz-component', require('./components/admin/CategoryQuizComponent.vue').default);
Vue.component('ask-quiz-component', require('./components/admin/AskQuizComponent.vue').default);
Vue.component('answer-quiz-component', require('./components/admin/AnswerQuizComponent.vue').default);
Vue.component('exchange-component', require('./components/admin/ExchangeComponent.vue').default);
Vue.component('edit-exchange-component', require('./components/admin/EditExchangeComponent.vue').default);
Vue.component('edit-matexchange-component', require('./components/admin/EditExchangMatComponent.vue').default);
Vue.component('material-component', require('./components/admin/MaterialComponent.vue').default);
Vue.component('headerex-component', require('./components/admin/HeaderExComponent.vue').default);

///// About
Vue.component('about-component', require('./components/admin/about/AboutComponent').default);
Vue.component('add-about-component', require('./components/admin/about/AddAboutComponent').default);
Vue.component('edit-about-component', require('./components/admin/about/EditAboutComponent').default);


// USERS
Vue.component('user-component', require('./components/admin/user/UserComponent').default);
Vue.component('edit-user-component', require('./components/admin/user/EditUserComponent').default);
Vue.component('user-posts-component', require('./components/admin/user/UserPostsComponent').default);
Vue.component('user-comments-component', require('./components/admin/user/UserCommentsComponent').default);
Vue.component('user-messages-component', require('./components/admin/user/UserMessagesComponent').default);

//// Depart
Vue.component('depart-component', require('./components/admin/depart/DepartComponent').default);
Vue.component('edit-depart-component', require('./components/admin/depart/EditDepartComponent').default);

Vue.component('material-exchange-component', require('./components/admin/MaterialExchangeComponent.vue').default);
Vue.component('system-component', require('./components/admin/SystemComponent.vue').default);
Vue.component('edit-system-component', require('./components/admin/EditSystemComponent.vue').default);
Vue.component('weather-component', require('./components/admin/WeatherComponent.vue').default);
Vue.component('edit-weather-component', require('./components/admin/EditWeatherComponent.vue').default);


Vue.component('message-component', require('./components/admin/MessageComponent.vue').default);
Vue.component('info-component', require('./components/admin/InfoComponent.vue').default);
Vue.component('settings-component', require('./components/admin/SettingsComponent.vue').default);


/// anylizes
Vue.component('analize-component', require('./components/admin/analize/AnalizeComponent.vue').default);
Vue.component('add-analize-component', require('./components/admin/analize/AddAnalizeComponent').default);
Vue.component('edit-analize-component', require('./components/admin/analize/EditAnalizeComponent').default);


const app = new Vue({
    el: '#app',
});
