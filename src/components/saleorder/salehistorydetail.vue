<template>
  <div ref="testDiv" class="quotation">
    <loading :active.sync="isLoading" :can-cancel="true" :is-full-page="fullPage"></loading>

    <div ref="testDiv" class="fluid-container">
      <div>
        <div class="container-fluid">
          <span class="md-title"></span>
          <md-steppers :md-active-step.sync="active" md-linear>
            <md-step
              id="first"
              md-label="ข้อมูลสินค้า"
              md-description="Optional"
              :md-done.sync="first"
            >
              <md-card-content>
                <div class="md-layout md-gutter">
                  <div
                    class="md-layout-item md-size-10 md-small-size-100"
                    style="text-align:right;"
                  >
                    <!-- <md-button style="position: relative;top: 50%;transform: translateY(-50%);" class="md-raised md-primary"><span>ค้นหา</span> </md-button> -->
                  </div>
                  <div class="md-layout-item md-size-40 md-small-size-100">
                    <span class="md-title sub">ประเภทการขายสินค้า</span>
                    <md-field>
                      <md-select
                        :disabled="docnoid>0"
                        @input="mockDocNo(),changePriceType()"
                        v-model="billtype"
                        name="country"
                        id="country"
                        placeholder="กรุณาเลือก"
                      >
                        <md-option value="0">สินค้าเงินสด</md-option>
                        <md-option value="1">สินค้าเงินเชื่อ</md-option>
                      </md-select>
                    </md-field>
                  </div>

                  <!-- <div class="md-layout-item md-size-5 md-xsmall-size-100">
                  </div>-->
                  <div
                    id="notop_mobile"
                    style="position: relative; top: 25px;"
                    class="md-layout-item md-size-40 md-small-size-100"
                  >
                    <md-field>
                      <label>เลขที่ใบขายสินค้า/เลขที่ใบกำกับภาษี</label>
                      <md-input v-if="docnoid>0" disabled v-model="docno"></md-input>
                      <md-input v-if="docnoid==0" disabled v-model="mockdocno"></md-input>
                    </md-field>
                  </div>
                </div>
                <!--docno mockdocno-->
                <div class="md-layout md-gutter">
                  <div class="md-layout-item md-size-10 md-small-size-100"></div>
                  <!-- <div
                    id="notop_mobile"
                    style="position: relative; top: 25px;"
                    class="md-layout-item md-size-50 md-small-size-100"
                  >
                    <md-field>
                      <label>เลขที่ใบกำกับภาษี</label>
                      <md-input disabled v-model="mockdocno"></md-input>
                    </md-field>
                  </div>-->
                  <div class="md-layout-item md-size-40 md-small-size-100">
                    <span class="md-title sub">ประเภทภาษี</span>
                    <md-field>
                      <md-select
                        name="country"
                        v-model="taxtype"
                        id="country"
                        placeholder="ประเภทภาษี"
                      >
                        <md-option value="0">ภาษีแยกนอก</md-option>
                        <md-option value="1">ภาษีรวมใน</md-option>
                        <md-option value="2">ภาษีอัตราศูนย์</md-option>
                      </md-select>
                    </md-field>
                  </div>
                  <div
                    id="changetop_mobile"
                    style="position:relative"
                    class="md-layout-item md-size-50 md-small-size-100"
                  >
                    <span class="md-title sub">วันที่ออก</span>
                    <div style="position:relative;height:100%;">
                      <md-icon
                        style="float:left;position:relative;top:28px;margin-right:10px;"
                      >calendar_today</md-icon>
                      <datepicker
                        v-model="datenow_datepicker"
                        input-class="form-control tc"
                        style="position:relative;top:15px;"
                        :language="languages[language]"
                        format="d MMMM yyyy"
                        :disabled="docnoid>0"
                      ></datepicker>
                    </div>
                  </div>
                </div>
                <div class="md-layout md-gutter md-title" style="    margin-top: 25px;">
                  <div class="md-layout-item md-size-10 md-small-size-100"></div>
                  <div class="md-layout-item md-size-30 md-small-size-90">
                    <md-field>
                      <md-icon>account_circle</md-icon>
                      <label>รหัสลูกค้า</label>
                      <md-input
                        required
                        :disabled="docnoid>0"
                        @keyup.enter="fsearchcus"
                        v-model="searchcus"
                      ></md-input>

                      <md-avatar style="position:absolute;right:0;top:10px">
                        <md-icon>info</md-icon>
                        <md-tooltip md-direction="top">
                          <md-icon style="color:white;">keyboard</md-icon>รหัสลูกค้า หรือ ชื่อ + Enter
                        </md-tooltip>
                      </md-avatar>
                      <!-- <md-icon>info</md-icon> -->
                    </md-field>
                  </div>
                  <div
                    class="md-size-5 md-small-size-5"
                    style="margin-left:-15px;margin-right:35px"
                  >
                    <md-button
                      @click="fsearchcus"
                      class="md-icon-button md-raised md productadd"
                      :disabled="docnoid>0"
                    >
                      <md-icon>add</md-icon>
                    </md-button>
                  </div>
                  <div
                    style="position: relative; top: 4px;"
                    class="md-layout-item md-size-40 md-small-size-100"
                  >
                    <md-field>
                      <label>ชื่อลูกค้า</label>
                      <md-input disabled v-model="detailcus"></md-input>
                    </md-field>
                  </div>
                </div>
                <!-- table -->
                <div class="md-layout md-gutter">
                  <md-card class="md-layout-item md-size-100 md-small-size-100 tablesale">
                    <md-card-header
                      style="    padding-top: 16px;
                                  padding-right: 16px;
                                  padding-bottom: 2px;
                                  padding-left: 16px;"
                    >
                      <md-card-header-text>
                        <div class="md-toolbar-section-start">
                          <div style="min-height:42px;position:relative" class="md-title">
                            <div
                              style="float:left;position:relative;top:13px;margin-right:10px"
                            >ข้อมูลสินค้า</div>

                            <div class="md-size-40 md-small-size-100" style="float:left;">
                              <md-field>
                                <label>เพิ่มสินค้า</label>
                                <md-input
                                  ref="addproduct"
                                  v-model="keywordproduct"
                                  @keyup.enter="addproduct"
                                ></md-input>
                              </md-field>
                              <md-avatar style="position: absolute; top: 15px; left: 273px;">
                                <md-icon style="color:grey">info</md-icon>
                                <md-tooltip md-direction="top">
                                  <md-icon style="color:white;">keyboard</md-icon>รหัสสินค้า หรือ ชื่อสินค้า + Enter
                                </md-tooltip>
                              </md-avatar>
                            </div>

                            <md-button
                              @click="addproduct"
                              class="md-icon-button md-raised md productadd"
                            >
                              <md-icon>add</md-icon>
                            </md-button>
                          </div>
                        </div>
                      </md-card-header-text>
                    </md-card-header>
                    <div class="tables">
                      <md-card-actions>
                        <md-button style="width:10%">รหัสสินค้า</md-button>
                        <md-button style="width:24%">ชื่อสินค้า</md-button>
                        <md-button style="width:5%">หน่วยนับ</md-button>
                        <md-button style="width:5%">จำนวน</md-button>
                        <md-button style="width:5%">ราคา/หน่วย</md-button>
                        <md-button style="width:5%">ส่วนลด</md-button>
                        <md-button style="width:5%">จำนวนเงิน</md-button>
                      </md-card-actions>
                    </div>
                  </md-card>
                  <itemtable :searched="searched" :searchcus="searchcus" :removeitemtable="removeitemtable"></itemtable>
                  <!-- <md-card
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
                        <md-button
                          style="min-width: 5%"
                          class="md-mini"
                          @click="removeitemtable(index)"
                        >
                          <md-icon style="width:5%;float: right;">delete</md-icon>
                        </md-button>
                      </md-card-actions>
                    </div>
                    <div class="tables2">
                      <div class="carddiscount">{{val.discount_word}}</div>
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
                              <md-menu-item @click="showtable=true" style="min-width: 30px;">
                                <md-icon style="width:10px;float: right;">delete</md-icon>delete
                              </md-menu-item>
                            </md-menu-content>
                          </md-menu>
                          <div style="text-align:center">
                            {{val.amount}}
                            <br>บาท
                          </div>
                        </div>
                      </md-card-content>
                    </div>
                  </md-card>-->
                </div>
                <!-- table  -->
                <md-dialog :md-active.sync="showtable">
                  <md-dialog-content class="modal-content">
                    <div>
                      <h4 style="margin-top:-20px">ข้อมูลสินค้า</h4>
                    </div>
                    <div class="modal-body" style="text-align:left">
                      <div class="col-md-12 col-12">
                        <div class="row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> รหัสสินค้า :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input
                                class="form-control"
                                v-model="itemtable.item_code"
                                placeholder="รหัสสินค้า"
                                disabled
                              >
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> ชื่อสินค้า :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input class="form-control" disabled v-model="itemtable.item_name">
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> หน่วยนับ :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <!-- <p>
                              <input
                                id="bank_no"
                                class="form-control"
                                v-model="itemtable.unit_code"
                                disabled
                              >
                            </p>
                            <div @click="searchunticode(item)">

                               <md-icon class="search_unitcode">arrow_drop_down</md-icon>
                            </div>-->
                            <md-field>
                              <md-select
                                name="country"
                                v-model="itemtable.unit_code"
                                id="country"
                                @click="searchunticode(item)"
                                placeholder="หน่วยนับ"
                              >
                                <md-option
                                  v-for="(uni,index) in unitcode_obj"
                                  :key="index"
                                  :value="uni.unit_code"
                                >{{uni.unit_code}}</md-option>
                              </md-select>
                            </md-field>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> จำนวน :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <button class="increment-button md-primary" @click="decrement()">−</button>

                            <input
                              class="form-control"
                              style="width:70%;float:left"
                              v-model.number="itemtable.qty"
                              @keydown.up.prevent="increment"
                              @keydown.down.prevent="decrement"
                            >
                            <button class="increment-button" @click="increment()">+</button>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> ราคา/หน่วย :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <money
                                id="credit_price"
                                class="form-control"
                                v-bind="money"
                                v-model="itemtable.prices"
                                disabled
                              ></money>
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> ส่วนลด :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input
                                id="credit_price"
                                class="form-control"
                                v-model="itemtable.discount_word"
                              >
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="row">
                          <p class="method-set col-lg-4 col-md-12 col-12" style="float:left">
                            <span style="color:red">*</span> จำนวนเงิน :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <money
                                id="credit_price"
                                class="form-control"
                                v-bind="money"
                                v-model="itemtable.item_amounts"
                                disabled
                              ></money>
                            </p>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12 col-12">
                        <div class="row">
                          <p class="method-set col-lg-4 col-md-12 col-12">หมายเหตุ :</p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <textarea
                                id="cr_notice"
                                class="form-control"
                                rows="2"
                                ref="crNotice"
                                @keyup.enter="getFocus('submit_cr')"
                                @keyup.down="getFocus('submit_cr')"
                                @keyup.up="getFocus('cr_charge')"
                              ></textarea>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button
                        id="submit_cr"
                        @click="createCreditCard(),resetCredit(),checktotal(),showCredit = false"
                        @keyup.up="getFocus('cr_notice')"
                        @keyup.right="getFocus('cancel_cr')"
                        ref="crButton"
                        class="btn btn-success"
                        style="margin-top:25px"
                      >
                        <span>แก้ไข</span>
                      </button>
                      <button
                        id="cancel_cr"
                        style="margin-top:25px"
                        class="btn btn-danger"
                        @click="showtable = false"
                        @keyup.up="getFocus('cr_notice')"
                        @keyup.left="getFocus('submit_cr')"
                      >ยกเลิก</button>
                    </div>
                  </md-dialog-content>
                </md-dialog>
                <div style="margin-top:15px" class="md-layout md-gutter">
                  <div
                    class="md-layout-item md-size-80 md-xsmall-size-100"
                    style="text-align:right;"
                  >
                    <span class="md-title subnotop">รวมมูลค่าสินค้า</span>
                  </div>

                  <div
                    class="md-layout-item md-size-10 md-xsmall-size-100 res_mobile"
                    style="text-align:right;"
                  >
                    <span class="md-title subnotop">{{ convertmoney(totalprice) }}</span>
                  </div>
                  <div
                    class="md-layout-item md-size-10 md-xsmall-size-100"
                    style="text-align:center;"
                  >
                    <span class="md-title subnotop" style="left:10px">บาท</span>
                  </div>
                </div>
                <div class="md-layout md-gutter">
                  <div
                    class="md-layout-item md-size-80 md-xsmall-size-100"
                    style="text-align:right;"
                  >
                    <span class="md-title subnotop">มูลค่าสินค้ายกเว้นภาษี</span>
                  </div>

                  <div
                    class="md-layout-item md-size-10 md-xsmall-size-100"
                    style="text-align:right;"
                  >
                    <span class="md-title subnotop">0</span>
                  </div>
                  <div
                    class="md-layout-item md-size-10 md-xsmall-size-100"
                    style="text-align:center;"
                  >
                    <span class="md-title subnotop" style="left:10px">บาท</span>
                  </div>
                </div>

                <div class="md-layout md-gutter">
                  <div
                    class="md-layout-item md-size-80 md-xsmall-size-100"
                    style="text-align:right;"
                  >
                    <span class="md-title subnotop">ส่วนลด</span>
                  </div>

                  <div
                    class="md-layout-item md-size-10 md-xsmall-size-100"
                    style="text-align:right;"
                  >
                    <span class="md-title subnotop">
                      <input
                        ref="discount"
                        v-model.number="caldiscount"
                        style="width:100%;text-align:right;"
                        type="text"
                      >
                    </span>
                  </div>

                  <div class="md-layout-item md-size-10 md-xsmall-size-100">
                    <md-button
                      style="width:5% !important"
                      @click="calbathordiscount"
                      v-show="percal"
                      class="md-raised md-primary"
                    >%</md-button>
                    <md-button
                      style="width:5% !important"
                      @click="calbathordiscount"
                      v-show="!percal"
                      class="md-raised md-primary"
                    >บาท</md-button>
                  </div>
                </div>

                <div class="md-layout md-gutter">
                  <div
                    class="md-layout-item md-size-80 md-xsmall-size-100"
                    style="text-align:right;"
                  >
                    <span class="md-title subnotop">ภาษีมูลค่าเพิ่ม</span>
                  </div>

                  <div
                    class="md-layout-item md-size-10 md-xsmall-size-100"
                    style="text-align:right;"
                  >
                    <span class="md-title subnotop">{{ convertmoney(dif_fee) }}</span>
                  </div>

                  <div
                    class="md-layout-item md-size-10 md-xsmall-size-100"
                    style="text-align:center;"
                  >
                    <span class="md-title subnotop" style="left:10px">บาท</span>
                  </div>
                </div>

                <div class="md-layout md-gutter">
                  <div
                    class="md-layout-item md-size-80 md-xsmall-size-100"
                    style="text-align:right;"
                  >
                    <span class="md-title subnotop">มูลค่ารวมภาษี</span>
                  </div>

                  <div
                    class="md-layout-item md-size-10 md-xsmall-size-100"
                    style="text-align:right;"
                  >
                    <span class="md-title subnotop">{{ convertmoney(cal_totalprice) }}</span>
                  </div>

                  <div
                    class="md-layout-item md-size-10 md-xsmall-size-100"
                    style="text-align:center;"
                  >
                    <span class="md-title subnotop" style="left:10px">บาท</span>
                  </div>
                </div>

                <div class="md-layout md-gutter">
                  <div
                    class="md-layout-item md-size-80 md-xsmall-size-100"
                    style="text-align:right;"
                  >
                    <span class="md-title subnotop">มูลค่าสุทธิ</span>
                  </div>

                  <div
                    class="md-layout-item md-size-10 md-xsmall-size-100"
                    style="text-align:right;"
                  >
                    <span class="md-title subnotop">{{ convertmoney(cal_totalprice) }}</span>
                  </div>

                  <div
                    class="md-layout-item md-size-10 md-xsmall-size-100"
                    style="text-align:center;"
                  >
                    <span class="md-title subnotop" style="left:10px">บาท</span>
                  </div>
                </div>
              </md-card-content>
              <!--  -->
            </md-step>
          </md-steppers>
        </div>
      </div>

      <!-- showDialogcus -->
      <div>
        <md-dialog :md-active.sync="showDialogcus">
          <md-dialog-title>เลือกลูกค้า</md-dialog-title>
          <md-tabs md-dynamic-height>
            <md-tab md-label>
              <md-field>
                <md-input
                  v-model="searchcus"
                  @keyup="searchCustomerRT"
                  @keydown="searchCustomerRT"
                  @input="searchCustomerRT"
                ></md-input>
              </md-field>
              <div class="table-responsive" style="overflow-y: auto;">
                <table class="table table-hover">
                  <thead align="center">
                    <tr>
                      <!--                                <th style=''>client_id</th>-->
                      <th>ลำดับ</th>
                      <th id="colorselectorder">รหัสลูกค้า</th>
                      <th id="colorselectgroup">ชื่อลูกค้า</th>
                      <th>ที่อยู่</th>
                    </tr>
                  </thead>
                  <tbody id="valuetable">
                    <tr
                      @click="C_customer(val)"
                      v-for="(val,index) in detailcusall"
                      :key="index"
                      style="text-align:center;cursor:pointer"
                    >
                      <td>{{index+1}}</td>
                      <td>{{val.code}}</td>
                      <td>{{val.name}}</td>
                      <td>{{val.address}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </md-tab>
          </md-tabs>

          <md-dialog-actions>
            <md-button class="md-primary" @click="showDialogcus = false">Close</md-button>
            <!-- <md-button class="md-primary" @click="showDialogcus = false">Save</md-button> -->
          </md-dialog-actions>
        </md-dialog>
      </div>
      <!-- showDialogcus -->
      <!-- -->
      <div>
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
                      <!--<th style=''>client_id</th>-->
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
                    <!-- <tr >
                      <td  colspan="10" >
                       <div :class="'hover'+index" style="text-align:right;visibility:hidden;height:0;transition:all 0.5s cubic-bezier(0.47, 0.46, 0, 1.02) 0s;"  v-for="(value,index2) in stockall" >
                       คลังสินค้า : {{val.stk_location[index2].wh_code}} ชั้นเก็บ : {{val.stk_location[index2].shelf_code}} จำนวน : {{val.stk_location[index2].qty}} <br>
                      </div></td>
                    </tr>-->
                  </tbody>
                </table>
              </div>
            </md-tab>
          </md-tabs>

          <md-dialog-actions>
            <md-button class="md-primary" @click="showDialogproduct = false">Close</md-button>
            <!-- <md-button class="md-primary" @click="showDialogcus = false">Save</md-button> -->
          </md-dialog-actions>
        </md-dialog>
      </div>
      <!-- -->
      <!-- search sale-->
      <div>
        <md-dialog :md-active.sync="searchsale">
          <md-dialog-title>เลือกพนักงานขาย</md-dialog-title>
          <md-tabs md-dynamic-height>
            <md-tab md-label>
              <div class="table-responsive" style="overflow-y: auto;">
                <table class="table table-hover">
                  <thead align="center">
                    <tr>
                      <th>ลำดับ</th>
                      <th id="colorselectorder">รหัสพนักงาน</th>
                      <th id="colorselectgroup">ชื่อพนักงาน</th>
                    </tr>
                  </thead>
                  <tbody id="valuetable">
                    <tr
                      @click="selectcus_step2(val)"
                      v-for="(val,index) in searchsaleobj"
                      :key="index"
                      style="text-align:center;cursor:pointer"
                    >
                      <td>{{index+1}}</td>
                      <td>{{val.sale_code}}</td>
                      <td>{{val.sale_name}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </md-tab>
          </md-tabs>

          <md-dialog-actions>
            <md-button class="md-primary" @click="searchsale = false">Close</md-button>
          </md-dialog-actions>
        </md-dialog>
      </div>
      <!-- search sale -->
      <!-- search depart -->
      <div>
        <md-dialog :md-active.sync="searchdepart">
          <md-dialog-title>เลือกแผนก</md-dialog-title>
          <md-tabs md-dynamic-height>
            <md-tab md-label>
              <div class="table-responsive" style="overflow-y: auto;">
                <table class="table table-hover">
                  <thead align="center">
                    <tr>
                      <th>ลำดับ</th>
                      <th id="colorselectorder">รหัสแผนก</th>
                      <th id="colorselectgroup">ชื่อแผนก</th>
                    </tr>
                  </thead>
                  <tbody id="valuetable">
                    <tr
                      @click="selectdepart_step2(val)"
                      v-for="(val,index) in objdepart"
                      :key="index"
                      style="text-align:center;cursor:pointer"
                    >
                      <td>{{index+1}}</td>
                      <td>{{val.code}}</td>
                      <td>{{val.name}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </md-tab>
          </md-tabs>

          <md-dialog-actions>
            <md-button class="md-primary" @click="searchdepart = false">Close</md-button>
          </md-dialog-actions>
        </md-dialog>
      </div>
      <!-- search depart -->
      <!-- search project -->
      <div>
        <md-dialog :md-active.sync="searchproject">
          <md-dialog-title>เลือกโครงการ</md-dialog-title>
          <md-tabs md-dynamic-height>
            <md-tab md-label>
              <div class="table-responsive" style="overflow-y: auto;">
                <table class="table table-hover">
                  <thead align="center">
                    <tr>
                      <th>ลำดับ</th>
                      <th id="colorselectorder">รหัสโครงการ</th>
                      <th id="colorselectgroup">ชื่อโครงการ</th>
                    </tr>
                  </thead>
                  <tbody id="valuetable">
                    <tr
                      @click="selectproject_step2(val)"
                      v-for="(val,index) in objproject"
                      :key="index"
                      style="text-align:center;cursor:pointer"
                    >
                      <td>{{index+1}}</td>
                      <td>{{val.code}}</td>
                      <td>{{val.name}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </md-tab>
          </md-tabs>
          <md-dialog-actions>
            <md-button class="md-primary" @click="searchproject = false">Close</md-button>
          </md-dialog-actions>
        </md-dialog>
      </div>
      <!-- search project -->
      <!-- search  Allocate-->
      <div>
        <md-dialog :md-active.sync="searchAllocate_m">
          <md-dialog-title>เลือกการจัดสรร</md-dialog-title>
          <md-tabs md-dynamic-height>
            <md-tab md-label>
              <div class="table-responsive" style="overflow-y: auto;">
                <table class="table table-hover">
                  <thead align="center">
                    <tr>
                      <th>ลำดับ</th>
                      <th id="colorselectorder">รหัสการจัดสรร</th>
                      <th id="colorselectgroup">ชื่อการจัดสรร</th>
                    </tr>
                  </thead>
                  <tbody id="valuetable">
                    <tr
                      @click="selectAllocate_step2(val)"
                      v-for="(val,index) in objAllocate"
                      :key="index"
                      style="text-align:center;cursor:pointer"
                    >
                      <td>{{index+1}}</td>
                      <td>{{val.code}}</td>
                      <td>{{val.name}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </md-tab>
          </md-tabs>

          <md-dialog-actions>
            <md-button class="md-primary" @click="searchAllocate_m = false">Close</md-button>
          </md-dialog-actions>
        </md-dialog>
      </div>
      <!-- search  Allocate-->
      <!-- search unitcode -->
      <div>
        <md-dialog :md-active.sync="searchunitcode_m">
          <md-dialog-title>เปลี่ยน หน่วยนับ</md-dialog-title>
          <md-tabs md-dynamic-height>
            <md-tab md-label>
              <div class="table-responsive" style="overflow-y: auto;">
                <table class="table table-hover">
                  <thead align="center">
                    <tr>
                      <th>ลำดับ</th>
                      <th id="colorselectorder">หน่วยนับ</th>
                      <th v-show="billtype == 0" id="colorselectorder">ราคา(เงินสด)</th>
                      <th v-show="billtype == 1" id="colorselectorder">ราคา(เงินเชื่อ)</th>
                    </tr>
                  </thead>
                  <tbody id="valuetable">
                    <tr
                      v-for="(val,index) in unitcode_obj"
                      :key="index"
                      @click="selectunitcode_step2(val)"
                      style="text-align:center;cursor:pointer"
                    >
                      <td>{{index+1}}</td>
                      <td>{{val.unit_code}}</td>
                      <td v-show="billtype == 0">{{ val.sale_price_1 }}</td>
                      <td v-show="billtype == 1">{{ val.sale_price_2 }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </md-tab>
          </md-tabs>

          <md-dialog-actions>
            <md-button class="md-primary" @click="searchunitcode_m = false">Close</md-button>
          </md-dialog-actions>
        </md-dialog>
      </div>
      <!-- search unitcode -->
    </div>
  </div>
</template>

<script src="../../js/salehistory.js">
</script>

<style  src="./salehistorydetail.css">
</style>
