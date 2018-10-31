import Vue from 'vue'
import Router from 'vue-router'
import salesorder from '@/components/salesorder'
import index from '@/components/index'
import login from '@/components/login'
import quotation from '@/components/quotation/quotation'
import sale from '@/components/quotation/quotation'
import setting from '@/components/setting'
import newquo from '@/components/quotation/newquo'
import newsale from '@/components/sale/newsale'
import test from '@/components/quotation/test'

Vue.use(Router)

export default new Router({
  mode: 'history',
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
      path: '/Login',
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
    },
    {
      path: '/sale/:id',
      name: 'sale',
      component: sale
    },//newquotation
    {
      path: '/newquotation/:id',
      name: 'newquo',
      component: newquo
    },
    {
      path: '/newsale/:id',
      name: 'newsale',
      component: newsale
    },
    {
      path: '/test',
      name: 'test',
      component: test
    },
  ]
})
