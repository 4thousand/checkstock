<template>
  <div class="index" style="background: #f4f5f7;">
    <div class="container">
      <div class="col-12">
        <md-field>
          <md-tooltip md-direction="bottom">ค้นหาใบเสนอราคา ใบสั่งขาย Black Order</md-tooltip>
          <md-icon>search</md-icon>
          <label>ค้นหา</label>
          <md-input v-model="searched"></md-input>
        </md-field>
      </div>

      <!-- payloadreal -->
      <div v-for="(val,index) in listFilter" :key="index">
        <div
          class="col-12 showhover"
          style="cursor: pointer;margin-bottom:10px"
        >
          <md-toolbar
            id="responsiveheight"
            class="md-transparent hoverdiv"
            style="min-width:251px;display:block;padding-top:5px;overflow:hidden"
          >
            <div class="md-layout md-gutter md-alignment-center">
              <div
                class="md-layout-item md-xlarge-size-5 md-large-size-5 md-xsmall-size-15 md-small-size-10 md-medium-size-5"
              >
                <md-avatar
                  class="md-avatar-icon md-primary"
                  :class="'active'+val.module.substring(0, 1)"
                  style="margin:0;"
                >{{ val.module.substring(0, 1) }}</md-avatar>
              </div>

              <div
                class="md-layout-item md-xlarge-size-95 md-large-size-95 md-xsmall-size-85 md-small-size-90 md-medium-size-95"
              >
                <div class="row">
                  <div class="col-12">
                    <span class="md-title">{{val.doc_no}}</span>
                    <md-icon
                      v-show="val.is_confirm == 1"
                      style="float:right;color:green"
                    >check_circle_outline</md-icon>
                    <md-icon
                      v-show="val.is_confirm == 0"
                      style="float:right;color:yellow"
                    >warning</md-icon>
                    <md-icon v-show="val.is_cancel == 1" style="float:right;color:red;">cancel</md-icon>
                    <span
                      class="md-title datehover"
                      style="float:right;font-size: .875rem;color: #5f6368;float:right;margin-right:10px"
                    >{{val.doc_date.substring(0, 10)}}</span>
                  </div>
                  <div class="col-12">
                    <span
                      style="position: relative;left: 8px;font-size: .875rem;color: #5f6368;"
                      class="md-subheading"
                    >{{ 'รหัสลูกค้า : '+val.ar_code + ' ชื่อลูกค้า :' + val.ar_name + ' พนักงานขาย :' +val.sale_name +' รวมมูลค่าสินค้าทั้งหมด : '+convertToBaht(val.total_amount) +" บาท"}}</span>
                    <div
                      style="float:right;"
                      class="starhover"
                    >
                      <md-button @click="seedetail(val)" class="md-raised md-primary"><md-icon>edit</md-icon></md-button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </md-toolbar>
        </div>
      </div>
      <!-- ข้อมูลใบเสนอราคา -->
    </div>
    <md-speed-dial class="md-bottom-right">
      <md-speed-dial-target @click="goindex('/quotation')">
        <md-icon>add</md-icon>
      </md-speed-dial-target>
    </md-speed-dial>
  </div>
</template>
<script>
import api from "../../service/service.js";

export default {
  name: "quotation",
  data() {
    return {
      msg: "",
      star: true,
      Search: "",
      searched: "",
      sale_code: JSON.parse(localStorage.Datauser),
      dataall: [],
      keyword_showalldoc: "",

      //data to change confirmed document
      id:'',
      doc_no:'',
      doc_date:null,
      company_id:'',
      branch_id:'',
      doc_type:'',
      ar_id:'',
      ar_code:'',
      ar_name:'',
      ar_bill_address:'',
      ar_telephone:'',
      sale_id:'',
      sale_code:'',
      sale_name:'',
      bill_type:'',
      tax_type:'',
      tax_rate:'',
      depart_id:'',
      ref_no:'',
      job_id:'',
      is_confirm:'',
      bill_status:'',
      validity:'',
      credit_day:'',
      due_date:'',
      expire_credit:'',
      expire_date:'',
      delivery_day:'',
      delivery_date:'',
      assert_status:'',
      is_condition_send:'',
      my_description:'',
      sum_of_item_amount:'',
      discount_word:'',
      discount_amount:'',
      after_discount_amount:'',
      before_tax_amount:'',
      tax_amount:'',
      total_amount:'',
      net_debt_amount:'',
      project_id:'',
      allocate_id:'',
      is_cancel:'',
      creator_by:'',
      create_time:'',
      edit_by:'',
      edit_time:'',
      cancel_by:'',
      cancel_time:'',
      subs:[]
    };
  },
  computed: {
    listFilter() {
        return this.dataall.filter(post => {
        if (post.doc_no.toLowerCase().includes(this.searched.toLowerCase())) {
          return post.doc_no
            .toLowerCase()
            .includes(this.searched.toLowerCase());
        } else if (
          post.ar_code.toLowerCase().includes(this.searched.toLowerCase())
        ) {
          return post.ar_code
            .toLowerCase()
            .includes(this.searched.toLowerCase());
          sale_name;
        } else if (
          post.ar_name.toLowerCase().includes(this.searched.toLowerCase())
        ) {
          return post.ar_name
            .toLowerCase()
            .includes(this.searched.toLowerCase());
        } else if (
          post.sale_name.toLowerCase().includes(this.searched.toLowerCase())
        ) {
          return post.sale_name
            .toLowerCase()
            .includes(this.searched.toLowerCase());
        }
      });
    }
  },
  methods: {
    convertToBaht(val) {
      var result = numeral(val).format("0,0.00");
      return result;
    },
    goindex(val) {
      this.showNavigation = false;

      if (val == "/quotation") {
        this.$router.push({ name: "quotation", params: { id: 0 } });
        return;
      }

      this.$router.push(val);
    },
    seedetail(val) {
      console.log(JSON.stringify(val));

      this.$router.push({ name: "quotation", params: { id: val.id } });
    },
    showalldoc() {
      var payload = {
        sale_code: this.sale_code.sale_code,
        keyword: this.keyword_showalldoc
      };
      // v
      console.log(JSON.stringify(payload));
      api.showdocall(
        payload,
        result => {
          for (var i = 0; i < result.data.length; i++) {
            if (result.data[i].module == "BackOrder"||result.data[i].module == "Quotation") {
              this.dataall.push(result.data[i]);
            }
          }
          console.log(JSON.stringify(this.dataall));
        },
        error => {
          console.log(JSON.stringify(error));
          alertify.error("Data ข้อมูลผิดพลาด");
          //  alertify.success('Error login');
          // this.cload()
        }
      );
    },
    pullAppeoved(val) {
      
      let payload1 ={
        id: parseInt(val.id)
      }
      console.log(JSON.stringify(payload1))
      api.detailquoall(payload1,
        (result) => {
          console.log(JSON.stringify(result.data))
          alertify.success('บันทึกสำเร็จ');
          this.id=result.data.id,
          this.doc_no=result.data.doc_no,
          this.doc_date=result.data.doc_date,
          this.company_id=result.data.company_id,
          this.branch_id=result.data.branch_id,
          this.doc_type=result.data.doc_type,
          this.ar_id=result.data.ar_id,
          this.ar_code=result.data.ar_code,
          this.ar_name=result.data.ar_name,
          this.ar_bill_address=result.data.ar_bill_address,
          this.ar_telephone=result.data.ar_telephone,
          this.sale_id=result.data.sale_id,
          this.sale_code=result.data.sale_code,
          this.sale_name=result.data.sale_name,
          this.bill_type=result.data.billtype,
          this.tax_type=result.data.tax_type,
          this.tax_rate=result.data.tax_rate,
          this.depart_id=result.data.depart_id,
          this.ref_no=result.data.ref_no,
          this.job_id=result.data.job_id,
          this.is_confirm=result.data.is_confirm,
          this.bill_status=result.data.bill_status,
          this.validity=result.data.validity,
          this.credit_day=result.data.credit_day,
          this.due_date=result.data.due_date,
          this.expire_credit=result.data.expire_credit,
          this.expire_date=result.data.expire_date,
          this.delivery_day=result.data.delivery_day,
          this.delivery_date=result.data.delivery_date,
          this.assert_status=result.data.assert_status,
          this.is_condition_send=result.data.is_condition_send,
          this.my_description=result.data.my_description,
          this.sum_of_item_amount=result.data.sum_of_item_amount,
          this.discount_amount=result.data.discount_amount,
          this.after_discount_amount=result.data.after_discount_amount,
          this.before_tax_amount=result.data.before_tax_amount,
          this.tax_amount=result.data.tax_amount,
          this.total_amount=result.data.total_amount,
          this.net_debt_amount=result.data.net_debt_amount,
          this.project_id=result.data.project_id,
          this.allocate_id=result.data.allocate_id,
          this.is_cancel=result.data.is_cancel,
          this.creator_by=result.data.creator_by,
          this.create_time=result.data.create_time,
          this.edit_by=result.data.edit_by,
          this.edit_time=result.data.edit_time,
          this.cancel_by=result.data.cancel_by,
          this.cancel_time=result.data.cancel_time,
          this.subs=result.data.subs
        },
        (error) => {
          console.log(JSON.stringify(error))
          alertify.error('เกิดข้อผิดพลาด');
        }
      )
    },
    appeovedStatus() {
      if(this.is_confirm==0){
        this.is_confirm=1
      }
      else if(this.is_confirm==1){
        this.is_confirm=0
      }
        let payload = {
          id: parseInt(this.id),// 0 แก้ไข,update ตามไอดี 
          doc_no:this.doc_no,
          doc_date:this.doc_date,
          company_id:parseInt(this.company_id),
          branch_id:parseInt(this.branch_id),
          doc_type:parseInt(this.doc_type),
          ar_id:parseInt(this.ar_id),
          ar_code:this.ar_code,
          ar_name:this.ar_name,
          ar_bill_address:this.ar_bill_address,
          ar_telephone:this.ar_telephone,
          sale_id:parseInt(this.sale_id),
          sale_code:this.sale_code,
          sale_name:this.sale_name,
          bill_type:this.billtype,
          tax_type:parseInt(this.tax_type),
          tax_rate:parseInt(this.tax_rate),
          depart_id:parseInt(this.depart_id),
          ref_no:this.ref_no,
          job_id:this.job_id,
          is_confirm:parseInt(this.is_confirm),
          bill_status:parseInt(this.bill_status),
          validity:parseInt(this.validity),
          credit_day:parseInt(this.credit_day),
          due_date:this.due_date,
          expire_credit:parseInt(this.expire_credit),
          expire_date:this.expire_date,
          delivery_day:parseInt(this.delivery_day),
          delivery_date:this.delivery_date,
          assert_status:parseInt(this.assert_status),
          is_condition_send:parseInt(this.is_condition_send),
          my_description:this.my_description,
          sum_of_item_amount:parseInt(this.sum_of_item_amount),
          discount_amount:parseInt(this.discount_amount),
          after_discount_amount:parseInt(this.after_discount_amount),
          before_tax_amount:parseInt(this.before_tax_amount),
          tax_amount:parseInt(this.tax_amount),
          total_amount:parseInt(this.total_amount),
          net_debt_amount:parseInt(this.net_debt_amount),
          project_id:parseInt(this.project_id),
          allocate_id:parseInt(this.allocate_id),
          is_cancel:parseInt(this.is_cancel),
          creator_by:this.creator_by,
          create_time:this.create_time,
          edit_by:this.edit_by,
          edit_time:this.edit_time,
          cancel_by:this.cancel_by,
          cancel_time:this.cancel_time,
          subs: this.subs
        }

        console.log(JSON.stringify(payload))
        api.savequotation(payload,
          (result) => {
            alertify.success('บันทึกสำเร็จ');
          },
          (error) => {
            console.log(JSON.stringify(error))
            alertify.error('เกิดข้อผิดพลาด');
          })
    },
  },
  mounted() {
    this.showalldoc();
  }
};
</script>
<style >
</style>
