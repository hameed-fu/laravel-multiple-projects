/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue'
import router from './router';
import vuetify from './vuetify/vuetify'


import Home from './components/Home.vue';
import topBar from './components/topBar.vue';
import Vuetify from 'vuetify';

const app = new Vue({
    el: '#app',
    Vuetify: new Vuetify(),
    vuetify,
    router,
    components:{
        Home,
        topBar
    },

    mounted(){
        
    },

    
    
});
