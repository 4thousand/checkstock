import Vue from 'vue'
import Router from 'vue-router'
import salesorder from '@/components/salesorder'
import index from '@/components/index'
import login from '@/components/login'
import quotation from '@/components/quotation/quotation'
import setting from '@/components/setting'

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
      path: '/quotation/:id',
      name: 'quotation',
      component: quotation
    },
    {
      path: '/setting',
      name: 'setting',
      component: setting
    }
  ]
})
