import Vue from 'vue'
import Router from 'vue-router'
import salesorder from '@/components/salesorder'
import index from '@/components/index'
import login from '@/components/login'
import quotation from '@/components/quotation/quotation'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/salesorder',
      name: 'salesorder',
      component: salesorder
    },
    {
      path: '/index',
      name: 'index',
      component: index
    },
    {
      path: '/',
      name: 'login',
      component: login
    },
    {
      path: '/quotation',
      name: 'quotation',
      component: quotation
    }
  ]
})
