/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import ChatApplication from "./components/ChatApplication";

require('./bootstrap')
import Vue from "vue";

window.Vue = Vue

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'))
Vue.component('chat-application', ChatApplication)

const app = new Vue({
    el: '#app',
    data: {
        userID: null,
        appSocketPrefix: null
    },
    mounted () {
        // Assign the ID from meta tag for future use in application
        this.userID = document.head.querySelector('meta[name="userID"]').content;
        this.appSocketPrefix = document.head.querySelector('meta[name="app-socket-prefix"]').content;
    }
})

//
// Echo.channel('newMessage-149-148')
//     .listen('.messages.new', (data) => {
//         console.log(data);
//
//         if (app.chatUserID) {
//             app.messages.push(data.message)
//         }
//     })
//
//
// Echo.channel('newMessage-148-149')
//     .listen('.messages.new', (data) => {
//         console.log(data);
//
//         if (app.chatUserID) {
//             app.messages.push(data.message)
//         }
//     })
//
// // working
// Echo.channel('sm_app_database_newMessage-148-149')
//     .listen('.messages.new', (data) => {
//         console.log(data, 'data');
//
//         if (app.chatUserID) {
//             app.messages.push(data.message)
//         }
//     })
