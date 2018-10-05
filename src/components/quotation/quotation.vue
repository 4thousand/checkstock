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
                <div class="md-layout-item md-size-45 md-xsmall-size-100">
                  <span class="md-title sub">
                        เลขที่ใบเสนอราคา
                      </span>
                  <md-field>
                    <md-select name="country" id="country" placeholder="">
                      <md-option value="S01-BHN=ขายสด NoVat">S01-BHN=ขายสด NoVat</md-option>
                      <md-option value="W01-BCN = ขายเชื่อ NoVat">W01-BCN = ขายเชื่อ NoVat</md-option>
                      <md-option value="S03-BHV=S03-BackOrder-เงินสด">S03-BHV=S03-BackOrder-เงินสด</md-option>
                      <md-option value="W03-BCV=S03-BackOrder-เงินเชื่อ">W03-BCV=S03-BackOrder-เงินเชื่อ</md-option>
                    </md-select>
                  </md-field>
                </div>
  
                <div style="position:relative" class=" md-layout-item md-size-40 md-xsmall-size-100">
                  <span class="md-title sub">
                        วันที่ออก
                      </span>
                      <div style="position:relative;height:100%;">
                 <md-icon style="float:left;position:relative;top:28px;margin-right:5px;">calendar_today</md-icon> <datepicker input-class="form-control tc" style="position:relative;top:15px;"  :language="languages[language]" format="d MMMM yyyy" ></datepicker>
                 </div>
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
  
                <div class="md-layout-item md-size-40 md-xsmall-size-100">
                  <span class="md-title sub">
                        ประเภทเสนอราคา
                      </span>
                  <md-field>
                    <md-select name="country" id="country" placeholder="ประเภทเสนอราคา">
                      <md-option value="ขายสินค้าเงินสด">ขายสินค้าเงินสด</md-option>
                      <md-option value="ขายสินค้าเงินเชื่อ">ขายสินค้าเงินเชื่อ</md-option>
                      <md-option value="งานบริการเงินสด">งานบริการเงินสด</md-option>
                      <md-option value="ขายบริการเงินเชื่อ">ขายบริการเงินเชื่อ</md-option>
                    </md-select>
                  </md-field>
                </div>
              </div>
  
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-15 md-xsmall-size-100">
  
                </div>
                <div class="md-layout-item md-size-45 md-xsmall-size-100">
                  <md-field>
                    <md-icon>account_circle</md-icon>
                    <label>รหัสลูกค้า</label>
                    <md-input required v-model="date"></md-input>
                    <md-button style="min-width: 50px;" @click="tests">
                      <md-icon>search</md-icon>
                    </md-button>
                  </md-field>
                </div>
  
                <div style="position: relative; top: 4px;" class="md-layout-item md-size-40 md-xsmall-size-100">
                  <md-field>
                    <label>ชื่อลูกค้า</label>
                    <md-input disabled v-model="date"></md-input>
                  </md-field>
                </div>
              </div>
              <!-- table -->
              <div class="md-layout md-gutter">
                <md-table class="col-12" v-model="searched" md-sort="name" md-sort-order="asc" md-card md-fixed-header>
                  <md-table-toolbar>
                    <div class="md-toolbar-section-start">
                      <h1 class="md-title">ข้อมูลสินค้า</h1>
                    </div>
  
                    <md-field md-clearable class="md-toolbar-section-end">
                      <md-input placeholder="Search by name..." v-model="search" @input="searchOnTable" />
                    </md-field>
                  </md-table-toolbar>
  
                  <md-table-empty-state md-label="ไม่พบสินค้า" :md-description="`ไม่มีสินค้า  '${search}' ในระบบกรุณาตรวจสอบใหม่อีกครั้ง`">
                    <md-button class="md-primary md-raised" @click="newUser">เพิ่มข้อมูลสินค้า</md-button>
                  </md-table-empty-state>
  
                  <md-table-row slot="md-table-row" slot-scope="{ item }">
                    <md-table-cell md-label="รหัสสินค้า" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell>
                    <md-table-cell md-label="ชื่อสินค้า" md-sort-by="name">{{ item.name }}</md-table-cell>
                    <md-table-cell md-label="หน่วยนับ" md-sort-by="count">{{ item.count }}</md-table-cell>
                    <md-table-cell md-label="จำนวน" md-sort-by="amount">{{ item.amount }}</md-table-cell>
                    <md-table-cell md-label="ราคา/หน่วย" md-sort-by="price">{{ item.price }}</md-table-cell>
                    <md-table-cell md-label="ส่วนลด" md-sort-by="discount">{{ item.discount }}</md-table-cell>
                    <md-table-cell md-label="จำนวนเงิน" md-sort-by="allprice">{{ item.allprice }}</md-table-cell>
                    <!-- <md-table-cell md-label="เงื่อนไขการขนส่ง" md-sort-by="because">{{ item.because }}</md-table-cell> -->
                  </md-table-row>
                </md-table>
              </div>
              <!-- table  -->
  
              <div style="margin-top:15px" class="md-layout md-gutter">
                
                <div class="md-layout-item md-size-85 md-xsmall-size-100" style="text-align:right;">
  
                  <span class="md-title subnotop">
                        รวมมูลค่าสินค้า
                      </span>
                </div>
  
                <div class="md-layout-item md-size-10 md-xsmall-size-100" style="text-align:right;">
  
                  <span class="md-title subnotop">
                        451,726.00
                      </span>
  
  
                </div>
                <div class="md-layout-item md-size-5 md-xsmall-size-100">
  
                  <span class="md-title subnotop">
                        บาท 
                      </span>
  
                </div>
  
  
              </div>
              <div class="md-layout md-gutter">
              
                <div class="md-layout-item md-size-85 md-xsmall-size-100" style="text-align:right;">
                  <span class="md-title subnotop">
                        มูลค่าสินค้ายกเว้นภาษี
                      </span>
                </div>
  
                <div class="md-layout-item md-size-10 md-xsmall-size-100" style="text-align:right;">
                  <span class="md-title subnotop">
                       0
                      </span>
  
                </div>
                <div class="md-layout-item md-size-5 md-xsmall-size-100">
                  <span  class="md-title subnotop">
                        บาท 
                      </span>
                </div>
              </div>
  
              <div class="md-layout md-gutter">
           
                <div class="md-layout-item md-size-85 md-xsmall-size-100" style="text-align:right;">
                  <span class="md-title subnotop">
                        ส่วนลด %,บาท
                      </span>
                </div>
  
                <div class="md-layout-item md-size-10 md-xsmall-size-100" style="text-align:right;">
                  <span class="md-title subnotop">
                       0
                      </span>
                </div>
  
                <div class="md-layout-item md-size-5 md-xsmall-size-100">
                  <span  class="md-title subnotop">
                        บาท 
                      </span>
                </div>
              </div>
  
              <div class="md-layout md-gutter">
        
                <div class="md-layout-item md-size-85 md-xsmall-size-100" style="text-align:right;">
                  <span class="md-title subnotop">
                        ภาษีมูลค่าเพิ่ม
                      </span>
                </div>
  
                <div class="md-layout-item md-size-10 md-xsmall-size-100" style="text-align:right;">
                  <span class="md-title subnotop">
                       29,552.17
                      </span>
                </div>
  
                <div class="md-layout-item md-size-5 md-xsmall-size-100">
                  <span  class="md-title subnotop">
                        บาท 
                      </span>
                </div>
              </div>
  
              <div class="md-layout md-gutter">
               
                <div class="md-layout-item md-size-85 md-xsmall-size-100" style="text-align:right;">
                  <span class="md-title subnotop">
                        มูลค่ารวมภาษี
                      </span>
                </div>
  
                <div class="md-layout-item md-size-10 md-xsmall-size-100" style="text-align:right;">
                  <span class="md-title subnotop">
                       451,726.00
                      </span>
                </div>
  
                <div class="md-layout-item md-size-5 md-xsmall-size-100">
                  <span  class="md-title subnotop">
                        บาท 
                      </span>
                </div>
              </div>
  
              <div class="md-layout md-gutter">
             
                <div class="md-layout-item md-size-85 md-xsmall-size-100" style="text-align:right;">
                  <span class="md-title subnotop">
                        มูลค่าสุทธิ
                      </span>
                </div>
  
                <div class="md-layout-item md-size-10 md-xsmall-size-100" style="text-align:right;">
                  <span class="md-title subnotop">
                       451,726.00
                      </span>
                </div>
  
                <div class="md-layout-item md-size-5 md-xsmall-size-100">
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
    <form  class="md-layout">
          <md-card class="md-layout-item md-size-50 md-small-size-100">
            <md-card-header>
              <div class="md-title ">พนักงาน</div>
            </md-card-header>
            <md-card-content>
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-small-size-100">
                  <md-field >
                    <label for="first-name subnotop">รหัสพนักงานขาย</label>
                    <md-input name="first-name" id="first-name" autocomplete="given-name"  />
                  </md-field>
                    <md-button style="min-width: 50px;" class="buttonemp" @click="tests">
                      <md-icon>search</md-icon>
                    </md-button>
                </div>
                <div class="md-layout-item md-small-size-100">
                  <md-field >
                    <label for="last-name subnotop">แผนก</label>
                    <md-input name="last-name" id="last-name" autocomplete="family-name" />
                  </md-field>
                      <md-button style="min-width: 50px;" class="buttonemp" @click="tests">
                      <md-icon>search</md-icon>
                    </md-button>
                </div>
                <div class="md-layout-item md-small-size-100">
                  <md-field >
                    <label for="last-name">โครงการ</label>
                    <md-input name="last-name" id="last-name" autocomplete="family-name" />
                  </md-field>
                      <md-button style="min-width: 50px;" class="buttonemp" @click="tests">
                      <md-icon>search</md-icon>
                    </md-button>
                </div>
                <div class="md-layout-item md-small-size-100">
                  <md-field >
                    <label for="last-name">รหัสผู้ติดต่อ</label>
                    <md-input name="last-name" id="last-name" autocomplete="family-name" />
                  </md-field>
                      <md-button style="min-width: 50px;" class="buttonemp" @click="tests">
                      <md-icon>search</md-icon>
                    </md-button>
                </div>
                <div class="md-layout-item md-small-size-100">
                  <md-field >
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
                  <md-field >
                    <label for="first-name subnotop">เอกสาร</label>
                    <md-input name="first-name" id="first-name" autocomplete="given-name"  />
                  </md-field>
                </div>
                <div class="md-layout-item md-small-size-100">
                  <md-field >
                    <label for="last-name subnotop">รหัสสกุลเงิน</label>
                    <md-input name="last-name" id="last-name" autocomplete="family-name" />
                  </md-field>
                </div>
                <div class="md-layout-item md-small-size-100">
                  <md-field >
                    <label for="last-name">อัตราแลกเปลี่ยน</label>
                    <md-input name="last-name" id="last-name" autocomplete="family-name" />
                  </md-field>
                </div>
                <div class="md-layout-item md-small-size-100">
                  <md-field >
                    <label for="last-name">อัตราภาษีมูลค่าเพิ่ม</label>
                    <md-input name="last-name" id="last-name" autocomplete="family-name" />
                  </md-field>
                </div>
                <div class="md-layout-item md-small-size-100">
                  <md-field >
                    <label for="last-name">ยอดเงินบาทสุทธิ</label>
                    <md-input name="last-name" id="last-name" autocomplete="family-name" />
                  </md-field>
                </div>
                   <div class="md-layout-item md-small-size-100">
                  <md-field >
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
                    <md-input name="first-name" id="first-name" autocomplete="given-name"  />
                  </md-field>
                   <label class="abright" for="first-name subnotop ">วัน</label>
                </div>
                <div class="md-layout-item md-small-size-100">
                  <md-field >
                    <label for="last-name subnotop">ลูกค้าต้องตอบรับภายใน</label>
                    <md-input name="last-name" id="last-name" autocomplete="family-name" />
                  </md-field>
                       <label class="abright" for="first-name subnotop ">วัน</label>
                </div>
                <div class="md-layout-item md-small-size-100">
                  <md-field >
                    <label for="last-name">เอกสารหมดอายุภายใน</label>
                    <md-input name="last-name" id="last-name" autocomplete="family-name" />
                  </md-field>
                     <label class="abright" for="first-name subnotop ">วัน</label>
                </div>
                <div class="md-layout-item md-small-size-100">
                  <md-field >
                    <label for="last-name">ส่งมอบภายใน</label>
                    <md-input name="last-name" id="last-name" autocomplete="family-name" />
                  </md-field>
                   <label class="abright" for="first-name subnotop ">วัน</label>
                </div>
                <div class="md-layout-item md-small-size-100">
                  <md-field >
                    <label for="last-name">เครดิต(วัน)</label>
                    <md-input name="last-name" id="last-name" autocomplete="family-name" />
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
                  <md-field class="md-layout-item md-small-size-100" >
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
                <div style="position:relative" class=" md-layout-item md-size-50 md-xsmall-size-100">
                  <span class="md-title subnotop" style="position: relative; top: -3px;">
                        วันที่เริ่มตามลูกค้า
                      </span>
                  <md-datepicker style="position:absolute;top:0;width: 85%;" v-model="selectedDate" />
                </div>
                  <div style="position:relative" class=" md-layout-item md-size-50 md-xsmall-size-100">
                  <span class="md-title subnotop" style="position: relative; top: -3px;">
                        ลงวันที่
                      </span>
                  <md-datepicker style="position:absolute;top:0;width: 85%;" v-model="selectedDate" />
                </div>
                <div style="position:relative;margin-top: 46px;"  class=" md-layout-item md-size-50 md-xsmall-size-100">
                  <span class="md-title subnotop" style="position: relative; top: -3px;">
                        วันที่ครบกำหนด
                      </span>
                  <md-datepicker style="position:absolute;top:0;width: 85%;" v-model="selectedDate" />
                </div>
                <div style="position:relative;margin-top: 46px;" class=" md-layout-item md-size-50 md-xsmall-size-100">
                  <span class="md-title subnotop" style="position: relative; top: -3px;">
                        คำตอบจากลูกค้า
                      </span>
                  <md-datepicker style="position:absolute;top:0;width: 85%;" v-model="selectedDate" />
                </div>
                <div class="md-layout-item md-small-size-100" style="    margin-top: 41px;">
                  <md-field >
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
                    <md-input name="first-name" id="first-name" autocomplete="given-name"  />
                  </md-field>
                </div>
                </div>
                 <div class="md-layout md-gutter">
                <div class="md-layout-item md-small-size-100">
                  <md-field >
                    <label for="last-name subnotop">สิ่งที่ส่งมาด้วย</label>
                    <md-input name="last-name" id="last-name" autocomplete="family-name" />
                  </md-field>
                </div>
                 </div>
                  <div class="md-layout md-gutter">
                <div class="md-layout-item md-small-size-100">
                  <md-field >
                    <label for="last-name">หมายเหตุ1</label>
                    <md-input name="last-name" id="last-name" autocomplete="family-name" />
                  </md-field>
                </div>
                  </div>
                   <div class="md-layout md-gutter">
                <div class="md-layout-item md-small-size-100">
                  <md-field >
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

      
      
              <!--  -->
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
  
  
      <!-- dsds -->
  
      <!-- dsdas -->
    </div>
  </div>
</template>

<script src="../../js/quotation.js"></script>

<style src="./quotation.css"></style>
