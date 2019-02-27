<template>
  <div class="index" style="background: #f4f5f7;">
    <div class="container">
      <div class="col-12">
        <md-field>
          <md-tooltip md-direction="bottom" v-show="typepage=='IV'">ค้นหาใบออกบิลขาย</md-tooltip>
          <md-icon>search</md-icon>
          <label>ค้นหา</label>
          <md-input v-model="searched"></md-input>
          <md-menu md-direction="bottom-end">
            <md-button
              class="md-icon-button"
              style="border-radius:0px;  height: 50%;"
              md-menu-trigger
              @click="changefilter=true"
            >
              <md-icon style="width: 50px;float: right;">more_horiz</md-icon>
            </md-button>
          </md-menu>
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
                <md-avatar class="md-avatar-icon md-primary" :class="'active'" style="margin:0;">IV</md-avatar>
              </div>

              <div
                class="md-layout-item md-xlarge-size-95 md-large-size-95 md-xsmall-size-85 md-small-size-90 md-medium-size-95"
              >
                <div class="row">
                  <div class="col-12">
                    <span class="md-title">{{ val.doc_no}}</span>
                    <md-icon
                      v-show="val.is_confirm == 1"
                      style="float:right;color:green"
                    >check_circle_outline</md-icon>
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
                      @click="val.total_amount = !val.total_amount"
                      v-show="val.total_amount"
                      style="float:right;"
                      class="starhover"
                    >
                      <md-icon>star_border</md-icon>
                    </div>
                    <div
                      class="starhover"
                      @click="val.total_amount = !val.total_amount"
                      v-show="val.total_amount == false"
                      style="float:right;color:red;"
                    >
                      <md-icon>star</md-icon>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </md-toolbar>
        </div>
      </div>
      <div>
        <md-dialog :md-active.sync="changefilter">
          <md-dialog-title>ตัวเลือกการค้นหา</md-dialog-title>
          <md-tabs md-dynamic-height>
            <md-tab md-label>
              <div class="table-responsive" style="overflow-y: auto;">
                <div>ค้นหาจาก
                  <br>
                  <md-radio v-model="fillter" value="doc_no">
                    เลขเอกสาร
                    <small>(Default)</small>
                  </md-radio>
                  <md-radio v-model="fillter" value="doc_date" class="md-primary">วันที่</md-radio>
                </div>
                <div>เรียง
                  <br>
                  <md-radio v-model="filterby" value="DSEC">
                    มากไปหาน้อย
                    <small>(Default)</small>
                  </md-radio>
                  <md-radio v-model="filterby" value="ASC" class="md-primary">น้อยไปหามาก</md-radio>
                </div>
              </div>
            </md-tab>
          </md-tabs>
          <md-dialog-actions>
            <md-button class="md-primary" @click="changefilter = false">Close</md-button>
          </md-dialog-actions>
        </md-dialog>
      </div>
      <!-- ข้อมูลใบเสนอราคา -->
    </div>
    <md-speed-dial class="md-bottom-right">
      <md-speed-dial-target @click="goindex()">
        <md-icon>add</md-icon>
      </md-speed-dial-target>
    </md-speed-dial>
  </div>
</template>
<script>
import Vue from "vue";
import api from "../../service/service.js";
import { Money } from "v-money";
export default {
  name: "itemtable",
  props: {
    // removeitemtable: Function,
    typepage: ""
  },
  data() {
    return {
      msg: "",
      star: true,
      Search: "",
      fillter: "doc_no",
      filterby: "DSEC",
      searched: "",
      sale_code: JSON.parse(localStorage.Datauser),
      dataall: [],
      keyword_showalldoc: "",
      changefilter: false
    };
  },
  computed: {
    listFilter() {
      var dataall = this.dataall.filter(dataall => {
        if (
          dataall.doc_no.toLowerCase().includes(this.searched.toLowerCase())
        ) {
          return dataall.doc_no
            .toLowerCase()
            .includes(this.searched.toLowerCase());
        } else if (
          dataall.ar_code.toLowerCase().includes(this.searched.toLowerCase())
        ) {
          return dataall.ar_code
            .toLowerCase()
            .includes(this.searched.toLowerCase());
        } else if (
          dataall.ar_name.toLowerCase().includes(this.searched.toLowerCase())
        ) {
          return dataall.ar_name
            .toLowerCase()
            .includes(this.searched.toLowerCase());
        } else if (
          dataall.sale_name.toLowerCase().includes(this.searched.toLowerCase())
        ) {
          return dataall.sale_name
            .toLowerCase()
            .includes(this.searched.toLowerCase());
        } else if (
          dataall.doc_date.toLowerCase().includes(this.searched.toLowerCase())
        ) {
          return dataall.doc_date
            .toLowerCase()
            .includes(this.searched.toLowerCase());
        }
      });

      if (this.fillter == "doc_date") {
        if (this.filterby == "ASC") {
          return dataall.sort((a, b) => (a.doc_date > b.doc_date ? 0 : -1));
        } else {
          return dataall.sort((a, b) => (a.doc_date < b.doc_date ? 0 : -1));
        }
      } else {
        if (this.filterby == "ASC") {
          return dataall.sort((a, b) => (a.doc_no > b.doc_no ? 0 : -1));
        } else {
          return dataall.sort((a, b) => (a.doc_no < b.doc_no ? 0 : -1));
        }
      }
    }
  },
  methods: {
    convertToBaht(val) {
      var result = numeral(val).format("0,0.00");
      // console.log(typeof result)
      return result;
    },

    goindex() {
      // localStorage.iddocno = 0
      this.showNavigation = false;

      if (this.typepage == "IV") {
        // this.topicmenu = 'ใบเสนอราคา'
        this.$router.push({ name: "invoice", params: { id: 0 } });
        return;
      }
    },
    seedetail(val) {
      console.log(JSON.stringify(val));
      if (this.typepage == "IV") {
        // this.topicmenu = 'ใบเสนอราคา'
        this.$router.push({ name: "invoice", params: { id: val.id } });
        return;
      }
    },
    showlistinvoice() {
      var payload = {
        sale_code: this.sale_code.sale_code,
        keyword: this.keyword_showalldoc
      };
      // v

      api.searchinvoicelist(
        payload,
        result => {
          for (var i = 0; i < result.data.length; i++) {
            this.dataall.push(result.data[i]);
          }
        },
        error => {
          alertify.error("Data ข้อมูลผิดพลาด");
          //  alertify.success('Error login');
          // this.cload()
        }
      );
    }
  },
  mounted() {
    if (this.typepage == "IV") {
      this.showlistinvoice();
    }
  }
};
</script>
<style  src="./componentlist.css">
</style>