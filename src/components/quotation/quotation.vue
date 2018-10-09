<template>
  <div ref="testDiv" class="quotation">
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
                      <md-select @input="showdocno" placeholder="กรุณาเลือก" v-model="tablecode" name="country" id="country">
                        <md-option value="QT">ใบเสนอราคา</md-option>
                        <md-option value="BO">BackOrder</md-option>
                      </md-select>
                    </md-field>
                  </div>
  
                  <div :class="attention" class="md-layout-item md-size-25 md-xsmall-size-100">
                    <span ref="focustype" :class="disablebilltype+'0'" class="md-title sub">
                              ประเภทเสนอราคา
                            </span> <md-icon v-show="disablebilltype" style="position:relative;top:10px;color:black">lock</md-icon>
                    <md-field  >
                      <md-select @input="showdocno"  :disabled="disablebilltype" v-model="billtype" name="country" id="country" placeholder="กรุณาเลือก">
                        <md-option value="0">ขายสินค้าเงินสด</md-option>
                        <md-option value="1">ขายสินค้าเงินเชื่อ</md-option>
                      </md-select>
                    </md-field>
                  </div>
  
                  <!-- <div class="md-layout-item md-size-5 md-xsmall-size-100">
                       </div> -->
  
                  <div style="position: relative; top: 25px;" class="md-layout-item md-size-40 md-xsmall-size-100">
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
                      <md-select name="country" id="country" placeholder="ประเภทภาษี">
                        <md-option value="ภาษีแยกนอก">ภาษีแยกนอก</md-option>
                        <md-option value="ภาษีรวมใน">ภาษีรวมใน</md-option>
                        <md-option value="ภาษีอัตราศูนย์">ภาษีอัตราศูนย์</md-option>
                      </md-select>
                    </md-field>
                  </div>
  
                  <div style="position:relative" class=" md-layout-item md-size-40 md-xsmall-size-100">
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
                      <md-input required @keyup.enter="fsearchcus" v-model="searchcus"></md-input>
                      <md-button style="min-width: 50px;" @click="fsearchcus">
                        <md-icon>search</md-icon>
                      </md-button>
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
                            <label>ค้นหาสินค้า</label>
                            <md-input ref="addproduct" v-model="keywordproduct" @keyup.enter="addproduct"></md-input>
                          </md-field>
                          </div>
                          <!-- <md-input style="float:left" required @keyup.enter="fsearchcus" v-model="searchcus"></md-input>
                    -->
                          <md-button @click="addproduct" class="md-icon-button md-raised md productadd">
                            <md-icon>add</md-icon>
                          </md-button>
                        </div>
                      </div>
  
                      <md-field md-clearable class="md-toolbar-section-end">
                        <md-input placeholder="Search by name..." v-model="search" @input="searchOnTable" />
                      </md-field>
                    </md-table-toolbar>
  
                    <md-table-empty-state style="width:100% !important;" md-label="ไม่พบสินค้า" :md-description="`ไม่มีสินค้า  '${search}' ในระบบกรุณาตรวจสอบใหม่อีกครั้ง`">
                      <md-button class="md-primary md-raised" @click="newUser">เพิ่มข้อมูลสินค้า</md-button>
                    </md-table-empty-state>
  
                    <md-table-row  slot="md-table-row" slot-scope="{ item }">
                      <md-table-cell md-label="รหัสบาร์โค้ด" md-sort-by="id" md-numeric><input type="text"  class="datatable" disabled v-model="item.barcode"></md-table-cell>
                      <md-table-cell md-label="ชื่อสินค้า" md-sort-by="name"><input type="text"  class="datatable" disabled  v-model="item.name"></md-table-cell>
                      <md-table-cell md-label="หน่วยนับ" md-sort-by="count"><input type="text"  class="datatable"  v-model="item.count"></md-table-cell>
                      <md-table-cell md-label="จำนวน" md-sort-by="amount"><input type="text"  class="datatable" @keyup="calculatedata(item)"   v-model.number="item.amount"></md-table-cell>
                      <md-table-cell md-label="ราคา/หน่วย" v-if="billtype == 0" md-sort-by="price"><input type="text" class="datatable"  @keyup="calculatedata(item)"   style="width:100%"  v-model.number="item.price"></md-table-cell>
                      <md-table-cell md-label="ราคา/หน่วย" v-if="billtype == 1" md-sort-by="price2"><input type="text" class="datatable"  @keyup="calculatedata(item)"   style="width:100%"  v-model.number="item.price2"></md-table-cell>
                      <md-table-cell md-label="ส่วนลด" md-sort-by="discount"><input type="text"  class="datatable"  @keyup="calculatedata(item)"  v-model.number="item.discount"></md-table-cell>
                      <md-table-cell md-label="จำนวนเงิน" md-sort-by="allprice"><input type="text" disabled class="datatable" v-model.number="item.allprice"></md-table-cell>
                      <!-- <md-table-cell md-label="เงื่อนไขการขนส่ง" md-sort-by="because">{{ item.because }}</md-table-cell> -->
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
  
                  <div class="md-layout-item md-size-10 md-xsmall-size-100" style="text-align:right;">
  
                    <span class="md-title subnotop">
                              {{ convertmoney(totalprice) }}
                            </span>
  
  
                  </div>
                  <div class="md-layout-item md-size-10 md-xsmall-size-100" style="text-align:center;">
  
                    <span class="md-title subnotop">
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
                             0
                            </span>
  
                  </div>
                  <div class="md-layout-item md-size-10 md-xsmall-size-100" style="text-align:center;">
                    <span class="md-title subnotop">
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
                             <input ref="discount"  v-model="caldiscount" style="width:100%;text-align:right;" type="text">
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
                    <span class="md-title subnotop">
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
                    <span class="md-title subnotop">
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
                    <span class="md-title subnotop">
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
                <form class="md-layout">
                  <md-card class="md-layout-item md-size-50 md-small-size-100">
                    <md-card-header>
                      <div class="md-title ">พนักงาน</div>
                    </md-card-header>
                    <md-card-content>
                      <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="first-name subnotop">รหัสพนักงานขาย</label>
                            <md-input name="first-name" v-model="salecode" id="first-name" autocomplete="given-name" />
                          </md-field>
                          <md-button style="min-width: 50px;" class="buttonemp" @click="tests">
                            <md-icon>search</md-icon>
                          </md-button>
                        </div>
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="last-name subnotop">แผนก</label>
                            <md-input name="last-name" id="last-name" autocomplete="family-name" />
                          </md-field>
                          <md-button style="min-width: 50px;" class="buttonemp" @click="tests">
                            <md-icon>search</md-icon>
                          </md-button>
                        </div>
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="last-name">โครงการ</label>
                            <md-input name="last-name" id="last-name" autocomplete="family-name" />
                          </md-field>
                          <md-button style="min-width: 50px;" class="buttonemp" @click="tests">
                            <md-icon>search</md-icon>
                          </md-button>
                        </div>
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="last-name">รหัสผู้ติดต่อ</label>
                            <md-input name="last-name" id="last-name" autocomplete="family-name" />
                          </md-field>
                          <md-button style="min-width: 50px;" class="buttonemp" @click="tests">
                            <md-icon>search</md-icon>
                          </md-button>
                        </div>
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="last-name">การจัดสรร</label>
                            <md-input name="last-name" id="last-name" autocomplete="family-name" />
                          </md-field>
                          <md-button style="min-width: 50px;" class="buttonemp" @click="tests">
                            <md-icon>search</md-icon>
                          </md-button>
                        </div>
                      </div>
                    </md-card-content>
                    <md-card-actions>
                    </md-card-actions>
                  </md-card>
  
                  <md-card class="md-layout-item md-size-50 md-small-size-100">
                    <md-card-header>
                      <div class="md-title ">กลุ่มเอกสาร</div>
                    </md-card-header>
                    <md-card-content>
                      <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="first-name subnotop">เอกสาร</label>
                            <md-input name="first-name" id="first-name" autocomplete="given-name" />
                          </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="last-name subnotop">รหัสสกุลเงิน</label>
                            <md-input name="last-name" id="last-name" autocomplete="family-name" />
                          </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="last-name">อัตราแลกเปลี่ยน</label>
                            <md-input name="last-name" id="last-name" autocomplete="family-name" />
                          </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="last-name">อัตราภาษีมูลค่าเพิ่ม</label>
                            <md-input name="last-name" id="last-name" autocomplete="family-name" />
                          </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="last-name">ยอดเงินบาทสุทธิ</label>
                            <md-input name="last-name" id="last-name" autocomplete="family-name" />
                          </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="last-name">ค่าขนส่ง</label>
                            <md-input name="last-name" id="last-name" autocomplete="family-name" />
                          </md-field>
                        </div>
                      </div>
                    </md-card-content>
                    <md-card-actions>
                    </md-card-actions>
                  </md-card>
  
                  <md-card class="md-layout-item md-size-50 md-small-size-100">
                    <md-card-header>
                      <div class="md-title ">ยืนราคา</div>
                    </md-card-header>
                    <md-card-content>
                      <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="first-name subnotop">ยืนราคา</label>
                            <md-input name="first-name" id="first-name" autocomplete="given-name" />
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
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="last-name">เครดิต(วัน)</label>
                            <md-input disabled v-model="bill_credit" name="last-name" id="last-name" autocomplete="family-name" />
                          </md-field>
                          <label class="abright" for="first-name subnotop ">วัน</label>
                        </div>
                        <div style="position:relative" class=" md-layout-item md-size-50 md-xsmall-size-100">
                          <span class="md-title subnotop" style="position: relative; top: -3px;">
                              วันที่เริ่มตามลูกค้า
                            </span>
                          <md-datepicker style="position:absolute;top:0;width:85%" v-model="selectedDate" />
                        </div>
                        <div class="md-layout-item md-small-size-100">
                          <md-field class="md-layout-item md-small-size-100">
                            <label for="last-name">Job ID</label>
                            <md-input name="last-name" id="last-name" autocomplete="family-name" />
                          </md-field>
                        </div>
                      </div>
                    </md-card-content>
                    <md-card-actions>
                    </md-card-actions>
                  </md-card>
  
                  <md-card class="md-layout-item md-size-50 md-small-size-100">
                    <md-card-header>
                      <div class="md-title ">วันที่หมดอายุ</div>
                    </md-card-header>
                    <md-card-content>
                      <div class="md-layout md-gutter">
                        <div style="position:relative" class=" md-layout-item md-size-100 md-xsmall-size-100">
                          <span class="md-title subnotop" style="position: relative; top: 20px;">
                              วันที่หมดอายุ
                            </span>
                       <div style="position:relative;">
                      <md-icon style="float:left;position:relative;top:28px;margin-right:5px;">calendar_today</md-icon>
                      <datepicker @input="calexpire_Date"  v-model="expiredate_cal" input-class="form-control" style="position:relative;top:15px;width: 80%;" :language="languages[language]" format="d MMMM yyyy"></datepicker>
                    </div>
                        </div>
                        <!--  -->
                        <div style="position:relative" class=" md-layout-item md-size-100 md-xsmall-size-100">
                             <span class="md-title subnotop" style="position: relative; top: 20px;">
                              ลงวันที่
                            </span>
                       <div style="position:relative;">
                      <md-icon style="float:left;position:relative;top:28px;margin-right:5px;">calendar_today</md-icon>
                      <datepicker @input="calDueDate_date"  v-model="DueDate_date" input-class="form-control tc" style="position:relative;top:15px;width: 80%;" :language="languages[language]" format="d MMMM yyyy"></datepicker>
                    </div>
                        </div>
                        <!--  -->
                        <div style="position:relative;" class=" md-layout-item md-size-100 md-xsmall-size-100">
                          <span class="md-title subnotop" style="position: relative;top:20px">
                              วันที่ครบกำหนด
                          </span><md-icon  style="position:relative;top:15px;color:black">lock</md-icon>

                            <div style="position:relative;">
                      <md-icon style="float:left;position:relative;top:28px;margin-right:5px;">calendar_today</md-icon>
                      <datepicker disabled  v-model="DueDate_cal" input-class="form-control tc" style="position:relative;top:15px;width: 80%;" :language="languages[language]" format="d MMMM yyyy"></datepicker>
                    </div>
                        </div>
                        <div style="position:relative;margin-top: 46px;" class=" md-layout-item md-size-100 md-xsmall-size-100">
                          <span class="md-title subnotop" style="position: relative; top: -3px;">
                              คำตอบจากลูกค้า
                            </span>
                          <md-datepicker style="position:absolute;top:0;width: 85%;" v-model="selectedDate" />
                        </div>
                        <div class="md-layout-item md-small-size-100" style="    margin-top: 41px;">
                          <md-field>
                            <label for="last-name">รูปแบบการสั่งซื้อสินค้า</label>
                            <md-input name="last-name" id="last-name" autocomplete="family-name" />
                          </md-field>
                        </div>
                      </div>
                    </md-card-content>
                    <md-card-actions>
                    </md-card-actions>
                  </md-card>
  
                  <md-card class="md-layout-item md-size-100 md-small-size-100">
                    <md-card-header>
                      <div class="md-title ">เรื่อง</div>
                    </md-card-header>
                    <md-card-content>
                      <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="first-name subnotop">เรื่อง</label>
                            <md-input name="first-name" id="first-name" autocomplete="given-name" />
                          </md-field>
                        </div>
                      </div>
                      <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="last-name subnotop">สิ่งที่ส่งมาด้วย</label>
                            <md-input name="last-name" id="last-name" autocomplete="family-name" />
                          </md-field>
                        </div>
                      </div>
                      <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="last-name">หมายเหตุ1</label>
                            <md-input name="last-name" id="last-name" autocomplete="family-name" />
                          </md-field>
                        </div>
                      </div>
                      <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-100">
                          <md-field>
                            <label for="last-name">หมายเหตุ2</label>
                            <md-input name="last-name" id="last-name" autocomplete="family-name" />
                          </md-field>
                        </div>
                      </div>
                    </md-card-content>
                    <md-card-actions>
                    </md-card-actions>
                  </md-card>
                </form>
              </div>
              <md-button style="float:right;margin-top:10px" class="md-raised md-primary" @click="setDone('second', 'third')">บันทึก</md-button>
            </md-step>
  
            <md-step id="third" md-label="Third Step" :md-done.sync="third">
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias doloribus eveniet quaerat modi cumque quos sed, temporibus nemo eius amet aliquid, illo minus blanditiis tempore, dolores voluptas dolore placeat nulla.</p>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias doloribus eveniet quaerat modi cumque quos sed, temporibus nemo eius amet aliquid, illo minus blanditiis tempore, dolores voluptas dolore placeat nulla.</p>
              <md-button class="md-raised md-primary" @click="setDone('third')">บันทึก</md-button>
            </md-step>
          </md-steppers>
        </div>
      </div>
  
  
      <!-- showDialogcus -->
      <div>
        <md-dialog :md-active.sync="showDialogcus">
          <md-dialog-title>เลือกลูกค้าที่ต้องการ</md-dialog-title>
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
                    </tr>
                  </thead>
                  <tbody id="valuetable">
                    <tr @click="C_customer(val)" v-for="(val,index) in detailcusall" style="text-align:center;cursor:pointer">
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
          <md-tabs md-dynamic-height>
            <md-tab md-label="">
              <div class="table-responsive" style="overflow-y: auto;">
                <table class="table table-hover">
                  <thead align="center">
                    <tr>
                      <!--                                <th style=''>client_id</th>-->
                      <th>ลำดับ</th>
                      <th>รูป</th>
                      <th>รหัสบาร์โค้ด</th>
                      <th>ชื่อสินค้า</th>
                      <th>หน่วยนับ</th>
                      <th v-show="billtype == 0">ราคา(เงินสด)</th>
                      <th v-show="billtype == 1">ราคา(เงินเชื่อ)</th>
                    </tr>
                  </thead>
                  <tbody id="valuetable">
                    <tr @click="showdetail(val)" v-for="(val,index) in dataproductDialog" style="text-align:center;cursor:pointer">
                      <td>{{index+1}}</td>
                      <td v-show="val.pic_path_1"><img style="width:50px;height:50px;" class="hoverzoom" :src="val.pic_path_1" alt=""></td>
                       <td v-show="!val.pic_path_1" ><img style="max-width:50px;max-height:50px;"  src="../../assets/No_Image_Available.png" alt=""></td>
                      <td>{{val.bar_code}}</td>
                      <td>{{val.item_name}}</td>
                      <td>{{val.unit_code}}</td>
                      <td v-show="billtype == 0">{{val.sale_price_1}}</td>
                      <td v-show="billtype == 1">{{val.sale_price_2}}</td>
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
    </div>
  </div>
</template>

<script src="../../js/quotation.js">
  
</script>

<style src="./quotation.css">
  
</style>
