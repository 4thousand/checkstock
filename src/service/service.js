import Vue from 'vue'
import axios from 'axios'
import Vueaxios from 'vue-axios'

Vue.use(Vueaxios, axios)
const localhost = 'http://localhost:8079'
const URL = 'https://n9.nopadol.com/'
const npsysURL = 'https://sys.nopadol.com/'
const telURL = 'https://sheetdb.io'
const smsURL = 'https://api.apitel.co/sms'
const test = 'http://192.168.0.83:8080/v2/atm/auth'


export default {
  signin(user, pass, success, error) {
    Vue.axios.get(npsysURL + 'login?access_token=aaaa&usercode=' + user + '&password=' + pass + '&appid=1').then(
      (response) => {
        console.log(response.data)
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  showdocall(payload, success, error) {
    Vue.axios.post(URL + 'sales/v1/sale/doc/search', payload).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  Customerall(payload, success, error) {
    payload.keyword = payload.keyword.replace(" ", "%")
    Vue.axios.post(URL + 'customer/v1/search/keyword', payload).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  findCustomerID(payload, success, error) {
    Vue.axios.post(URL + 'customer/v1/search/id', payload).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      }
    )
  },
  showdocno(payload, success, error) {
    console.log(JSON.stringify(payload))
    Vue.axios.post(URL + 'gendocno/v1/gen', JSON.stringify(payload)).then(
      (response) => {
        console.log(response.data)
        success(response.data)
      },
      (response) => {
        error(response)
      })
  }, cancelinvoice(payload, success, error) {
    console.log(JSON.stringify(payload))


    Vue.axios.post(URL + 'sales/v1/inv/cancel', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  searchbykeyword(payload, success, error) {
    console.log(JSON.stringify(payload))
    payload.keyword = payload.keyword.replace(" ", "%")
    console.log(JSON.stringify(payload.keyword))
    Vue.axios.post(URL + 'product/v1/search/keyword', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })

  },
  searchcus(payload, success, error) {
    Vue.axios.post(URL + 'employee/v1/search/keyword', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  }, saveInvoice(payload, success, error) {
    Vue.axios.post(URL + 'sales/v1/inv/new', JSON.stringify(payload)).then(
      (response) => {
        console.log(JSON.stringify(response.data))
        console.log("บันทึก")
        success(response.data)

      },
      (response) => {
        error(response)
      })
  },
  savequotation(payload, success, error) {
    Vue.axios.post(URL + 'sales/v1/quo/new', JSON.stringify(payload)).then(
      (response) => {
        console.log(JSON.stringify(response.data))
        console.log("บันทึก")
        success(response.data)
      },
      (response) => {
        error(response)
      })
  }, searchinvoicelist(payload, success, error) {
    Vue.axios.post(URL + 'sales/v1/inv/list', payload).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  }, searchcreditcard(payload, success, error) {
    console.log(payload)
    Vue.axios.post(URL + 'sales/v1/search/creditcard', JSON.stringify(payload)).then(
      (response) => {
        console.log(JSON.stringify(response.data))
        console.log("บันทึก")
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  detailquoall(payload, success, error) {
    Vue.axios.post(URL + 'sales/v1/quo/search/id', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  detailsaleall(payload, success, error) {
    Vue.axios.post(URL + 'sales/v1/sale/search/id', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  searchQuotationByKeyword(payload, success, error) {
    Vue.axios.post(URL + 'sales/v1/quo/search/keyword', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  searchSaleOrderByKeyword(payload, success, error) {
    Vue.axios.post(URL + 'sales/v1/sale/search/keyword', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  detailinvall(payload, success, error) {
    Vue.axios.post(URL + 'sales/v1/inv/search/id', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  searchdepartment(payload, success, error) {
    payload.keyword = payload.keyword.replace(" ", "%")
    Vue.axios.post(URL + 'env/v1/department/search/keyword', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  searchproject(payload, success, error) {
    payload.keyword = payload.keyword.replace(" ", "%")
    Vue.axios.post(URL + 'env/v1/project/search/keyword', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  searchAllocate(payload, success, error) {
    payload.keyword = payload.keyword.replace(" ", "%")
    Vue.axios.post(URL + 'env/v1/allocate/search/keyword', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  searchunitcode(payload, success, error) {
    Vue.axios.post(URL + 'product/v1/search/itemcode', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  createdeposit(payload, success, error) {
    Vue.axios.post(URL + 'sales/v1/dep/new', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  searchDepById(payload, success, error) {
    Vue.axios.post(URL + 'sales/v1/dep/search/id', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  searchDepByKeyword(payload, success, error) {
    payload.keyword = payload.keyword.replace(" ", "%")
    Vue.axios.post(URL + 'sales/v1/dep/search/keyword', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  searchInvById(payload, success, error) {
    Vue.axios.post(URL + 'sales/v1/inv/search/id', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  searchInvByKeyword(payload, success, error) { //boss add
    payload.keyword = payload.keyword.replace(" ", "%")
    Vue.axios.post(URL + 'sales/v1/inv/search/keyword', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  SearchHisByKeyword(payload, success, error) { //boss add
    payload.keyword = payload.keyword.replace(" ", "%")
    Vue.axios.post(URL + 'sales/v1/his/search/keyword', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  searchSaleByItem(payload, success, error) { //boss add
    Vue.axios.post(URL + 'sales/v1/sale/search/item', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  searchHisCustomer(payload, success, error) { //boss add
    Vue.axios.post(URL + 'sales/v1/search/hiscustomer', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  showSetting(payload, success, error) { //boss add
    Vue.axios.post(URL + 'settingconfig/v1/config/search/id', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  createSetting(payload, success, error) { //boss add
    Vue.axios.post(URL + 'settingconfig/v1/config/new', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  searchSetByKeyword(payload, success, error) { //boss add
    payload.keyword = payload.keyword.replace(" ", "%")
    Vue.axios.post(URL + 'settingconfig/v1/config/search/keyword', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  searchReserveByKeyword(payload, success, error) {
    payload.keyword = payload.keyword.replace(" ", "%")
    Vue.axios.post(URL + 'sales/v1/dep/reserve/search', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  createsale(payload, success, error) {
    Vue.axios.post(URL + 'sales/v1/sale/new', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  },
  confirmQuotation(payload, success, error) {
    Vue.axios.post(URL + 'sales/v1/quo/confirm', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      }
    )
  },
  cancelQuotation(payload, success, error) {
    Vue.axios.post(URL + 'sales/v1/quo/cancel', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      }
    )
  },
  transferQTtoSO(payload, success, error) {
    Vue.axios.post(URL + 'sales/v1/quo/gen/saleorder', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      }
    )
  },
  callTel(success, error) {
    Vue.axios.get(telURL + '/api/v1/x6r5jxmu9otla').then(
      (response) => {
        console.log(response.data)
        success(response.data)
      },
      (response) => {
        error(response)
      }
    )
  },
  testCallTel(success, error) {
    Vue.axios.get(telURL + '/api/v1/e9cklwsj2nqwr').then(
      (response) => {
        console.log(response.data)
        success(response.data)
      },
      (response) => {
        error(response)
      }
    )
  },
  sendSMS(payload, success, error) {
    Vue.axios.post(smsURL, payload).then(
      (response) => {
        console.log(response.data)
        success(response.data)
      },
      (response) => {
        error(response)
      }
    )
  },
  tester(payload, success, error) {
    Vue.axios.post(test, payload).then(
      (response) => {
        console.log(response.data)
        success(response.data)
      },
      (response) => {
        error(response)
      }
    )
  }
  , callqrcode(data, success, error) {
    console.log("ส่ง JSON payment" + JSON.stringify(data))
    Vue.axios.post('https://test.paybox.work/v1/payment/qrpay/open', JSON.stringify(data), {
      headers: {
        'Content-Type': 'application/json',
        'x-access-token': '246aa13b23f64f67be1ab463de0dcb72',
      }
    },
    ).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  }, testcallapi(data, success, error) {
    data.id = 1000063
    console.log("ส่ง JSON payment" + JSON.stringify("https://test.paybox.work/item/v1/quickpay"))
    Vue.axios.post('https://test.paybox.work/item/v1/menu/items', JSON.stringify(data), {
      headers: {
        'Content-Type': 'application/json',
        'X-Access-Token': '942be569a799418c9b4249dc964e7930',
      }
    },
    ).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      })
  }, showstocklist(payload, success, error) {
    Vue.axios.post(localhost + '/npinven/v1/findstock', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      }
    )
  }
  , showstockbyItemCode(payload, success, error) {
    Vue.axios.post(localhost + '/npinven/v1/findstockid', JSON.stringify(payload)).then(
      (response) => {
        success(response.data)
      },
      (response) => {
        error(response)
      }
    )
  }
}
