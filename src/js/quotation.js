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
    search: '',
    objuser: JSON.parse(localStorage.Datauser),
    dproducts: [
      // {
      //   id: "1",
      //   barcode: "0000290",
      //   name: "พาเวอร์ปลั๊ก ตัวเมีย 3 ขา 16 A ต่อตรงกลาง HT-213 / PT-213",
      //   count: "อัน/อัน",
      //   amount: 0,
      //   price: 80.0,
      //   price2: 81.0,
      //   discount: 0,
      //   allprice: 0,
      //   because: "รับเอง"
      // },
      // {
      //   id: "2",
      //   barcode: "8852439012978",
      //   name: "คอบสันโค้งเซรามิค FLATO สีศิลเวอร์เกรย์",
      //   count: "แผ่น/แผ่น",
      //   amount: 0,
      //   price: 280.0,
      //   price2: 281.0,
      //   discount: 0,
      //   allprice: 0,
      //   because: "ส่งให้"
      // },
      // {
      //   id: "8852439013296",
      //   barcode: "8852439013296",
      //   name: "ครอบตะเข้ส้นเซรามิค FLATO สีซิลเวอร์เกรย์",
      //   count: "แผ่น/แผ่น",
      //   amount: 0,
      //   price: 280.0,
      //   price2: 281.0,
      //   discount: 0,
      //   allprice: 0,
      //   because: "รับเอง"
      // },
      // {
      //   id: "8852439013012",
      //   barcode: "8852439013012",
      //   name: "ครอบปิดปลายตะเข้สันเซรามิค FLATO สีซิลเวอร์เกรย์",
      //   count: "แผ่น/แผ่น",
      //   amount: 0,
      //   price: 310.0,
      //   price2: 315.0,
      //   discount: 0,
      //   allprice: 0,
      //   because: "รับเอง"
      // },
      // {
      //   id: "8852439007677",
      //   barcode: "8852439007677",
      //   name: "การเส้น EXCELLA",
      //   count: "กล่อง/กล่อง",
      //   amount: 0,
      //   price: 290.0,
      //   price2: 300.0,
      //   discount: 0,
      //   allprice: 0,
      //   because: "รับเอง"
      // },
      // {
      //   id: "88524390153597",
      //   barcode: "88524390153597",
      //   name: "แผ่นรองเชิงชายตราช้าง / Excella",
      //   count: "ม้วน/ม้วน",
      //   amount: 0,
      //   price: 350.0,
      //   price2: 360.0,
      //   discount: 0,
      //   allprice: 0,
      //   because: "รับเอง"
      // },
      // {
      //   id: "88524390155397",
      //   barcode: "88524390155397",
      //   name: "แผ่นรองเชิงชายตราช้าง / Excella",
      //   count: "ม้วน/ม้วน",
      //   amount: 0,
      //   price: 350.0,
      //   price2: 360.0,
      //   discount: 0,
      //   allprice: 0,
      //   because: "รับเอง"
      // },
      // {
      //   id: "8852439015597",
      //   barcode: "8852439015597",
      //   name: "แผ่นรองเชิงชายตราช้าง / Excella",
      //   count: "ม้วน/ม้วน",
      //   amount: 0,
      //   price: 350.0,
      //   price2: 360.0,
      //   discount: 0,
      //   allprice: 0,
      //   because: "รับเอง"
      // },
      // {
      //   id: "88524390154597",
      //   barcode: "88524390154597",
      //   name: "แผ่นรองเชิงชายตราช้าง / Excella",
      //   count: "ม้วน/ม้วน",
      //   amount: 0,
      //   price: 350.0,
      //   price2: 360.0,
      //   discount: 0,
      //   allprice: 0,
      //   because: "รับเอง"
      // },
      // {
      //   id: "88524390155597",
      //   barcode: "88524390155597",
      //   name: "แผ่นรองเชิงชายตราช้าง / Excella",
      //   count: "ม้วน/ม้วน",
      //   amount: 0,
      //   price: 350.0,
      //   price2: 360.0,
      //   discount: 0,
      //   allprice: 0,
      //   because: "รับเอง"
      // },
      // {
      //   id: "88524390115597",
      //   barcode: "88524390115597",
      //   name: "แผ่นรองเชิงชายตราช้าง / Excella",
      //   count: "ม้วน/ม้วน",
      //   amount: 0,
      //   price: 350.0,
      //   price2: 360.0,
      //   discount: 0,
      //   allprice: 0,
      //   because: "รับเอง"
      // }
    ],
    active: 'first',
    first: false,
    second: false,
    third: false,
    secondStepError: null,
    language: "th",
    languages: lang,
    idcus:'',
    searchcus: '',
    detailcus: '',
    showDialogcus: false,
    detailcusall: [],
    tablecode: '',
    billtype: '',
    taxtype:'',
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
    expire_date:0,
    expiredate_cal:'',
    isshowdocument:false,
    docheight:'72px',
    searchsale:false,
    sale_id: JSON.parse(localStorage.userid),
    salecode:'',
    searchsaleobj:[],
    validity:'',
    is_condition_send:'',
    my_description:'',
    creator_by: '',
  }),
  methods: {
    isshowdoc_fuc(){
      if(!this.isshowdocument){
        this.docheight = '72px'
      }
      if(this.isshowdocument){
        this.docheight = 'auto'
      }
      
    },
    calexpire_Date(){
      var date1 = new Date(this.expiredate_cal);
      var date2 = new Date();
      var timeDiff = Math.abs(date2.getTime() - date1.getTime());
      var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
      this.expire_date = diffDays
    },
    calexpiredate(){
      console.log(this.expire_date)
      let date = new Date();
      date.setDate(date.getDate() + parseInt(this.expire_date));
      this.expiredate_cal = (date.getMonth() + 1) + '/' + date.getDate() + '/' + date.getFullYear();
    },
    calDueDate_date() {
      var date1 = new Date(this.DueDate_date);
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
    newUser() {
      this.$refs.addproduct.$el.focus()
    },
    searchOnTable() {
      this.searched = searchByName(this.dproducts, this.search);
    },
    tests() {
      alert("ค้นหาข้อมูล Waiting ...");
    },
    setDone(id, index) {
      //
      this[id] = true
      this.secondStepError = null
      //
      if(index == 'third') { //บันทึก
          let doc_type
          let tax_type
          let percent
          let discount_amount

          if(this.tablecode == 'BO'){
            doc_type = 0 
          }else if(this.tablecode == 'QT'){
            doc_type = 1
          }
          if(this.salecode){
            var str = this.salecode;
            var res = str.split("/");
            // console.log(res)
            var sale_code = res[0]
            var sale_name = res[1]
          }
          if(this.taxtype == 'ภาษีแยกนอก'){
            tax_type = 0
          }else if(this.taxtype == 'ภาษีรวมใน'){
            tax_type = 1
          }else if(this.taxtype == 'ภาษีอัตราศูนย์'){
            tax_type = 2
          }

          if(this.percal == true){
            percent = '%'
            discount_amount = this.totalprice - this.cal_totalprice
          }else{
            percent = ''
            discount_amount = this.caldiscount
          }

        let payload = {
          doc_no : this.docno,
          doc_type,
          ar_id:this.idcus,
          ar_code:this.searchcus,
          ar_name:this.detailcus,
          sale_id:this.sale_id,
          sale_code,
          sale_name,
          bill_type:parseInt(this.billtype),
          tax_type,
          tax_rate:7,
          depart_code:'',
          ref_no:'',
          is_confirm:0,
          bill_status:0,
          credit_day: this.bill_credit,
          due_date: this.convermonth_y_m_d(this.DueDate_cal),
          validity: parseInt(this.validity),
          expire_day: parseInt(this.expire_date),
          expire_date:this.convermonth_y_m_d(this.expiredate_cal),
          delivery_day: parseInt(this.Deliver_date),
          delivery_date:this.convermonth_y_m_d(this.DueDate_date),
          assert_status:0,
          is_condition_send:parseInt(this.is_condition_send),
          my_description:this.my_description,
          sum_of_item_amount:parseInt(this.totalprice),
          discount_word:this.caldiscount+percent,
          discount_amount,
          // after_discount_amount:'',
          before_tax_amount: this.totalprice - this.caldiscount,
          project_id:0,
          allocate_id:0,
          is_cancel:0,
          creator_by:this.creator_by,
          subs:this.dproducts
        }
        console.log(JSON.stringify(payload))
        api.savequotation(payload,
          (result) => {
            console.log(result)
            alertify.success('บันทึกสำเร็จ ' + this.docno);
          },
          (error) => {
            console.log(JSON.stringify(error))
            //Customerall
            alertify.error('Data ข้อมูลค้นหาลูกค้าผิดพลาด');
            //  alertify.success('Error login');
            // this.cload()
          })
        // console.log(JSON.stringify(payload))
      }
      //บันทึก


      if (index) {
        this.active = index
      }
      document.getElementsByClassName("md-content")[0].scrollTop = 0
    },
    convermonth_y_m_d(val){
      var date = val;
      var cut = date.split("/");
      var result = cut[2]+'-'+cut[0]+'-'+cut[1];
      return result;
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
    },
    addproduct() {
      if (this.billtype == '') {
        if (this.attention == 'wobble-hor-bottom') {
          this.attention = 'wobble-hor-bottom2'
        } else {
          this.attention = 'wobble-hor-bottom'
        }
        // this.$refs.focustype.$el.focus()
        // console.log(this.attention)
        return
      }

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
      if (this.billtype) {
        this.disablebilltype = true
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
          item_id: val.id,
          bar_code: val.bar_code,
          item_name: val.item_name,
          unit_code: val.unit_code,
          qty: 1,
          price: val.sale_price_1,
          discount_word:'',
          discount_amount: 0,
          item_amount: val.sale_price_1 * 1,
          item_description: "ไม่มี",
          packing_rate_1:1,
          is_cancel:0
        }
        this.dproducts.push(datashow)
        //close modal
        this.showDialogproduct = false
        alertify.success('เพิ่มข้อมูลสินค้า ' + val.item_name);
      } else if (this.billtype == 1) {
        var datashow = {
          item_id : val.id,
          bar_code: val.bar_code,
          item_name: val.item_name,
          unit_code: val.unit_code,
          qty: 1,
          price: val.sale_price_2,
          discount_word:'',
          discount_amount: 0,
          item_amount: val.sale_price_2 * 1,
          item_description: "ไม่มี",
          packing_rate_1:1,
          is_cancel:0
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
        val.item_amount = (val.qty * val.price) - val.discount_amount
      } else if (this.billtype == 1) {
        val.item_amount = (val.qty * val.price) - val.discount_amount
      }
    },
    convertmoney(val) {
      // console.log(val)
      var number = numeral(val).format('0,0.00');
      return number
    },
    convertshowdoc(val){
      if(val == false){
        var comment = 'ปิด'
        return comment
      }else if(val == true){
        var comment = 'เปิด'
        return comment
      }
    },
    showcontent_step2() {
      this.salecode = this.objuser.sale_code + ' / ' + this.objuser.username
    },
    searchsale_step2(){
      let payload = {
        keyword: this.salecode
      }
      console.log(payload)
      api.searchcus(payload,
        (result) => {
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
          console.log(JSON.stringify(error))
          alertify.error('Data ข้อมูลค้นหาลูกค้าผิดพลาด');
        })
    },
    selectcus_step2(val){
      console.log(JSON.stringify(val))
      this.sale_id = val.employee_id
      this.salecode = val.sale_code + ' / ' + val.sale_name
      this.searchsale = false
    },
    focussearchcus(){
      this.salecode = ''
      this.$refs.codesale.$el.focus()
    },
  },
  created() {
    this.searched = this.dproducts;
  },
  computed: {
    totalprice() {
      return this.dproducts.reduce(function (sum, item) {
        return (sum + item.item_amount)
      }, 0)
    },
    dif_fee() {
      if(this.taxtype == 'ภาษีแยกนอก' || this.taxtype == 'ภาษีรวมใน'){
      if (!this.percal) {
        return (this.totalprice - this.caldiscount) - (((this.totalprice - this.caldiscount) * 100) / 107)

      } else if (this.percal) {
        let percent = this.totalprice - (this.totalprice * this.caldiscount / 100)
        console.log(percent)
        return percent - ((percent * 100) / 107)
      }
    }
    if(this.taxtype == 'ภาษีอัตราศูนย์'){
      return 0
    }
    },
    cal_totalprice() {
    if(this.taxtype == 'ภาษีรวมใน'){
      if (!this.percal) {
        return this.totalprice - this.caldiscount
      }
      if (this.percal) {
        return this.totalprice - (this.totalprice * this.caldiscount / 100)
      }
    }
    if(this.taxtype == 'ภาษีแยกนอก'){
      if (!this.percal) {
        return this.totalprice + this.dif_fee
      }
      if (this.percal) {
        return this.totalprice + this.dif_fee
      }
    }
    if(this.taxtype == 'ภาษีอัตราศูนย์'){
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
  mounted() {
     this.creator_by =  this.objuser.usercode
    this.showcontent_step2()
    console.log(this.objuser)
    // data:('3')
    // this.showdocno()
    // console.log(localStorage.test)
    // console.log(this.salecode)
    // console.log(JSON.stringify(this.test.sale_code))
    // this.$refs.testDiv.scrollTop = 0;
    // console.log(this.loading)
  }
};