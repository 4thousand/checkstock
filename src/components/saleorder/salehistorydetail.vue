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
                  <div class="md-layout-item md-size-30 md-small-size-100">
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
                    class="md-layout-item md-size-20 md-small-size-100"
                  >
                    <md-field>
                      <label>เลขที่ใบขายสินค้า</label>
                      <md-input disabled v-model="docno"></md-input>
                    </md-field>
                  </div>

                  <div class="md-layout-item md-size-25 md-small-size-100">
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
                </div>
                <!--docno mockdocno-->
                <div class="md-layout md-gutter">
                  <div class="md-layout-item md-size-10 md-small-size-100"></div>
                  <div
                    id="notop_mobile"
                    style="position: relative; top: 25px;"
                    class="md-layout-item md-size-50 md-small-size-100"
                  >
                    <md-field>
                      <label>เลขที่ใบกำกับภาษี</label>
                      <md-input disabled v-model="docno"></md-input>
                    </md-field>
                  </div>
                  <div
                    id="changetop_mobile"
                    style="position:relative"
                    class="md-layout-item md-size-40 md-small-size-100"
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
                      style="     padding-top: 16px;
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
                        <md-button style="width:20%">ชื่อสินค้า</md-button>
                        <md-button style="width:10%">หน่วยนับ</md-button>
                        <md-button style="width:10%">จำนวน</md-button>
                        <md-button style="width:10%">ราคา/หน่วย</md-button>
                        <md-button style="width:10%">ส่วนลด</md-button>
                        <md-button style="width:10%">จำนวนเงิน</md-button>
                      </md-card-actions>
                    </div>
                  </md-card>
                  <md-card
                    v-for="(val,index) in searched"
                    :key="index"
                    class="md-layout-item md-size-100 md-small-size-100"
                  >
                    <div class="tables">
                      <md-card-actions>
                        <md-button style="width:10%">{{val.item_code}}</md-button>
                        <md-button style="width:20%">{{val.item_name}}</md-button>
                        <md-button style="width:10%">{{val.unit_code}}</md-button>
                        <md-button style="width:10%">{{val.qty}}</md-button>
                        <md-button style="width:10%">{{val.prices}}</md-button>
                        <md-button style="width:10%">{{val.discount_word}}</md-button>
                        <md-button style="width:10%">{{val.item_amounts}} บาท</md-button>

                        <md-button style="min-width: 30px;" @click="testtable(val)">
                          <md-icon style="width: 10px;float: right;">edit</md-icon>
                        </md-button>
                        <md-button style="min-width: 30px;" class="md-mini">
                          <md-icon style="width:10px;float: right;">delete</md-icon>
                        </md-button>
                        <md-button style="min-width: 30px;" @click="searchhistable(val)">
                          <md-icon style="width: 10px;float: right;">history</md-icon>
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

                              <md-menu-item style="min-width: 30px;" @click="searchhistable(val)">
                                <md-icon style="width:10px;float: right;">history</md-icon>history
                              </md-menu-item>
                            </md-menu-content>
                          </md-menu>
                          <div style="text-align:center">
                            {{val.item_amounts}}
                            <br>บาท
                          </div>
                        </div>
                      </md-card-content>
                    </div>
                  </md-card>
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
              md-label="Second Step"
              :md-error="secondStepError"
              :md-done.sync="second"
            >
              <!--  -->
              <div style="display:inline-block">
                <form class="md-layout" style="justify-content: center;">
                  <md-card
                    style="margin-right:8px;margin-bottom:8px;"
                    class="md-layout-item md-size-90 md-small-size-100"
                  >
                    <md-card-header>
                      <div class="md-title">พนักงาน</div>
                    </md-card-header>
                    <md-card-content>
                      <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-100" style="position:relative">
                          <md-field>
                            <label for="first-name subnotop">รหัสพนักงานขาย</label>
                            <md-input
                              name="first-name"
                              ref="codesale"
                              @keyup.enter="searchsale_step2"
                              v-model="salecode"
                              id="first-name"
                              autocomplete="given-name"
                            />
                          </md-field>
                          <md-avatar style="position: absolute; top: 15px;right:10px;">
                            <md-icon style="color:grey">info</md-icon>
                            <md-tooltip md-direction="top">
                              <md-icon style="color:white;">keyboard</md-icon>รหัสพนักงาน หรือ ชื่อพนักงาน + Enter
                            </md-tooltip>
                          </md-avatar>
                          <!-- <md-button style="min-width: 50px;" class="buttonemp" @click="focussearchcus">
                            <md-icon>clear</md-icon>
                          </md-button>-->
                        </div>
                        <div class="md-layout-item md-size-50 md-small-size-100">
                          <md-field>
                            <label for="last-name subnotop">แผนก</label>
                            <md-input
                              name="last-name"
                              id="last-name"
                              @keyup.enter="searchdepart_step2"
                              v-model="department"
                              autocomplete="family-name"
                            />
                          </md-field>
                          <md-avatar style="position: absolute; top: 15px;right:10px;">
                            <md-icon style="color:grey">info</md-icon>
                            <md-tooltip md-direction="top">
                              <md-icon style="color:white;">keyboard</md-icon>รหัสแผนก หรือ ชื่อแผนก + Enter
                            </md-tooltip>
                          </md-avatar>
                        </div>
                        <div class="md-layout-item md-size-50 md-small-size-100">
                          <md-field>
                            <label for="last-name">รหัสผู้ติดต่อ</label>
                            <md-input name="last-name" id="last-name" autocomplete="family-name"/>
                          </md-field>
                          <md-button style="min-width: 50px;" class="buttonemp" @click="tests">
                            <md-icon>search</md-icon>
                          </md-button>
                        </div>
                        <div class="md-layout-item md-size-50 md-small-size-100">
                          <md-field>
                            <label for="last-name">การจัดสรร</label>
                            <md-input
                              name="last-name"
                              id="last-name"
                              @keyup.enter="searchAllocate"
                              v-model="Allocate"
                              autocomplete="family-name"
                            />
                          </md-field>
                          <md-avatar style="position: absolute; top: 15px;right:10px;">
                            <md-icon style="color:grey">info</md-icon>
                            <md-tooltip md-direction="top">
                              <md-icon style="color:white;">keyboard</md-icon>รหัสการจัดสรร หรือ ชื่อการจัดสรร + Enter
                            </md-tooltip>
                          </md-avatar>
                        </div>
                        <div class="md-layout-item md-size-100 md-small-size-100">
                          <md-field>
                            <label for="last-name">โครงการ</label>
                            <md-input
                              name="last-name"
                              id="last-name"
                              @keyup.enter="searchproject_step2"
                              v-model="project"
                              autocomplete="family-name"
                            />
                          </md-field>
                          <md-avatar style="position: absolute; top: 15px;right:10px;">
                            <md-icon style="color:grey">info</md-icon>
                            <md-tooltip md-direction="top">
                              <md-icon style="color:white;">keyboard</md-icon>รหัสโครงการ หรือ ชื่อโครงการ + Enter
                            </md-tooltip>
                          </md-avatar>
                        </div>
                        <div class="md-layout-item md-size-50 md-small-size-100">
                          <md-field>
                            <label for="last-name">Job ID (Optional)</label>
                            <md-input/>
                          </md-field>
                        </div>
                      </div>
                    </md-card-content>
                    <md-card-actions></md-card-actions>
                  </md-card>
                  <md-card
                    style="margin-bottom:8px;"
                    class="md-layout-item md-size-90 md-small-size-100"
                  >
                    <md-card-header>
                      <div class="md-title">วันที่หมดอายุ</div>
                    </md-card-header>
                    <md-card-content>
                      <div class="md-layout md-gutter">
                        <div
                          style="position:relative;top:-30px"
                          class="md-layout-item md-size-100 md-xsmall-size-100"
                        >
                          <span
                            class="md-title subnotop"
                            style="position: relative; top: 20px;"
                          >วันที่หมดอายุ</span>
                          <div style="position:relative;">
                            <md-icon
                              style="float:left;position:relative;top:28px;margin-right:5px;"
                            >calendar_today</md-icon>
                            <datepicker
                              @input="calexpire_Date"
                              v-model="expiredate_cal"
                              input-class="form-control"
                              style="position:relative;top:15px;width: 80%;"
                              :language="languages[language]"
                              format="d MMMM yyyy"
                            ></datepicker>
                          </div>
                        </div>
                        <!--  -->
                        <div
                          style="position:relative;top:-30px"
                          class="md-layout-item md-size-100 md-xsmall-size-100"
                        >
                          <span
                            class="md-title subnotop"
                            style="position: relative; top: 20px;"
                          >ลงวันที่</span>
                          <div style="position:relative;">
                            <md-icon
                              style="float:left;position:relative;top:28px;margin-right:5px;"
                            >calendar_today</md-icon>
                            <datepicker
                              @input="calDueDate_date"
                              v-model="DueDate_date"
                              input-class="form-control tc"
                              style="position:relative;top:15px;width: 80%;"
                              :language="languages[language]"
                              format="d MMMM yyyy"
                            ></datepicker>
                          </div>
                        </div>
                        <!--  -->
                        <div
                          style="position:relative;top:-30px"
                          class="md-layout-item md-size-100 md-xsmall-size-100"
                        >
                          <span
                            class="md-title subnotop"
                            style="position: relative;top:20px"
                          >วันที่ครบกำหนด</span>
                          <md-icon style="position:relative;top:15px;color:black">lock</md-icon>

                          <div style="position:relative;">
                            <md-icon
                              style="float:left;position:relative;top:28px;margin-right:5px;"
                            >calendar_today</md-icon>
                            <datepicker
                              disabled
                              v-model="DueDate_cal"
                              input-class="form-control tc"
                              style="position:relative;top:15px;width: 80%;"
                              :language="languages[language]"
                              format="d MMMM yyyy"
                            ></datepicker>
                          </div>
                        </div>
                        <!--  -->
                        <div
                          style="position:relative;top:-15px"
                          class="md-layout-item md-size-50 md-xsmall-size-100"
                        >
                          <span class="md-title sub" style="font-size: 18px;">คำตอบจากลูกค้า</span>
                          <md-field>
                            <md-select
                              placeholder="กรุณาเลือก"
                              v-model="answer_cus"
                              name="condition_send"
                              id="condition_send"
                            >
                              <md-option value="0">รอตอบกลับ</md-option>
                              <md-option value="1">ตอบกลับแล้ว</md-option>
                              <md-option value="2">ไม่รับในราคา</md-option>
                            </md-select>
                          </md-field>
                        </div>
                        <div class="md-layout-item md-size-50 md-xsmall-size-100" style="top:16px">
                          <md-field>
                            <label for="last-name">รูปแบบการสั่งซื้อสินค้า</label>
                            <md-input name="last-name" id="last-name" autocomplete="family-name"/>
                          </md-field>
                        </div>
                        <!--  -->
                      </div>
                    </md-card-content>
                    <md-card-actions></md-card-actions>
                  </md-card>
                  <md-card
                    class="md-layout-item md-size-90 md-small-size-100"
                    :style="{height: docheight}"
                    style="transition:all 0.5s;margin-bottom:8px;"
                  >
                    <md-card-header>
                      <div class="md-title">ข้อมูลลูกค้า
                        <md-switch
                          @change="isshowdoc_fuc"
                          style="position:absolute;right:0;"
                          v-model="isshowdocument"
                        >{{ convertshowdoc(isshowdocument) }}</md-switch>
                      </div>
                    </md-card-header>
                    <md-card-content v-if="isshowdocument">
                      <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-50">
                          <md-field>
                            <label for="first-name subnotop">ผู้รับสินค้า</label>
                            <md-input name="first-name" id="first-name" v-model="sale_id"/>
                          </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-50">
                          <md-field>
                            <label for="last-name">เวลาที่รับ</label>
                            <md-input
                              name="last-name"
                              v-model="create_time"
                              id="last-name"
                              autocomplete="family-name"
                            />
                          </md-field>
                        </div>
                      </div>
                      <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-50">
                          <md-field>
                            <label for="last-name subnotop">ทะเบียนลูกค้า</label>
                            <md-input
                              name="last-name"
                              id="last-name"
                              v-model="customerName"
                              autocomplete="family-name"
                            />
                          </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-50">
                          <md-field>
                            <label for="last-name">สถานที่ขนส่ง</label>
                            <md-input
                              name="last-name"
                              v-model="ar_bill_address"
                              id="last-name"
                              autocomplete="family-name"
                            />
                          </md-field>
                        </div>
                      </div>
                    </md-card-content>
                    <md-card-actions></md-card-actions>
                  </md-card>

                </form>
              </div>
              <!--<md-button
                style="float:right;right: 50px;"
                class="md-raised md-primary"
                @click="confirmDialog=true,showdocno()"
              >บันทึก</md-button>-->
              <md-button
                style="float:right;"
                @click="setDone('second','first')"
                class="md-raised md-primary"
              >
                <span>ย้อนกลับ</span>
              </md-button>
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

      <div>
        <md-dialog :md-active.sync="showDialoghis">
          <md-dialog-title>ประวัติซื้อขาย</md-dialog-title>
          <md-tabs id="none" md-dynamic-height>
            <md-tab md-label>
              <md-field>
                <md-input
                  v-model="searchcus"
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
                      <th style="white-space: nowrap;">ลูกหนี้</th>
                    </tr>
                  </thead>

                  <tbody v-for="(val,index) in dataitem" :key="index" id="valuetable">
                    <tr style="text-align:center;cursor:pointer">
                      <td @click="showhisdetail(val)">{{index+1}}</td>
                      <td @click="showhisdetail(val)">{{val.doc_date}}</td>
                      <td @click="showhisdetail(val)">{{val.doc_no}}</td>
                      <td @click="showhisdetail(val)">{{val.item_code}}</td>
                      <td @click="showhisdetail(val)">{{val.item_name}}</td>
                      <td @click="showhisdetail(val)">{{val.unit_code}}</td>
                      <td @click="showhisdetail(val)">{{val.qty}}</td>
                      <td @click="showhisdetail(val)">{{val.ar}}</td>
                      <td @click="showhisdetail(val)">{{val.ar_name}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </md-tab>
          </md-tabs>

          <md-dialog-actions>
            <md-button class="md-primary" @click="showDialoghis = false">Close</md-button>
            <!-- <md-button class="md-primary" @click="showDialogcus = false">Save</md-button> -->
          </md-dialog-actions>
        </md-dialog>
      </div>

    </div>
  </div>
</template>
<script>
import VueCtkDateTimePicker from "vue-ctk-date-time-picker";
import "vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.min.css";
import VueStripePayment from "vue-stripe-payment";
import api from "../../service/service.js";
import { ModelSelect } from "vue-search-select";
import setting from "../../js/setting.js";
import Loading from "vue-loading-overlay";
import { Money } from "v-money";

export default {
  name: "deposit",
  data() {
    return {
      serialNo: "",
      taxNo: "",
      id: "",
      uuid: "",
      customerID: "",
      customerCode: "",
      customerName: "",
      customerAddress: "",
      customerPhone: "",
      customerCreditDay: "",
      customerDueDate: "",
      documentDate: this.getDate(),
      creditDate: "",
      checkDate: "",
      preemptionNo: "",
      employeeID: "",
      employeeCode: "",
      employeeName: "",
      department: "",
      departmentData: [],
      infoNotice: "",
      taxrate: setting.data().setting_taxRate,
      click: false,
      selectCustomer: false,
      selectReserve: false,
      searchCustomerInput: "",
      searchReserveInput: "",
      php: "http://" + document.domain,
      reserveNo: "",
      customerDetail: [],
      reserveDetail: [],
      QRPaymentPart: false,
      cashPayment: 0,
      creditPayment: 0,
      checkPayment: 0,
      bankPayment: 0,
      payment: 0,
      creditNumber: "",
      validateCreditCardNo: "",
      creditType: "",
      creditBank: "",
      creditPrice: "",
      cardCharge: "",
      cardChargePrice: "",
      creditNotice: "",
      creditCardList: [],
      checkBankId: "",
      checkBankName: "",
      checkNumber: "",
      chqPrize: "",
      chqDate: "",
      chqNotice: "",
      chqList: [],
      bankAccount: "",
      bankTransDate: "",
      bankTransList: [],
      bankNotice: "",
      billType: "0",
      saleType: "0", //setting.data().setting_saleType
      eCreditPo: null,
      eChqPo: null,
      eBankPo: null,
      feeType: "1", //setting.data().setting_feeType
      project: "",
      allocate: "",
      companyId: 1,
      branchId: "1", //setting.data().setting_branchId
      showDialog: false,
      showReserve: false,
      showCredit: false,
      showChq: false,
      showBank: false,
      confirm: false,
      active: "first",
      first: false,
      second: false,
      third: false,
      profile: JSON.parse(localStorage.Datauser),
      isLoading: false,
      money: {
        decimal: ".",
        thousands: ",",
        prefix: "",
        suffix: " บาท",
        precision: 2,
        masked: false
      },
      isEditCr: false,
      isEditChq: false,
      isEditBank: false
    };
  },
  components: {
    VueCtkDateTimePicker,
    ModelSelect,
    Loading,
    Money
  },
  use: {
    VueStripePayment
  },
  methods: {
    showEditDetail() {
      if (this.id == 0) {
        // alert('หนักหลัก')
        return;
      }
      // alert('แก้ไข')
      // แก้ไข
      let payload = {
        id: parseInt(this.id)
      };
      this.isLoading = true;
      console.log(payload);
      api.searchSaleByKeyword(
        payload,
        result => {
          this.isLoading = false;
          console.log(result.data);
          this.id = result.data.id;
          this.uuid = result.data.uuid;
          this.serialNo = result.data.doc_no;
          this.taxNo = result.data.doc_no;
          console.log(this.serialNo);
          this.feeType = result.data.tax_type;
          this.branchId = result.data.branch_id;
          this.customerID = result.data.ar_id;
          this.customerName = result.data.ar_name;
          this.customerCode = result.data.ar_code;
          this.customerCreditDay = result.data.credit_day;
          this.customerDueDate = result.data.due_date;
          this.saleID = result.data.sale_id;
          this.saleName = result.data.sale_name;
          this.saleCode = result.data.sale_code;
          this.saleType = result.data.bill_type;
          //   this.customerAddress = result.data.ar_bill_address;
          //   this.customerPhone = result.data.ar_telephone;
          this.department = result.data.depert_id;
          this.taxRate = result.data.tax_type;
          this.datenow_datepicker = result.data.doc_date;
          this.creditCardList = result.data.credit_card;

          this.chqList = result.data.chq;
          this.payment = result.data.total_amount;
           this.cashPayment = result.data.cash_amount;
          this.infoNotice = result.data.my_description;
          this.creator = result.data.create_by;
        },
        error => {
          this.isLoading = false;
          console.log(JSON.stringify(error));
          alertify.error("ข้อมูลผิดพลาด");
        }
      );
    },
    setDone(id, index) {
      this[id] = true;
      this.active = index;
    },
    check_date_p(e) {
      alert(e);
    },
    convertToBaht(val) {
      var result = numeral(val).format("0,0.00");
      // console.log(typeof result)
      return result;
    },
    createCreditCard() {
      var creditcard = {
        credit_type: this.creditType,
        credit_card_no: this.creditNumber,
        amount: this.creditPayment,
        bank_id: parseInt(this.creditBank)
      };
      console.log(JSON.stringify(creditcard));
      this.creditCardList.push(creditcard);
      console.log(JSON.stringify(this.creditCardList));
    },
    resetCredit() {
      this.creditType = "";
      this.validateCreditCardNo = "";
      this.creditNumber = "";
      this.creditPrice = 0;
      this.creditBank = "";
      this.creditNotice = "";
    },
    pullCreditCard(index) {
      this.eCreditPo = index;
      this.creditType = this.creditCardList[index].credit_type;
      this.creditNumber = this.creditCardList[index].credit_card_no;
      this.creditPrice = this.creditCardList[index].amount;
      this.creditBank = parseInt(this.creditCardList[index].bank_id);
    },
    editCreditCard() {
      this.creditCardList[this.eCreditPo].credit_type = this.creditType;
      this.creditCardList[this.eCreditPo].credit_card_no = this.creditNumber;
      this.creditCardList[this.eCreditPo].amount = this.creditPayment;
      this.creditCardList[this.eCreditPo].bank_id = parseInt(this.creditBank);
    },
    removeCreditCard(index) {
      console.log(index);
      this.creditCardList.slice(index);
    },
    createChq() {
      var chq = {
        chq_number: this.checkNumber,
        chq_amount: this.checkPayment,
        bank_id: parseInt(this.checkBankId),
        description: this.chqNotice
      };
      this.chqList.push(chq);
    },
    resetChq() {
      this.checkNumber = "";
      this.chqPrize = 0;
      this.checkPayment = 0;
      this.checkBankId = "";
      this.chqNotice = "";
    },
    pullChq(index) {
      this.eChqPo = index;
      this.checkNumber = this.chqList[index].chq_number;
      this.checkPayment = this.chqList[index].chq_amount;
      this.checkBankId = parseInt(this.chqList[index].bank_id);
      this.chqNotice = this.chqList[index].description;
    },
    editChq() {
      this.chqList[this.eChqPo].chq_number = this.checkNumber;
      this.chqList[this.eChqPo].chq_amount = this.checkPayment;
      this.chqList[this.eChqPo].bank_id = parseInt(this.checkBankId);
      this.chqList[this.eChqPo].description = this.chqNotice;
    },
    removeChq(index) {
      this.chqList.slice(index);
    },
    createBank() {
      var bank = {
        bank_account: this.bankAccount,
        bank_date: this.bankTransDate,
        bank_amount: this.bankPayment
      };
      this.bankTransList.push(bank);
    },
    resetBank() {
      this.bankAccount = "";
      this.bankTransDate = this.getDate();
      this.bankPayment = 0;
    },
    pullBank(index) {
      this.eBankPo = index;
      this.bankAccount = this.bankTransList[index].bank_account;
      this.bankTransDate = this.bankTransList[index].bank_date;
      this.bankPayment = this.bankTransList[index].bank_amount;
    },
    editBank() {
      this.bankTransList[eBankPo].bank_account = this.bankAccount;
      this.bankTransList[eBankPo].bank_date = this.bankTransDate;
      this.bankTransList[eBankPo].bank_amount = this.bankPayment;
    },
    removeBank(index) {
      console.log(index);
      this.bankTransList.slice(index);
    },
    searchCustomerAllKeyApi() {
      var payload = {
        keyword: this.searchCustomerInput
      };

      api.Customerall(
        payload,
        result => {
          console.log(JSON.stringify(result.data));
          if (result.data.length == 0) {
            this.customerDetail = result.data;
            alertify.error("ไม่มีข้อมูลลูกค้าคนนี้");
            return;
          }
          if (result.data.length > 0) {
            this.customerDetail = result.data;
            alertify.success(
              "พบข้อมูลลูกค้าจำนวน " + result.data.length + " คน"
            );
            return;
          }
        },
        error => {
          console.log(error);
        }
      );
    },
    searchReserveKeyApi() {
      var payload = {
        ar_id: this.customerID,
        keyword: this.searchReserveInput
      };

      api.searchReserveByKeyword(
        payload,
        result => {
          console.log(JSON.stringify(result.data));
          if (result.data.length == 0) {
            this.reserveDetail = result.data;
            alertify.error("ไม่มีข้อมูลเลขใบสั่งจอง");
            return;
          }
          if (result.data.length > 0) {
            this.reserveDetail = result.data;
            alertify.success(
              "พบเลขใบสั่งจองจำนวน " + result.data.length + " ใบ"
            );
            return;
          }
        },
        error => {
          console.log(error);
        }
      );
    },
    searchCustomer(val) {
      console.log(JSON.stringify(val));
      this.customerID = val.id;
      this.customerCode = val.code;
      this.customerName = val.name;
      this.customerAddress = val.address;
      this.customerPhone = val.telephone;
      this.customerCreditDay = val.bill_credit;
      this.customerDueDate = this.getDueDate(val.bill_credit);

      this.showDialogCustomer = false;
    },
    searchReserve(val) {
      this.reserveNo = val.doc_no;
    },
    createDepositNoApi() {
      let payload = {
        branch_id: parseInt(this.profile.branch_id),
        table_code: "DP",
        bill_type: parseInt(this.saleType)
      };

      console.log(payload);
      api.showdocno(
        payload,
        result => {
          console.log(JSON.stringify(result));
          if (result.error) {
            this.serialNo = "ไม่มีข้อมูล";
            this.taxNo = "ไม่มีข้อมูล";
            return;
          }
          this.serialNo = result;
          this.taxNo = result;
        },
        error => {
          console.log(error);
        }
      );
    },
    goindex(val) {
      if (val == "/invoicelist") {
        this.$router.push({ name: "invoicelist" });
        return;
      }
    },
    getDate() {
      const toTwoDigits = num => (num < 10 ? "0" + num : num);
      let today = new Date();
      let year = today.getFullYear();
      let month = toTwoDigits(today.getMonth() + 1);
      let day = toTwoDigits(today.getDate());
      return `${year}-${month}-${day}`;
    },
    getDueDate(val) {
      const toTwoDigits = num => (num < 10 ? "0" + num : num);
      let today = new Date();
      today.setDate(today.getDate() + val);
      let year = today.getFullYear();
      let month = toTwoDigits(today.getMonth() + 1);
      let day = toTwoDigits(today.getDate());
      return `${year}-${month}-${day}`;
    },
    payment_validation() {
      if (this.showCredit == false) {
        // this.creditCardName = null;
        this.creditNumber = null;
        this.validateCreditCardNo = null;
        this.creditBank = null;
        // this.creditBranch = null;
        this.creditDate = "";
        this.creditPrice = "";
        this.creditType = null;
        this.cardCharge = null;
        this.creditPayment = null;
        this.creditNotice = null;
      }
      if (this.showChq == false) {
        this.checkNumber = null;
        this.chqPrize = null;
        this.checkDate = null;
        this.checkBankName = null;
        // this.checkBankBranch = null;
        this.checkPayment = null;
        this.chqNotice = null;
      }
    },
    checkLength() {
      return console.log(this.creditNumber.length);
    },
    getFocus(id) {
      document.getElementById(id).focus();
    },
    createDepositDocApi() {
      let payload = {
        id: this.id,
        uuid: this.uuid,
        doc_no: this.serialNo,
        company_id: this.companyId,
        branch_id: parseInt(this.branchId),
        tax_type: parseInt(this.feeType),
        ar_id: parseInt(this.customerID),
        ar_name: this.customerName,
        ar_code: this.customerCode,
        // ar_bill_address: this.customerAddress,
        // ar_telephone: this.customerPhone,
        sale_id: parseInt(this.profile.id),
        sale_name: this.profile.username,
        sale_code: this.profile.sale_code,
        credit_day: this.customerCreditDay,
        due_date: this.customerDueDate,
        depart_id: parseInt(this.department),
        bill_type: parseInt(this.saleType),
        tax_rate: this.taxrate,
        ref_no: this.reserveNo,
        my_description: this.infoNotice,
        cash_amount: this.cashPayment,
        creditcard_amount: this.totalCreditPayment,
        chq_amount: this.totalChqPayment,
        // bank_amount: this.transferPayment,
        total_amount: this.payment,
        credit_card: this.creditCardList,
        chq: this.chqList,
        create_by: this.profile.rolename
        // edit_by: this.profile.rolename
      };
      console.log(JSON.stringify(payload));
      api.createdeposit(
        payload,
        result => {
          console.log(JSON.stringify(result));
          alertify.success("บันทึกข้อมูลใบรับเงินมัดจำเรียบร้อย");
          this.setDone("second", "third");
        },
        error => {
          console.log(JSON.stringify(error));
          alertify.error("การส่งข้อมูลผิดพลาด");
        }
      );
    },
    createPrintData() {
      let payload = {
        id: this.id,
        uuid: this.uuid,
        doc_no: this.serialNo,
        company_id: this.companyId,
        branch_id: parseInt(this.branchId),
        tax_type: parseInt(this.feeType),
        ar_id: parseInt(this.customerID),
        ar_name: this.profile.customerName,
        ar_code: this.customerCode,
        ar_bill_address: this.customerAddress,
        ar_telephone: this.customerPhone,
        sale_id: parseInt(this.profile.id),
        sale_name: this.profile.username,
        sale_code: this.profile.sale_code,
        credit_day: this.customerCreditDay,
        due_date: this.customerDueDate,
        depart_id: parseInt(this.department),
        bill_type: parseInt(this.saleType),
        tax_rate: this.taxrate,
        // ref_no:this.preemptionNo,
        my_description: this.infoNotice,
        cash_amount: this.cashPayment,
        creditcard_amount: this.totalCreditPayment,
        chq_amount: this.totalChqPayment,
        bank_amount: this.transferPayment,
        total_amount: this.payment,
        credit_card: this.creditCardList,
        chq: this.chqList,
        create_by: this.profile.rolename
        // edit_by: this.profile.rolename
      };
      document.getElementsByName("depData")[0].value = JSON.stringify(payload);
    }
  },
  computed: {
    totalPayment() {
      if (
        this.cashPayment != null ||
        this.totalCreditPayment != null ||
        this.totalChqPayment != null ||
        this.totalBankPayment != null
      ) {
        console.log( this.totalCreditPayment )
        return (
          this.cashPayment +
          this.totalCreditPayment +
          this.totalChqPayment +
          this.totalBankPayment
        );
      }
    },
    chargeCal() {
      this.creditPayment = this.creditPrice;
      console.log(this.creditPayment);
      return this.creditPayment;
    },
    totalCreditPayment() {
      if (this.creditCardList == null) {
        this.creditCardList = [];
      }
      return this.creditCardList.reduce((sum, item) => {
        console.log(sum + item.amount)
        return sum + item.amount;
      }, 0);
    },
    totalChqPayment() {
      if (this.chqList == null) {
        this.chqList = [];
      }
      return this.chqList.reduce((sum, item) => {
        return sum + item.chq_amount;
      }, 0);
    },
    totalBankPayment() {
      if (this.bankTransList == null) {
        this.bankTransList = [];
      }
      return this.bankTransList.reduce((sum, item) => {
        return sum + item.bank_amount;
      }, 0);
    },
    payment_type() {
      if (this.feeType == "0") {
        return this.payment;
      }
      if (this.feeType == "1") {
        return this.payment * (100 / (100 + this.taxrate));
      }
      if (this.feeType == "2") {
        return this.payment;
      }
    },
    cal_VAT() {
      if (this.feeType == "0") {
        return this.payment_type * (this.taxrate / 100);
      }
      if (this.feeType == "1") {
        return this.payment - this.payment_type;
      }
      if (this.feeType == "2") {
        return 0;
      }
    },
    total_VAT() {
      if (this.feeType == "0") {
        return this.payment + this.cal_VAT;
      }
      if (this.feeType == "1") {
        return this.payment;
      }
      if (this.feeType == "2") {
        return this.payment;
      }
    },
    balance() {
      return this.totalPayment - this.total_VAT;
    },
    checkLength() {
      return console.log(this.validateCreditCardNo.length);
    }
  },
  mounted() {
    // this.setDone("first", "second");
    // this.setDone('second', 'third');
    this.id = this.$route.params.id;
    this.showEditDetail();
    console.log(this.selectCustomer);
    console.log(this.feeType);
    console.log(this.profile);
    console.log(this.id);
    console.log(this.creditNumber.length);
  }
};
</script>

<script src="../../js/salehistory.js">
</script>

<style  src="./salehistorydetail.css">
</style>
