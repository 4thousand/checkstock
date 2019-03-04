<template>
  <div style="padding: 10px;" class="container">
    <form class="md-layout" style="justify-content: center;">
      <loading :active.sync="isLoading" :can-cancel="true" :is-full-page="fullPage"></loading>
      <md-card class="md-layout-item md-size-100 md-small-size-100">
        <md-card-header>
          <md-icon>settings</md-icon>
          <div
            style="display:inline-block;position: relative; top: 4px; left: 6px;"
            class="md-title"
          >Setting</div>
        </md-card-header>
        <md-card-content>
          <form class="md-layout" style="justify-content: center;">
            <div class="md-layout-item md-size-50 md-small-size-100">
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-90 md-small-size-100">
                  <md-field>
                    <label>ชื่อ บริษัท</label>
                    <md-select
                      :disabled="company_id>0"
                      v-model="company_id"
                      name="movie"
                      id="movie"
                    >
                      <md-option value="1">บริษัท นพดลพานิช จำกัด</md-option>
                      <md-option value="2">บริษัท นวเวนดิ้ง จำกัด</md-option>
                      <md-option value="3">บริษัท Paybox</md-option>
                    </md-select>
                  </md-field>
                </div>
              </div>
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-90 md-small-size-100">
                  <md-field>
                    <label>ชื่อ สาขา</label>
                    <md-select :disabled="branch_id>0" v-model="branch_id" name="movie" id="movie">
                      <md-option value="1">สำนักงานใหญ่</md-option>
                      <md-option value="2">สาขาสันกำแพง</md-option>
                    </md-select>
                  </md-field>
                </div>
              </div>
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-90 md-small-size-100">
                  <md-field>
                    <label for="first-name">
                      <md-icon>home</md-icon>ที่อยู่
                    </label>
                    <md-input name="first-name" id="first-name" v-model="address"/>
                  </md-field>
                </div>
              </div>
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-90 md-small-size-100">
                  <md-field>
                    <label for="first-name">
                      <md-icon>print</md-icon>Fax
                    </label>
                    <md-input name="first-name" id="first-name" v-model="fax"/>
                  </md-field>
                </div>
              </div>
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-90 md-small-size-100">
                  <md-field>
                    <label for="first-name">
                      <md-icon>phone</md-icon>Telephone
                    </label>
                    <md-input name="first-name" id="first-name" v-model="telephone"/>
                  </md-field>
                </div>
              </div>
            </div>
            <!--sprit -->
            <div class="md-layout-item md-size-50 md-small-size-100">
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-90 md-small-size-100">
                  <md-field>
                    <label for="first-name">
                      <md-icon>add_photo_alternate</md-icon>Logo
                    </label>
                    <md-input name="first-name" id="first-name" v-model="logo_path"/>
                  </md-field>
                </div>
              </div>
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-90 md-small-size-100">
                  <md-field>
                    <label>
                      <md-icon>payment</md-icon>Tax Rate
                    </label>
                    <md-input v-model="tax_rate"/>
                  </md-field>
                </div>
              </div>
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-90 md-small-size-100">
                  <md-field>
                    <label>โรงเก็บของสินค้าซื้อ</label>
                    <md-select v-model="def_buy_wh_id" name="movie" id="movie">
                      <md-option value="1">S1-A</md-option>
                      <md-option value="2">S1-B</md-option>
                      <md-option value="3">S2-B</md-option>
                      <md-option value="4">S2-B</md-option>
                    </md-select>
                  </md-field>
                </div>
              </div>
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-90 md-small-size-100">
                  <md-field>
                    <label>ชั้นเก็บของสินค้าซื้อ</label>
                    <md-select v-model="def_buy_shelf_id" name="movie" id="movie">
                      <md-option value="1">S1-A</md-option>
                    </md-select>
                  </md-field>
                </div>
              </div>
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-90 md-small-size-100">
                  <md-field>
                    <label>โรงเก็บของสินค้าขาย</label>
                    <md-select v-model="def_sale_shelf_id" name="movie" id="movie">
                      <md-option value="1">S1-A</md-option>
                      <md-option value="2">S1-B</md-option>
                      <md-option value="3">S2-B</md-option>
                      <md-option value="4">S2-B</md-option>
                    </md-select>
                  </md-field>
                </div>
              </div>
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-90 md-small-size-100">
                  <md-field>
                    <label>ชั้นเก็บของสินค้าขาย</label>
                    <md-select v-model="def_sale_wh_id" name="movie" id="movie">
                      <md-option value="1">S1-A</md-option>
                    </md-select>
                  </md-field>
                </div>
              </div>
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-90 md-small-size-100">
                  <md-field>
                    <label>Department</label>
                    <md-select v-model="depart_id" name="movie" id="movie">
                      <md-option value="1">ค้าปลีกสาขา 1</md-option>
                      <md-option value="2">ค้าปลีกสาขา 2</md-option>
                      <md-option value="3">ค้าส่งและขายโครงการ</md-option>
                    </md-select>
                  </md-field>
                </div>
              </div>
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-90 md-small-size-100">
                  <md-field>
                    <label for="first-name">
                      <md-icon>payment</md-icon>ลูกค้าเริ่มต้น
                    </label>
                    <md-input name="first-name" id="first-name" v-model="def_cust_id"/>
                  </md-field>
                </div>
              </div>
            </div>
              <md-button
                style="float:center;"
                class="md-raised md-primary"
                @click="confirmDialog=true"
              >บันทึก</md-button>
          </form>
        </md-card-content>
        <md-card-actions>
          <div style="md-layout-item md-size-90 md-small-size-100" >
            <md-dialog :md-active.sync="confirmDialog">
              <md-dialog-title>ยืนยันการตั้งค่า</md-dialog-title>
              <md-button type="submit" style="position:relative;" class="md-raised md-primary" @click="setdone(),confirmDialog=false ">ยืนยัน</md-button>
              <md-button style="float:right; position:relative;" class="md-raised md-primary" @click="confirmDialog=false ">ยกเลิก</md-button>
            </md-dialog>
          </div>
        </md-card-actions>
      </md-card>
    </form>
  </div>
</template>
<!--<script src="../../js/setting.js"></script>-->
<script src="../js/setting.js"></script>
<style scoped>
.md-field.md-focused .md-icon,
.md-field.md-has-value .md-icon {
  color: blue !important;
  font-size: 20px !important;
  position: relative;
  top: -3px;
}
</style>
