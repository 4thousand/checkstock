<template>
  <div style="padding: 15px;" class="container">
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
                    <label>ประเภทการขาย</label>
                    <md-select v-model="setting_saleType" name="movie" id="movie">
                      <md-option value="0">ขายหน้าร้าน</md-option>
                      <md-option value="1">ขายโครงการ</md-option>
                    </md-select>
                  </md-field>
                </div>
              </div>
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-90 md-small-size-100">
                  <md-field>
                    <label>ประเภทภาษี</label>
                    <md-select v-model="setting_feeType">
                      <md-option value="0">ภาษีแยกนอก</md-option>
                      <md-option value="1">ภาษีรวมใน</md-option>
                      <md-option value="2">ภาษีอัตราศูนย์</md-option>
                    </md-select>
                  </md-field>
                </div>
              </div>
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-90 md-small-size-100">
                  <md-field>
                    <label for="first-name">
                      <md-icon>account_balance</md-icon>Company Name
                    </label>
                    <md-input name="first-name" id="first-name" v-model="branch_name"/>
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
                      <md-icon>add_photo_alternate</md-icon>logo_path
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
                    <label>def_buy_wh_id</label>
                    <md-select v-model="def_buy_wh_id" name="movie" id="movie" >
                      <md-option value="0">S1-A</md-option>
                      <md-option value="1">S1-B</md-option>
                      <md-option value="2">S2-B</md-option>
                      <md-option value="3">S2-B</md-option>
                    </md-select>
                  </md-field>
                </div>
              </div>
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-90 md-small-size-100">
                  <md-field>
                    <label for="first-name">
                      <md-icon>code</md-icon>def_buy_shelf_id
                    </label>
                    <md-input name="first-name" id="first-name" v-model="def_buy_shelf_id"/>
                  </md-field>
                </div>
              </div>
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-90 md-small-size-100">
                  <md-field>
                    <label>def_buy_wh_id</label>
                    <md-select v-model="def_buy_wh_id" name="movie" id="movie" >
                      <md-option value="0">S1-A</md-option>
                      <md-option value="1">S1-B</md-option>
                      <md-option value="2">S2-B</md-option>
                      <md-option value="3">S2-B</md-option>
                    </md-select>
                  </md-field>
                </div>
              </div>
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-90 md-small-size-100">
                  <md-field>
                    <label for="first-name">
                      <md-icon>code</md-icon>def_sale_shelf_id
                    </label>
                    <md-input name="first-name" id="first-name" v-model="def_sale_shelf_id"/>
                  </md-field>
                </div>
              </div>
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-90 md-small-size-100">
                  <md-field>
                    <label for="first-name">
                      <md-icon>code</md-icon>def_sale_wh_id
                    </label>
                    <md-input name="first-name" id="first-name" v-model="def_sale_wh_id"/>
                  </md-field>
                </div>
              </div>
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-90 md-small-size-100">
                  <md-field>
                    <label for="first-name">
                      <md-icon>code</md-icon>depart_id
                    </label>
                    <md-input name="first-name" id="first-name" v-model="depart_id"/>
                  </md-field>
                </div>
              </div>
              <div class="md-layout md-gutter">
                <div class="md-layout-item md-size-90 md-small-size-100">
                  <md-field>
                    <label for="first-name">
                      <md-icon>payment</md-icon>def_cust_id
                    </label>
                    <md-input name="first-name" id="first-name" v-model="def_cust_id"/>
                  </md-field>
                </div>
              </div>
            </div>
          </form>
        </md-card-content>
        <md-card-actions>
          <md-button type="submit" class="md-primary" @click="setdone()">ตกลง</md-button>
        </md-card-actions>
      </md-card>
    </form>
  </div>
</template>
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
