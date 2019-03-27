<template>
  <div class="index" style="background: #f4f5f7;">
    <div class="body">
      <div class="header">
        <div class="headcontent">
          <div class="headtitle">ค้นหาข้อมูลสินค้า</div>
          <div class="form">
            <div class="carddiscount" @click="showstock">
              <md-icon>search</md-icon>
            </div>
            <input @keyup.enter="showstock" v-model="search" autofocus>
          </div>
        </div>
      </div>
      <div class="content">
        <div class="title">{{wh[0].itemcode}} {{wh[0].itemname}}</div>
        <div class="detailcontent">
          <div class="detial">
            <div class="md-title" style="margin-top:10px;padding:10px;">คงเหลือ</div>
            <md-tab>
              <div class="table-responsive" style="overflow-y: auto;">
                <table class="table table-hover">
                  <thead align="center">
                    <tr>
                      <th id="colorselectorder">คลัง</th>
                      <th id="colorselectorder">ที่เก็บ</th>
                      <th id="colorselectorder">จำนวน</th>
                      <th id="colorselectorder">หน่วยนับ</th>
                    </tr>
                  </thead>
                  <tbody id="valuetable" v-for="(val,index) in wh" :key="index">
                    <tr>
                      <th id="colorselectorder">{{val.whcode}}</th>
                      <th id="colorselectorder">{{val.shelfcode}}</th>
                      <th id="colorselectorder">{{val.qty}}</th>
                      <th id="colorselectorder">{{val.unitcode}}</th>
                    </tr>
                  </tbody>
                </table>
              </div>
            </md-tab>
            <!-- <md-table v-model="wh" md-card>
              <md-table-toolbar>
                <h1 class="md-title">คงเหลือ</h1>
              </md-table-toolbar>

              <md-table-row slot="md-table-row" slot-scope="{ item }">
                <md-table-cell md-label="คลัง" md-sort-by="whcode">{{ item.whcode }}</md-table-cell>
                <md-table-cell md-label="ที่เก็บ" md-sort-by="shelfcode">{{ item.shelfcode }}</md-table-cell>
                <md-table-cell md-label="จำนวน" md-sort-by="qty">{{ item.qty }}</md-table-cell>
                <md-table-cell md-label="หน่วยนับ" md-sort-by="unitcode">{{ item.unitcode }}</md-table-cell>
              </md-table-row>
            </md-table>-->

            <div>
              <div class="md-title" style="padding:10px;">รวมสินค้าคงเหลือ</div>
              <div class="sumofitem">
                <label>S01</label>
                <label style="float:right;font-size:1em;">{{sumofs.s01}} {{sumofs.u01}}</label>
              </div>
              <div class="sumofitem">
                <label>S02</label>
                <label style="float:right;font-size:1em;">{{sumofs.s02}} {{sumofs.u02}}</label>
              </div>
              <div class="sumofitem">
                <label>รวมสินค้าคงเหลือทั้งหมด</label>

                <label style="float:right;font-size:1em;">{{sumofs.sum}} {{sumofs.u01}}</label>
              </div>
            </div>
          </div>
          <div class="priceitem">
            <div class="md-title" style="padding:10px;">ราคาสินค้า</div>
            <div
              style="
    padding: 20px;
    width: 100%;
    height: 30%;
    margin-top: 10px;
    box-shadow: 1px 0 0 #d6d6d6, inset -1px 0 0 #dadce0, 0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 1px 3px 1px rgba(60, 64, 67, 0.15);
    background-color: rgb(234, 234, 234);"
            >
              <label style="font-size: 20px;
    margin-top: 10px;">ราคาเงินสด</label>
              <br>
              <div style="margin-left:50%;font-size:3.5em;">
                <label>{{price.price1}} บาท</label>
              </div>
            </div>
            <div
              style="
    padding: 20px;
    width: 100%;
    height: 30%;
    margin-top: 10px;
    box-shadow: 1px 0 0 #d6d6d6, inset -1px 0 0 #dadce0, 0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 1px 3px 1px rgba(60, 64, 67, 0.15);
    background-color: rgb(234, 234, 234);"
            >
              <label style="font-size: 20px;
    margin-top: 10px;">ราคาเงินเชื่อ</label>

              <br>
              <div style="margin-left:50%;font-size:3.5em;">
                <label>{{price.price2}} บาท</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from "../../service/service.js";
import Loading from "vue-loading-overlay";
export default {
  name: "showstock",
  data() {
    return {
      dataall: [],
      search: "",
      wh: [],
      price: {
        price1: 0,
        price2: 0
      },
      sumofs: {
        s01: 0,
        u01: "",
        s02: 0,
        u02: "",
        sum: 0
      },
      fax: "",
      headers: [
        {
          text: "คลัง",
          align: "left",
          sortable: false,

          value: "คลัง"
        },
        { text: "Calories", value: "calories" },
        { text: "Fat (g)", value: "fat" },
        { text: "Carbs (g)", value: "carbs" },
        { text: "Protein (g)", value: "protein" },
        { text: "Iron (%)", value: "iron" }
      ]
    };
  },
  components: {
    Loading
  },
  methods: {
    showstock() {
      let i = 0;
      let payload = {
        keyword: this.search
      };
      if (payload.keyword == "") {
        this.$router.push({ name: "login" });
        return;
      }
      api.showstocklist(
        payload,
        result => {
          this.isLoading = false;
          if (result.data.length == 0) {
            alertify.error("ไม่พบข้อมูลสินค้าที่ค้นหา");
            this.$router.push({ name: "login" });
            return;
          }
          console.log(JSON.stringify(result));
          if (result.data[0].findstatus == 0) {
            this.$router.push({
              name: "stocklist",
              params: { id: this.search }
            });
            return;
          } else {
            this.wh = [];
            this.sumofs.s01 = 0;
            this.sumofs.s02 = 0;
            this.sumofs.u01 = "";
            this.sumofs.u02 = "";
            this.price.price1 = 0;
            this.price.price2 = 0;
            let payload = {
              item_code: this.search
            };
            console.log(payload);
            api.showstockbyItemCode(
              payload,
              result => {
                this.isLoading = false;
                console.log(JSON.stringify(result));
                if (result.data.length == 0) {
                  alertify.error("ไม่พบข้อมูลสินค้าที่ค้นหา");
                  this.$router.push({ name: "login" });
                  return;
                }
                this.dataall = result.data;
                this.price.price1 = result.data[0].SalePrice1;
                this.price.price2 = result.data[0].SalePrice2;
                console.log(this.dataall);
                for (let x = 0; x < result.data.length; x++) {
                  if (result.data[x].datacenter == "S01") {
                    this.sumofs.s01 = this.sumofs.s01 + result.data[x].qty;
                    this.sumofs.u01 = result.data[x].unitcode;
                  } else {
                    this.sumofs.s02 = this.sumofs.s02 + result.data[x].qty;
                    this.sumofs.u02 = result.data[x].unitcode;
                  }
                  this.sumofs.sum = this.sumofs.s01 + this.sumofs.s02;
                  console.log(result.data[x]);
                  this.wh.push(result.data[x]);
                  console.log(this.wh);
                  // data = {
                  //   datacenter: result.data[x].datacenter,
                  //   whcode: result.data[x].whcode,
                  //   shelfcode: result.data[x].shelfcode,
                  //   qty: result.data[x].qty,
                  //   unitcode: result.data[x].unitcode
                  // };
                }
              },
              error => {
                this.isLoading = false;
                console.log(JSON.stringify(error));
                alertify.error("Data ข้อมูลการจัดสรรผิดพลาด");
              }
            );
          }
        },
        error => {
          this.isLoading = false;
          console.log(JSON.stringify(error));
          alertify.error("Data ข้อมูลการจัดสรรผิดพลาด");
        }
      );
    }
  },
  mounted() {
    this.docnoid = this.$route.params.id;
    this.search = this.$route.params.id;
    console.log(this.docnoid);
    if (this.docnoid == "" || this.docnoid == 0) {
      //|| this.docnoid == null) {
      this.$router.push({ name: "login" });
      return;
    }
    let payload = {
      item_code: this.docnoid
    };
    console.log(payload);
    api.showstockbyItemCode(
      payload,
      result => {
        this.isLoading = false;
        console.log(JSON.stringify(result));
        if (result.data.length == 0) {
          alertify.error("ไม่พบข้อมูลสินค้าที่ค้นหา");
          this.$router.push({ name: "login" });
          return;
        }
        this.dataall = result.data;
        this.price.price1 = result.data[0].SalePrice1;
        this.price.price2 = result.data[0].SalePrice2;
        console.log(this.dataall);
        for (let x = 0; x < result.data.length; x++) {
          if (result.data[x].datacenter == "S01") {
            this.sumofs.s01 = this.sumofs.s01 + result.data[x].qty;
            this.sumofs.u01 = result.data[x].unitcode;
          } else {
            this.sumofs.s02 = this.sumofs.s02 + result.data[x].qty;
            this.sumofs.u02 = result.data[x].unitcode;
          }
          this.sumofs.sum = this.sumofs.s01 + this.sumofs.s02;
          console.log(result.data[x]);
          this.wh.push(result.data[x]);
          console.log(this.wh);
          // data = {
          //   datacenter: result.data[x].datacenter,
          //   whcode: result.data[x].whcode,
          //   shelfcode: result.data[x].shelfcode,
          //   qty: result.data[x].qty,
          //   unitcode: result.data[x].unitcode
          // };
        }
      },
      error => {
        this.isLoading = false;
        console.log(JSON.stringify(error));
        alertify.error("Data ข้อมูลการจัดสรรผิดพลาด");
      }
    );
  }
};
</script>

<style   lang="scss" scoped src="./showstock.scss">
</style>
