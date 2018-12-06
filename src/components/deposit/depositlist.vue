<template>
    <div>
      <div class="container">
        <div class="col-12">
          <md-field>
            <md-tooltip md-direction="bottom">ค้นหาใบรับเงินมัดจำ</md-tooltip>
            <md-icon>search</md-icon>
            <label>ค้นหา</label>
            <md-input @keyup.enter="searchDepApi" v-model="searchDepositDoc"></md-input>
          </md-field>
        </div>

        <div v-for="val in deplist">
          <div @click="checkval" class="col-12 showhover" style="cursor: pointer;margin-bottom:10px">
            <md-toolbar id="responsiveheight" class="md-transparent hoverdiv" style="display:block;padding-top:5px;padding-bottom:5px;overflow:hidden">
              <div class="row">
                <div class="col-2 col-md-1">
                  <md-avatar style="margin-top:12px" class="md-avatar-icon md-primary">D</md-avatar>
                </div>
                <div class="col-10 col-md-11">
                    <div class="row">
                      <div class="col-8 col-md-8">
                        <span class="bl-title">{{val.doc_no}}</span>
                      </div>
                      <div class="col-4 col-md-4 md-xsmall-hide">
                        <span class="dateOfDep">{{val.doc_date.substring(0, 10)}}</span>
                      </div>
                      <div class="col-12 col-md-12 md-small-hide">
                        <span style="position: relative;font-size: .875rem;color: #5f6368;" class="md-subheading">
                        {{ 'รหัสลูกค้า : '+val.ar_code + ' ชื่อลูกค้า :' + val.ar_name }}
                        </span>
                      </div>
                      <div class="col-12 col-md-12 ">
                        <span style="position: relative;font-size: .875rem;color: #5f6368;" class="md-subheading">
                        {{ ' พนักงานขาย :' +val.sale_name +' รวมมูลค่ารวมภาษี : '+convertToBaht(val.total_amount) +" บาท"}}
                        </span>
                      </div>
                    </div>
                </div>
              </div>
            </md-toolbar>
          </div>
        </div>

        <md-speed-dial class="md-bottom-right">
          <md-speed-dial-target @click="goindex('/prototype')">
            <md-icon>add</md-icon>
          </md-speed-dial-target>
        </md-speed-dial>

      </div>
    </div>
</template>
<script>
import api from "../../service/service.js";
 export default {
   data(){
      return{
        msg:'',
        searchDepositDoc:'',
        deplist:[]
      }
     
   },
  methods:{
    goindex(val) {
      // localStorage.iddocno = 0

      if (val == "/deposit") {
        this.$router.push({ name: "deposit"});
        return;
      }

      if (val == "/prototype") {
        this.$router.push({ name: "prototype"});
        return;
      }

    },
    checkval(){
      JSON.stringify(this.deplist)
    },
    convertToBaht(val) {
      var result = numeral(val).format("0,0.00");
      // console.log(typeof result)
      return result;
    },
    searchDepApi(){
      var payload = {
        keyword: parseInt(this.searchDepositDoc)
      };

      console.log(JSON.stringify(payload))
      api.searchDepByKeyword(payload,
        (result)=>{
          this.deplist=result.data
          console.log(JSON.stringify(result))
        },
        (error)=>{
          console.log(JSON.stringify(error))
          alertify.error('Data ข้อมูลผิดพลาด');
        }
      );
    },
  },
  
  mounted(){
   this.searchDepApi()
  }
 }
</script>
<style>

  .container {
    padding: 5px 0;
  }
  
  
  .md-app {
    max-height: 400px;
    border: 1px solid rgba(#000, .12);
  }
  
  .md-drawer {
    width: 230px;
    max-width: calc(100vw - 125px);
  }

  .bl-title{
    font-size: 16px
  }
  
  span {
    font-family: 'Kanit', sans-serif !important;
  }
  
  .datehover,
  .starhover {
    visibility: hidden;
    opacity: 0;
    transition: all 0.5s;
  }
  
  .showhover:hover .datehover,
  .showhover:hover .starhover {
    opacity: 1;
    visibility: visible;
  }
  
  .activeQ {
    background: #3d91ff !important;
  }
  
  .activeS {
    background: #64fc69 !important;
  }
  
  .activeB {
    background: #ff815a !important;
  }

  .activeD{
    background: #f4c20d !important;
  }

  .dateOfDep {
    float:right;
    font-size: .875rem;
    color: #5f6368;
    float:right;
    margin-right:10px;
  }

  .md-toolbar {
    z-index: 1;
  }
  
  span,
  label,
  input {
    font-family: 'Kanit', sans-serif !important;
  }
  
  .hoverdiv {
    transition: all 1s;
  }
</style>