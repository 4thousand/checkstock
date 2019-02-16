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
                    <div class="tables" style="width:100%;">
                      <md-card-actions style="justify-content:end;">
                        <md-button style="width:10%">รหัสสินค้า</md-button>
                        <md-button style="width:20%">ชื่อสินค้า</md-button>
                        <md-button style="    width: 5%;">คลัง</md-button>
                        <md-button style="   width: 5%;">หน่วยนับ</md-button>
                        <md-button style="     min-width: 5%;">จำนวน</md-button>
                        <md-button style="   width: 5%;">ราคา/หน่วย</md-button>
                        <md-button style="   min-width: 5%;">ส่วนลด</md-button>
                        <md-button style="    width: 5%;">จำนวนเงิน</md-button>
                      </md-card-actions>
                    </div>
                  </md-card>
                  <itemtable :searched="searched" :product="dproducts" :typepage="'IV'"></itemtable>
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

                <!-- หาคลัง -->
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

              <md-button
                style="float:right;"
                @click="setDone('first', 'second')"
                class="md-raised md-primary"
              >
                <span>ถัดไป</span>
              </md-button>
              <!--  -->
            </md-step>
            <md-step
              id="second"
              md-label="วิธีการชำระเงิน"
              :md-error="secondStepError"
              :md-done.sync="second"
            >
              <!--  -->
              <div style="display:inline-block;width: 100%;">
                <form style="justify-content: center;">
                  <div>
                    <div>
                      <div class="row md-layout-item">
                        <div class="col-12 col-md-7 col-lg-8 big-margin" style="float:left">
                          <div class="card">
                            <div class="card-header deposit-header">
                              <span>วิธีการชำระเงิน</span>
                            </div>
                            <div class="deposit-border">
                              <!-- <div class="row">
                                <div class="col-md-12 col-12">
                                  <div class="form-group row">
                                    <p class="article-set col-md-3 col-12">
                                      <span style="color:red">*</span> ประเภทภาษี :
                                    </p>
                                    <div class="col-md-8 col-12">
                                      <select id="tax_type" v-model="taxtype" class="form-control">
                                        <option value="0">ภาษีแยกนอก</option>
                                        <option value="1">ภาษีรวมใน</option>
                                        <option value="2">ภาษีอัตราศูนย์</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>-->
                              <h4 class="payment-sub-header information-part col-12">ราคารวม</h4>
                              <div class="row">
                                <div class="col-md-12 col-12">
                                  <div class="form-group row">
                                    <p class="article-set col-md-3 col-12">
                                      <span style="color:red"></span> จำนวนเงิน :
                                    </p>
                                    <div class="col-md-8 col-12">
                                      <money
                                        id="total_pay"
                                        class="form-control"
                                        min="0"
                                        disabled
                                        v-model.number="payment "
                                        v-bind="money"
                                        @keypress="isNumber(event)"
                                        v-on:keyup.native.enter="getFocus('cash_pay')"
                                        v-on:keyup.native.down="getFocus('cash_pay')"
                                      ></money>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <hr class="col-10">
                              <h4 class="payment-sub-header information-part col-12">เงินสด</h4>
                              <div class="row">
                                <div class="col-md-12 col-12">
                                  <div class="form-group row">
                                    <p class="article-set col-md-3 col-12">
                                      <span style="color:red">*</span> จำนวนเงิน :
                                    </p>
                                    <div class="col-md-8 col-12">
                                      <money
                                        id="cash_pay"
                                        class="form-control"
                                        min="0"
                                        v-model.number="cashPayment"
                                        v-bind="money"
                                        @keypress="isNumber(event)"
                                        v-on:keyup.native.enter="getFocus('add_cr')"
                                        v-on:keyup.native.up="getFocus('total_pay')"
                                        v-on:keyup.native.down="getFocus('add_cr')"
                                      ></money>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <h4 class="payment-sub-header information-part col-12">เงินทอน</h4>
                              <div class="row">
                                <div class="col-md-12 col-12">
                                  <div class="form-group row">
                                    <p class="article-set col-md-3 col-12">
                                      <span style="color:red">*</span> จำนวนเงิน :
                                    </p>
                                    <div class="col-md-8 col-12">{{balance}}</div>
                                  </div>
                                </div>
                              </div>
                              <hr class="col-10">
                              <h4
                                class="payment-sub-header information-part col-12"
                              >บัตรเครดิต/บัตรเดบิต</h4>

                              <!-- v-for -->
                              <div
                                class="col-md-12 col-12"
                                v-for="(val,index) in creditCardList"
                                :key="index"
                              >
                                <div class="form-group row">
                                  <div class="col-lg-12 col-md-12 col-12">
                                    <div class="alert alert-info">
                                      <a
                                        class="close"
                                        data-dismiss="alert"
                                        aria-label="close"
                                        @click="removeCreditCard(index),recallmoney(val)"
                                      >&times;</a>
                                      <a class="edit close">
                                        <i class="material-icons">edit</i>
                                      </a>
                                      <span
                                        class="fontsize"
                                      >เลขบัตร : {{"XXXX-XXXX-XXXX-"+val.credit_card_no}}</span>
                                      <span
                                        class="fontsize"
                                      >จำนวนเงิน :{{convertToBaht(val.amount)+" บาท"}}</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12 col-12" style="text-align:center">
                                <button
                                  id="add_cr"
                                  class="btn btn-primary"
                                  @click="showCredit=true,resetCredit(),isEditCr=false"
                                  @keyup.up="getFocus('cash_pay')"
                                  @keyup.down="getFocus('add_chq')"
                                >
                                  <div class="row">
                                    <i
                                      class="material-icons"
                                      style="padding:5px 5px 5px 10px"
                                    >add_circle_outline</i>
                                    <span style="padding:5px 10px 5px 5px">เพิ่มบัตรเครดิต</span>
                                  </div>
                                </button>
                              </div>

                              <hr class="col-10">
                              <h4 class="payment-sub-header information-part col-12">เช็ค</h4>
                              <!-- v-for -->
                              <div
                                class="col-md-12 col-12"
                                v-for="(val,index) in chqList"
                                :key="index"
                              >
                                <div class="form-group row">
                                  <div class="col-lg-12 col-md-12 col-12">
                                    <div class="alert alert-info">
                                      <a
                                        class="close"
                                        data-dismiss="alert"
                                        aria-label="close"
                                        @click="removeChq(index)"
                                      >&times;</a>
                                      <a class="edit close">
                                        <i
                                          class="material-icons"
                                          @click="showChq=true,isEditChq=true,pullChq(index)"
                                        >edit</i>
                                      </a>
                                      <span class="fontsize">เลขบัตร : {{val.chq_number}}</span>
                                      <span
                                        class="fontsize"
                                      >จำนวนเงิน : {{convertToBaht(val.chq_amount)+" บาท"}}</span>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="col-md-12 col-12" style="text-align:center">
                                <button
                                  id="add_chq"
                                  class="btn btn-primary"
                                  @click="showChq=true,resetChq(),isEditChq=false"
                                  @keyup.down="getFocus('add_b')"
                                  @keyup.up="getFocus('add_cr')"
                                >
                                  <div class="row">
                                    <i
                                      class="material-icons"
                                      style="padding:5px 5px 5px 10px"
                                    >add_circle_outline</i>
                                    <span style="padding:5px 10px 5px 5px">เพิ่มเช็คเงินสด</span>
                                  </div>
                                </button>
                              </div>

                              <hr class="col-10">
                              <h4 class="payment-sub-header information-part col-12">เงินโอน</h4>
                              <!-- v-for -->
                              <div
                                class="col-md-12 col-12"
                                v-for="(val,index) in bankTransList"
                                :key="index"
                              >
                                <div class="form-group row">
                                  <div class="col-lg-12 col-md-12 col-12">
                                    <div class="alert alert-info">
                                      <a
                                        class="close"
                                        data-dismiss="alert"
                                        aria-label="close"
                                        @click="removeBank(index)"
                                      >&times;</a>
                                      <a class="edit close">
                                        <i class="material-icons">edit</i>
                                      </a>
                                      <span class="fontsize">เลขที่บัญชี : {{val.bank_account}}</span>
                                      <span
                                        class="fontsize"
                                      >จำนวนเงิน : {{convertToBaht(val.bank_amount)+" บาท"}}</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12 col-12" style="text-align:center">
                                <button
                                  id="add_bank"
                                  class="btn btn-primary"
                                  @keyup.down="getFocus('add_doc')"
                                  @keyup.up="getFocus('add_chq')"
                                  @click="showBank=true,isEditBank=false,pullBank(index)"
                                >
                                  <div class="row">
                                    <i
                                      class="material-icons"
                                      style="padding:5px 5px 5px 10px"
                                    >add_circle_outline</i>
                                    <span style="padding:5px 10px 5px 5px">เพิ่มเลขเงินโอน</span>
                                  </div>
                                </button>
                              </div>

                              <hr class="col-10">

                              <h4 class="payment-sub-header information-part col-12">พร้อมเพย์</h4>
                              <div
                                class="col-md-12 col-12"
                                v-for="(val,index) in promplaylist"
                                :key="index"
                              >
                                <div class="form-group row">
                                  <div class="col-lg-12 col-md-12 col-12">
                                    <div class="alert alert-info">
                                      <a
                                        class="close"
                                        data-dismiss="alert"
                                        aria-label="close"
                                      >&times;</a>
                                      <a class="edit close">
                                        <i class="material-icons">edit</i>
                                      </a>
                                      <span
                                        class="fontsize"
                                      >เลขบัตร : {{"Phone XX-XXXX-"+val.promplayphone}}</span>
                                      <br>
                                      <span
                                        class="fontsize"
                                      >จำนวนเงิน : {{convertToBaht(val.promplayprice) +" บาท"}}</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12 col-12" style="text-align:center">
                                <button
                                  id="add_bank"
                                  class="btn btn-primary"
                                  @click="setbalance(4),genqrcode()"
                                >
                                  <div class="row">
                                    <i
                                      class="material-icons"
                                      style="padding:5px 5px 5px 10px"
                                    >add_circle_outline</i>
                                    <span style="padding:5px 10px 5px 5px">เพิ่มพร้อมเพย์</span>
                                  </div>
                                </button>
                              </div>

                              <br>
                            </div>
                          </div>
                        </div>

                        <div class="col-12 col-md-5 col-lg-4 big-margin">
                          <div class="card stickydestop" style="position: sticky; top: 0;">
                            <div class="card-header tax-header">
                              <span>สรุปยอดชำระเงิน</span>
                            </div>
                            <div class="tax-border">
                              <div class="row tax-head-part">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <p class="tax-head">อัตราภาษีมูลค่าเพิ่ม :{{taxrate}} %</p>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <p
                                      class="tax-head"
                                    >จำนวนเงินก่อนภาษี :{{ convertToBaht(payment_type) }} บาท</p>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <p
                                      class="tax-head"
                                    >ภาษีมูลค่าเพิ่ม : {{ convertToBaht(cal_VAT) }} บาท</p>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <p
                                      class="tax-summary"
                                    >มูลค่ารวมภาษี :{{ convertToBaht(total_VAT) }} บาท</p>
                                  </div>
                                </div>
                              </div>
                              <div class="row tax-bottom-part">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <p class="tax-head">เงินทอน : {{ convertToBaht(balance) }} บาท</p>
                                  </div>
                                </div>
                              </div>
                              <div class="tax-bottom-part tax-button">
                                <button
                                  id="add_doc"
                                  :disabled="balance!=0||payment==null"
                                  @keyup.left="getFocus('bank_pay')"
                                  @keyup.up="getFocus('bank_pay')"
                                  @click="setDone('second', 'third'),showdocno"
                                  class="btn btn-primary"
                                >
                                  <span>บันทึก</span>
                                </button>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <p
                                      class="tax-head"
                                      style="color:red"
                                      :hidden="(taxtype!=''&&balance>=0)||taxtype==''"
                                    >*ยอดชำระไม่เพียงพอ</p>
                                  </div>
                                </div>
                              </div>
                              <div class="row tax-bottom-part">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <p
                                      class="tax-head"
                                      style="color:red"
                                      :hidden="(feeType!=''&&balance<=0)||feeType==''"
                                    >*ยอดชำระมากเกินไป</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <md-dialog :md-active="showCredit">
                    <md-dialog-content class="modal-content">
                      <div class="modal-header">
                        <h4 style="margin-top:-20px">บัตรเครดิต</h4>
                      </div>
                      <div class="modal-body">
                        <div class="col-md-12 col-12">
                          <div class="row">
                            <p class="method-set col-lg-4 col-md-12 col-12">
                              <span style="color:red">*</span> เลขที่เครดิต :
                            </p>
                            <div class="col-lg-7 col-md-12 col-12">
                              <p>
                                <input
                                  id="cr_no"
                                  class="form-control"
                                  type="text"
                                  v-model.number="creditNumber"
                                  maxlength="4"
                                  v-autofocus
                                  @keypress="isNumber(event)"
                                  @keyup.enter="getFocus('cr_ref_no')"
                                  @keyup.down="getFocus('cr_ref_no')"
                                  placeholder="เลขสี่ตัวท้ายของบัตร"
                                >
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 col-12">
                          <div class="row">
                            <p class="method-set col-lg-4 col-md-12 col-12">
                              <span style="color:red">*</span> เลขที่อนุมัติ :
                            </p>
                            <div class="col-lg-7 col-md-12 col-12">
                              <p>
                                <input
                                  id="cr_ref_no"
                                  class="form-control"
                                  v-model="validateCreditCardNo"
                                  maxlength="6"
                                  @keypress="isNumber(event)"
                                  ref="refNo"
                                  @keyup.enter="getFocus('bank_no')"
                                  @keyup.down="getFocus('bank_no')"
                                  @keyup.up="getFocus('cr_no')"
                                >
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 col-12">
                          <div class="row">
                            <p class="method-set col-lg-4 col-md-12 col-12">
                              <span style="color:red">*</span> รหัสธนาคาร :
                            </p>
                            <div class="col-lg-7 col-md-12 col-12">
                              <p>
                                <input
                                  id="bank_no"
                                  class="form-control"
                                  v-model="creditBank"
                                  @keyup.enter="getFocus('cr_type')"
                                  @keyup.down="getFocus('cr_type')"
                                  @keyup.up="getFocus('cr_ref_no')"
                                >
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 col-12">
                          <div class="row">
                            <p class="method-set col-lg-4 col-md-12 col-12">
                              <span style="color:red">*</span> ประเภทบัตร :
                            </p>
                            <div class="col-lg-7 col-md-12 col-12">
                              <p>
                                <input
                                  id="cr_type"
                                  class="form-control"
                                  v-model="creditType"
                                  @keyup.enter="getFocus('credit_price')"
                                  @keyup.down="getFocus('credit_price')"
                                  @keyup.up="getFocus('bank_no')"
                                >
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 col-12">
                          <div class="row">
                            <p class="method-set col-lg-4 col-md-12 col-12">
                              <span style="color:red">*</span> ยอดเงิน :
                            </p>
                            <div class="col-lg-7 col-md-12 col-12">
                              <p>
                                <money
                                  id="credit_price"
                                  class="form-control"
                                  v-model.number="creditPrice"
                                  v-bind="money"
                                  v-on:keyup.native.enter="getFocus('cr_charge')"
                                  v-on:keyup.native.down="getFocus('cr_charge')"
                                  v-on:keyup.native.up="getFocus('cr_type')"
                                ></money>
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 col-12">
                          <div class="row">
                            <p class="method-set col-lg-4 col-md-12 col-12">ค่า Charge :</p>
                            <div class="col-lg-7 col-md-12 col-12">
                              <p>
                                <input
                                  id="cr_charge"
                                  class="form-control"
                                  v-model="cardCharge"
                                  @change="chargeCal"
                                  @keyup.enter="getFocus('cr_notice')"
                                  @keyup.down="getFocus('cr_notice')"
                                  @keyup.up="getFocus('credit_price')"
                                >
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 col-12" v-if="isEditCr==false">
                          <div class="row">
                            <p class="method-set col-lg-4 col-md-12 col-12">หมายเหตุ :</p>
                            <div class="col-lg-7 col-md-12 col-12">
                              <p>
                                <textarea
                                  id="cr_notice"
                                  class="form-control"
                                  v-model.number="creditNotice"
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
                        <div class="col-md-12 col-12" v-if="isEditCr==true">
                          <div class="row">
                            <p class="method-set col-lg-4 col-md-12 col-12">หมายเหตุ :</p>
                            <div class="col-lg-7 col-md-12 col-12">
                              <p>
                                <textarea
                                  id="cr_notice"
                                  class="form-control"
                                  v-model.number="creditNotice"
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
                          v-if="isEditCr==false"
                          :disabled="creditType==''||creditBank==''||(creditNumber.length<4)||(validateCreditCardNo.length<6)||creditPrice==0"
                          @click="createCreditCard(),resetCredit(),checktotal(),showCredit = false"
                          @keyup.up="getFocus('cr_notice')"
                          @keyup.right="getFocus('cancel_cr')"
                          ref="crButton"
                          class="btn btn-success"
                          style="margin-top:25px"
                        >
                          <span>เพิ่ม</span>
                        </button>
                        <button
                          id="submit_cr"
                          v-if="isEditCr==true"
                          :disabled="creditType==''||creditBank==''||(creditNumber.length<4)||(validateCreditCardNo.length<6)||creditPrice==0"
                          @click="editCreditCard(),resetCredit(),showCredit = false"
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
                          @click="showCredit = false"
                          @keyup.up="getFocus('cr_notice')"
                          @keyup.left="getFocus('submit_cr')"
                        >ยกเลิก</button>
                      </div>
                    </md-dialog-content>
                  </md-dialog>
                  <md-dialog :md-active="showChq">
                    <md-dialog-content class="modal-content">
                      <div class="modal-header">
                        <h4>เช็ค</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> เลขที่เช็ค :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input
                                id="chq_no"
                                class="form-control"
                                v-model="checkNumber"
                                @keyup.enter="getFocus('chq_prize')"
                                @keyup.down="getFocus('chq_prize')"
                              >
                            </p>
                          </div>
                        </div>
                        <div class="row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> มูลค่าเช็ค :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <money
                                id="chq_prize"
                                class="form-control"
                                min="0"
                                v-model.number="chqPrize"
                                v-bind="money"
                                v-on:keyup.native.enter="getFocus('bank')"
                                v-on:keyup.native.down="getFocus('bank')"
                                v-on:keyup.native.up="getFocus('chq_no')"
                              ></money>
                            </p>
                          </div>
                        </div>
                        <div class="row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> ธนาคาร :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input
                                id="bank"
                                class="form-control"
                                v-model="checkBankId"
                                @keyup.enter="getFocus('chq_pay')"
                                @keyup.down="getFocus('chq_day')"
                                @keyup.up="getFocus('chq_prize')"
                              >
                            </p>
                          </div>
                        </div>
                        <div class="row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> วันที่ลงเช็ค :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <vue-ctk-date-time-picker
                                id="chq_day"
                                locale="th"
                                format="YYYY-MM-DD"
                                v-model="chqDate"
                                :disable-time="true"
                              ></vue-ctk-date-time-picker>
                            </p>
                          </div>
                        </div>
                        <div class="row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> จำนวนเงิน :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <money
                                id="chq_pay"
                                class="form-control"
                                min="0"
                                v-model.number="checkPayment"
                                v-bind="money"
                                v-on:keyup.native.enter="getFocus('chq_notice')"
                                v-on:keyup.native.down="getFocus('chq_notice')"
                                v-on:keyup.native.up="getFocus('bank')"
                              ></money>
                            </p>
                          </div>
                        </div>
                        <div class="form-group row" v-if="isEditChq==false">
                          <p class="method-set col-lg-4 col-md-12 col-12">หมายเหตุ :</p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <textarea
                                id="chq_notice"
                                class="form-control"
                                v-model.number="chqNotice"
                                rows="2"
                                @keyup.down="getFocus('submit_chq')"
                                @keyup.up="getFocus('chq_pay')"
                              ></textarea>
                            </p>
                          </div>
                        </div>
                        <div class="form-group row" v-if="isEditChq==true">
                          <p class="method-set col-lg-4 col-md-12 col-12">หมายเหตุ :</p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <textarea
                                id="chq_notice"
                                class="form-control"
                                v-model.number="chqNotice"
                                rows="2"
                                @keyup.down="getFocus('submit_chq')"
                                @keyup.up="getFocus('chq_pay')"
                              ></textarea>
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button
                          id="submit_chq"
                          v-if="isEditChq==false"
                          :disabled="checkNumber==''||checkPayment==''||checkBankId==''||typeof(checkPayment)=='string'||checkPayment==0"
                          @keyup.up="getFocus('chq_notice')"
                          @keyup.right="getFocus('cancel_chq')"
                          @click="createChq(),resetChq,showChq = false"
                          class="btn btn-success"
                        >
                          <span>เพิ่ม</span>
                        </button>
                        <button
                          id="submit_chq"
                          v-if="isEditChq==true"
                          :disabled="checkNumber==''||checkPayment==''||checkBankId==''||typeof(checkPayment)=='string'||checkPayment==0"
                          @keyup.up="getFocus('chq_notice')"
                          @keyup.right="getFocus('cancel_chq')"
                          @click="editChq(),resetChq,showChq = false"
                          class="btn btn-success"
                        >
                          <span>แก้ไข</span>
                        </button>
                        <button
                          id="cancel_chq"
                          style="text-align:center"
                          class="btn btn-danger"
                          @keyup.up="getFocus('chq_notice')"
                          @keyup.left="getFocus('submit_chq')"
                          @click="showChq = false"
                        >ยกเลิก</button>
                      </div>
                    </md-dialog-content>
                  </md-dialog>
                  <md-dialog :md-active="showsucess">
                    <md-dialog-content class="modal-content">
                      <div class="modal-header">
                        <h4>ชำระเงินพร้อมเพย์สำเร็จ</h4>
                      </div>
                      <button
                        id="submit_bank"
                        @keyup.up="getFocus('bank_notice')"
                        @keyup.right="getFocus('cancel_bank')"
                        @click="createpromplay(),this.showpromplay = false,showsucess= false"
                        class="btn btn-success"
                      >
                        <span>ตกลง</span>
                      </button>
                    </md-dialog-content>
                  </md-dialog>
                  <md-dialog :md-active="showBank">
                    <md-dialog-content class="modal-content">
                      <div class="modal-header">
                        <h4>เงินโอน</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> เลขที่บัญชี :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input
                                id="bank_acc"
                                class="form-control"
                                v-model="bankAccount"
                                @keyup.enter="getFocus('bank_day')"
                                @keyup.down="getFocus('bank_day')"
                              >
                            </p>
                          </div>
                        </div>
                        <div class="row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> วันที่โอนเงิน :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <vue-ctk-date-time-picker
                                id="bank_day"
                                locale="th"
                                format="YYYY-MM-DD"
                                v-model="bankTransDate"
                                :disable-time="true"
                              ></vue-ctk-date-time-picker>
                            </p>
                          </div>
                        </div>
                        <div class="row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> จำนวนเงิน :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <money
                                id="bank_pay"
                                class="form-control"
                                min="0"
                                v-model.number="bankPayment"
                                v-bind="money"
                                v-on:keyup.native.enter="getFocus('chq_notice')"
                                v-on:keyup.native.down="getFocus('bank_notice')"
                                v-on:keyup.native.up="getFocus('bank')"
                              ></money>
                            </p>
                          </div>
                        </div>
                        <div class="form-group row" v-if="isEditBank==false">
                          <p class="method-set col-lg-4 col-md-12 col-12">หมายเหตุ :</p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <textarea
                                id="bank_notice"
                                class="form-control"
                                v-model.number="bankNotice"
                                rows="2"
                                @keyup.down="getFocus('submit_bank')"
                                @keyup.up="getFocus('bank_pay')"
                              ></textarea>
                            </p>
                          </div>
                        </div>
                        <div class="form-group row" v-if="isEditBank==true">
                          <p class="method-set col-lg-4 col-md-12 col-12">หมายเหตุ :</p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <textarea
                                id="bank_notice"
                                class="form-control"
                                v-model.number="bankNotice"
                                rows="2"
                                @keyup.down="getFocus('submit_bank')"
                                @keyup.up="getFocus('bank_pay')"
                              ></textarea>
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button
                          id="submit_bank"
                          v-if="isEditBank==false"
                          :disabled="bankAccount==''||bankPayment==''||bankTransDate==''||typeof(bankPayment)=='string'||bankPayment==0"
                          @keyup.up="getFocus('bank_notice')"
                          @keyup.right="getFocus('cancel_bank')"
                          @click="createBank(),resetBank,showBank= false"
                          class="btn btn-success"
                        >
                          <span>เพิ่ม</span>
                        </button>
                        <button
                          id="submit_bank"
                          v-if="isEditBank==true"
                          :disabled="bankAccount==''||bankPayment==''||bankTransDate==''||typeof(bankPayment)=='string'||bankPayment==0"
                          @keyup.up="getFocus('bank_notice')"
                          @keyup.right="getFocus('cancel_bank')"
                          @click="createBank(),resetBank,showBank= false"
                          class="btn btn-success"
                        >
                          <span>แก้ไข</span>
                        </button>
                        <button
                          id="cancel_bank"
                          style="text-align:center"
                          class="btn btn-danger"
                          @keyup.up="getFocus('bank_notice')"
                          @keyup.left="getFocus('submit_bank')"
                          @click="showBank = false"
                        >ยกเลิก</button>
                      </div>
                    </md-dialog-content>
                  </md-dialog>

                  <md-dialog :md-active="showpromplay">
                    <md-dialog-content class="modal-content">
                      <div class="modal-header">
                        <h4 style="margin-top:-20px">ชำระเงินด้วยพร้อมเพย์</h4>
                      </div>
                      <div class="modal-body">
                        <div class="col-md-12 col-12">
                          <div class="row">
                            <p class="method-set col-lg-4 col-md-12 col-12">
                              <span style="color:red">*</span> เบอร์โทรศัพ :
                            </p>
                            <div class="col-lg-7 col-md-12 col-12">
                              <p>
                                <input
                                  id="cr_no"
                                  class="form-control"
                                  type="text"
                                  v-model.number="prompaly.phone"
                                  maxlength="4"
                                  v-autofocus
                                  @keypress="isNumber(event)"
                                  @keyup.enter="getFocus('cr_ref_no')"
                                  @keyup.down="getFocus('cr_ref_no')"
                                  placeholder="เลขสี่ตัวท้ายเลขโทรศัพ"
                                >
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 col-12">
                          <div class="row">
                            <p class="method-set col-lg-4 col-md-12 col-12">
                              <span style="color:red">*</span> จำนวนเงิน :
                            </p>

                            <div class="col-lg-7 col-md-12 col-12">
                              <p>
                                <money
                                  id="prom_pay"
                                  class="form-control"
                                  min="0.00"
                                  max="10000.00"
                                  v-model="prompaly.price"
                                  v-bind="money"
                                  @keypress="qrcodegen"
                                  v-on:keyup.native.enter="getFocus('chq_notice')"
                                  v-on:keyup.native.down="getFocus('bank_notice')"
                                  v-on:keyup.native.up="getFocus('bank')"
                                ></money>
                              </p>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12 col-12">
                          <div class="row">
                            <div class="col-lg-7 col-md-12 col-12">
                              <p>
                                <button
                                  id="cancel_cr"
                                  style="margin-top:25px"
                                  class="btn btn-danger"
                                  @click="genqrcode()"
                                  @keyup.up="getFocus('cr_notice')"
                                  @keyup.left="getFocus('submit_cr')"
                                >Gen Qrcode</button>
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-lg-7">
                              <center>
                                <qr-code
                                  :text="prompaly.qr_code"
                                  style="position:relative"
                                  foreground="#0089D1"
                                  :size="128"
                                  error-level="Q"
                                ></qr-code>
                              </center>
                            </div>
                          </div>
                        </div>
                        <br>

                        <div>
                          <div class="modal-footer" style="position:relative;height:10vh;">
                            <button
                              style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);height:50px;width:60px;"
                              type="button"
                              class="btn btn-danger"
                              data-dismiss="modal"
                              @click="removetime()"
                            >
                              <span style="font-size:20px;">
                                <i class="fas fa-angle-double-left"></i>
                              </span>
                              <span
                                id="counter"
                                style="font-family:'Open Sans', sans-serif;font-weight: bold;font-size: 20px;"
                              ></span>
                            </button>
                          </div>
                        </div>

                        <div class="col-md-12 col-12" v-if="isEditPromplay==true">
                          <div class="row">
                            <p class="method-set col-lg-4 col-md-12 col-12">หมายเหตุ :</p>
                            <div class="col-lg-7 col-md-12 col-12">
                              <p>
                                <textarea
                                  id="cr_notice"
                                  class="form-control"
                                  v-model.number="prompaly.detailedit"
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
                          v-show="isEditPromplay==true"
                          :disabled="prompaly.price<=0"
                          @click="createpromplay(),showpromplay = false,resetpromplay()"
                          @keyup.up="getFocus('cr_notice')"
                          @keyup.right="getFocus('cancel_cr')"
                          ref="crButton"
                          class="btn btn-success"
                          style="margin-top:25px"
                        >
                          <span>เพิ่ม</span>
                        </button>
                        <button
                          id="submit_cr"
                          v-show="isEditPromplay==false"
                          :disabled="prompaly.price<=0"
                          @click="editCreditCard(),resetCredit(),showpromplay = false"
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
                          @click="showpromplay = false"
                          @keyup.up="getFocus('cr_notice')"
                          @keyup.left="getFocus('submit_cr')"
                        >ยกเลิก</button>
                      </div>
                    </md-dialog-content>
                  </md-dialog>
                </form>
              </div>
              <br>

              <!-- <md-buttons
                style="float:right;right: 50px;"
                class="md-raised md-primary"
                @click="setDone('second', 'third'),showdocno"
              >บันทึก</md-button>-->
            </md-step>

            <md-step id="third" md-label="Third Step" :md-done.sync="third">
              <div class="md-layout md-gutter">
                <md-toolbar style="padding:30px 0" class="md-primary">
                  <div
                    class="md-layout-item md-xlarge-size-40 md-large-size-40 md-xsmall-size-40 md-small-size-40 md-medium-size-40"
                  >
                    <h3
                      style="font-size: 46px; overflow: visible;padding:10px;"
                      class="md-title"
                    >บิลชำระเงิน</h3>
                  </div>
                  <div
                    style="text-align:right;"
                    class="md-layout-item md-xlarge-size-20 md-large-size-20 md-xsmall-size-20 md-small-size-20 md-medium-size-20"
                  ></div>
                  <div
                    style="text-align:right;"
                    class="md-layout-item md-xlarge-size-20 md-large-size-20 md-xsmall-size-20 md-small-size-20 md-medium-size-20"
                  >
                    <h4
                      style="overflow:visible;white-space:normal;font-size:15px"
                      class="md-title"
                    >ติดต่อ นพดลพานิช (053) 261-000 E-mail : sale@nopadol.com</h4>
                  </div>
                  <div
                    style="text-align:right;"
                    class="md-layout-item md-xlarge-size-20 md-large-size-20 md-xsmall-size-20 md-small-size-20 md-medium-size-20"
                  >
                    <h4
                      style="padding-right:10px;overflow:visible;white-space:normal;font-size:15px"
                      class="md-title"
                    >ถนน เชียงใหม่- ดอยสะเก็ด ตำบล ฟ้าฮ่าม อำเภอเมืองเชียงใหม่ เชียงใหม่ 50000</h4>
                  </div>
                </md-toolbar>

                <div
                  style="text-align:left;word-break: break-word;"
                  class="md-layout-item md-xlarge-size-30 md-large-size-30 md-xsmall-size-30 md-small-size-30 md-medium-size-30 contentpadding"
                >
                  <span style="color:grey;">Billed To</span>
                  <span style="display:block;">Code {{ searchcus }}</span>
                  <span style="display:block;">Name {{ detailcus }}</span>
                </div>
                <div
                  style="text-align:left"
                  class="md-layout-item md-xlarge-size-30 md-large-size-30 md-xsmall-size-30 md-small-size-30 md-medium-size-30 contentpadding"
                >
                  <span style="color:grey">invoice Number</span>
                  <span style="display:block;">Docno {{ docno }}</span>
                  <br>
                  <span style="color:grey">Date Of Issue</span>
                  <span style="display:block;">Date {{ convertmonth_preview(datenow_datepicker) }}</span>
                </div>
                <div
                  style="text-align:right"
                  class="md-layout-item md-xlarge-size-40 md-large-size-40 md-xsmall-size-40 md-small-size-40 md-medium-size-40 contentpadding"
                >
                  <span style="display:block;color:grey;padding-bottom:15px;">invoice Total</span>
                  <span style="font-size: 35px;">{{ convertmoney(cal_totalprice) }} บาท</span>
                </div>

                <div
                  style="text-align:left"
                  class="md-layout-item md-xlarge-size-100 md-large-size-100 md-xsmall-size-100 md-small-size-100 md-medium-size-100 contentpadding"
                >
                  <div class="underline"></div>
                </div>
                <div class="table-responsive" style="overflow-y: auto;padding:0 20px">
                  <table
                    id="bordernone"
                    style="border-bottom:none;border-top:none;"
                    class="table table-hover"
                  >
                    <thead align="center">
                      <tr style="color:#448aff">
                        <th>ลำดับ</th>
                        <th id="colorselectorder">Description</th>
                        <th id="colorselectgroup">Unit Cost</th>
                        <th id="colorselectgroup">Qty</th>
                        <th id="colorselectgroup">Amount</th>
                      </tr>
                    </thead>
                    <tbody id="valuetable">
                      <tr
                        v-for="(val,index) in dproducts"
                        :key="index"
                        style="width:100%;cursor:pointer;border-bottom: 1px rgba(0,0,0,0.25) solid;text-align:center"
                      >
                        <td>{{index+1}}</td>
                        <td>{{val.item_code}} {{val.item_name}}</td>
                        <td>{{val.price}}</td>
                        <td>{{val.qty}}</td>
                        <td>{{val.item_amount}}</td>
                        <div style="background:black;width:100%;height:2px;"></div>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div
                  style="text-align:right"
                  class="md-layout-item md-xlarge-size-100 md-large-size-100 md-xsmall-size-100 md-small-size-100 md-medium-size-100 contentpadding"
                >
                  <div>
                    <span class="paddingright" style="color:#448aff;font-size:16px;">รวมมูลค่าสินค้า</span>
                    <p style="display:inline-block;width:90px">{{ convertmoney(totalprice) }} บาท</p>
                  </div>
                  <div>
                    <span class="paddingright" style="color:#448aff;font-size:16px;">ส่วนลด</span>
                    <p style="display:inline-block;width:90px">
                      {{ caldiscount }}
                      <span v-show="percal">%</span>
                      <span v-show="!percal">บาท</span>
                    </p>
                  </div>
                  <div>
                    <span class="paddingright" style="color:#448aff;font-size:16px;">ภาษีมูลค่าเพิ่ม</span>
                    <p style="display:inline-block;width:90px">{{ convertmoney(dif_fee) }} บาท</p>
                  </div>
                  <div>
                    <span class="paddingright" style="color:#448aff;font-size:16px;">มูลค่าสุทธิ</span>
                    <p
                      style="display:inline-block;width:90px"
                    >{{ convertmoney(cal_totalprice) }} บาท</p>
                  </div>
                </div>
                <div
                  style="text-align:right"
                  class="md-layout-item md-xlarge-size-100 md-large-size-100 md-xsmall-size-100 md-small-size-100 md-medium-size-100"
                >
                  <span>This quotation is brought to you by</span>
                  <img style="width: 100px; height: 50px;" src="../../assets/nopadol.jpg">
                </div>
              </div>
              <md-button class="md-raised md-primary" @click="setDone('third')">สิ้นสุด</md-button>
              <!-- testprint -->
              <form
                id="tax_report"
                :action="php + '/vue_sale/report_pdf/report_quotation.php'"
                method="post"
                target="_blank"
              >
                <input type="hidden" name="dataquotation">
                <md-button
                  type="submit"
                  style="float: right; position: relative; top: -37px;"
                  class="md-raised md-primary"
                >Print</md-button>
                <!-- <button type="submit">กด</button> -->
              </form>
              <form
                :action="php + '/vue_sale/report_pdf/report_quotationpdf.php'"
                method="post"
                target="_blank"
              >
                <input type="hidden" name="dataquotation">
                <md-button
                  type="submit"
                  style="float: right; position: relative; top: -37px;right: 10px;"
                  class="md-raised md-primary"
                >PDF</md-button>
                <!-- <button type="submit">กด</button> -->
              </form>
              <!-- testprint -->
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

<script src="../../js/invoice.js">
</script>

<style  src="./invoice.css">
</style>
