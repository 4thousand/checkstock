<template>
  <div style="width:100%">
    <md-card
      v-for="(val,index) in searched"
      :key="index"
      class="md-layout-item md-size-100 md-small-size-100"
    >
      <div class="tables" style="width:100%">
        <md-card-actions>
          <md-button style="width:10%">{{val.item_code}}</md-button>
          <md-button style="width:24%;    height: auto;
      ">
            <div
              style="width:100%;white-space: normal;word-wrap:  text-align-last: left; break-word;      text-align: left;  text-indent: 20px;display: inline-block;height:auto;"
            >{{val.item_name}}</div>
          </md-button>
          <md-button style="width:5%">
            <span>{{val.unit_code}}</span>
          </md-button>
          <md-button style="width:5%">
            <span>{{val.qty}}</span>
          </md-button>
          <md-button style="width:5%">
            <span>{{val.price}}</span>
          </md-button>
          <md-button style="width:5%">{{val.discount_word_sub}}</md-button>
          <md-button style="width:5%">{{val.amount}} บาท</md-button>
          <md-button style="min-width:5%;" @click="testtable(val)">
            <md-icon style="width: 5%;float: right;">edit</md-icon>
          </md-button>
          <md-button style="min-width: 5%" class="md-mini" @click="removeitemtable(index)">
            <md-icon style="width:5%;float: right;">delete</md-icon>
          </md-button>
          <md-button style="min-width: 5%" class="md-mini" @click="histable(val)">
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

                <md-button style="min-width: 5%" class="md-mini" @click="histable(val)">
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
                    <md-input
                      v-model="keywordproduct"
                    ></md-input>
                  </md-field>
                  <div class="table-responsive" style="overflow-y: auto;">
                    <table class="table table-hover">
                      <thead align="center">
                        <tr>
                          <!--<th style=''>client_id</th>-->
                          <th style="white-space: nowrap;">ลำดับ</th>
                          <th style="overflow:auto;white-space: nowrap;">วันที่เอกสาร</th>
                          <th style="white-space: nowrap;">เลขที่เอกสาร</th>
                          <th style="white-space: nowrap;">รหัสสินค้า</th>
                          <th style="white-space: nowrap;">ชื่อสินค้า</th>
                          <th style="white-space: nowrap;">หน่วยนับ</th>
                          <th style="white-space: nowrap;">จำนวน</th>
                          <th style="white-space: nowrap;">ราคา/หน่วย</th>
                          <th style="white-space: nowrap;">ส่วนลด</th>
                          <th style="overflow:auto;white-space: nowrap;">ลูกหนี้</th>
                        </tr>
                      </thead>
                      <tbody v-for="(val,index) in dataproductItem" :key="index" id="">
                        <tr style="text-align:center;cursor:pointer">
                          <td @click="showhisdetail(val)">{{index+1}}</td>
                          <td @click="showhisdetail(val)">{{val.doc_date}}</td>
                          <td @click="showhisdetail(val)">{{val.doc_no}}</td>
                          <td @click="showhisdetail(val)">{{val.item_code}}</td>
                          <td @click="showhisdetail(val)">{{val.item_name}}</td>
                          <td @click="showhisdetail(val)">{{val.unit_code}}</td>
                          <td @click="showhisdetail(val)">{{val.qty}}</td>
                          <td @click="showhisdetail(val)">{{val.price}}</td>
                          <td @click="showhisdetail(val)">{{val.discount_word}}</td>
                          <td @click="showhisdetail(val)">{{val.name}}</td>
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

  </div>
</template>


<script>
import Vue from 'vue';
import api from "../../service/service.js"
import { Money } from "v-money";
export default {
  name: "itemtable",
  props: {
    removeitemtable: Function,
    parentData: [],
    stringProp: [],
    searched: Array
  },
  data() {
    return {
      isLoading: false,
      dataproductItem: [],
      showDialogItem: false,
      dproducts: [],
    };
  },
  methods: {
    seedetail() {},
    showalldoc() {},
    histable(val) {
          console.log(JSON.stringify(val))
          console.log(val.item_code)
          this.showDialogItem = true
          let payload = {
              item_code: val.item_code
              //item_code: ""
          }
          this.isLoading = true
          console.log(payload)
          api.searchSaleByItem(payload,
              result => {
                  this.isLoading = false
                  console.log(result.data)
                  console.log(result.data.length)
                  this.showDialogItem = true
                  this.dataproductItem = result.data
              },
              error => {
                  this.isLoading = false
                  console.log(JSON.stringify("มันเสียนะ",error))
                  alertify.error('ข้อมูล สินค้าเกิดข้อผิดพลาด');
              })
      },
      showhisdetail(val) {
          console.log(JSON.stringify(val))
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
                  discount_word: '0',
                  discount_amount: 0,
                  item_amounts: val.sale_price_1 * 1,
                  item_description: "",
                  packing_rate_1: parseInt(val.rate_1),
                  is_cancel: 0
              }
              console.log(itemshow)
              this.dproducts.push(itemshow)
              //close modal
              this.showDialogItem = false
              alertify.success('เพิ่มข้อมูลสินค้า ' + val.item_name);
          //this.keywordproduct = ''
          //console.log(itemshow)
      },
  },
  mounted() {}
};
</script>
