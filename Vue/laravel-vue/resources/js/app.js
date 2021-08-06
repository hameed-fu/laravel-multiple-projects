/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router'

Vue.use(VueRouter)
import router from './router';


import Home from './components/Home.vue';
import About from './components/About.vue';
import Contact from './components/Contact.vue';
import Navbar from './components/Navbar.vue';

const app = new Vue({
    el: '#app',
    router,
    components:{
        Home,
        About,
        Contact,
        Navbar
    },

    mounted(){
        console.log("OK")
    },

    
    
});
