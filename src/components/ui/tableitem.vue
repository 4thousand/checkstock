<template>
  <div style="width:100%">
    <md-card
      v-for="(val,index) in searched"
      :key="index"
      class="md-layout-item md-size-100 md-small-size-100"
    >
      <div class="tables" style="width:100%">
        <md-card-actions style="justify-content:end;">
          <md-button style="width:10%">{{val.item_code}}</md-button>
          <md-button style="width:20%;    height: auto;
      ">
            <div
              style="width:100%;white-space: normal;word-wrap:  text-align-last: left; break-word;      text-align: left;  text-indent: 20px;display: inline-block;height:auto;"
            >{{val.item_name}}</div>
          </md-button>
          <md-button
            style="width:5%"
            v-if="typepage=='saleorder' || typepage=='invoice'"
            @click="select_wh(val,index)"
          >
            <span>{{val.location}}</span>
          </md-button>
          <md-button style="width: 5%;">
            <span>{{val.unit_code}}</span>
          </md-button>
          <md-button
            style="min-width:5.6%;"
            v-show="isQtySelected==false"
            @click="isQtySelected=true"
          >
            <span>{{val.qty}}</span>
          </md-button>
          <input
            type="number"
            style="min-width:5.6%;"
            v-model="val.qty"
            v-show="isQtySelected==true"
            @keyup.enter="isQtySelected=false,calEachPrice(val)"
            v-if="typepage!='invoice'"
            @blur="isQtySelected=false,calEachPrice(val)"
          >
          <input
            type="text"
            style="width:5%;"
            v-model="val.qty"
            v-show="isQtySelected==true"
            @keyup.enter="isQtySelected=false,calEachPriceinvoice(val)"
            v-if="typepage=='invoice'"
            @blur="isQtySelected=false,calEachPriceinvoice(val)"
          >
          <md-button style="width:5%">
            <span>{{convertmoney(val.price)}}</span>
          </md-button>
          <md-button
            style="width: 5%"
            v-show="isDiscountSelected==false"
            @click="isDiscountSelected=true"
            v-if="typepage!='invoice'"
            :disabled="permission.is_update==0"
          >{{val.discount_word}}</md-button>
          <input
            style="width:5%"
            type="text"
            v-model="val.discount_word"
            v-show="isDiscountSelected==true"
            @keyup.enter="isDiscountSelected=false,calEachPrice(val)"
            @blur="isDiscountSelected=false,calEachPrice(val)"
            v-if="typepage!='invoice'"
          >
          <md-button
            style="width: 5%"
            v-show="isDiscountSelected==false"
            @click="isDiscountSelected=true"
            v-if="typepage=='invoice'"
          >{{val.discount_word_sub}}</md-button>
          <input
            style="width:5%"
            type="text"
            v-model="val.discount_word_sub"
            v-show="isDiscountSelected==true"
            @keyup.enter="isDiscountSelected=false,calEachPriceinvoice(val)"
            @blur="isDiscountSelected=false,calEachPriceinvoice(val)"
            v-if="typepage=='invoice'"
          >
          <md-button
            style="width:5%"
            v-if="typepage=='saleorder'||typepage=='quotation'"
          >{{convertmoney(val.item_amount)}}</md-button>
          <md-button style="width:5%" v-if="typepage=='invoice'">{{convertmoney(val.amount)}}</md-button>
          <md-button style="min-width:5%;" class="md-mini" @click="removeitemtable(index)">
            <md-icon style="width:5%;float: right;">delete</md-icon>
          </md-button>
          <md-button style="min-width: 5%" class="md-mini" @click="histable(val,searchcus)">
            <md-icon style="width:5%;float: right;">history</md-icon>
          </md-button>
        </md-card-actions>
      </div>
      <div class="tables2">
        <div class="carddiscount">{{val.discount_word_sub}}</div>
        <md-card-header style=" margin-top: 0px;    padding: 5px; width:60%;">
          <div class="md-title" style="    font-size: 15px;">{{val.item_code}}</div>
          <div class="md-subhead">{{val.item_name}}</div>
          <div class="md-subhead">จำนวน : {{val.qty}} {{val.unit_code}}</div>
        </md-card-header>
        <md-card-content style="padding:0px;width:40%;">
          <div style=" height: 100%;  float: right;padding-top:5px">
            <md-menu md-direction="bottom-end">
              <md-button
                class="md-icon-button"
                style="border-radius:0px;  height: 10%;"
                md-menu-trigger
              >
                <md-icon style="width: 50px;float: right;">more_horiz</md-icon>
              </md-button>
              <md-menu-content>
                <md-menu-item style="min-width: 30px;" @click="testtable(val)">
                  <md-icon style="width: 10px;float: right;">edit</md-icon>edit
                </md-menu-item>

                <md-menu-item @click="removeitemtable(index)" style="min-width: 30px;">
                  <md-icon style="width:10px;float: right;">delete</md-icon>delete
                </md-menu-item>
                <md-button style="min-width: 5%" class="md-mini" @click="histable(val,searchcus)">
                  <md-icon style="width:5%;float: right;">history</md-icon>
                </md-button>
              </md-menu-content>
            </md-menu>
            <div style="text-align:center">
              {{val.amount}}
              <br>บาท
            </div>
          </div>
          <div>
            <md-dialog :md-active.sync="showDialogItem">
              <md-dialog-title>ประวัติซื้อขาย</md-dialog-title>
              <md-tabs id="none" md-dynamic-height>
                <md-tab md-label>
                  <md-field>
                    <h5>
                      <span>{{val.item_code}} {{searchcus}}</span>
                    </h5>
                  </md-field>
                  <div class="table-responsive" style="overflow-y: auto;">
                    <table class="table table-hover">
                      <thead align="center">
                        <tr>
                          <!--<th style=''>client_id</th>-->
                          <th style="white-space: nowrap;">ลำดับ</th>
                          <th style="overflow:auto;white-space: nowrap;">วันที่เอกสาร</th>
                          <th style="white-space: nowrap;">เลขที่เอกสาร</th>
                          <th style="white-space: nowrap;">ชื่อสินค้า</th>
                          <th style="white-space: nowrap;">จำนวน</th>
                          <th style="white-space: nowrap;">หน่วยนับ</th>
                          <th style="white-space: nowrap;">ราคา/หน่วย</th>
                          <th style="white-space: nowrap;">ส่วนลด</th>
                        </tr>
                      </thead>
                      <tbody v-for="(val,index) in dataproductItem" :key="index" id>
                        <tr style="text-align:center;cursor:pointer">
                          <td>{{index+1}}</td>
                          <td v-if="typepage==='invoice'">{{val.doc_date}}</td>
                          <td v-if="typepage==='invoice'">{{val.doc_no}}</td>
                          <td v-if="typepage==='invoice'">{{val.item_name}}</td>
                          <td v-if="typepage==='invoice'">{{val.qty}}</td>
                          <td v-if="typepage==='invoice'">{{val.unit_code}}</td>
                          <td v-if="typepage==='invoice'">{{val.price}}</td>
                          <td v-if="typepage==='invoice'">{{val.discount_word_sub}}</td>

                          <td v-if="typepage==='quotation'">{{val.DocDate}}</td>
                          <td v-if="typepage==='quotation'">{{val.DocNo}}</td>
                          <td v-if="typepage==='quotation'">{{val.ItemName}}</td>
                          <td v-if="typepage==='quotation'">{{val.Qty}}</td>
                          <td v-if="typepage==='quotation'">{{val.UnitCode}}</td>
                          <td v-if="typepage==='quotation'">{{val.Price}}</td>
                          <td v-if="typepage==='quotation'">{{val.DiscountWord}}</td>

                          <td v-if="typepage==='saleorder'">{{val.DocDate}}</td>
                          <td v-if="typepage==='saleorder'">{{val.DocNo}}</td>
                          <td v-if="typepage==='saleorder'">{{val.ItemName}}</td>
                          <td v-if="typepage==='saleorder'">{{val.Qty}}</td>
                          <td v-if="typepage==='saleorder'">{{val.UnitCode}}</td>
                          <td v-if="typepage==='saleorder'">{{val.Price}}</td>
                          <td v-if="typepage==='saleorder'">{{val.DiscountWord}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </md-tab>
              </md-tabs>

              <md-dialog-actions>
                <md-button class="md-primary" @click="showDialogItem = false">Close</md-button>
                <!-- <md-button class="md-primary" @click="showDialogcus = false">Save</md-button> -->
              </md-dialog-actions>
            </md-dialog>
          </div>
        </md-card-content>
      </div>
    </md-card>
    <div>
      <md-dialog :md-active.sync="searchwarehousecode_m">
        <md-dialog-title>เปลี่ยน คลัง</md-dialog-title>
        <md-tabs md-dynamic-height>
          <md-tab md-label>
            <div class="table-responsive" style="overflow-y: auto;">
              <table class="table table-hover">
                <thead align="center">
                  <tr>
                    <th>ลำดับ</th>
                    <th id="colorselectorder">คลัง</th>
                    <th id="colorselectorder">ที่เก็บ</th>
                    <th id="colorselectorder">จำนวน</th>
                  </tr>
                </thead>
                <tbody id="valuetable">
                  <tr
                    v-for="(val,index) in edit_wh"
                    :key="index"
                    @click="selectwarehousecode(val)"
                    style="text-align:center;cursor:pointer"
                  >
                    <td>{{index+1}}</td>
                    <td>{{val.wh_code}}</td>
                    <td>{{val.shelf_code}}</td>
                    <td>{{val.qty}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </md-tab>
        </md-tabs>

        <md-dialog-actions>
          <md-button class="md-primary" @click="searchwarehousecode_m = false">Close</md-button>
        </md-dialog-actions>
      </md-dialog>
    </div>
    <div>
      <md-dialog :md-active.sync="changeqty">
        <md-dialog-title>เพิ่ม หรือ ลดจำนวนสินค้า</md-dialog-title>
        <md-tabs md-dynamic-height>
          <md-tab md-label>
            <div class="table-responsive" style="overflow-y: auto;">
              <md-button
                class="md-primary"
                :md-ripple="false"
                @click="searchwarehousecode_m = false"
              >
                <md-icon style="width:5%;float: right;">add</md-icon>
              </md-button>
              <md-button
                class="md-primary"
                :md-ripple="false"
                @click="searchwarehousecode_m = false"
              >1</md-button>
              <md-button
                class="md-primary"
                :md-ripple="false"
                @click="searchwarehousecode_m = false"
              >
                <md-icon style="width:5%;float: right;">remove</md-icon>
              </md-button>
            </div>
          </md-tab>
        </md-tabs>
        <md-dialog-actions>
          <md-button class="md-primary" @click="changeqty = false">Close</md-button>
        </md-dialog-actions>
      </md-dialog>
    </div>
  </div>
</template>


<script>
import Vue from "vue";
import api from "../../service/service.js";
import { Money } from "v-money";
export default {
  name: "itemtable",
  props: {
    parentData: [],
    stringProp: [],
    searched: Array,
    product: Array,
    typepage: "",
    searchcus: "",
    permission:""
  },
  data() {
    return {
      isLoading: false,
      changeqty: false,
      dataproductItem: [],
      showDialogItem: false,
      dproducts: [],
      edit_wh: [],
      searchwarehousecode_m: false,
      isQtySelected: false,
      isDiscountSelected: false
    };
  },
  methods: {
    changevalue_qty(val, index) {
      var items = {
        id: 0,
        Stk_unit_code: "",
        qty: 0,
        shelf_code: "",
        wh_code: ""
      };
      this.changeqty = true;
    },
    select_wh(val, index) {
      var items = {
        id: 0,
        Stk_unit_code: "",
        qty: 0,
        shelf_code: "",
        wh_code: ""
      };

      let payload = {
        item_code: val.item_code
      };
      var data = new Array();
      data = [];
      // console.log(payload)
      api.searchunitcode(
        payload,
        result => {
          console.log(result.data[0].stk_location);
          result.data[0].stk_location.forEach(item => {
            item.id = index;
            data.push(item);
          });

          this.edit_wh = data;
        },
        error => {
          console.log(JSON.stringify(error));
          alertify.error("Data ข้อมูล Unit code ผิดพลาด");
        }
      );
      console.log(this.typepage);

      this.searchwarehousecode_m = true;
    },
    selectwarehousecode(val) {
      this.product[val.id].location = val.wh_code;
      //  this.product[val.id].shelf_code = val.shelf_code

      this.searchwarehousecode_m = false;
    },
    convertmoney(val) {
      var number = numeral(val).format("0,0.00");
      return number;
    },
    removeitemtable(index) {
      console.log(this.product);
      this.product.splice(index, 1);
      // this.searchProductInObject(this.dproducts,index)
    },
    seedetail() {},
    showalldoc() {},
    histable(val, searchcus) {
      console.log(JSON.stringify(val));
      console.log(val.item_code);
      console.log(searchcus);
      console.log(this.typepage);
      //console.log(this.detailcus)
      //this.showDialogItem = true
      let payload = {
        name: this.searchcus,
        item_code: val.item_code,
        page: this.typepage
      };
      this.isLoading = true;
      console.log(payload);
      api.searchSaleByItem(
        payload,
        result => {
          this.isLoading = false;
          console.log(result.data);
          console.log(result.data.length);
          this.showDialogItem = true;
          this.dataproductItem = result.data;
        },
        error => {
          this.isLoading = false;
          console.log(JSON.stringify("มันเสียนะ", error));
          alertify.error("ข้อมูล สินค้าเกิดข้อผิดพลาด");
        }
      );
    },
    showhisdetail(val) {
      console.log(JSON.stringify(val));
      var itemshow = {
        item_id: val.id,
        item_code: val.item_code,
        bar_code: val.bar_code,
        item_name: val.item_name,
        unit_code: val.unit_code,
        doc_date: val.doc_date,
        qty: 1,
        name: val.name,
        prices: val.sale_price_1,
        sale_price_1: val.sale_price_1,
        sale_price_2: val.sale_price_2,
        discount_word: "0",
        discount_amount: 0,
        item_amounts: val.sale_price_1 * 1,
        item_description: "",
        packing_rate_1: parseInt(val.rate_1),
        is_cancel: 0
      };
      console.log(itemshow);
      this.dproducts.push(itemshow);
      //close modal
      this.showDialogItem = false;
      alertify.success("เพิ่มข้อมูลสินค้า " + val.item_name);
      //this.keywordproduct = ''
      //console.log(itemshow)
    },
    calEachPrice(val) {
      val.qty = parseInt(val.qty);
      console.log(val);
      let eachPriceNoDiscount = val.price;
        for (let i = 0; i < val.discount_word.length; i++) {
          if (val.discount_word[i] == "%" || val.discount_word[i] == ",") {
            val.item_amount = this.calDiscountEachPrice(
              eachPriceNoDiscount,
              val.discount_word
            );
            console.log(JSON.stringify(val.item_amount));
            val.item_amount=parseFloat(val.item_amount*val.qty);
            val.item_amount=parseFloat(val.item_amount.toFixed(2));
            console.log(JSON.stringify(val.item_amount));
            val.discount_amount=parseFloat((eachPriceNoDiscount*val.qty)-val.item_amount);
            val.discount_amount=parseFloat(val.discount_amount.toFixed(2));
            console.log(JSON.stringify("ส่วนลด"+val.discount_amount));
            console.log(JSON.stringify(eachPriceNoDiscount));
            return;
          }
        }
      if (val.discount_word == "") {
        val.item_amount = eachPriceNoDiscount * val.qty;
        return eachPriceNoDiscount;
      } else {
        val.item_amount =
          (eachPriceNoDiscount - parseInt(val.discount_word)) * val.qty;
        return;
      }
    },
    calEachPriceinvoice(val) {
      val.qty = parseInt(val.qty);
      var discount_amount = val.amount;
      console.log(val.discount_word_sub);
      let eachPriceNoDiscount = val.qty * val.price;
      for (let i = 0; i < val.discount_word_sub.length; i++) {
        if (
          val.discount_word_sub[i] == "%" ||
          val.discount_word_sub[i] == ","
        ) {
          val.amount = this.calDiscountEachPrice(
            eachPriceNoDiscount,
            val.discount_word_sub
          );
          console.log(eachPriceNoDiscount);
          val.discount_amount_sub = eachPriceNoDiscount - val.amount;

          return;
        }
      }
      console.log(JSON.stringify(eachPriceNoDiscount));

      if (val.discount_word_sub == "") {
        val.amount = eachPriceNoDiscount;
        return eachPriceNoDiscount;
      } else {
        val.discount_amount_sub = parseInt(val.discount_word_sub);
        val.amount = eachPriceNoDiscount - parseInt(val.discount_word_sub);
        return;
      }
    },
    calDiscountEachPrice(eachPrice, discount_word) {
      //let discountCaled
      console.log("test");
      let percentDiscount;
      let discountedPrice;
      let bahtDiscount;
      let discountArray;
      let mixDiscount;
      let mixPrice = eachPrice;
      //
      if (discount_word.includes(",") == false) {
        for (let i = 0; i < discount_word.length; i++) {
          if (discount_word[i] == "%") {
            console.log(JSON.stringify(discount_word));
            console.log(JSON.stringify(discount_word.replace("%", "")));
            let floatPercent = parseFloat(discount_word.replace("%", ""));
            percentDiscount = parseFloat(parseFloat(floatPercent / 100.0));
            console.log(JSON.stringify(percentDiscount));
            discountedPrice = eachPrice - eachPrice * percentDiscount;
            console.log(JSON.stringify(discountedPrice));
            return parseFloat(discountedPrice);
          }
        }
      }
      if (discount_word.includes(",") == true) {
        discountArray = discount_word.split(",");
        console.log(JSON.stringify(discountArray));
        for (let i = 0; i < discountArray.length; i++) {
          let pToken = [];

          for (let j = 0; j < discountArray[i].length; j++) {
            console.log(JSON.stringify(discountArray[i]));
            let str = discountArray[i];
            console.log(JSON.stringify(str[j]));
            if (str[j] == "%") {
              mixDiscount = parseFloat(str.replace("%", "")) / 100.0;
              console.log(JSON.stringify(mixDiscount));
              mixPrice = mixPrice - mixPrice * mixDiscount;
              console.log(JSON.stringify(mixPrice));
              pToken[i] = 1;
            }
          }
          if (pToken[i] != 1) {
            mixDiscount = parseFloat(discountArray[i]);
            mixPrice = mixPrice - mixDiscount;
            console.log(JSON.stringify(mixPrice));
          }
        }
        return parseFloat(mixPrice);
      }
    }
  },
  computed: {},
  mounted() {}
};
</script>
