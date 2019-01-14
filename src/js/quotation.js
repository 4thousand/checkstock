const toLower = text => {
  return text.toString().toLowerCase();
}

const searchByName = (items, term) => {
  if (term) {
    return items.filter(item => toLower(item.item_name).includes(toLower(term)) || toLower(item.unit_code).includes(toLower(term))  );
  }
  return items;
}

import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import Datepicker from 'vuejs-datepicker';
import * as lang from "vuejs-datepicker/src/locale";
import api from "../service/service.js"
// import * as jsPDF from 'jspdf'
import JQuery from 'jquery'
let $ = JQuery

export default {
  name: "quotation",
  components: {
    Datepicker,
    Loading
  },
  data: () => ({
    msg: "",
    selectedDate: null,
    date: "",
    search: [],
    search: '',
    objuser: JSON.parse(localStorage.Datauser),
    dproducts: [],
    active: 'first',
    first: false,
    second: false,
    third: false,
    secondStepError: null,
    language: "th",
    languages: lang,
    idcus: '',
    searchcus: '',
    detailcus: '',
    showDialogcus: false,
    detailcusall: [],
    tablecode: '',
    billtype: '',
    taxtype: 1,
    mockdocno:'',
    docno: 'ไม่มีข้อมูล',
    keywordproduct: '',
    showDialogproduct: false,
    dataproductDialog: [],
    disablebilltype: false,
    datenow_datepicker: Date.now(),
    attention: '',
    percal: false, //true == % , false == บาท
    caldiscount: 0,
    keywordemp: '',
    // page 2
    bill_credit: 0,
    DueDate_cal: '',
    Deliver_date: 0,
    DueDate_date: '',
    expire_date: 0,
    expiredate_cal: '',
    isshowdocument: false,
    docheight: '72px',
    searchsale: false,
    sale_id: JSON.parse(localStorage.userid),
    salecode: '',
    searchsaleobj: [],
    validity: 0,
    is_condition_send: 0,
    my_description: '',
    creator_by: '',
    branch_id: 0,
    docnoid: localStorage.iddocno,
    answer_cus: '',
    company_id: localStorage.company_id,
    php: 'http://' + document.domain,
    ar_bill_address:'',
    ar_telephone:'',
    department:'',
    searchdepart:false,
    objdepart:[],
    project:'',
    idprojectC:'',
    searchproject:false,
    objproject:[],
    Allocate:'',
    searchAllocate_m:false,
    objAllocate:[],
    Allocateid:'',
    searchunitcode_m:false,
    unitcode_obj:[],
    thisunticode:[],
    stockobj:[],
    namestock:'',
    stockall:[],
    isLoading: false,
    fullPage: true,
  }),
  methods: {
    checkval(val){
      console.log(val)
    },
    searchunticode(val){
      // console.log(index)
      // console.log(this.selectunitcode_step2())
      console.log(JSON.stringify(val))
      let payload = {
        item_code: val.item_code
      }
      this.isLoading = true
      // console.log(payload)
      api.searchunitcode(payload,
        (result) => {
          this.isLoading = false
          console.log(JSON.stringify(result.data))
          this.unitcode_obj = result.data
           this.searchunitcode_m = true
        },
        (error) => {
          this.isLoading = false
          console.log(JSON.stringify(error))
          alertify.error('Data ข้อมูล Unit code ผิดพลาด');
        })
    },
    selectunitcode_step2(val){
      console.log(JSON.stringify(val))
      this.searchunitcode_m = false
      var index = this.findWithAttr(this.dproducts, 'item_name', val.item_name)
          if(this.billtype == 0){//สด  
            this.dproducts[index].unit_code = val.unit_code
            this.dproducts[index].price = val.sale_price_1
            this.dproducts[index].packing_rate_1 = val.rate_1
            this.dproducts[index].item_amount = (this.dproducts[index].price * this.dproducts[index].qty)-this.dproducts[index].discount_word
          }
          if(this.billtype == 1){//เชื่อ
            this.dproducts[index].unit_code = val.unit_code
            this.dproducts[index].price = val.sale_price_2
            this.dproducts[index].packing_rate_1 = val.rate_1
            this.dproducts[index].item_amount = (this.dproducts[index].price * this.dproducts[index].qty)-this.dproducts[index].discount_word
          }
     
    },
     findWithAttr(array, attr, value) {
      for(var i = 0; i < array.length; i += 1) {
          if(array[i][attr] === value) {
              return i;
          }
      }
      return -1;
    },
    searchAllocate(){
      let payload = {
        keyword: this.Allocate
      }
      console.log(payload)
      this.isLoading = true
      api.searchAllocate(payload,
        (result) => {
          this.isLoading = false
          console.log(JSON.stringify(result.data))
          // console.log(result.data.length)
          if (result.data.length == 0) {
            alertify.error('ไม่มีการจัดสรร');
            return
          }
          if (result.data.length == 1) {
            this.Allocateid = result.data[0].id
            this.Allocate = result.data[0].name
            
          } else if (result.data.length > 1) {
            this.searchAllocate_m = true
            this.objAllocate = result.data
          }
        },
        (error) => {
          this.isLoading = false
          console.log(JSON.stringify(error))
          alertify.error('Data ข้อมูลการจัดสรรผิดพลาด');
        })
    },
    selectAllocate_step2(val){
      this.Allocateid = val.id
      this.Allocate = val.name
      this.searchAllocate_m = false
    },
    searchproject_step2(){
      let payload = {
        keyword: this.project
      }
      console.log(payload)
      this.isLoading = true
      api.searchproject(payload,
        (result) => {
          this.isLoading = false
          console.log(JSON.stringify(result.data))
          // console.log(result.data.length)
          if (result.data.length == 0) {
            alertify.error('ไม่มีโครงการนี้');
            return
          }
          if (result.data.length == 1) {
            this.project = result.data[0].code +' '+result.data[0].name
            this.idprojectC = result.data[0].id
          } else if (result.data.length > 1) {
            this.searchproject = true
            this.objproject = result.data
          }
        },
        (error) => {
          this.isLoading = false
          console.log(JSON.stringify(error))
          alertify.error('Data ข้อมูลโครงการผิดพลาด');
        })
    },
    selectproject_step2(val){
      // console.log(val)
      this.idprojectC = val.id
       this.project =  val.code+' '+val.name
       this.searchproject = false
    },
    searchdepart_step2(){
      let payload = {
        keyword: this.department
      }
      this.isLoading = true
      console.log(payload)
      api.searchdepartment(payload,
        (result) => {
          this.isLoading = false
          console.log(JSON.stringify(result.data))
          // console.log(result.data.length)
          if (result.data.length == 0) {
            alertify.error('ไม่มีแผนกนี้');
            return
          }
          if (result.data.length == 1) {
            this.iddepartment = result.data[0].id
            this.department = result.data[0].name
            
          } else if (result.data.length > 1) {
            this.searchdepart = true
            this.objdepart = result.data
          }
        },
        (error) => {
          this.isLoading = false
          console.log(JSON.stringify(error))
          alertify.error('Data ข้อมูลแผนกผิดพลาด');
        })
    },
    selectdepart_step2(val){
      this.iddepartment = val.id
      this.searchdepart = false
      this.department = val.name
    },
    isshowdoc_fuc() {
      if (!this.isshowdocument) {
        this.docheight = '72px'
      }
      if (this.isshowdocument) {
        this.docheight = '256px'
      }
    },
    calexpire_Date() {
      var date1 = new Date(this.expiredate_cal);
      this.expiredate_cal = (date1.getMonth() + 1) + '/' +  date1.getDate() + '/' +  date1.getFullYear()
      var date2 = new Date();
      var timeDiff = Math.abs(date2.getTime() - date1.getTime());
      var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
      this.expire_date = diffDays
    },
    calexpiredate() {
      console.log(this.expire_date)
      let date = new Date();
      date.setDate(date.getDate() + parseInt(this.expire_date));
      this.expiredate_cal = (date.getMonth() + 1) + '/' + date.getDate() + '/' + date.getFullYear();
    },
    calDueDate_date() {
      var date1 = new Date(this.DueDate_date); 
      this.DueDate_date =  (date1.getMonth() + 1) + '/' +  date1.getDate() + '/' +  date1.getFullYear()
      // alert(this.DueDate_date)
      var date2 = new Date();
      var timeDiff = Math.abs(date2.getTime() - date1.getTime());
      var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
      this.Deliver_date = diffDays
    },
    calDeliverdate() {
      let date = new Date();
      date.setDate(date.getDate() + parseInt(this.Deliver_date));
      this.DueDate_date = (date.getMonth() + 1) + '/' + date.getDate() + '/' + date.getFullYear();
      console.log(this.DueDate_date)
    },
    calbathordiscount() {
      // alert('dsad')
      console.log(this.percal)
      this.percal = !this.percal
    },
    // newUser() {
    //   this.$refs.addproduct.$el.focus()
    // },
    searchOnTable() {
      this.searched = searchByName(this.dproducts, this.search);
      console.log(this.searched)
    },
    tests() {
      alert("ค้นหาข้อมูล Waiting ...");
    },
    setDone(id, index) {
      if (id == 'third') {
        this.$router.push("/index");
        return
      }
      //
      this[id] = true
      this.secondStepError = null
      //

      if (index == 'third') { //บันทึก
        let doc_type
        let tax_type
        let percent
        let discount_amount

        if (this.tablecode == 'BO') {
          doc_type = 0
        } else if (this.tablecode == 'QT') {
          doc_type = 1
        }
        if (this.salecode) {
          var str = this.salecode;
          var res = str.split("/");
          // console.log(res)
          var sale_code = res[0]
          var sale_name = res[1]
        }

        // if (this.taxtype == 'ภาษีแยกนอก') {
        //   tax_type = 0
        // } else if (this.taxtype == 'ภาษีรวมใน') {
        //   tax_type = 1
        // } else if (this.taxtype == 'ภาษีอัตราศูนย์') {
        //   tax_type = 2
        // }

        if (this.percal) {
          percent = '%'
          discount_amount = this.totalprice - (this.totalprice - (this.totalprice * this.caldiscount / 100))
          //   alert('dsa')
        } else if (!this.percal) {
          percent = ''
          discount_amount = this.caldiscount
        }
        // console.log(this.datenow_datepicker)
        // console.log(this.docnoid)
        let payload = {
          id: parseInt(this.docnoid),// 0 แก้ไข,update ตามไอดี 
          branch_id: this.branch_id,
          doc_no: this.docno,
          //norecord
           ar_bill_address: this.ar_bill_address,
           ar_telephone: this.ar_telephone,
           datenow_datepicker: this.datenow_datepicker,
           dif_fee: this.dif_fee,
          //norecord
          doc_type,
          ar_id: this.idcus,
          ar_code: this.searchcus,
          ar_name: this.detailcus,
          sale_id: this.sale_id,
          sale_code,
          sale_name: sale_name.trim(),
          bill_type: parseInt(this.billtype),
          tax_type,
          tax_rate: 7,
          depart_code: '',
          ref_no: '',
          is_confirm: 0,
          bill_status: 0,
          credit_day: this.bill_credit,
          due_date: this.convermonth_y_m_d(this.DueDate_cal),
          validity: parseInt(this.validity),
          expire_credit: parseInt(this.expire_date),
          expire_date: this.convermonth_y_m_d(this.expiredate_cal),
          delivery_day: parseInt(this.Deliver_date),
          delivery_date: this.convermonth_y_m_d(this.DueDate_date),
          assert_status: 0,
          is_condition_send: parseInt(this.is_condition_send),
          my_description: this.my_description,
          sum_of_item_amount: this.totalprice,
          discount_word: this.caldiscount + percent,
          discount_amount: parseInt(discount_amount),
          after_discount_amount: this.totalprice - this.caldiscount,
          company_id: parseInt(this.company_id),
          //  before_tax_amount: '',
          assert_status: parseInt(this.answer_cus),
          depart_id: parseInt(this.iddepartment),
          project_id: parseInt(this.idprojectC),
          allocate_id: 0,
          is_cancel: 0,
          creator_by: this.creator_by,
          subs: this.dproducts
        }
        
        console.log(payload.subs.length)
        document.getElementsByName('dataquotation')[0].value = JSON.stringify(
          payload
        )
        
        document.getElementsByName('dataquotation')[1].value = JSON.stringify(
          payload
        )

        console.log(JSON.stringify(payload))
        api.savequotation(payload,
          (result) => {
            console.log(result)
           alertify.success('บันทึกสำเร็จ ' + this.docno);
         },
          (error) => {
            console.log(JSON.stringify(error))
            //Customerall
            alertify.error('เกิดข้อผิดพลาด');
         })
      }
      //บันทึก


      if (index) {
        this.active = index
      }
      document.getElementsByClassName("md-content")[0].scrollTop = 0
    },
    convermonth_y_m_d(val) {
      if (val == '') {
        return ''
      }
      var date = val;
      var cut = date.split("/");
      var result = cut[2] + '-' + cut[0] + '-' + cut[1];
      return result;
    },
    convertmonth_d_m_y(val) {
      var date = val.substring(0, 10);
      var cut = date.split("-");
      var result = cut[1] + '/' + cut[2] + '/' + cut[0];
      return result;
    },
    fsearchcus() {
      var payload = {
        keyword: this.searchcus
      }
      this.isLoading = true
      api.Customerall(payload,
        (result) => {
          this.isLoading = false
          console.log(JSON.stringify(result.data))
          // console.log(result.data.length)
          if (result.data.length == 0) {
            alertify.error('ไม่มีข้อมูลลูกค้านี้');
            return
          }
          if (result.data.length == 1) {
            this.idcus = result.data[0].id
            this.detailcus = result.data[0].name
            this.searchcus = result.data[0].code
          } else if (result.data.length > 1) {
            this.detailcusall = result.data
            this.showDialogcus = true

          }
        },
        (error) => {
          this.isLoading = false
          console.log(JSON.stringify(error))
          //Customerall
          alertify.error('Data ข้อมูลค้นหาลูกค้าผิดพลาด');
          //  alertify.success('Error login');
          // this.cload()
        })
    },
    C_customer(val) {
      console.log(JSON.stringify(val))
      this.idcus = val.id
      this.searchcus = val.code
      this.detailcus = val.name
      
      this.showDialogcus = false
      //bill_credit
      this.bill_credit = val.bill_credit
      // 
      var date = new Date();
      console.log(date)
      date.setDate(date.getDate() + this.bill_credit);
      this.DueDate_cal = (date.getMonth() + 1) + '/' + date.getDate() + '/' + date.getFullYear();
      console.log(this.DueDate_cal)
      this.$refs.addproduct.$el.focus()
      
    },
    addproduct() {
      console.log(this.keywordproduct)
      // alert(this.billtype)
      // alert('d')
      if (this.billtype === '' && this.billtype !== 0 && this.billtype !== 1) {
        if (this.attention == 'wobble-hor-bottom') {
          this.attention = 'wobble-hor-bottom2'
        } else {
          this.attention = 'wobble-hor-bottom'
        }
        return
      }

      if (!this.keywordproduct) {
        return
      }
      
      let payload = {
        keyword: this.keywordproduct
      }
      this.isLoading = true
      console.log(payload)
      api.searchbykeyword(payload,
        (result) => {
          this.isLoading = false
          console.log(result.data)
          console.log(result.data.length)
          this.showDialogproduct = true
          
          this.dataproductDialog = result.data
          this.stockall = result.data[0].stk_location
          console.log(this.stockall)
          console.log('billtype : ' + this.billtype)
          this.$refs.addproduct.$el.focus()
        },
        (error) => {
          this.isLoading = false
          console.log(JSON.stringify(error))
          alertify.error('ข้อมูล สินค้าเกิดข้อผิดพลาด');
        })
    },
    removeProduct(index){
      // console.log(JSON.stringify(this.dproducts.length))
      // this.searchProductInObject(this.dproducts,index)
      console.log(JSON.stringify(this.searchProductInObject(this.dproducts,index)))
      this.dproducts.splice(this.searchProductInObject(this.dproducts,index),1)

    },
    searchProductInObject(arraytosearch, valuetosearch) {
      for (var i = 0; i < arraytosearch.length; i++) {
        if (arraytosearch[i].index == valuetosearch) {
          return i;
        }
      }
      return null;
    },
    showdocno() {
      if (this.docnoid != 0) {
        // alert('หน้าแก้ไข')
        return
      }
      if (!this.tablecode || !this.billtype) {
        return
      }
 
      if(this.dproducts.length > 0 ){
      
      // var test;
      // for (let x = 0; x < this.dproducts.length; x++) {
      //   test +=  this.dproducts[x].bar_code
      // }
      // console.log(test)
      }

      this.disablebilltype = true
      let payload = {
        branch_id: this.objuser.branch_id,
        table_code: this.tablecode,
        bill_type: parseInt(this.billtype)
      }
      this.isLoading = true
      console.log(payload)
      api.showdocno(payload,
        (result) => {
          this.isLoading = false
          if (result.error) {
            this.docno = 'ไม่มีข้อมูล'
            return
          }
          this.mockdocno='';
          for(var i=0;i<(result.length-4);i++){
            this.mockdocno+=result.charAt(i);
          }
          this.mockdocno+="XXXX";
          this.docno = result

        },
        (error) => {
          this.isLoading = false
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
          item_id: val.id,
          item_code: val.item_code,
          bar_code: val.bar_code,
          item_name: val.item_name,
          unit_code: val.unit_code,
          qty: 1,
          price: val.sale_price_1,
          sale_price_1: val.sale_price_1,
          sale_price_2: val.sale_price_2,
          discount_word: '0',
          discount_amount: 0,
          item_amount: val.sale_price_1 * 1,
          item_description: "",
          packing_rate_1: parseInt(val.rate_1),
          is_cancel: 0
        }
        this.dproducts.push(datashow)
        //close modal
        this.showDialogproduct = false
        alertify.success('เพิ่มข้อมูลสินค้า ' + val.item_name);
      } else if (this.billtype == 1) {
        var datashow = {
          item_id: val.id,
          item_code: val.item_code,
          bar_code: val.bar_code,
          item_name: val.item_name,
          unit_code: val.unit_code,
          qty: 1,
          price: val.sale_price_2,
          sale_price_1: val.sale_price_1,
          sale_price_2: val.sale_price_2,
          discount_word: '0',
          discount_amount: 0,
          item_amount: val.sale_price_2 * 1,
          item_description: "",
          packing_rate_1: parseInt(val.rate_1),
          is_cancel: 0
        }
        this.dproducts.push(datashow)
        //close modal
        this.showDialogproduct = false
        alertify.success('เพิ่มข้อมูลสินค้า ' + val.item_name);
      }
      this.keywordproduct = ''

      //console.log(datashow)
    },
    calculatedata(val) {
      val.discount_word = val.discount_word.toString()
      console.log(val.discount_word)
  
      if(val.discount_word.search(",") < 0){
      if(val.discount_word.slice(-1) == '%'){
        var cutper = parseInt(val.discount_word.slice(0, -1))
        val.item_amount = val.qty*(val.price - (val.price * cutper)/100)
        val.discount_amount = (val.price * val.qty) - ((val.price - ((val.price * cutper)/100))*val.qty)
        console.log(val.discount_word) // ตัวอักษร
        console.log(val.discount_amount) // ส่วนต่าง
        return
      }else{
        val.discount_amount = (val.price * val.qty) - ((val.price - val.discount_word)*val.qty)
      }
      console.log(JSON.stringify(val))
      if (this.billtype == 0) {//เงินสด
        val.item_amount = val.qty * (val.price - val.discount_word)
      } else if (this.billtype == 1) {//เงินเชื่อ
        val.item_amount = val.qty * (val.price - val.discount_word)
      }
      console.log(val.discount_word) // ตัวอักษร
      console.log(val.discount_amount) // ส่วนต่าง
     }else if(val.discount_word.search(",") >= 0){
        var res = val.discount_word.split(",")
        if(res[0].slice(-1) == '%'){
          var cutper = parseInt(res[0].slice(0, -1))
          val.item_amount =  val.price - (val.price  * cutper)/100
          var diff1 =  (val.price  * cutper)/100
          console.log('diff1 : '+diff1)
        }else{
          var diff1 = val.price -(val.price - res[0])
          console.log(diff1)
          val.item_amount = val.price - res[0]
        }
        if(res[1].slice(-1) == '%'){
           let cutper1 = parseInt(res[1].slice(0, -1))
           val.item_amount = val.qty *(val.item_amount -( val.item_amount * cutper1)/100)
           var diff2 = ((val.price - diff1)*cutper1)/100
           console.log('diff2 : '+diff2)
           val.discount_amount = (diff1 + diff2)*val.qty
           console.log(val.discount_amount)
        }else{
          var diff2 = val.price -(val.price - res[1])
          val.discount_amount = (diff1 + diff2)*val.qty
          val.item_amount = (val.price * val.qty)- val.discount_amount
          console.log(val.discount_amount)
        }
        return
      }
    },
    getFocus(id) {
      document.getElementById(id).focus();
    },
    convertmoney(val) {
      // console.log(val)
      var number = numeral(val).format('0,0.00');
      return number
    },
    convertshowdoc(val) {
      if (val == false) {
        var comment = 'ปิด'
        return comment
      } else if (val == true) {
        var comment = 'เปิด'
        return comment
      }
    },
    showcontent_step2() {
      this.salecode = this.objuser.sale_code + ' / ' + this.objuser.username
    },
    searchsale_step2() {
      let payload = {
        keyword: this.salecode
      }
      this.isLoading = true
      console.log(payload)
      api.searchcus(payload,
        (result) => {
          this.isLoading = false
          console.log(JSON.stringify(result.data))
          // console.log(result.data.length)
          if (result.data.length == 0) {
            alertify.error('ไม่มีพนักงานคนนี้');
            return
          }
          if (result.data.length == 1) {
            this.salecode = result.data[0].sale_code + ' / ' + result.data[0].sale_name

          } else if (result.data.length > 1) {
            this.searchsale = true
            this.searchsaleobj = result.data
          }
        },
        (error) => {
          this.isLoading = false
          console.log(JSON.stringify(error))
          alertify.error('Data ข้อมูลค้นหาลูกค้าผิดพลาด');
        })
    },
    selectcus_step2(val) {
      console.log(JSON.stringify(val))
      this.sale_id = val.employee_id
      this.salecode = val.sale_code + ' / ' + val.sale_name
      this.searchsale = false
    },
    focussearchcus() {
      this.salecode = ''
      this.$refs.codesale.$el.focus()
    },
    showedit() {
      if (this.docnoid == 0) {
        // alert('หนักหลัก')
        return
      }
      // alert('แก้ไข')
      // แก้ไข 
      let payload = {
        id: parseInt(this.docnoid)
      }
      this.isLoading = true
      console.log(payload)
      api.detailquoall(payload,
        (result) => {
          this.isLoading = false
          console.log(JSON.stringify(result.data))
          console.log(result.data.bill_type)
          let doc_type
          let tax_type
          // let percent
          // let discount_amount

          if (result.data.doc_type == 0) {
            doc_type = 'BO'
          } else if (result.data.doc_type == 1) {
            doc_type = 'QT'
          }

          if (result.data.tax_type == 0) {
            tax_type = 'ภาษีแยกนอก'
          } else if (result.data.tax_type == 1) {
            tax_type = 'ภาษีรวมใน'
          } else if (result.data.tax_type == 2) {
            tax_type = 'ภาษีอัตราศูนย์'
          }
          // this.dproducts = []
          this.disablebilltype = true
          this.tablecode = doc_type
          this.billtype = result.data.bill_type
          console.log(this.billtype)
          this.ar_bill_address = result.data.ar_bill_address
          this.ar_telephone = result.data.ar_telephone
          this.docno = result.data.doc_no
          this.taxtype = tax_type
          this.datenow_datepicker = result.data.doc_date
          this.idcus = result.data.ar_id
          this.searchcus = result.data.ar_code
          this.detailcus = result.data.ar_name
          var datasubs = result.data.subs
          console.log(datasubs.length)
          for (let x = 0; x < datasubs.length; x++) {
            var data = {
              item_id: datasubs[x].id,
              item_code: datasubs[x].item_code,
              bar_code: datasubs[x].bar_code,
              item_name: datasubs[x].item_name,
              unit_code: datasubs[x].unit_code,
              qty: datasubs[x].qty,
              price: datasubs[x].price,
              discount_word: datasubs[x].discount_word,
              discount_amount: datasubs[x].discount_amount,
              item_amount: datasubs[x].item_amount,
              item_description: datasubs[x].item_description,
              packing_rate_1: datasubs[x].packing_rate_1,
              is_cancel: datasubs[x].is_cancel
            }
            this.dproducts.push(data)
          }
          this.salecode = result.data.sale_code.trim() + ' / ' + result.data.sale_name
          this.validity = result.data.validity
          this.expire_date = result.data.expire_credit
          this.caldiscount = result.data.discount_amount
          // console.log(this.expire_date)
          this.answer_cus = result.data.assert_status
          this.Deliver_date = result.data.delivery_day
          this.bill_credit = result.data.credit_day
          this.is_condition_send = result.data.is_condition_send
          this.expiredate_cal = this.convertmonth_d_m_y(result.data.expire_date)
          // console.log(this.expiredate_cal)
          this.DueDate_date = this.convertmonth_d_m_y(result.data.delivery_date)
          this.DueDate_cal = this.convertmonth_d_m_y(result.data.due_date)
          // console.log(this.DueDate_cal)
          this.my_description = result.data.my_description
          //  console.log(this.dproducts)
          console.log(JSON.stringify(result.data.subs))
        },
        (error) => {
          this.isLoading = false
          console.log(JSON.stringify(error))
          alertify.error('ข้อมูลผิดพลาด detailquoall');
        })

    },
    convertmonth_preview(val) {
      // console.log(val)
      // console.log(val.length)
      if (val.length === undefined) {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!

        var yyyy = today.getFullYear();
        if (dd < 10) {
          dd = '0' + dd;
        }
        if (mm < 10) {
          mm = '0' + mm;
        }
         today = yyyy + '-' + mm + '-' + dd;
         return today
      } else if (val.length != undefined) {
        return val.substring(0, 10)
      }
  },
  changePriceType(){
    for(var i=0;i<this.dproducts.length;i++){
      if(this.billtype==0){
        this.dproducts[i].price=this.dproducts[i].sale_price_1
        this.dproducts[i].item_amount=this.dproducts[i].sale_price_1
      }
      if(this.billtype==1){
        this.dproducts[i].price=this.dproducts[i].sale_price_2
        this.dproducts[i].item_amount=this.dproducts[i].sale_price_2
      }
      console.log(JSON.stringify(this.dproducts))
    }
  },
  changevaluetest(){
    this.tablecode = 'QT'
  },
  changevaluetest2(){
    this.tablecode = 'BO'
  },
  findstock(val,index){
 
      console.log(index)
      // console.log(this.stockall.length)
      // for (let i = 0; i < this.stockall.length ; i++) {
      //   if(index != i){
      //     console.log(index+':'+i)
      //   document.getElementsByClassName('hover'+i)[i].style.display = 'none';
      //   document.getElementsByClassName('hover'+i)[i].style.height = '0px';
      //  }
      // }

      for (let i = 0; i < this.stockall.length; i++) {
        document.getElementsByClassName('hover'+index)[i].style.visibility = 'visible';
        document.getElementsByClassName('hover'+index)[i].style.height = '20px';
      }
      return
        
    
    this.namestock = ''
    this.stockobj = []
    console.log(val.item_code)
    var payload = {
      item_code : val.item_code
     }
     this.isLoading = true
    api.searchunitcode(payload,
      (result) => {
        this.isLoading = false
        console.log(result)
        console.log(JSON.stringify(result.data))
        console.log(JSON.stringify(result.data.stock))
        this.namestock = result.data[0].item_name
        this.stockobj = result.data[0].stk_location
        console.log(result.data[0].stk_location.length)
      },
      (error) => {
        this.isLoading = false
        console.log(JSON.stringify(error))
        alertify.error('Data ข้อมูล ค้นหาคลัง ผิดพลาด');
      })
    // alert('ทดสอบ')
  }
  },
  created() {
    this.searched = this.dproducts;
  },
  computed: {
    keymap () {
      return {
        'ctrl+shift+1': this.changevaluetest,
        'ctrl+shift+2': this.changevaluetest2,
      }
    },
    totalprice() {
      return this.dproducts.reduce(function (sum, item) {
        return (sum + item.item_amount)
      }, 0)
    },
    dif_fee() {
      if (this.taxtype == 0 || this.taxtype == 1) {
        if (!this.percal) {
          return (this.totalprice - this.caldiscount) - (((this.totalprice - this.caldiscount) * 100) / 107)

        } else if (this.percal) {
          let percent = this.totalprice - (this.totalprice * this.caldiscount / 100)
          console.log(percent)
          return percent - ((percent * 100) / 107)
        }
      }
      if (this.taxtype == 2) {
        return 0
      }
    },
    cal_totalprice() {
      if (this.taxtype == 1) {
        if (!this.percal) {
          return this.totalprice - this.caldiscount
        }
        if (this.percal) {
          return this.totalprice - (this.totalprice * this.caldiscount / 100)
        }
      }
      if (this.taxtype == 0) {
        if (!this.percal) {
          return this.totalprice + this.dif_fee
        }
        if (this.percal) {
          return this.totalprice + this.dif_fee
        }
      }
      if (this.taxtype == 2) {
        if (!this.percal) {
          return this.totalprice
        }
        if (this.percal) {
          return this.totalprice
        }
      }
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
  mounted () {
    this.docnoid = this.$route.params.id
    // if (this.docnoid == 0) {
    //   // location.reload()
    // }
    this.showedit()
    this.creator_by = this.objuser.usercode
    this.branch_id = this.objuser.branch_id
    this.showcontent_step2()
    // console.log(this.objuser)
  }
};