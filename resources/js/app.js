require('./bootstrap');

import Vue from "vue";
import router from "./router";
import VueRouter from "vue-router";

import Vuetify from 'vuetify';
Vue.use(Vuetify);


import Header from "./components/Header";
import Footer from "./components/Footer";


import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faUserSecret, faMugSaucer } from '@fortawesome/free-solid-svg-icons';

import VeeValidate, { Validator } from "vee-validate";
import ja from 'vee-validate/dist/locale/ja';
Validator.localize('ja', ja);

Vue.use(VeeValidate, {
  locale: 'ja'
});

Vue.mixin({
   methods: {
      async validationCheck(){
      await this.$validator.validateAll();
      return !this.errors.any();
     }
   }
});

const fonts = [
    faUserSecret,
        faMugSaucer
	];

library.add(fonts);
Vue.component('font-awesome-icon', FontAwesomeIcon);

//cors回避
//import cors from "./setting";

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.use(VueRouter);
Vue.component('header-component',Header);

Vue.component('footer-component',Footer);
const app = new Vue({
    el: "#app",
    vuetify: new Vuetify(),
    router
});

