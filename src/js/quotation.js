const toLower = text => {
  return text.toString().toLowerCase();
};

const searchByName = (items, term) => {
  if (term) {
    return items.filter(item => toLower(item.name).includes(toLower(term)));
  }
  return items;
};
import Datepicker from 'vuejs-datepicker';
import * as lang from "vuejs-datepicker/src/locale";
import api from "../service/service.js"

export default {
  name: "quotation",
  components: {
    Datepicker
  },
  data: () => ({
    msg: "",
    selectedDate: null,
    date: "",
    search: [],
    search: null,
    test: localStorage.test,
    dproducts: [
      {
        id: "1",
        barcode: "0000290",
        name: "พาเวอร์ปลั๊ก ตัวเมีย 3 ขา 16 A ต่อตรงกลาง HT-213 / PT-213",
        count: "อัน/อัน",
        amount: 0,
        price: 80.0,
        price2: 81.0,
        discount: 0,
        allprice: 0,
        because: "รับเอง"
      },
      {
        id: "2",
        barcode: "8852439012978",
        name: "คอบสันโค้งเซรามิค FLATO สีศิลเวอร์เกรย์",
        count: "แผ่น/แผ่น",
        amount: 0,
        price: 280.0,
        price2: 281.0,
        discount: 0,
        allprice: 0,
        because: "ส่งให้"
      },
      {
        id: "8852439013296",
        barcode: "8852439013296",
        name: "ครอบตะเข้ส้นเซรามิค FLATO สีซิลเวอร์เกรย์",
        count: "แผ่น/แผ่น",
        amount: 0,
        price: 280.0,
        price2: 281.0,
        discount: 0,
        allprice: 0,
        because: "รับเอง"
      },
      {
        id: "8852439013012",
        barcode: "8852439013012",
        name: "ครอบปิดปลายตะเข้สันเซรามิค FLATO สีซิลเวอร์เกรย์",
        count: "แผ่น/แผ่น",
        amount: 0,
        price: 310.0,
        price2: 315.0,
        discount: 0,
        allprice: 0,
        because: "รับเอง"
      },
      {
        id: "8852439007677",
        barcode: "8852439007677",
        name: "การเส้น EXCELLA",
        count: "กล่อง/กล่อง",
        amount: 0,
        price: 290.0,
        price2: 300.0,
        discount: 0,
        allprice: 0,
        because: "รับเอง"
      },
      {
        id: "88524390153597",
        barcode: "88524390153597",
        name: "แผ่นรองเชิงชายตราช้าง / Excella",
        count: "ม้วน/ม้วน",
        amount: 0,
        price: 350.0,
        price2: 360.0,
        discount: 0,
        allprice: 0,
        because: "รับเอง"
      },
      {
        id: "88524390155397",
        barcode: "88524390155397",
        name: "แผ่นรองเชิงชายตราช้าง / Excella",
        count: "ม้วน/ม้วน",
        amount: 0,
        price: 350.0,
        price2: 360.0,
        discount: 0,
        allprice: 0,
        because: "รับเอง"
      },
      {
        id: "8852439015597",
        barcode: "8852439015597",
        name: "แผ่นรองเชิงชายตราช้าง / Excella",
        count: "ม้วน/ม้วน",
        amount: 0,
        price: 350.0,
        price2: 360.0,
        discount: 0,
        allprice: 0,
        because: "รับเอง"
      },
      {
        id: "88524390154597",
        barcode: "88524390154597",
        name: "แผ่นรองเชิงชายตราช้าง / Excella",
        count: "ม้วน/ม้วน",
        amount: 0,
        price: 350.0,
        price2: 360.0,
        discount: 0,
        allprice: 0,
        because: "รับเอง"
      },
      {
        id: "88524390155597",
        barcode: "88524390155597",
        name: "แผ่นรองเชิงชายตราช้าง / Excella",
        count: "ม้วน/ม้วน",
        amount: 0,
        price: 350.0,
        price2: 360.0,
        discount: 0,
        allprice: 0,
        because: "รับเอง"
      },
      {
        id: "88524390115597",
        barcode: "88524390115597",
        name: "แผ่นรองเชิงชายตราช้าง / Excella",
        count: "ม้วน/ม้วน",
        amount: 0,
        price: 350.0,
        price2: 360.0,
        discount: 0,
        allprice: 0,
        because: "รับเอง"
      }
    ],
    active: 'first',
    first: false,
    second: false,
    third: false,
    secondStepError: null,
    language: "th",
    languages: lang,
    searchcus: '',
    detailcus: '',
    showDialogcus: false,
    detailcusall: [],
    tablecode: '',
    billtype: '',
    docno: 'ไม่มีข้อมูล',
    keywordproduct: '',
    showDialogproduct: false,
    dataproductDialog: [],
    disablebilltype: false
  }),
  methods: {
    test1234() {
      alert("12313");
    },
    newUser() {
      window.alert("Noop");
    },
    searchOnTable() {
      this.searched = searchByName(this.dproducts, this.search);
    },
    tests() {
      alert("ค้นหาข้อมูล Waiting ...");
    },
    setDone(id, index) {
      this[id] = true
      this.secondStepError = null
      if (index) {
        this.active = index
      }
      document.getElementsByClassName("md-content")[0].scrollTop = 0
    },
    fsearchcus() {
      var payload = {
        keyword: this.searchcus
      }

      api.Customerall(payload,
        (result) => {
          console.log(JSON.stringify(result.data))
          // console.log(result.data.length)
          if (result.data.length == 0) {
            alertify.error('ไม่มีข้อมูลลูกค้านี้');
            return
          }
          if (result.data.length == 1) {
            this.detailcus = result.data[0].name
            this.searchcus = result.data[0].code
          } else if (result.data.length > 1) {
            this.detailcusall = result.data
            this.showDialogcus = true
          }
        },
        (error) => {
          console.log(JSON.stringify(error))
          //Customerall
          alertify.error('Data ข้อมูลค้นหาลูกค้าผิดพลาด');
          //  alertify.success('Error login');
          // this.cload()
        })
    },
    C_customer(val) {
      this.searchcus = val.code
      this.detailcus = val.name
      this.showDialogcus = false
    },
    addproduct() {
      if (!this.keywordproduct) {
        return
      }
      let payload = {
        keyword: this.keywordproduct
      }
      api.searchbykeyword(payload,
        (result) => {
          console.log(result.data)
          console.log(result.data.length)
          this.showDialogproduct = true
          this.dataproductDialog = result.data
          console.log('billtype : ' + this.billtype)
        },
        (error) => {
          console.log(JSON.stringify(error))
          alertify.error('ข้อมูล สินค้าเกิดข้อผิดพลาด');
        })
    },
    showdocno() {

      if (!this.tablecode || !this.billtype) {
        return
      }

      let payload = {
        branch_id: 1,
        table_code: this.tablecode,
        bill_type: parseInt(this.billtype)
      }
      console.log(payload)
      api.showdocno(payload,
        (result) => {
          if (result.error) {
            this.docno = 'ไม่มีข้อมูล'
            return
          }
          this.docno = result
          this.disablebilltype = true
        },
        (error) => {
          console.log(JSON.stringify(error))
          //Customerall
          alertify.error('ข้อมูล ประเภทเสนอราคาเกิดข้อผิดพลาด');
          //  alertify.success('Error login');
          // this.cload()
        })

    },
    showdetail(val) {
      console.log(JSON.stringify(val))
      if (this.billtype == 0) {
        var datashow = {
          id: val.id,
          barcode: val.bar_code,
          name: val.item_name,
          count: val.unit_code,
          amount: 1,
          price: val.sale_price_1,
          price2: val.sale_price_2,
          discount: 0,
          allprice: val.sale_price_1 * 1,
          because: "ไม่มี"
        }
        this.dproducts.push(datashow)
        //close modal
        this.showDialogproduct = false
        alertify.success('เพิ่มข้อมูลสินค้า ' + val.item_name);
      } else if (this.billtype == 1) {
        var datashow = {
          id: val.id,
          barcode: val.bar_code,
          name: val.item_name,
          count: val.unit_code,
          amount: 1,
          price: val.sale_price_1,
          price2: val.sale_price_2,
          discount: 0,
          allprice: val.sale_price_2 * 1,
          because: "ไม่มี"
        }
        this.dproducts.push(datashow)
        //close modal
        this.showDialogproduct = false
        alertify.success('เพิ่มข้อมูลสินค้า ' + val.item_name);
      }
      //console.log(datashow)
    },
    calculatedata(val) {
      console.log(JSON.stringify(val))
      if (this.billtype == 0) {
        val.allprice = (val.amount * val.price) - val.discount
      } else if (this.billtype == 1) {
        val.allprice = (val.amount * val.price2) - val.discount
      }
    },
    convertmoney(val){
      console.log(val)
      var number = numeral(val).format('0,0.00');
      return number
    }
  },
  created() {
    this.searched = this.dproducts;
  },
  computed: {
    totalprice () {
      return this.dproducts.reduce(function(sum, item) {
        return (sum + item.allprice)
      }, 0)
    },
    firstDayOfAWeek: {
      get() {
        return this.$material.locale.firstDayOfAWeek;
      },
      set(val) {
        this.$material.locale.firstDayOfAWeek = val;
      }
    }
  },
  mounted() {

    // data:('3')
    // this.showdocno()
    console.log(localStorage.test)
    console.log(this.test)
    // this.$refs.testDiv.scrollTop = 0;
    // console.log(this.loading)
  }
};