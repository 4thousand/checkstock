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
              md-label="First Step"
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
                  <div class="md-layout-item md-size-20 md-small-size-100">
                    <span class="md-title sub">ประเภทการชำระเงิน</span>
                    <md-field>
                      <md-select
                        v-hotkey="keymap"
                        @input="showdocno"
                        placeholder="กรุณาเลือก"
                        v-model="tablecode"
                        name="country"
                        id="country"
                      >
                        <md-option value="QT">เงินสด</md-option>
                        <md-option value="BO">เงินเชื่อ</md-option>
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
                      <label>เลขที่เอกสาร</label>
                      <md-input disabled v-model="docno"></md-input>
                    </md-field>
                  </div>
                </div>
                <!--docno mockdocno-->
                <div class="md-layout md-gutter">
                  <div class="md-layout-item md-size-10 md-small-size-100"></div>
                  <div class="md-layout-item md-size-20 md-small-size-100">
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
                    id="notop_mobile"
                    style="position: relative; top: 25px;"
                    class="md-layout-item md-size-40 md-small-size-100"
                  >
                    <md-field>
                      <label>รหัสลูกค้า</label>
                      <md-icon>account_circle</md-icon>

                      <md-input required @keyup.enter="fsearchcus" v-model="searchcus"></md-input>

                      <md-avatar style="position:absolute;right:0;top:10px">
                        <md-icon>info</md-icon>
                        <md-tooltip md-direction="top">
                          <md-icon style="color:white;">keyboard</md-icon>รหัสลูกค้า หรือ ชื่อ + Enter
                        </md-tooltip>
                      </md-avatar>
                    </md-field>
                  </div>
                  <div
                    class="md-size-5 md-small-size-5"
                    style="margin-left:-15px;margin-right:35px;     margin-top: 20px;"
                  >
                    <md-button @click="fsearchcus" class="md-icon-button md-raised md productadd">
                      <md-icon>add</md-icon>
                    </md-button>
                  </div>
                  <!--  -->
                </div>

                <div class="md-layout md-gutter md-title">
                  <div class="md-layout-item md-size-10 md-small-size-100"></div>

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
                  <md-table
                    class="col-12"
                    v-model="searched"
                    md-sort="name"
                    md-sort-order="asc"
                    md-card
                    md-fixed-header
                  >
                    <md-table-toolbar>
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
                          <!-- <md-input style="float:left" required @keyup.enter="fsearchcus" v-model="searchcus"></md-input>
                          -->
                          <md-button
                            @click="addproduct"
                            class="md-icon-button md-raised md productadd"
                          >
                            <md-icon>add</md-icon>
                          </md-button>
                        </div>
                      </div>

                      <!-- <md-field md-clearable class="md-toolbar-section-end">
                        <md-input
                          placeholder="ค้นหาสินค้า"
                          v-model="search"
                          @input="searchOnTable"
                        /> 226  v-model="item.unit_code.trim()"
                      </md-field>-->
                    </md-table-toolbar>

                    <md-table-empty-state
                      style="width:100% !important;"
                      md-label="ไม่พบสินค้า"
                      :md-description="`ไม่มีสินค้า  '${search}' ในระบบกรุณาตรวจสอบใหม่อีกครั้ง`"
                    ></md-table-empty-state>

                    <md-table-row @click="checkval(item)" slot="md-table-row" slot-scope="{ item }">
                      <md-table-cell md-label="รหัสสินค้า" md-sort-by="item_code" md-numeric>
                        <input
                          type="text"
                          class="datatable"
                          disabled
                          v-model="item.item_code"
                          style="  border: none;
  border-bottom:2px solid #ded8d8; background-color: #FFF;"
                        >
                      </md-table-cell>
                      <md-table-cell md-label="ชื่อสินค้า" md-sort-by="item_name">
                        <input
                          type="text"
                          class="datatable"
                          disabled
                          v-model="item.item_name"
                          style="  border: none;
  border-bottom:2px solid #ded8d8; background-color: #FFF;"
                        >
                      </md-table-cell>
                      <md-table-cell md-label="หน่วยนับ" md-sort-by="unit_code">
                        <input
                          type="text"
                          style="padding-right: 31px !important;  border: none;
  border-bottom:2px solid #ded8d8; background-color: #FFF;"
                          class="datatable"
                          v-model="item.unit_code"
                        >
                        <div @click="searchunticode(item) ">
                          <md-icon class="search_unitcode" style="    border: none;">arrow_drop_down</md-icon>
                        </div>
                      </md-table-cell>
                      <md-table-cell md-label="จำนวน" md-sort-by="qty">
                        <input
                          type="text"
                          class="datatable"
                          @keyup="calculatedata(item)"
                          v-model.number="item.qty"
                          style="  border: none;
  border-bottom:2px solid #ded8d8; background-color: #FFF;"
                        >
                      </md-table-cell>
                      <md-table-cell md-label="ราคา/หน่วย" md-sort-by="price">
                        <input
                          type="text"
                          disabled
                          class="datatable"
                          @keyup="calculatedata(item)"
                          style="width:100%;border: none;
  border-bottom:2px solid #ded8d8; background-color: #FFF;"
                          v-model="item.price"
                        >
                      </md-table-cell>
                      <!-- <md-table-cell md-label="ราคา/หน่วย" v-if="billtype == 1" md-sort-by="price2"><input type="text" class="datatable" @keyup="calculatedata(item)" style="width:100%" v-model.number="item.price2"></md-table-cell> -->
                      <md-table-cell md-label="ส่วนลด" md-sort-by="discount_word">
                        <input
                          type="text"
                          class="datatable"
                          @keyup="calculatedata(item)"
                          v-model="item.discount_word"
                          style="  border: none;
  border-bottom:2px solid #ded8d8; background-color: #FFF;"
                        >
                      </md-table-cell>
                      <md-table-cell md-label="จำนวนเงิน" md-sort-by="item_amount">
                        <input
                          type="text"
                          disabled
                          class="datatable"
                          v-model.number="item.item_amount"
                          style="  border: none;
  border-bottom:2px solid #ded8d8; background-color: #FFF;"
                        >
                      </md-table-cell>
                      <!-- <md-table-cell md-label="เงื่อนไขการขนส่ง" md-sort-by="because">{{ item.because }}</md-table-cell> -->
                      <md-table-cell md-label>
                        <md-button @click="removeProduct(item.index)">
                          <md-icon class="search-icon">delete</md-icon>
                        </md-button>
                      </md-table-cell>
                    </md-table-row>
                  </md-table>
                </div>
                <!-- table  -->
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
              <div style="display:inline-block;width: 100%; ">
                <form class="md-layout" style="justify-content: center;">
                  <md-card
                    style="margin-bottom:8px;margin-right:8px; width:100%"
                    class="md-layout-item md-size-90 md-small-size-100"
                  >
                    <md-card-header>
                      <div class="md-title">วิธีชำระเงิน</div>
                    </md-card-header>

                    <vs-tabs vs-position="left" style="display:block;">
                      <vs-tab vs-label="ชำระด้วยเงินสด" @click="turnselect(1)">
                        <md-card
                          style="margin-bottom:8px;margin-right:8px; width:100%;padding:10px"
                          class="md-layout-item md-size-100 md-small-size-100"
                        >
                          <md-card-header>
                            <div class="md-title">ชำระด้วยเงินสด</div>
                          </md-card-header>
                          <div style="width:100%;height:20px; margin-top:10px; margin-bottom:10px">
                            <div style="float:left;width:40%">ภาษีมูลค่าสินค้า</div>
                            <div style="float:right;width:40%;text-align:right;">
                              <div style="float:left">{{ convertmoney(totalprice) }}</div>
                              <div style="width:20px; float:right;">บาท</div>
                            </div>
                          </div>
                          <div style="width:100%;height:20px;margin-top:10px; margin-bottom:10px">
                            <div style="float:left;width:40%">มูลค่าสินค้ายกเว้นภาษี</div>
                            <div style="float:right;width:40%;text-align:right;">
                              <div style="float:left">0</div>
                              <div style="width:20px; float:right;">บาท</div>
                            </div>
                          </div>
                          <div style="width:100%;height:20px;margin-top:10px; margin-bottom:10px">
                            <div style="float:left;width:40%">ส่วนลด</div>
                            <div style="float:right;width:40%;text-align:right;">
                              <div style="float:left" v-show="percal">{{ caldiscount }}</div>
                              <div style="float:left" v-show="!percal">{{ caldiscount }}</div>
                              <div style="width:20px; float:right;">บาท</div>
                            </div>
                          </div>
                          <div style="width:100%;height:20px;margin-top:10px; margin-bottom:10px">
                            <div style="float:left;width:40%">ภาษีมูลค่าเพิ่ม</div>
                            <div style="float:right;width:40%;text-align:right;">
                              <div style="float:left">{{ convertmoney(dif_fee) }}</div>
                              <div style="width:20px; float:right;">บาท</div>
                            </div>
                          </div>
                          <div style="width:100%;height:20px;margin-top:10px; margin-bottom:10px">
                            <div style="float:left;width:40%">มูลค่ารวมภาษี</div>
                            <div style="float:right;width:40%;text-align:right;">
                              <div style="float:left">{{ convertmoney(cal_totalprice) }}</div>
                              <div style="width:20px; float:right;">บาท</div>
                            </div>
                          </div>
                          <div style="width:100%;height:20px;margin-top:10px; margin-bottom:10px">
                            <div style="float:left;width:40%">มูลค่าสุทธิ</div>
                            <div style="float:right;width:40%;text-align:right;">
                              <div style="float:left">{{ convertmoney(cal_totalprice) }}</div>
                              <div style="width:20px; float:right;">บาท</div>
                            </div>
                          </div>
                        </md-card>
                      </vs-tab>
                      <vs-tab vs-label="ชำระผ่านบัตร" @click="turnselect(2)">
                        <md-card
                          style="margin-bottom:8px;margin-right:8px; width:100%"
                          class="md-layout-item md-size-90 md-small-size-100"
                        >
                          <md-card-header>
                            <div class="md-title">ชำระผ่านบัตร</div>
                          </md-card-header>
                        </md-card>
                      </vs-tab>
                      <vs-tab vs-label="ชำระผ่านการโอน" @click="turnselect(3)">
                        <md-card
                          style="margin-bottom:8px;margin-right:8px; width:100%"
                          class="md-layout-item md-size-90 md-small-size-100"
                        >
                          <md-card-header>
                            <div class="md-title">ชำระผ่านการโอน</div>
                          </md-card-header>
                        </md-card>
                      </vs-tab>
                      <vs-tab vs-label="ชำระด้วยเช็ค" @click="turnselect(4)">
                        <md-card
                          style="margin-bottom:8px;margin-right:8px; width:100%"
                          class="md-layout-item md-size-90 md-small-size-100"
                        >
                          <md-card-header>
                            <div class="md-title">ชำระด้วยเช็ค</div>
                          </md-card-header>
                        </md-card>
                      </vs-tab>
                      <vs-tab vs-label="ชำระด้วยพร้อมเพย์" @click="turnselect(5)">
                        <md-card-header>
                          <div class="md-title">ชำระด้วยพร้อมเพย์</div>
                        </md-card-header>
                      </vs-tab>
                    </vs-tabs>
                  </md-card>
                </form>
              </div>
              <br>

              <md-button
                style="float:right;right: 50px;"
                class="md-raised md-primary"
                @click="setDone('second', 'third'),showdocno"
              >บันทึก</md-button>
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
                    >ใบเสนอราคา</h3>
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
                  <span style="color:grey">Quotation Number</span>
                  <span style="display:block;">Docno {{ docno }}</span>
                  <br>
                  <span style="color:grey">Date Of Issue</span>
                  <span style="display:block;">Date {{ convertmonth_preview(datenow_datepicker) }}</span>
                </div>
                <div
                  style="text-align:right"
                  class="md-layout-item md-xlarge-size-40 md-large-size-40 md-xsmall-size-40 md-small-size-40 md-medium-size-40 contentpadding"
                >
                  <span style="display:block;color:grey;padding-bottom:15px;">Quotation Total</span>
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
                      <td @click="showdetail(val)">{{val.bar_code}}</td>
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
