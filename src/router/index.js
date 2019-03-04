import Vue from 'vue'
import Router from 'vue-router'
import index from '@/components/index'
import login from '@/components/login'
import quotation from '@/components/quotation/quotation'
import sale from '@/components/quotation/quotation'
import settinglist from '@/components/setting/settinglist'
//import setting from '@/components/setting/setting'
import setting from '@/components/setting'
import newquo from '@/components/quotation/newquo'
import newsale from '@/components/sale/newsale'
import depositlist from '@/components/deposit/depositlist'
import saleorder from '@/components/saleorder/saleorder'
import newsaleorder from '@/components/saleorder/newsaleorder'
import dashboard from '@/components/dashboard/dashboard'
import utility from '@/components/utility/utility'
import dp from '@/components/deposit/deposit'
import sms from '@/components/mk/sms'
import quolist from '@/components/quotation/quotationlist'
import solist from '@/components/saleorder/saleorderlist'
import invoice from '@/components/invoice/invoice'
import invoicelist from '@/components/invoice/invoicelist'
import salehistory from '@/components/saleorder/salehistory'
import salehistorydetail from '@/components/saleorder/salehistorydetail'
Vue.use(Router)

export default new Router({
  routes: [
    // {
    //   path: '/index',
    //   name: 'index',
    //   component: index
    // },
    {
      path: '/index',
      name: 'index',
      component: dashboard
    },
    {
      path: '/',
      name: 'login',
      component: login
    }, {
      path: '/invoicelist',
      name: 'invoicelist',
      component: invoicelist
    },
    {
      path: '/invoice/:id',
      name: 'invoice',
      component: invoice
    },
    {
      path: '/quotation/:id',
      name: 'quotation',
      component: quotation
    },
    {
      path: '/settinglist',
      name: 'settinglist',
      component: settinglist
    },
    {
      path: '/setting/:id',
      name: 'setting',
      component: setting
    },
    /*{
      path: '/setting',
      name: 'setting',
      component: setting
    },*/
    {
      path: '/sale/:id',
      name: 'sale',
      component: sale
    },
    {
      path: '/salehistory',
      name: 'salehistory',
      component: salehistory
    },//salehistory
    {
      path: '/salehistorydetail/:id',
      name: 'salehistorydetail',
      component: salehistorydetail
    },
    {
      path: '/saleorder/:id',
      name: 'saleorder',
      component: saleorder
    },
    {
      path: '/saleorder/:id',
      name: 'saleorder2',
      component: saleorder,
      props: {
        payload: Object
      }
    },
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
      path: '/utility',
      name: 'utility',
      component: utility
    },
    {
      path: '/dp/:id',
      name: 'dp',
      component: dp
    },
    {
      path: '/sms',
      name: 'sms',
      component: sms
    },
    {
      path: '/quolist',
      name: 'quolist',
      component: quolist
    },
    {
      path: '/solist',
      name: 'solist',
      component: solist
    }
  ]
})
