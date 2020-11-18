import Vue from 'vue'
import App from './App.vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import BootstrapVue from 'bootstrap-vue'
import VueConfirmDialog from 'vue-confirm-dialog'

Vue.config.productionTip = false
Vue.use(VueAxios, axios)
Vue.use(BootstrapVue)
Vue.use(VueConfirmDialog)

new Vue({
  render: h => h(App),
}).$mount('#app')
