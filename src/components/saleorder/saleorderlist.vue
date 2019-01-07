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
    
      <!-- payloadreal -->
      <div v-for="val in dataall">
        <div @click="seedetail(val)" class="col-12 showhover" style="cursor: pointer;margin-bottom:10px">
          <md-toolbar id="responsiveheight" class="md-transparent hoverdiv" style="min-width:251px;display:block;padding-top:5px;overflow:hidden">
            <div class="md-layout md-gutter md-alignment-center">
              <div class="md-layout-item md-xlarge-size-5 md-large-size-5 md-xsmall-size-15 md-small-size-10 md-medium-size-5">
                <md-avatar class="md-avatar-icon md-primary" :class="'active'+val.module.substring(0, 1)" style="margin:0;">{{ val.module.substring(0, 1) }}</md-avatar>
              </div>
  
              <div class="md-layout-item md-xlarge-size-95  md-large-size-95 md-xsmall-size-85 md-small-size-90 md-medium-size-95">
                <div class="row">
                  <div class="col-12">
                    <span class="md-title">{{ val.doc_no}}</span>
                    <md-icon v-show="val.is_confirm == 1" style="float:right;color:green">check_circle_outline</md-icon>
                    <md-icon v-show="val.is_cancel == 1" style="float:right;color:red;">cancel</md-icon>
                    <span class="md-title datehover" style="float:right;font-size: .875rem;color: #5f6368;float:right;margin-right:10px">{{val.doc_date.substring(0, 10)}}</span>
                  </div>
                  <div class="col-12">
                    <span style="position: relative;left: 8px;font-size: .875rem;color: #5f6368;" class="md-subheading">
                    {{ 'รหัสลูกค้า : '+val.ar_code + ' ชื่อลูกค้า :' + val.ar_name + ' พนักงานขาย :' +val.sale_name +' รวมมูลค่าสินค้าทั้งหมด : '+convertToBaht(val.total_amount) +" บาท"}}
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
    <md-speed-dial class="md-bottom-right">
      <md-speed-dial-target @click="goindex('/saleorder')">
        <md-icon>add</md-icon>
      </md-speed-dial-target>
    </md-speed-dial>
  </div>
</template>
<script src="../../js/index.js">
  
</script>
<style >

</style>