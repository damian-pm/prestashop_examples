import Vue from 'vue'
import App from './App.vue'
import $ from 'jquery';
import './css/style.css';

Vue.config.productionTip = false

if ($('#ds_comment').length) {
  new Vue({
    render: h => h(App),
  }).$mount('#ds_comment')
} else {
  console.warn('Translpalnt module ds_comment for example to displayFooterProduct')
}