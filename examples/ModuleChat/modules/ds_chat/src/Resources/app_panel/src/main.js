import Vue from 'vue'
import AppPanel from './AppPanel.vue'
// import $ from 'jquery';
import './css/style.css';
import feather from 'vue-icon'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.use(feather, 'v-icon')

Vue.config.productionTip = false

  new Vue({
    render: h => h(AppPanel),
  }).$mount('#app-ds-chat-panel')
