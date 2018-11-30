<template>
    <div>
      <div class="container">
        <div class="col-12">
          <md-field>
            <md-tooltip md-direction="bottom">ค้นหาใบรับเงินมัดจำ</md-tooltip>
            <md-icon>search</md-icon>
            <label>ค้นหา</label>
            <md-input @keyup.enter="showalldoc" v-model="keyword_showalldoc"></md-input>
          </md-field>
        </div>

            <md-toolbar id="responsiveheight" class="md-transparent hoverdiv" style="min-width:251px;display:block;padding-top:5px;overflow:hidden">
              <div class="md-layout md-gutter md-alignment-center">
                <div class="md-layout-item md-xlarge-size-5 md-large-size-5 md-xsmall-size-15 md-small-size-10 md-medium-size-5">
                  <md-avatar class="md-avatar-icon md-primary">D</md-avatar>
                </div>
    
                <div
                      style="cursor: pointer;margin-bottom:10px"
                    >
                  <div class="md-layout-item md-xlarge-size-95  md-large-size-95 md-xsmall-size-85 md-small-size-90 md-medium-size-95">
                    <div class="row">
                      <div class="col-12">
                        <span class="md-title">S01-QHV6010-0006</span>
                        <span class="md-title datehover" style="float:right;font-size: .875rem;color: #5f6368;float:right;margin-right:10px">2018-11-28</span>
                      </div>
                      <div class="col-12">
                        <span style="position: relative;left: 8px;font-size: .875rem;color: #5f6368;" class="md-subheading">
                        {{ 'รหัสลูกค้า : '+5064 + ' ชื่อลูกค้า :' + "val.ar_name" + ' พนักงานขาย :' +"val.sale_name" +' รวมมูลค่ารวมภาษี : '+"convertToBaht(val.total_amount) "+" บาท"}}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </md-toolbar>


        <md-speed-dial class="md-bottom-right">
          <md-speed-dial-target @click="goindex('/prototype')">
            <md-icon>add</md-icon>
          </md-speed-dial-target>
        </md-speed-dial>

      </div>
    </div>
</template>
<script>
 export default {
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

    }
  },
  convertToBaht(val) {
    var result = numeral(val).format("0,0.00");
    // console.log(typeof result)
    return result;
  },
 }
</script>
<style>

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
    transition: all 1s;
    height: 30px;
  }
</style>