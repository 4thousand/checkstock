import Vue from 'vue'
import axios from 'axios'
import Vueaxios from 'vue-axios'

Vue.use(Vueaxios, axios)

const URL = 'http://venus.nopadol.com'
const telURL = 'https://sheetdb.io'
const smsURL = 'https://api.apitel.co/sms'
const test = 'http://192.168.0.83:8080/v2/atm/auth'

export default {
    signin (user, pass, success, error) {
        Vue.axios.get(URL + ':9000/login?access_token=aaaa&usercode=' + user + '&password=' + pass + '&appid=1').then(
          (response) => {
            success(response.data)
          },
          (response) => {
            error(response)
          })
      },
    showdocall (payload, success, error) {
      Vue.axios.post(URL + ':8081/sales/v1/sale/doc/search', payload).then(
        (response) => {
          success(response.data)
        },
        (response) => {
          error(response)
        })
    },
    Customerall (payload, success, error) {
      Vue.axios.post(URL + ':8081/customer/v1/search/keyword', payload).then(
        (response) => {
          success(response.data)
        },
        (response) => {
          error(response)
        })
    },
    findCustomerID (payload, success, error){
      Vue.axios.post(URL + ':8081/customer/v1/search/id', payload).then(
        (response)=>{
          success(response.data)
        },
        (response)=>{
          error(response)
        }
      )
    },
    showdocno (payload, success, error) {
      console.log(JSON.stringify(payload))
      Vue.axios.post(URL + ':8081/gendocno/v1/gen', JSON.stringify(payload)).then(
        (response) => {
          console.log(response.data)
          success(response.data)
        },
        (response) => {
          error(response)
        })
    },
    searchbykeyword(payload, success, error) {
      console.log(JSON.stringify(payload))
      Vue.axios.post(URL + ':8081/product/v1/search/keyword', JSON.stringify(payload)).then(
        (response) => {
          success(response.data)
        },
        (response) => {
          error(response)
        })
    },
    searchcus(payload, success, error) {
      Vue.axios.post(URL + ':8081/employee/v1/search/keyword', JSON.stringify(payload)).then(
        (response) => {
          success(response.data)
        },
        (response) => {
          error(response)
        })
    },
    savequotation(payload, success, error) {
      Vue.axios.post(URL + ':8081/sales/v1/quo/new', JSON.stringify(payload)).then(
        (response) => {
          success(response.data)
        },
        (response) => {
          error(response)
        })
    },
    detailquoall(payload, success, error) {
      Vue.axios.post(URL + ':8081/sales/v1/quo/search/id', JSON.stringify(payload)).then(
        (response) => {
          success(response.data)
        },
        (response) => {
          error(response)
        })
    },
    searchdepartment(payload, success, error) {
      Vue.axios.post(URL + ':8081/env/v1/department/search/keyword', JSON.stringify(payload)).then(
        (response) => {
          success(response.data)
        },
        (response) => {
          error(response)
        })
    },
    searchproject(payload, success, error) {
      Vue.axios.post(URL + ':8081/env/v1/project/search/keyword', JSON.stringify(payload)).then(
        (response) => {
          success(response.data)
        },
        (response) => {
          error(response)
        })
    },
    searchAllocate(payload, success, error) {
      Vue.axios.post(URL + ':8081/env/v1/allocate/search/keyword', JSON.stringify(payload)).then(
        (response) => {
          success(response.data)
        },
        (response) => {
          error(response)
        })
    },
    searchunitcode(payload, success, error) {
      Vue.axios.post(URL + ':8081/product/v1/search/itemcode', JSON.stringify(payload)).then(
        (response) => {
          success(response.data)
        },
        (response) => {
          error(response)
        })
    },
    createdeposit(payload, success, error){
      Vue.axios.post(URL + ':8081/sales/v1/dep/new', JSON.stringify(payload)).then(
        (response) => {
          success(response.data)
        },
        (response) => {
          error(response)
        })
    },
    searchDepById(payload, success, error){
      Vue.axios.post(URL + ':8081/sales/v1/dep/search/id', JSON.stringify(payload)).then(
        (response) => {
          success(response.data)
        },
        (response) => {
          error(response)
        })
    },
    searchDepByKeyword(payload, success, error){
      Vue.axios.post(URL + ':8081/sales/v1/dep/search/keyword', JSON.stringify(payload)).then(
        (response) => {
          success(response.data)
        },
        (response) => {
          error(response)
        })
    },
    createsale(payload, success, error){
      Vue.axios.post(URL + ':8081/sales/v1/sale/new', JSON.stringify(payload)).then(
        (response) => {
          success(response.data)
        },
        (response) => {
          error(response)
        })
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
}