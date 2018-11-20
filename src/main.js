// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css' // This line here
import 'jspdf-customfonts/dist/jspdf.customfonts.min.js'
import VueHotkey from 'v-hotkey'
import VueApexCharts from 'vue-apexcharts'

Vue.use(VueApexCharts)
Vue.use(VueHotkey)
Vue.use(VueMaterial)
Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
