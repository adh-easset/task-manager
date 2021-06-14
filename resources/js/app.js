require('./bootstrap');

import Vue from 'vue';
import Vuex from 'vuex';
import App from './vue/app'

import { library } from '@fortawesome/fontawesome-svg-core'
import { faPlusSquare, faEdit, faCommentAlt, faWindowClose  } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'es6-promise/auto'

library.add( faPlusSquare, faEdit, faCommentAlt, faWindowClose )

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

Vue.use(Vuex)

Vue.component('font-awesome-icon', FontAwesomeIcon)

const app = new Vue({
    el: '#app',
    components: { App }
})


