<template>
  <div style="width:100%">
    <div class="md-toolbar-section-start">
      <div style="min-height:42px;position:relative" class="md-title">
        <div style="float:left;position:relative;top:13px;margin-right:10px">ข้อมูลสินค้า</div>

        <div class="md-size-40 md-small-size-100" style="float:left;">
          <md-field>
            <label>เพิ่มสินค้า</label>
            <md-input ref="addproduct" v-model="keywordproduct" @keyup.enter="addproduct"></md-input>
          </md-field>
          <md-avatar style="position: absolute; top: 15px; left: 273px;">
            <md-icon style="color:grey">info</md-icon>
            <md-tooltip md-direction="top">
              <md-icon style="color:white;">keyboard</md-icon>รหัสสินค้า หรือ ชื่อสินค้า + Enter
            </md-tooltip>
          </md-avatar>
        </div>

        <md-button @click="addproduct" class="md-icon-button md-raised md productadd">
          <md-icon>add</md-icon>
        </md-button>
      </div>
    </div>
    <md-dialog :md-active.sync="showDialogproduct">
      <md-dialog-title>ค้นหาสินค้า</md-dialog-title>
      <md-tabs id="none" md-dynamic-height>
        <md-tab md-label>
          <md-field>
            <md-input
              v-model="keywordproduct"
              @keyup="addproductrt"
              @keydown="addproductrt"
              @input="addproductrt"
            ></md-input>
          </md-field>
          <div class="table-responsive" style="overflow-y: auto;">
            <table class="table table-hover">
              <thead align="center">
                <tr>
                  <th style="white-space: nowrap;">ลำดับ</th>
                  <th style="white-space: nowrap;">รูป</th>
                  <th style="overflow:auto;white-space: nowrap;">รหัสสินค้า</th>
                  <th style="white-space: nowrap;">ชื่อสินค้า</th>
                  <th style="white-space: nowrap;">หน่วยนับ</th>
                  <th style="white-space: nowrap;" v-show="billtype == 0">ราคา(เงินสด)</th>
                  <th style="white-space: nowrap;" v-show="billtype == 1">ราคา(เงินเชื่อ)</th>
                  <th style="white-space: nowrap;">คงเหลือ</th>
                </tr>
              </thead>
              <tbody v-for="(val,index) in dataproductDialog" :key="index" id="valuetable">
                <tr style="text-align:center;cursor:pointer">
                  <td @click="showdetail(val)">{{index+1}}</td>
                  <td @click="showdetail(val)" v-show="val.pic_path_1">
                    <img
                      style="width:50px;height:50px;"
                      class="hoverzoom"
                      :src="val.pic_path_1"
                      alt
                    >
                  </td>
                  <td @click="showdetail(val)" v-show="!val.pic_path_1">
                    <img
                      style="max-width:50px;max-height:50px;"
                      src="../../assets/No_Image_Available.png"
                      alt
                    >
                  </td>
                  <td @click="showdetail(val)">{{val.item_code}}</td>
                  <td @click="showdetail(val)">{{val.item_name}}</td>
                  <td @click="showdetail(val)">{{val.unit_code}}</td>
                  <td @click="showdetail(val)" v-show="billtype == 0">{{val.sale_price_1}}</td>
                  <td @click="showdetail(val)" v-show="billtype == 1">{{val.sale_price_2}}</td>
                  <td>
                    <md-button
                      @click="findstock(val,index)"
                      style="height:18px;"
                      class="md-primary"
                    >{{ val.stk_qty }}</md-button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </md-tab>
      </md-tabs>

      <md-dialog-actions>
        <md-button class="md-primary" @click="showDialogproduct = false">Close</md-button>
      </md-dialog-actions>
    </md-dialog>
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
    parentData: [],
    stringProp: [],
    ref: "addproduct",
    product: Array,

    typepage: "",
    billtype: 0
  },
  data() {
    return {
      keywordproduct: "",
      showDialogproduct: false,
      attention: "",

      dataproductDialog: []
    };
  },
  methods: {
    addproduct() {
      console.log(this.keywordproduct);
      // alert(this.billtype)
      // alert('d')

      if (this.billtype === "" && this.billtype !== 0 && this.billtype !== 1) {
        if (this.attention == "wobble-hor-bottom") {
          this.attention = "wobble-hor-bottom2";
        } else {
          this.attention = "wobble-hor-bottom";
        }
        return;
      }

      if (!this.keywordproduct) {
        return;
      }
      console.log(this.billtype);
      var itemtable = new Array();
      this.dataproductDialog = [];

      let payload = {
        keyword: this.keywordproduct
      };
      var str = payload.keyword.split(" ");
      console.log(str.length);
      if (str.length > 1) {
        str.forEach(item => {
          payload.keyword = item;
          api.searchbykeyword(
            payload,
            result => {
              console.log(result.data);
              console.log(result.data.length);

              itemtable.push(result.data[0]);

              this.dataproductDialog = itemtable;
              this.showDialogproduct = true;

              console.log(this.dataproductDialog);
              console.log("billtype : " + this.billtype);
              this.$refs.addproduct.$el.focus();
            },
            error => {
              console.log(JSON.stringify(error));
              alertify.error("ข้อมูล สินค้าเกิดข้อผิดพลาด");
            }
          );
        });
      } else {
        api.searchbykeyword(
          payload,
          result => {
            console.log(result.data);
            console.log(result.data.length);

            this.dataproductDialog = result.data;
            if (this.dataproductDialog.length == 1) {
              console.log(result.data.length);
              var s = 0;
              var i = 0;
              this.product.forEach(function(items, a) {
                console.log(items);
                if (items.item_code == result.data[0].item_code) {
                  alertify.success(
                    "สินค้า " + result.data[0].item_name + "อยู่ในรายการแล้ว"
                  );
                  i += 1;
                  return;
                }
              });
              console.log(result.data[0].item_code);
              if (i > 0) {
                return;
              }
              var data = new Array();
              console.log(JSON.stringify(result.data));

              result.data[0].stk_location.forEach(item => {
                console.log(JSON.stringify(item));
                data.push(item);
              });
              if (this.billtype == 0) {
                console.log(result.data[0].id);
                var datashow = {
                  item_id: result.data[0].id,
                  item_code: result.data[0].item_code,
                  bar_code: result.data[0].bar_code,
                  item_name: result.data[0].item_name,
                  unit_code: result.data[0].unit_code,
                  qty: 1,
                  price: result.data[0].sale_price_1,
                  sale_price_1: result.data[0].sale_price_1,
                  sale_price_2: result.data[0].sale_price_2,

                  stock_location: data,

                  location: data[0].wh_code,
                  discount_word_sub: "0",
                  discount_word: "0",
                  discount_amount_sub: 0,
                  discount_amount: 0,
                  item_amount: result.data[0].sale_price_1 * 1,
                  amount: result.data[0].sale_price_1 * 1,
                  item_description: "",
                  packing_rate_1: parseInt(result.data[0].rate_1),
                  is_cancel: 0
                };

                console.log(datashow);
                this.product.push(datashow);
                //close modal
                this.showDialogproduct = false;
                alertify.success(
                  "เพิ่มข้อมูลสินค้า " + result.data[0].item_name
                );
              } else if (this.billtype == 1) {
                var datashow = {
                  item_id: result.data[0].id,
                  item_code: result.data[0].item_code,
                  bar_code: result.data[0].bar_code,
                  item_name: result.data[0].item_name,
                  unit_code: result.data[0].unit_code,
                  qty: 1,
                  price: result.data[0].sale_price_2,
                  sale_price_1: result.data[0].sale_price_1,
                  stock_location: data,
                  location: data[0].wh_code,
                  discount_word_sub: "0",
                  discount_word: "0",
                  discount_amount_sub: 0,
                  discount_amount: 0,
                  item_amount: result.data[0].sale_price_2 * 1,
                  amount: result.data[0].sale_price_2 * 1,
                  item_description: "",
                  packing_rate_1: parseInt(result.data[0].rate_1),
                  is_cancel: 0
                };

                this.product.push(datashow);
                //close modal
                this.showDialogproduct = false;
                alertify.success(
                  "เพิ่มข้อมูลสินค้า " + result.data[0].item_name
                );
              }
            } else {
              this.showDialogproduct = true;
            }
            console.log(this.dataproductDialog);
            console.log("billtype : " + this.billtype);
            this.$refs.addproduct.$el.focus();
          },
          error => {
            console.log(JSON.stringify(error));
            alertify.error("ข้อมูล สินค้าเกิดข้อผิดพลาด");
          }
        );
      }

      console.log(this.dataproductDialog);
    },
    addproductrt() {
      console.log(this.keywordproduct);
      // alert(this.billtype)
      // alert('d')
      if (this.billtype === "" && this.billtype !== 0 && this.billtype !== 1) {
        if (this.attention == "wobble-hor-bottom") {
          this.attention = "wobble-hor-bottom2";
        } else {
          this.attention = "wobble-hor-bottom";
        }
        return;
      }

      if (!this.keywordproduct) {
        return;
      }
      var itemtable = new Array();
      let payload = {
        keyword: this.keywordproduct
      };
      var str = payload.keyword.split(" ");
      console.log(str.length);

      api.searchbykeyword(
        payload,
        result => {
          this.dataproductDialog = result.data;

          console.log("billtype : " + this.billtype);
          this.$refs.addproduct.$el.focus();
        },
        error => {
          console.log(JSON.stringify(error));
          alertify.error("ข้อมูล สินค้าเกิดข้อผิดพลาด");
        }
      );

      console.log(itemtable);
    },
    showdetail(val) {
      var i = 0;
      this.product.forEach(function(items, a) {
        console.log(items);
        if (items.item_code == val.item_code) {
          alertify.success("สินค้า " + val.item_name + "อยู่ในรายการแล้ว");
          i += 1;
          return;
        }
      });
      console.log(val);
      if (i > 0) {
        return;
      }

      var data = new Array();
      console.log(JSON.stringify(val));

      val.stk_location.forEach(item => {
        console.log(JSON.stringify(item));
        data.push(item);
      });
      console.log(data);
      if (this.billtype == 0) {
        var datashow = {
          item_id: val.id,
          item_code: val.item_code,
          bar_code: val.bar_code,
          item_name: val.item_name,
          unit_code: val.unit_code,
          qty: 1,
          price: val.sale_price_1,
          sale_price_1: val.sale_price_1,
          sale_price_2: val.sale_price_2,

          stock_location: data,
          location: data[0].wh_code,
          discount_word_sub: "0",
          discount_word: "0",
          discount_amount_sub: 0,
          discount_amount: 0,
          item_amount: val.sale_price_1 * 1,
          amount: val.sale_price_1 * 1,
          item_description: "",
          packing_rate_1: parseInt(val.rate_1),
          is_cancel: 0
        };

        console.log(datashow);
        this.product.push(datashow);
        //close modal

        alertify.success("เพิ่มข้อมูลสินค้า " + val.item_name);
      } else if (this.billtype == 1) {
        var datashow = {
          item_id: val.id,
          item_code: val.item_code,
          bar_code: val.bar_code,
          item_name: val.item_name,
          unit_code: val.unit_code,
          qty: 1,
          price: val.sale_price_2,
          sale_price_1: val.sale_price_1,
          sale_price_2: val.sale_price_2,
          stock_location: data,
          location: data[0].wh_code,
          discount_word_sub: "0",
          discount_word: "0",
          discount_amount_sub: 0,
          discount_amount: 0,
          amount: val.sale_price_2 * 1,
          item_amount: val.sale_price_2 * 1,
          item_description: "",
          packing_rate_1: parseInt(val.rate_1),
          is_cancel: 0
        };

        this.product.push(datashow);
        //close modal
        this.showDialogproduct = false;
        alertify.success("เพิ่มข้อมูลสินค้า " + val.item_name);
      }
      this.keywordproduct = "";

      //console.log(datashow)
    }
  },
  mounted() {}
};
</script>
