import Vue from 'vue'
import Router from 'vue-router'
import index from '@/components/index'
import login from '@/components/login'
import quotation from '@/components/quotation/quotation'
import sale from '@/components/quotation/quotation'
import setting from '@/components/setting'
import newquo from '@/components/quotation/newquo'
import newsale from '@/components/sale/newsale'
import deposit from '@/components/deposit/deposit'
import depositlist from '@/components/deposit/depositlist'
import saleorder from '@/components/saleorder/saleorder'
import newsaleorder from '@/components/saleorder/newsaleorder'
import dashboard from '@/components/dashboard/dashboard'
import utility from '@/components/utility/utility'
import prototype from '@/components/dashboard/depositprototype'

Vue.use(Router)

export default new Router({
  routes: [
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
    },
    {
      path: '/sale/:id',
      name: 'sale',
      component: sale
    },//newquotation
    {
      path: '/saleorder/:id',
      name: 'saleorder',
      component: saleorder
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
      path: '/deposit',
      name: 'deposit',
      component: deposit
    },
    {
      path: '/depositlist',
      name: 'depositlist',
      component: depositlist
    },
    {
      path: '/newsaleorder/:id',
      name: 'newsaleorder',
      component: newsaleorder
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: dashboard
    },
    {
      path: '/utility',
      name: 'utility',
      component: utility
    },
    {
      path: '/prototype',
      name: 'prototype',
      component: prototype
    }
  ]
})
