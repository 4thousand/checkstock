<template>
  <div class="index" style="background: #f4f5f7;">
    <div class="container">
      <div class="col-12">
        <md-field>
          <md-tooltip md-direction="bottom">ค้นหาใบเสนอราคา ใบสั่งขาย Black Order</md-tooltip>
          <md-icon>search</md-icon>
          <label>ค้นหา</label>
          <md-input @keyup.enter="showalldoc" v-model="keyword_showalldoc"></md-input>
        </md-field>
      </div>
      
      <!-- ข้อมูลใบเสนอราคา -->
      <!-- payloadtest -->
      <!-- <div v-for="val in payload">
        <div class="col-12 showhover" style="cursor: pointer;margin-bottom:10px">
          <md-toolbar class="md-transparent hoverdiv" style="min-width:251px;display:block;padding-top:5px;">
            <div class="md-layout md-gutter md-alignment-center">
              <div class="md-layout-item md-xlarge-size-5 md-large-size-5 md-xsmall-size-15 md-small-size-10 md-medium-size-5">
                <md-avatar class="md-avatar-icon md-primary" :class="'active'+val.head" style="margin:0;">{{ val.head }}</md-avatar>
              </div>
  
              <div class="md-layout-item md-xlarge-size-95  md-large-size-95 md-xsmall-size-85 md-small-size-90 md-medium-size-95">
                <div class="row">
                  <div class="col-12">
                    <span class="md-title">{{ val.topic}}</span>
                    <span class="md-title datehover" style="float:right;font-size: .875rem;color: #5f6368;">{{val.date}}</span>
                  </div>
                  <div class="col-12">
                    <span style="position: relative;left: 8px;font-size: .875rem;color: #5f6368;" class="md-subheading">
               {{val.detail}}
              </span>
                    <div @click="val.star = !val.star" v-show="val.star" style="float:right;z-index:99" class=" starhover">
                      <md-icon>star_border</md-icon>
                    </div>
                    <div class="starhover" @click="val.star = !val.star" v-show="val.star == false" style="float:right;color:red;z-index:99;">
                      <md-icon>star</md-icon>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </md-toolbar>
        </div>
      </div> -->
      <!-- payloadreal -->
      <div v-for="val in dataall">
        <div @click="seedetail(val)" class="col-12 showhover" style="cursor: pointer;margin-bottom:10px">
          <md-toolbar class="md-transparent hoverdiv" style="min-width:251px;display:block;padding-top:5px;overflow:hidden">
            <div class="md-layout md-gutter md-alignment-center">
              <div class="md-layout-item md-xlarge-size-5 md-large-size-5 md-xsmall-size-15 md-small-size-10 md-medium-size-5">
                <md-avatar class="md-avatar-icon md-primary" :class="'active'+val.module.substring(0, 1)" style="margin:0;">{{ val.module.substring(0, 1) }}</md-avatar>
              </div>
  
              <div class="md-layout-item md-xlarge-size-95  md-large-size-95 md-xsmall-size-85 md-small-size-90 md-medium-size-95">
                <div class="row">
                  <div class="col-12">
                    <span class="md-title">{{ val.doc_no}}</span>
                      <md-icon v-show="val.is_confirm == 0" style="float:right;color:green">check_circle_outline</md-icon>
                       <md-icon v-show="val.is_cancel == 0" style="float:right;color:red;">cancel</md-icon>
                         <span class="md-title datehover" style="float:right;font-size: .875rem;color: #5f6368;float:right;margin-right:10px">{{val.doc_date.substring(0, 10)}}</span>
                  </div>
                  <div class="col-12">
                    <span style="position: relative;left: 8px;font-size: .875rem;color: #5f6368;" class="md-subheading">
                    {{ 'รหัสลูกค้า : '+val.ar_code + ' ชื่อลูกค้า :' + val.ar_name + ' พนักงานขาย :' +val.sale_name +' รวมมูลค่าสินค้าทั้งหมด : '+val.total_amount +" บาท"}}
                    </span>
                    <div @click="val.total_amount = !val.total_amount" v-show="val.total_amount" style="float:right;" class=" starhover">
                      <md-icon>star_border</md-icon>
                    </div>
                    <div class="starhover" @click="val.total_amount = !val.total_amount" v-show="val.total_amount == false" style="float:right;color:red;">
                      <md-icon>star</md-icon>
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
    <md-speed-dial style="z-index:99" class="md-bottom-right">
      <md-speed-dial-target>
        <md-icon>add</md-icon>
      </md-speed-dial-target>
  
      <md-speed-dial-content>
        <md-button class="md-icon-button">
          <md-icon>folder</md-icon>
        </md-button>
        <md-button class="md-icon-button">
          <md-icon>folder</md-icon>
        </md-button>
        <md-button class="md-icon-button">
          <md-icon>event</md-icon>
        </md-button>
  
        <md-button class="md-icon-button">
          <md-icon>note</md-icon>
        </md-button>
      </md-speed-dial-content>
    </md-speed-dial>
  </div>
</template>

<style lang="scss" scoped>
.md-speed-dial .md-button{
      margin: 4px;
}
  .container {
    padding: 5px 0;
  }
  
  .md-title {
    font-weight: 700;
    font-size: 1.075rem;
  }
  
  .md-app {
    max-height: 400px;
    border: 1px solid rgba(#000, .12);
  }
  
  // Demo purposes only
  .md-drawer {
    width: 230px;
    max-width: calc(100vw - 125px);
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
  
  span,
  label,
  input {
    font-family: 'Kanit', sans-serif !important;
  }
  
  .hoverdiv {
    transition: all 0.8s;
    height: 30px;
  }
  
  // .hoverdiv:hover {
  //   height: 200px !important;
  // }
</style>

<script src="../js/index.js">
  
</script>