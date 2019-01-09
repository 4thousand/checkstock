<template>
  <div ref="testDiv" class="saleorder">
    <loading :active.sync="isLoading" 
        :can-cancel="true" 
        :on-cancel="onCancel"
        :is-full-page="fullPage"></loading>
    <div ref="testDiv" class="fluid-container">
      <div>
        <div class="container">
          <span class="md-title"></span>
          <md-steppers :md-active-step.sync="active" md-linear>
            <md-step id="first" md-label="First Step" md-description="Optional" :md-done.sync="first">
              <md-card-content>
                <div class="md-layout md-gutter">
                  <div class="md-layout-item md-size-15 md-xsmall-size-100" style="text-align:right;">
                    <md-button style="position: relative;top: 50%;transform: translateY(-50%);" class="md-raised md-primary"><span>ค้นหา</span> </md-button>
                  </div>
                  <div class="md-layout-item md-size-20 md-xsmall-size-100">
                    <span class="md-title sub">
                        เลขที่ใบเสนอราคา
                    </span>
                    <md-field>
                      <md-select  v-hotkey="keymap"  @input="showdocno" placeholder="กรุณาเลือก" v-model="tablecode" name="country" id="country">
                        <md-option value="RO">ใบสั่งจอง</md-option>
                        <md-option value="SO">ใบสั่งขาย</md-option>
                        <!-- <md-option value="BO">BackOrder</md-option> -->
                      </md-select>
                    </md-field>
                  </div>
                  <div :class="attention" class="md-layout-item md-size-25 md-xsmall-size-100">
                    <!-- :class="disablebilltype+'0'" -->
                    <span ref="focustype" class="md-title sub">
                                      ประเภทเสนอราคา
                                    </span>
                    <!-- v-show="disablebilltype"   -->
                    <md-field>
                      <!-- :disabled="disablebilltype" -->
                      <md-select @input="showdocno(),changePriceType()" v-model="billtype" name="country" id="country" placeholder="กรุณาเลือก">
                        <md-option value="0">ขายสินค้าเงินสด</md-option>
                        <md-option value="1">ขายสินค้าเงินเชื่อ</md-option>
                      </md-select>
                    </md-field>
                  </div>
                  <!-- <div class="md-layout-item md-size-5 md-xsmall-size-100">
                               </div> -->
                  <div id="notop_mobile" style="position: relative; top: 25px;" class="md-layout-item md-size-40 md-xsmall-size-100">
                    <md-field>
                      <label>เลขที่เอกสาร</label>
                      <md-input disabled v-model="docno"></md-input>
                    </md-field>
                  </div>
                </div>
                <div class="md-layout md-gutter">
                  <div class="md-layout-item md-size-15 md-xsmall-size-100">
                  </div>
                  <div class="md-layout-item md-size-45 md-xsmall-size-100">
                    <span class="md-title sub">
                                      ประเภทภาษี
                                    </span>
                    <md-field>
                      <md-select name="country" v-model="taxtype" id="country" placeholder="ประเภทภาษี">
                        <md-option value="ภาษีแยกนอก">ภาษีแยกนอก</md-option>
                        <md-option value="ภาษีรวมใน">ภาษีรวมใน</md-option>
                        <md-option value="ภาษีอัตราศูนย์">ภาษีอัตราศูนย์</md-option>
                      </md-select>
                    </md-field>
                  </div>
  
                  <div id="changetop_mobile" style="position:relative" class=" md-layout-item md-size-40 md-xsmall-size-100">
                    <span class="md-title sub">
                                      วันที่ออก
                                    </span>
                    <div style="position:relative;height:100%;">
                      <md-icon style="float:left;position:relative;top:28px;margin-right:5px;">calendar_today</md-icon>
                      <datepicker v-model="datenow_datepicker" input-class="form-control tc" style="position:relative;top:15px;" :language="languages[language]" format="d MMMM yyyy"></datepicker>
                    </div>
                  </div>
                  <!--  -->
                </div>
  
                <div class="md-layout md-gutter">
                  <div class="md-layout-item md-size-15 md-xsmall-size-100">
  
                  </div>
                  <div class="md-layout-item md-size-45 md-xsmall-size-100">
                    <md-field>
                      <md-icon>account_circle</md-icon>
                      <label>รหัสลูกค้า</label> 
                      <md-input @blur="fsearchcus" required @keyup.enter="fsearchcus" v-model="searchcus"></md-input>
                    
                      <md-avatar style="position:absolute;right:0;top:15px">
                    <md-icon>info</md-icon>
                      <md-tooltip  md-direction="top"> <md-icon style="color:white;">keyboard</md-icon> รหัสลูกค้า หรือ ชื่อ + Enter</md-tooltip>
                    </md-avatar>
                    </md-field>
                  </div>
  
                  <div style="position: relative; top: 4px;" class="md-layout-item md-size-40 md-xsmall-size-100">
                    <md-field>
                      <label>ชื่อลูกค้า</label>
                      <md-input disabled v-model="detailcus"></md-input>
                    </md-field>
                  </div>
                </div>
                <!-- table -->
                <div class="md-layout md-gutter">
                  <md-table class="col-12" v-model="searched" md-sort="name" md-sort-order="asc" md-card md-fixed-header>
                    <md-table-toolbar>
                      <div class="md-toolbar-section-start">
                        <div style="min-height:42px;position:relative" class="md-title">
                          <div style="float:left;position:relative;top:13px;margin-right:10px">ข้อมูลสินค้า</div>
  
                          <div style="float:left;width:200px">
                            <md-field>
                              <label>เพิ่มสินค้า</label>
                              <md-input ref="addproduct" v-model="keywordproduct" @keyup.enter="addproduct"></md-input>
                            </md-field>
                               <md-avatar style="position: absolute; top: 15px; left: 273px;">
                            <md-icon style="color:grey">info</md-icon>
                              <md-tooltip md-direction="top"> <md-icon style="color:white;">keyboard</md-icon> รหัสสินค้า หรือ ชื่อสินค้า + Enter</md-tooltip>
                            </md-avatar>
                          </div>
                          <!-- <md-input style="float:left" required @keyup.enter="fsearchcus" v-model="searchcus"></md-input>
                            -->
                          <md-button @click="addproduct" class="md-icon-button md-raised md productadd">
                            <md-icon>add</md-icon>
                          </md-button>
                        </div>
                      </div>
  
                      <md-field md-clearable class="md-toolbar-section-end">
                        <md-input placeholder="ค้นหาสินค้า" v-model="search" @input="searchOnTable" />
                      </md-field>
                    </md-table-toolbar>
  
                    <md-table-empty-state style="width:100% !important;" md-label="ไม่พบสินค้า" :md-description="`ไม่มีสินค้า  '${search}' ในระบบกรุณาตรวจสอบใหม่อีกครั้ง`">
                      <md-button class="md-primary md-raised">เพิ่มข้อมูลสินค้า</md-button>
                    </md-table-empty-state>
  
                    <md-table-row @click="checkitem" slot="md-table-row"  slot-scope="{ item }">
                         <!-- <md-table-cell md-label="ลำดับ" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell> -->
                      <md-table-cell md-label="รหัสสินค้า" md-sort-by="item_code" md-numeric><input type="text" class="datatable" disabled v-model="item.item_code"></md-table-cell>
                      <md-table-cell md-label="ชื่อสินค้า" md-sort-by="item_name"><input type="text" class="datatable" disabled v-model="item.item_name"></md-table-cell>
                      <md-table-cell md-label="คลังสินค้า" md-sort-by="wh_code"><input type="text" style="padding-right: 31px !important;" class="datatable" v-model="item.wh_code"><div @click="searchstorecode(item)"><md-icon class="search_unitcode">arrow_drop_down</md-icon></div></md-table-cell>
                      <md-table-cell md-label="ที่เก็บ" md-sort-by="shelf_code"><input type="text" style="padding-right: 31px !important;" class="datatable" v-model="item.shelf_code"><div @click="searchstorecode(item)"><md-icon class="search_unitcode">arrow_drop_down</md-icon></div></md-table-cell>
                      <md-table-cell md-label="หน่วยนับ" md-sort-by="unit_code"><input  type="text" style="padding-right: 31px !important;" class="datatable" v-model="item.unit_code.trim()"><div @click="searchunticode(item)"><md-icon class="search_unitcode">arrow_drop_down</md-icon></div></md-table-cell>
                      <md-table-cell md-label="จำนวน" md-sort-by="qty"><input type="text" class="datatable" @keyup="calculatedata(item)" v-model.number="item.qty"></md-table-cell>
                      <md-table-cell md-label="ราคา/หน่วย" md-sort-by="price"><input type="text" disabled class="datatable" @keyup="calculatedata(item)" v-model="item.price"></md-table-cell>
                      <!-- <md-table-cell md-label="ราคา/หน่วย" v-if="billtype == 1" md-sort-by="price2"><input type="text" class="datatable" @keyup="calculatedata(item)" style="width:100%" v-model.number="item.price2"></md-table-cell> -->
                      <md-table-cell md-label="ส่วนลด" md-sort-by="discount_word"><input type="text" class="datatable" @keyup="calculatedata(item)" v-model="item.discount_word"></md-table-cell>
                      <md-table-cell md-label="จำนวนเงิน" md-sort-by="item_amount"><input type="text" disabled class="datatable" v-model.number="item.item_amount"></md-table-cell>
                      <!-- <md-table-cell md-label="เงื่อนไขการขนส่ง" md-sort-by="because">{{ item.because }}</md-table-cell> -->
                      <md-table-cell md-label=""><md-button @click="removeProduct(item.index)"><md-icon class="search-icon">delete</md-icon></md-button></md-table-cell>
                    </md-table-row>
                  </md-table>
                </div>
                <!-- table  -->
  
                <div style="margin-top:15px" class="md-layout md-gutter">
                  <div class="md-layout-item md-size-80 md-xsmall-size-100" style="text-align:right;">
  
                    <span class="md-title subnotop">
                                      รวมมูลค่าสินค้า
                                    </span>
                  </div>
  
                  <div class="md-layout-item md-size-10 md-xsmall-size-100 res_mobile" style="text-align:right;">
  
                    <span class="md-title subnotop">
                                      {{ convertmoney(totalprice) }}
                                    </span>
  
  
                  </div>
                  <div class="md-layout-item md-size-10 md-xsmall-size-100" style="text-align:center;">
  
                    <span class="md-title subnotop " style="left:10px">
                                      บาท 
                                    </span>
  
                  </div>
  
  
                </div>
                <div class="md-layout md-gutter">
  
                  <div class="md-layout-item md-size-80 md-xsmall-size-100" style="text-align:right;">
                    <span class="md-title subnotop">
                                      มูลค่าสินค้ายกเว้นภาษี
                                    </span>
                  </div>
  
                  <div class="md-layout-item md-size-10 md-xsmall-size-100" style="text-align:right;">
                    <span class="md-title subnotop">
                                     0.00
                                    </span>
  
                  </div>
                  <div class="md-layout-item md-size-10 md-xsmall-size-100" style="text-align:center;">
                    <span class="md-title subnotop" style="left:10px">
                                      บาท 
                                    </span>
                  </div>
                </div>
  
                <div class="md-layout md-gutter">
  
                  <div class="md-layout-item md-size-80 md-xsmall-size-100" style="text-align:right;">
                    <span class="md-title subnotop">
                                      ส่วนลด
                            </span>
  
                  </div>
  
                  <div class="md-layout-item md-size-10 md-xsmall-size-100" style="text-align:right;">
                    <span class="md-title subnotop">
                                     <input ref="discount"  v-model.number="caldiscount" style="width:100%;text-align:right;" type="text">
                              </span>
                  </div>
  
                  <div class="md-layout-item md-size-10 md-xsmall-size-100">
                    <md-button style="width:5% !important" @click="calbathordiscount" v-show="percal" class="md-raised md-primary">%</md-button>
                    <md-button style="width:5% !important" @click="calbathordiscount" v-show="!percal" class="md-raised md-primary">บาท</md-button>
                  </div>
                </div>
  
                <div class="md-layout md-gutter">
  
                  <div class="md-layout-item md-size-80 md-xsmall-size-100" style="text-align:right;">
                    <span class="md-title subnotop">
                                      ภาษีมูลค่าเพิ่ม
                                    </span>
                  </div>
  
                  <div class="md-layout-item md-size-10 md-xsmall-size-100" style="text-align:right;">
                    <span class="md-title subnotop">
                                    {{ convertmoney(dif_fee) }}
                                    </span>
                  </div>
  
                  <div class="md-layout-item md-size-10 md-xsmall-size-100" style="text-align:center;">
                    <span class="md-title subnotop" style="left:10px">
                                      บาท 
                                    </span>
                  </div>
                </div>
  
                <div class="md-layout md-gutter">
  
                  <div class="md-layout-item md-size-80 md-xsmall-size-100" style="text-align:right;">
                    <span class="md-title subnotop">
                                      มูลค่ารวมภาษี
                                    </span>
                  </div>
  
                  <div class="md-layout-item md-size-10 md-xsmall-size-100" style="text-align:right;">
                    <span class="md-title subnotop">
                                     {{ convertmoney(cal_totalprice) }}
                                    </span>
                  </div>
  
                  <div class="md-layout-item md-size-10 md-xsmall-size-100" style="text-align:center;">
                    <span class="md-title subnotop" style="left:10px">
                                      บาท 
                                    </span>
                  </div>
                </div>
  
                <div class="md-layout md-gutter">
  
                  <div class="md-layout-item md-size-80 md-xsmall-size-100" style="text-align:right;">
                    <span class="md-title subnotop">
                                      มูลค่าสุทธิ
                                    </span>
                  </div>
  
                  <div class="md-layout-item md-size-10 md-xsmall-size-100" style="text-align:right;">
                    <span class="md-title subnotop">
                                     {{ convertmoney(cal_totalprice) }}
                                    </span>
                  </div>
  
                  <div class="md-layout-item md-size-10 md-xsmall-size-100" style="text-align:center;">
                    <span class="md-title subnotop" style="left:10px">
                                      บาท 
                            </span>
                  </div>
  
                </div>
              </md-card-content>
  
              <md-button style="float:right;" @click="setDone('first', 'second')" class="md-raised md-primary"><span>ถัดไป</span> </md-button>
              <!--  -->
  
            </md-step>
            <md-step id="second" md-label="Second Step" :md-error="secondStepError" :md-done.sync="second">
              <!--  -->
              <div style="display:inline-block">
                <form class="md-layout" style="justify-content: center;">
                  <md-card style="margin-right:8px;margin-bottom:8px;" class="md-layout-item md-size-90 md-small-size-100">
                    <md-card-header>
                      <div class="md-title ">พนักงาน</div>
                    </md-card-header>
                    <md-card-content>
                      <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-100" style="position:relative">
                          <md-field>
                            <label for="first-name subnotop">รหัสพนักงานขาย</label>
                            <md-input name="first-name" ref="codesale" @keyup.enter="searchsale_step2" v-model="salecode" id="first-name" autocomplete="given-name" />
                          </md-field>
                               <md-avatar style="position: absolute; top: 15px;right:10px;">
     <md-icon style="color:grey">info</md-icon>
      <md-tooltip  md-direction="top"> <md-icon style="color:white;">keyboard</md-icon> รหัสพนักงาน หรือ ชื่อพนักงาน + Enter</md-tooltip>
    </md-avatar>
                          <!-- <md-button style="min-width: 50px;" class="buttonemp" @click="focussearchcus">
                            <md-icon>clear</md-icon>
                          </md-button> -->
                        </div>
                        <div class="md-layout-item md-size-50 md-small-size-100">
                          <md-field>
                            <label for="last-name subnotop">แผนก</label>
                            <md-input name="last-name" id="last-name" @keyup.enter="searchdepart_step2" v-model="department" autocomplete="family-name" />
                          </md-field>
                                 <md-avatar style="position: absolute; top: 15px;right:10px;">
     <md-icon style="color:grey">info</md-icon>
      <md-tooltip  md-direction="top"> <md-icon style="color:white;">keyboard</md-icon> รหัสแผนก หรือ ชื่อแผนก + Enter</md-tooltip>
    </md-avatar>
                        </div> 
                        <div class="md-layout-item md-size-50 md-small-size-100">
                          <md-field>
                            <label for="last-name">รหัสผู้ติดต่อ // ไม่มีฟิลรับ</label>
                            <md-input v-model="contact" name="last-name" id="last-name" autocomplete="family-name"/>
                          </md-field>
                          <md-button style="min-width: 50px;" class="buttonemp" @click="tests">
                            <md-icon>search</md-icon>
                          </md-button>
                        </div>
                        <div class="md-layout-item md-size-50 md-small-size-100">
                          <md-field>
                            <label for="last-name">การจัดสรร</label>
                            <md-input name="last-name" id="last-name" @keyup.enter="searchAllocate" v-model="Allocate" autocomplete="family-name" />
                          </md-field>
                                <md-avatar style="position: absolute; top: 15px;right:10px;">
     <md-icon style="color:grey">info</md-icon>
      <md-tooltip  md-direction="top"> <md-icon style="color:white;">keyboard</md-icon> รหัสการจัดสรร หรือ ชื่อการจัดสรร + Enter</md-tooltip>
    </md-avatar>
                        </div>
                        <div class="md-layout-item md-size-100 md-small-size-100">
                          <md-field>
                            <label for="last-name">โครงการ</label>
                            <md-input name="last-name" id="last-name" @keyup.enter="searchproject_step2" v-model="project" autocomplete="family-name" />
                          </md-field>
                                <md-avatar style="position: absolute; top: 15px;right:10px;">
     <md-icon style="color:grey">info</md-icon>
      <md-tooltip  md-direction="top"> <md-icon style="color:white;">keyboard</md-icon> รหัสโครงการ หรือ ชื่อโครงการ + Enter</md-tooltip>
    </md-avatar>
                        </div>
                      </div>
                    </md-card-content>
                    <md-card-actions>
                    </md-card-actions>
                  </md-card>
  
                
  
                  <md-card style="margin-bottom:8px;margin-right:8px;" class="md-layout-item md-size-45 md-small-size-100">
                    <md-card-header>
                      <div class="md-title ">ยืนราคา</div>
                    </md-card-header>
                    <md-card-content>
                      <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="first-name subnotop">ยืนราคา</label>
                            <md-input name="first-name" v-model="validity" id="first-name" autocomplete="given-name" />
                          </md-field>
                          <label class="abright" for="first-name subnotop ">วัน</label>
                        </div>
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="last-name subnotop">ลูกค้าต้องตอบรับภายใน</label>
                            <md-input name="last-name" id="last-name" autocomplete="family-name" />
                          </md-field>
                          <label class="abright" for="first-name subnotop ">วัน</label>
                        </div>
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="last-name">เอกสารหมดอายุภายใน</label>
                            <md-input @keyup="calexpiredate" v-model="expire_date" name="last-name" id="last-name" autocomplete="family-name" />
                          </md-field>
                          <label class="abright" for="first-name subnotop ">วัน</label>
                        </div>
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="last-name">ส่งมอบภายใน</label>
                            <md-input name="last-name" @keyup="calDeliverdate" v-model="Deliver_date" id="last-name" autocomplete="family-name" />
                          </md-field>
                          <label class="abright" for="first-name subnotop ">วัน</label>
                        </div>
                        <div class="md-layout-item md-size-50 md-xsmall-size-100">
                          <md-field>
                            <label for="last-name">เครดิต(วัน)</label>
                            <md-input disabled v-model="bill_credit" name="last-name" id="last-name" autocomplete="family-name" />
                          </md-field>
                          <label class="abright" for="first-name subnotop ">วัน</label>
                        </div>
  
                        <div style="position:relative;top:-30px;" class=" md-layout-item md-size-50 md-xsmall-size-100">
                          <span class="md-title subnotop" style="position: relative; top: 20px;">วันที่เริ่มตามลูกค้า</span>
                          <div style="position:relative;">
                            <md-icon style="float:left;position:relative;top:28px;margin-right:5px;">calendar_today</md-icon>
                            <datepicker calendar-class="calendarfollowcus" input-class="form-control" style="position:relative;top:15px;width: 80%;" :language="languages[language]" format="d MMMM yyyy"></datepicker>
                          </div>
                        </div>
                        <div class="md-layout-item md-size-50 md-xsmall-size-100">
                          <span class="md-title sub" style="font-size: 18px;">
                                      เงื่อนไขการขนส่ง
                                    </span>
                          <md-field>
                            <md-select placeholder="กรุณาเลือก" v-model="is_condition_send" name="condition_send" id="condition_send">
                              <md-option value="0">รับเอง</md-option>
                              <md-option value="1">ส่งให้</md-option>
                            </md-select>
                          </md-field>
                        </div>
                      </div>
                    </md-card-content>
                    <md-card-actions>
                    </md-card-actions>
                  </md-card>
  
                  <md-card style="margin-bottom:8px;" class="md-layout-item md-size-45 md-small-size-100">
                    <md-card-header>
                      <div class="md-title ">วันที่หมดอายุ</div>
                    </md-card-header>
                    <md-card-content>
                      <div class="md-layout md-gutter">
                        <div style="position:relative;top:-30px" class=" md-layout-item md-size-100 md-xsmall-size-100">
                          <span class="md-title subnotop" style="position: relative; top: 20px;">
                                      วันที่หมดอายุ
                                    </span>
                          <div style="position:relative;">
                            <md-icon style="float:left;position:relative;top:28px;margin-right:5px;">calendar_today</md-icon>
                            <datepicker @input="calexpire_Date" v-model="expiredate_cal" input-class="form-control" style="position:relative;top:15px;width: 80%;" :language="languages[language]" format="d MMMM yyyy"></datepicker>
                          </div>
                        </div>
                        <!--  -->
                        <div style="position:relative;top:-30px" class=" md-layout-item md-size-100 md-xsmall-size-100">
                          <span class="md-title subnotop" style="position: relative; top: 20px;">
                                      ลงวันที่
                                    </span>
                          <div style="position:relative;">
                            <md-icon style="float:left;position:relative;top:28px;margin-right:5px;">calendar_today</md-icon>
                            <datepicker @input="calDueDate_date" v-model="DueDate_date" input-class="form-control tc" style="position:relative;top:15px;width: 80%;" :language="languages[language]" format="d MMMM yyyy"></datepicker>
                          </div>
                        </div>
                        <!--  -->
                        <div style="position:relative;top:-30px" class=" md-layout-item md-size-100 md-xsmall-size-100">
                          <span class="md-title subnotop" style="position: relative;top:20px">
                                      วันที่ครบกำหนด
                                  </span>
                          <md-icon style="position:relative;top:15px;color:black">lock</md-icon>
  
                          <div style="position:relative;">
                            <md-icon style="float:left;position:relative;top:28px;margin-right:5px;">calendar_today</md-icon>
                            <datepicker disabled v-model="DueDate_cal" input-class="form-control tc" style="position:relative;top:15px;width: 80%;" :language="languages[language]" format="d MMMM yyyy"></datepicker>
                          </div>
                        </div>
                        <!--  -->
                        <div style="position:relative;top:-15px" class="md-layout-item md-size-50 md-xsmall-size-100">
                          <span class="md-title sub" style="font-size: 18px;">
                                      คำตอบจากลูกค้า
                                    </span>
                          <md-field>
                            <md-select placeholder="กรุณาเลือก" v-model="answer_cus" name="condition_send" id="condition_send">
                              <md-option value="0">รอตอบกลับ</md-option>
                              <md-option value="1">ตอบกลับแล้ว</md-option>
                              <md-option value="2">ไม่รับในราคา</md-option>
                            </md-select>
                          </md-field>
                        </div>
                        <div class="md-layout-item md-size-50 md-xsmall-size-100" style="top:16px">
                          <md-field>
                            <label for="pattern_order">รูปแบบการสั่งซื้อสินค้า</label>
                            <md-input name="pattern_order" id="pattern_order" v-model="pattern_order" autocomplete="family-name" />
                          </md-field>
                        </div>
                        <!--  -->
                      </div>
                    </md-card-content>
                    <md-card-actions>
                    </md-card-actions>
                  </md-card>

                    <!-- <md-card class="md-layout-item md-size-90 md-small-size-100" :style="{height: docheight}" style="transition:all 0.5s;margin-bottom:8px;">
                    <md-card-header>
                      <div class="md-title ">กลุ่มเอกสาร
                        <md-switch @change="isshowdoc_fuc" style="position:absolute;right:0;" v-model="isshowdocument">{{ convertshowdoc(isshowdocument) }}</md-switch>
                      </div>
                    </md-card-header>
                    <md-card-content v-if="isshowdocument">
                      <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="groupdoc_name subnotop">เอกสาร</label>
                            <md-input name="groupdoc_name" id="groupdoc_name" v-model="groupdoc_name" autocomplete="given-name" />
                          </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="groupdoc_currency subnotop">รหัสสกุลเงิน</label>
                            <md-input name="groupdoc_currency" id="groupdoc_currency" v-model="groupdoc_currency" autocomplete="family-name" />
                          </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="groupdoc_exchange">อัตราแลกเปลี่ยน</label>
                            <md-input name="groupdoc_exchange" id="groupdoc_exchange" v-model="groupdoc_exchange" autocomplete="family-name" />
                          </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="groupdoc_vatrate">อัตราภาษีมูลค่าเพิ่ม</label>
                            <md-input name="groupdoc_vatrate" id="groupdoc_vatrate" v-model="groupdoc_vatrate" autocomplete="family-name" />
                          </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="groupdoc_moneytotal">ยอดเงินบาทสุทธิ</label>
                            <md-input name="groupdoc_moneytotal" id="groupdoc_moneytotal" v-model="groupdoc_moneytotal" autocomplete="family-name" />
                          </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="groupdoc_delivery">ค่าขนส่ง</label>
                            <md-input name="groupdoc_delivery" id="groupdoc_delivery" v-model="groupdoc_delivery" autocomplete="family-name" />
                          </md-field>
                        </div>
                      </div>
                    </md-card-content>
                    <md-card-actions>
                    </md-card-actions>
                  </md-card> -->
  
                  <md-card class="md-layout-item md-size-90 md-small-size-100" style="margin-bottom:8px">
                    <md-card-header>
                      <div class="md-title ">ข้อมูลลูกค้า</div>
                    </md-card-header>
                    <md-card-content>
                      <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-50">
                          <md-field>
                            <label for="first-name subnotop">ผู้รับสินค้า</label>
                            <md-input name="first-name" id="first-name" v-model="cus_name" />
                          </md-field>
                        </div>
                               <div class="md-layout-item md-small-size-50">
                          <md-field>
                            <label for="last-name">เวลาที่รับ</label>
                            <md-input name="last-name" v-model="cus_timetorecive" id="last-name" autocomplete="family-name" />
                          </md-field>
                        </div>
                    
                      </div>
                      <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-50">
                          <md-field>
                            <label for="last-name subnotop">ทะเบียนลูกค้า</label>
                            <md-input name="last-name" id="last-name" autocomplete="family-name" v-model="cus_regis" />
                          </md-field>
                        </div>
                         <div class="md-layout-item md-small-size-50">
                          <md-field>
                            <label for="last-name">สถานที่ขนส่ง</label>
                            <md-input name="last-name" v-model="cus_transport" id="last-name" autocomplete="family-name" />
                          </md-field>
                        </div>
                          </div>

                 
                      <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="last-name">หมายเหตุ</label>
                            <md-input name="last-name" id="last-name" v-model="cus_etc" autocomplete="family-name" />
                          </md-field>
                        </div>
                      </div>
                    </md-card-content>
                    <md-card-actions>
                    </md-card-actions>
                  </md-card>

                  <transition name="fade">
                  <md-card v-show="is_condition_send == '1'" class="md-layout-item md-size-90 md-small-size-100">
                    <md-card-header>
                      <div class="md-title ">ที่อยู่ลูกค้า</div>
                    </md-card-header>
                    <md-card-content>
                      
                      <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="first-name subnotop">ที่อยู่ (เลขที่, ตึก, ชื่อถนน)</label>
                            <md-input name="first-name" id="first-name" v-model="cus_address" autocomplete="given-name" />
                          </md-field>
                        </div>
                      </div>

                 

                      <div class="md-layout md-gutter">
                         <div class="md-layout-item md-small-size-50">
                          <md-field>
                            <label for="last-name">ตำบล/แขวง</label>
                            <md-input name="last-name" v-model="cus_district" id="last-name" autocomplete="family-name" />
                          </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-50">
                          <md-field>
                            <label for="last-name subnotop">อำเภอ/เขต</label>
                            <md-input name="last-name" id="last-name" v-model="cus_canton" autocomplete="family-name" />
                          </md-field>
                        </div>
                        </div>

                      <div class="md-layout md-gutter">
                          <div class="md-layout-item md-small-size-50">
                          <md-field>
                            <label for="last-name">จังหวัด</label>
                            <md-input name="last-name" v-model="cus_province" id="last-name" autocomplete="family-name" />
                          </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-50">
                          <md-field>
                            <label for="last-name">รหัสไปรษณีย์</label>
                            <md-input name="last-name" id="last-name" v-model="cus_post" autocomplete="family-name" />
                          </md-field>
                        </div>
                      </div>
                      
                       <div class="md-layout md-gutter">
                          <div class="md-layout-item md-xlarge-size-50 md-large-size-50 md-xsmall-size-50 md-small-size-50 md-medium-size-50">
                          <md-field>
                            <label for="last-name">เบอร์โทรศัพท์ผู้รับสินค้า</label>
                            <md-input name="last-name" v-model="cus_tel" id="last-name" autocomplete="family-name" />
                          </md-field>
                        </div>
                      </div>


                    </md-card-content>
                    <md-card-actions>
                    </md-card-actions>
                  </md-card>
                  </transition>


                  
                </form>
              </div>
              <md-button style="float:right;right: 50px;" class="md-raised md-primary" @click="setDone('second', 'third')">บันทึก</md-button>
            </md-step>
  
            <md-step id="third" md-label="Third Step" :md-done.sync="third">
  
              <div class="md-layout md-gutter">
                <md-toolbar style="padding:30px 0" class="md-primary">
                  <div class="md-layout-item md-xlarge-size-40 md-large-size-40 md-xsmall-size-40 md-small-size-40 md-medium-size-40">
                    <h3 style="font-size: 46px; overflow: visible;padding:10px;" class="md-title">INVOICE</h3>
                  </div>
                  <div style="text-align:right;" class="md-layout-item md-xlarge-size-20  md-large-size-20 md-xsmall-size-20 md-small-size-20 md-medium-size-20">
                  </div>
                  <div style="text-align:right;" class="md-layout-item md-xlarge-size-20  md-large-size-20 md-xsmall-size-20 md-small-size-20 md-medium-size-20">
                    <h4 style="overflow:visible;white-space:normal;font-size:15px" class="md-title">ติดต่อ นพดลพานิช (053) 261-000 E-mail : sale@nopadol.com</h4>
                  </div>
                  <div style="text-align:right;" class="md-layout-item md-xlarge-size-20  md-large-size-20 md-xsmall-size-20 md-small-size-20 md-medium-size-20">
                    <h4 style="padding-right:10px;overflow:visible;white-space:normal;font-size:15px" class="md-title">ถนน เชียงใหม่- ดอยสะเก็ด ตำบล ฟ้าฮ่าม อำเภอเมืองเชียงใหม่ เชียงใหม่ 50000</h4>
                  </div>
                </md-toolbar>
  
                <div style="text-align:left;word-break: break-word;" class="md-layout-item md-xlarge-size-30 md-large-size-30 md-xsmall-size-30 md-small-size-30 md-medium-size-30 contentpadding">
                  <span style="color:grey;">Billed To</span>
                  <span style="display:block;">Code {{ searchcus }}</span>
                  <span style="display:block;">Name {{ detailcus }}</span>
  
                </div>
                <div style="text-align:left" class="md-layout-item md-xlarge-size-30  md-large-size-30 md-xsmall-size-30 md-small-size-30 md-medium-size-30 contentpadding">
                  <span style="color:grey"> Invoice Number</span>
                  <span style="display:block;">Docno {{ docno }}</span>
                  <br>
                  <span style="color:grey">Date Of Issue</span>
                  <span style="display:block;">Date {{ convertmonth_preview(datenow_datepicker) }}</span>
                </div>
                <div style="text-align:right" class="md-layout-item md-xlarge-size-40  md-large-size-40 md-xsmall-size-40 md-small-size-40 md-medium-size-40 contentpadding">
  
                  <span style="display:block;color:grey;padding-bottom:15px;">   Invoice Total</span>
                  <span style="font-size: 35px;">  {{ convertmoney(cal_totalprice) }} บาท</span>
  
                </div>
  
                <div style="text-align:left" class="md-layout-item md-xlarge-size-100  md-large-size-100 md-xsmall-size-100 md-small-size-100 md-medium-size-100 contentpadding">
                  <div class="underline"></div>
                </div>
                <div class="table-responsive" style="overflow-y: auto;padding:0 20px">
                  <table id="bordernone" style="border-bottom:none;border-top:none;" class="table table-hover">
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
                      <tr v-for="(val,index) in dproducts" style="width:100%;cursor:pointer;border-bottom: 1px rgba(0,0,0,0.25) solid;text-align:center">
                        <td>{{index+1}}</td>
                        <td >{{val.item_code}} {{val.item_name}}</td>
                        <td >{{val.price}}</td>
                        <td >{{val.qty}}</td>
                        <td >{{val.item_amount}}</td>
                        <div style="background:black;width:100%;height:2px;"></div>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div style="text-align:right" class="md-layout-item md-xlarge-size-100  md-large-size-100 md-xsmall-size-100 md-small-size-100 md-medium-size-100 contentpadding">
                  <div>
                    <span class="paddingright" style="color:#448aff;font-size:16px;">รวมมูลค่าสินค้า</span>
                    <p style="display:inline-block;width:90px"> {{ convertmoney(totalprice) }} บาท </p>
                  </div>
                  <div>
                    <span class="paddingright" style="color:#448aff;font-size:16px;">ส่วนลด</span>
                    <p style="display:inline-block;width:90px"> {{ caldiscount }}
                      <span v-show="percal">%</span>
                      <span v-show="!percal">บาท</span></p>
                  </div>
                  <div>
                    <span class="paddingright" style="color:#448aff;font-size:16px;">ภาษีมูลค่าเพิ่ม</span>
                    <p style="display:inline-block;width:90px"> {{ convertmoney(dif_fee) }} บาท </p>
                  </div>
                  <div>
                    <span class="paddingright" style="color:#448aff;font-size:16px;">มูลค่าสุทธิ</span>
                    <p style="display:inline-block;width:90px"> {{ convertmoney(cal_totalprice) }} บาท </p>
                  </div>
                </div>
                <div style="text-align:right" class="md-layout-item md-xlarge-size-100  md-large-size-100 md-xsmall-size-100 md-small-size-100 md-medium-size-100">
                  <span> This invoice is brought to you by </span> <img style="width: 100px; height: 50px;" src="../../assets/nopadol.jpg">
                </div>
  
  
              </div>
              <md-button class="md-raised md-primary" @click="setDone('third')">สิ้นสุด</md-button>
                    <!-- testprint -->
              <form v-show="tablecode == 'SO'" id="tax_report" :action="php + '/vue_sale/report_pdf/report_sale.php'" method="post" target="_blank">
			      		<input type="hidden" name="datasale">
                   <!-- <span style="float:right;">ปริ้นใบสั่งขาย :</span> -->
                     <md-button type="submit" style="float: right; position: relative; top: -37px;" class="md-raised md-primary">Print ใบสั่งขาย</md-button>
			      	</form>
            
              <form v-show="tablecode == 'RO'" :action="php + '/vue_sale/report_pdf/report_ro.php'" method="post" target="_blank"> -->
			      		<input type="hidden" name="datasale">
                   <md-button type="submit" style="float: right; position: relative; top: -37px;right: 10px;" class="md-raised md-primary">Print ใบสั่งจอง</md-button>
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
            <md-tab md-label="">
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
                    <tr @click="C_customer(val)" v-for="(val,index) in detailcusall" style="text-align:center;cursor:pointer">
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
            <md-tab md-label="">
              <div class="table-responsive" style="overflow-y: auto;">
                <table class="table table-hover">
                  <thead align="center">
                    <tr>
                      <!--<th style=''>client_id</th>-->
                      <th style="white-space: nowrap;">ลำดับ</th>
                      <th style="white-space: nowrap;">รูป</th>
                      <th style="overflow:auto;white-space: nowrap;">รหัสสินค้า</th>
                      <th style="white-space: nowrap;padding: .75rem 5rem;">ชื่อสินค้า</th>
                      <th style="white-space: nowrap;">หน่วยนับ</th>
                      <th style="white-space: nowrap;" v-show="billtype == 0">ราคา(เงินสด)</th>
                      <th style="white-space: nowrap;" v-show="billtype == 1">ราคา(เงินเชื่อ)</th>
                      <th style="white-space: nowrap;">คงเหลือ</th>
                       <th style="white-space: nowrap;">อัตราส่วน</th>
                    </tr>
                  </thead>
                  <tbody  v-for="(val,index) in dataproductDialog" id="valuetable">
                    <tr @click="findstock(val,index)" style="text-align:center;cursor:pointer">
                      <td  >{{index+1}}</td>
                      <td  v-show="val.pic_path_1"><img style="min-width:50px;height:50px;" class="hoverzoom" :src="val.pic_path_1" alt=""></td>
                      <td  v-show="!val.pic_path_1"><img style="max-width:50px;max-height:50px;" src="../../assets/No_Image_Available.png" alt=""></td>
                      <td style="min-width:80px;" >{{val.item_code}}</td>
                      <td  >{{val.item_name}}</td>
                      <td  >{{val.unit_code}}</td>
                      <td  v-show="billtype == 0">{{val.sale_price_1}}</td>
                      <td  v-show="billtype == 1">{{val.sale_price_2}}</td>
                      <td><div style="height:18px;" >{{ val.stk_qty }} </div></td>
                       <td><div style="height:18px;" >{{ val.rate_1 }} </div></td>
                    </tr>
                    <tr class="nohover">
                      <td style="display:none;"  :class="'trshow'+index" colspan="10" >
                        <span > กรุณาเลือกคลัง </span>
                       <div class="hovercolor" :class="'hover'+index" style="text-align:right;visibility:hidden;height:0;transition:all 0.5s cubic-bezier(0.47, 0.46, 0, 1.02) 0s;"  v-for="(value,index2) in stockall" :key="index2" >
                         <!--  -->
                      <md-button @click="showdetail(val,value,index2)" style="margin: 5px 0" class="md-raised md-primary"> คลังสินค้า : {{val.stk_location[index2].wh_code}} ชั้นเก็บ : {{val.stk_location[index2].shelf_code}} จำนวน : {{val.stk_location[index2].qty}} </md-button>
                      </div>
                      </td>
                    </tr>
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
            <md-tab md-label="">
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
                    <tr @click="selectcus_step2(val)" v-for="(val,index) in searchsaleobj" style="text-align:center;cursor:pointer">
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
            <md-tab md-label="">
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
                    <tr @click="selectdepart_step2(val)" v-for="(val,index) in objdepart" style="text-align:center;cursor:pointer">
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
            <md-tab md-label="">
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
                    <tr @click="selectproject_step2(val)" v-for="(val,index) in objproject" style="text-align:center;cursor:pointer">
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
            <md-tab md-label="">
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
                    <tr @click="selectAllocate_step2(val)" v-for="(val,index) in objAllocate" style="text-align:center;cursor:pointer">
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
            <md-tab md-label="">
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
                    <tr  v-for="(val,index) in unitcode_obj" @click="selectunitcode_step2(val)" style="text-align:center;cursor:pointer">
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


       <!-- search warehouse -->
        <div>
        <md-dialog :md-active.sync="searchwarehousecode_m">
          <md-dialog-title>เปลี่ยน คลัง</md-dialog-title>
          <md-tabs md-dynamic-height>
            <md-tab md-label="">
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
                    <tr v-for="(val,index) in stock_obj" @click="selectwarehousecode(val)" style="text-align:center;cursor:pointer">
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
       <!-- search unitcode -->
    </div>
  </div>
</template>

<script src="../../js/saleorder.js">
</script>

<style src="./saleorder.css">
</style>
<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}
</style>
