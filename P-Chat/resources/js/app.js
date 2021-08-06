/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import Vue from 'vue'

Vue.component('Message', require('./components/Message.vue').default);

import VueChatScroll from 'vue-chat-scroll';

Vue.use(VueChatScroll);
 
import Toaster from 'v-toaster'
Vue.use(Toaster, {timeout: 5000})
import 'v-toaster/dist/v-toaster.css'

const app = new Vue({
    el: '#app',
    data:{
        message :'',
        chat:{
            message:[],
            user:[],
            color:[],
        },
        typing:'',
        numberOfUsers:0,
        usersArr:[]
    },
    watch:{
        message(){
            Echo.private('chats')
        .whisper('typing', {
            name: this.message
        });
        }
    },
    methods:{
        send(){
            if(this.message.length!=0)
            this.chat.message.push(this.message)
            this.chat.user.push("you")
            this.chat.color.push("success")
            
            axios.post('/send', {
                message: this.message,
                chat: this.chat
              })
              .then(response => {
                console.log(response);
                this.message =''
              })
              .catch(error => {
                console.log(error);
              });
        }
   
    },

    mounted(){
        window.Echo.private('chats')
            .listen("ChatEvent",(e) => {
                this.chat.message.push(e.message)
                this.chat.user.push(e.user.name)
                this.chat.color.push("info")   
                var username = e.user.name          
            }).listenForWhisper('typing', (e) => {
                if(e.name !=""){
                    this.typing =  "typing..."
                }else{
                    this.typing = ""
                }
                
            })
            Echo.join('chats')
                .here((users) => {
                    this.numberOfUsers = users.length;
                    console.log(users)
                    // users.forEach(element => {
                    //     console.log(element)
                    //     this.usersArr = element.name
                    // });
                })
                .joining((user) => {
                    this.numberOfUsers += 1;
                    this.$toaster.success(user.name+' Joined the chat room.')
                })
                .leaving((user) => {
                    this.numberOfUsers -= 1;
                    this.$toaster.warning(user.name+' leaved the chat room.')
                    
                });
            }
});
