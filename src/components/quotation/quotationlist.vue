<template>
  <div class="index" style="background: #f4f5f7;">
    <div class="container">
      <div class="col-12">
        <md-field>
          <md-tooltip md-direction="bottom">ค้นหาใบเสนอราคา ใบสั่งซื้อล่วงหน้า</md-tooltip>
          <md-icon>search</md-icon>
          <label>ค้นหา</label>
          <md-input v-model="searched"></md-input>
        </md-field>
      </div>

      <!-- payloadreal -->
      <div v-for="(val,index) in listFilter" :key="index">
        <div
          @click="seedetail(val)"
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
                      v-show="val.is_confirm == 0&& val.is_cancel==0"
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
      api.searchQuotationByKeyword(
        payload,
        result => {
          for (var i = 0; i < result.data.length; i++) {
            this.dataall.push(result.data[i]);
          }
          console.log(JSON.stringify(this.dataall));
        },
        error => {
          console.log(JSON.stringify(error));
          alertify.error("Data ข้อมูลผิดพลาด");
        }
      );
    },
  },
  mounted() {
    this.showalldoc();
  }
};
</script>
<style >
</style>
