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

        <md-speed-dial class="md-bottom-right">
          <md-speed-dial-target>
            <md-icon>add</md-icon>
          </md-speed-dial-target>
          <md-speed-dial-content>
            <md-button class="md-icon-button" @click="goindex('/deposit')">
              <md-icon>description</md-icon>
              <md-tooltip md-direction="left">เพิ่มใบรับเงินมัดจำแบบหน้าร้าน</md-tooltip>
            </md-button>

            <md-button class="md-icon-button" @click="goindex('/prototype')">
              <md-icon>streetview</md-icon>
              <md-tooltip md-direction="left">เพิ่มใบรับเงินมัดจำแบบขายโครงการ</md-tooltip>
            </md-button>
          </md-speed-dial-content>
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
   }
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