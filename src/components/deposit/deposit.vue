<template>
  <div>
    <md-steppers md-sync-route md-dynamic-height :md-active-step.sync="active">
      <md-step id="first" md-label="ฟอร์มใบรับเงินมัดจำ">
        <div>
          <div class="row">
            <div class="col-12 col-md-12 col-lg-12 big-margin">
              <div class="card">
                <div class="card-header deposit-header">
                  <span>ใบรับเงินมัดจำ</span>
                </div>
                <div class="deposit-border">
                  <div class="row">
                    <div class="col-md-12 col-12">
                      <div class="form-group row">
                        <p class="article-set col-md-3 col-12">
                          <span style="color:red">*</span> สาขาที่ขาย :
                        </p>
                        <div class="col-md-8 col-12">
                          <select id="branch" v-model="branchId" class="form-control">
                            <option value="1">นพดลพานิช สำนักงานใหญ่</option>
                            <option value="2">เอสซีจี โฮมโซลูชั่น (แยกต้นเปา)</option>
                            <option value="3">Home Expert Paint Shop</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-12">
                      <div class="form-group row">
                        <p class="article-set col-md-3 col-12">
                          <span style="color:red">*</span> ประเภทการขาย :
                        </p>
                        <div class="col-md-8 col-12">
                          <select id="saletype" v-model="saleType" class="form-control">
                            <option value="0">ขายหน้าร้าน</option>
                            <option value="1">ขายโครงการ</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div v-show="selectCustomer==false" class="row">
                    <div class="col-md-12 col-12">
                      <div class="form-group row">
                        <p class="article-set col-md-3 col-12">
                          <span style="color:red">*</span> ค้นหาลูกค้า :
                        </p>
                        <div class="col-md-8 col-12">
                          <div class="input-group">
                            <input
                              type="text"
                              disabled
                              v-model.number="customerCode"
                              class="form-control disable-control"
                            >
                            <div class="input-group-append">
                              <button
                                class="btn btn-primary icon-margin search-icon"
                                @click="showDialog = true"
                              >
                                <md-icon class="search-icon">search</md-icon>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div v-show="selectCustomer==true" class="row">
                    <div class="col-md-12 col-12">
                      <div class="form-group row">
                        <p class="article-set col-md-3 col-12">
                          <span style="color:red">*</span> ชื่อลูกค้า :
                        </p>
                        <div class="col-md-8 col-12">
                          <div class="input-group">
                            <input
                              type="text"
                              disabled
                              v-model.number="customerName"
                              class="form-control disable-control"
                            >
                            <div class="input-group-append">
                              <button
                                class="btn btn-danger icon-margin search-icon"
                                @click="selectCustomer = false, customerCode='',customerName='',searchCustomerInput='',customerDetail=[],reserveNo='',selectReserve=false"
                              >
                                <md-icon class="search-icon">highlight_off</md-icon>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-12">
                      <div class="form-group row">
                        <p class="article-set col-md-3 col-12">
                          <span style="color:red">*</span> วันที่ออกเอกสาร :
                        </p>
                        <div class="col-md-8 col-12">
                          <vue-ctk-date-time-picker
                            locale="th"
                            format="YYYY-MM-DD"
                            v-model="documentDate"
                            :disable-time="true"
                          ></vue-ctk-date-time-picker>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div v-show="selectReserve==false" class="row">
                    <div class="col-md-12 col-12">
                      <div class="form-group row">
                        <p class="article-set col-md-3 col-12">
                          ค้นหาเลขที่ใบสั่งจอง :
                        </p>
                        <div class="col-md-8 col-12">
                          <div class="input-group">
                            <input
                              type="text"
                              disabled
                              v-model="reserveNo"
                              class="form-control disable-control"
                            >
                            <div class="input-group-append">
                              <button
                                class="btn btn-primary icon-margin search-icon"
                                :disabled="customerName==''"
                                @click="showReserve = true"
                              >
                                <md-icon class="search-icon">search</md-icon>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div v-show="selectReserve==true" class="row">
                    <div class="col-md-12 col-12">
                      <div class="form-group row">
                        <p class="article-set col-md-3 col-12">
                          เลขที่ใบสั่งจอง :
                        </p>
                        <div class="col-md-8 col-12">
                          <div class="input-group">
                            <input
                              type="text"
                              disabled
                              v-model="reserveNo"
                              class="form-control disable-control"
                            >
                            <div class="input-group-append">
                              <button
                                class="btn btn-danger icon-margin search-icon"
                                @click="selectReserve = false, reserveNo='',searchReserveInput='',reserveDetail=[]"
                              >
                                <md-icon class="search-icon">highlight_off</md-icon>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-12">
                      <div class="form-group row">
                        <p class="article-set col-md-3 col-12">แผนก :</p>
                        <div class="col-md-8 col-12">
                          <select v-model="department" class="form-control">
                            <option value="1">ค้าปลีกสาขา 1</option>
                            <option value="2">ค้าปลีกสาขา 2</option>
                            <option value="3">ค้าส่งและขายโครงการ</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="row">
                    <div class="col-md-12 col-12">
                      <div class="form-group row">
                        <p class="article-set col-md-3 col-12">โครงการ :</p>
                        <div class="col-md-8 col-12">
                          <select v-model="project" class="form-control">
                            <option value="1">ม.ราชภัฎเชียงมใหม่ สะลวง-ขี้เหล็ก</option>
                            <option value="2">มาสด้า มหิดล</option>
                            <option value="3">อาคารพาณิชย์ซอยร้องขุ่นแยกหลุยส์</option>
                            <option value="4">มบ.กาญจน์สิริหลังม.พายัพ</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div> -->
                  <div class="row">
                    <div class="col-md-12 col-12">
                      <div class="form-group row">
                        <p class="article-set col-md-3 col-12">หมายเหตุ :</p>
                        <div class="col-md-8 col-12">
                          <textarea id="depNotice" class="form-control" v-model="infoNotice" rows="5"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-12">
                      <div class="form-group row">
                        <p class="article-set col-md-3 col-4">
                          <span style="color:red"></span>
                        </p>
                        <div class="tax-bottom-part tax-head col-md-8 col-7">
                          <button
                            :disabled="customerCode==''||customerName==''"
                            @click="setDone('first', 'second')"
                            class="btn btn-primary"
                          >
                            <span>ถัดไป</span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <md-dialog :md-active.sync="showDialog" :md-fullscreen="false">
              <md-dialog-content class="modal-content">
                <div class="modal-header">
                  <h4>ค้นหาลูกค้า</h4>
                  <button type="button" class="close" @click="showDialog = false">&times;</button>
                </div>
                <div class="modal-body">
                  <label>รหัสลูกค้า</label>
                  <input
                    id="searchCT"
                    class="form-control"
                    v-autofocus
                    @keyup.enter="searchCustomerAllKeyApi"
                    v-model="searchCustomerInput"
                  >
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead align="center">
                        <tr>
                          <th>ลำดับ</th>
                          <th class="md-xsmall-hide">รหัสลูกค้า</th>
                          <th>ชื่อลูกค้า</th>
                          <th>ที่อยู่</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          class="table-pointer"
                          @click="searchCustomer(val),showDialog = false,selectCustomer=true"
                          v-for="(val,index) in customerDetail" :key="index"
                          style="text-align:center;cursor:pointer"
                        >
                          <td>{{index+1}}</td>
                          <td class="md-xsmall-hide">{{val.code}}</td>
                          <td>{{val.name}}</td>
                          <td>{{val.address}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="modal-footer">
                  <md-dialog-actions>
                    <md-button class="md-primary" @click="showDialog = false">Close</md-button>
                  </md-dialog-actions>
                </div>
              </md-dialog-content>
            </md-dialog>

            <md-dialog :md-active.sync="showReserve" :md-fullscreen="false">
              <md-dialog-content class="modal-content">
                <div class="modal-header">
                  <h4>ค้นหาใบสั่งจอง</h4>
                  <button type="button" class="close" @click="showReserve = false">&times;</button>
                </div>
                <div class="modal-body">
                  <label>ใบสั่งจอง</label>
                  <input
                    id="searchRS"
                    class="form-control"
                    v-autofocus
                    @keyup.enter="searchReserveKeyApi"
                    v-model="searchReserveInput"
                  >
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead align="center">
                        <tr>
                          <th>ลำดับ</th>
                          <th class="md-xsmall-hide">เลขใบสั่งจอง</th>
                          <th>ชื่อลูกค้า</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          class="table-pointer"
                          @click="searchReserve(val),showReserve = false,selectReserve=true"
                          v-for="(val,index) in reserveDetail" :key="index"
                          style="text-align:center;cursor:pointer"
                        >
                          <td>{{index+1}}</td>
                          <td class="md-xsmall-hide">{{val.doc_no}}</td>
                          <td>{{val.ar_name}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="modal-footer">
                  <md-dialog-actions>
                    <md-button class="md-primary" @click="showReserve = false">Close</md-button>
                  </md-dialog-actions>
                </div>
              </md-dialog-content>
            </md-dialog>

          </div>
        </div>
      </md-step>
      <md-step id="second" to md-label="ช่องทางการชำระเงิน">
        <div>
          <div>
            <div class="row">
              <div class="col-12 col-md-7 col-lg-8 big-margin">
                <div class="card">
                  <div class="card-header deposit-header">
                    <span>วิธีการชำระเงิน</span>
                  </div>
                  <div class="deposit-border">
                    <div class="row">
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="article-set col-md-3 col-12">
                            <span style="color:red">*</span> ประเภทภาษี :
                          </p>
                          <div class="col-md-8 col-12">
                            <select id="tax_type" v-model="feeType" class="form-control">
                              <option value="0">ภาษีแยกนอก</option>
                              <option value="1">ภาษีรวมใน</option>
                              <option value="2">ภาษีอัตราศูนย์</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="article-set col-md-3 col-12">
                            <span style="color:red">*</span> ราคารวม :
                          </p>
                          <div class="col-md-8 col-12">
                            <money id="total_pay" class="form-control" min="0" v-model.number="payment" v-bind="money" @keypress="isNumber(event)" v-on:keyup.native.enter="getFocus('cash_pay')" v-on:keyup.native.down="getFocus('cash_pay')"></money>
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
                            <money id="cash_pay" class="form-control" min="0" v-model.number="cashPayment" v-bind="money" @keypress="isNumber(event)" v-on:keyup.native.enter="getFocus('add_cr')" v-on:keyup.native.up="getFocus('total_pay')" v-on:keyup.native.down="getFocus('add_cr')"></money>
                          </div>
                        </div>
                      </div>
                    </div>

                    <hr class="col-10">
                    <h4 class="payment-sub-header information-part col-12">บัตรเครดิต/บัตรเดบิต</h4>

                    <!-- v-for -->
                    <div class="col-md-12 col-12" v-for="(val,index) in creditCardList" :key="index">
                      <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-12">
                          <div class="alert alert-info">
                            <a
                              class="close"
                              data-dismiss="alert"
                              aria-label="close"
                              @click="removeCreditCard(index)"
                            >&times;</a>
                            <a class="edit close">
                              <i
                                class="material-icons"
                                @click="showCredit=true,pullCreditCard(index),isEditCr=true"
                              >edit</i>
                            </a>
                            <span class="fontsize">เลขบัตร : {{"XXXX-XXXX-XXXX-"+val.credit_card_no}}</span>
                            <span class="fontsize">จำนวนเงิน : {{convertToBaht(val.amount)+" บาท"}}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-12" style="text-align:center">
                      <button id="add_cr" class="btn btn-primary" @click="showCredit=true,resetCredit(),isEditCr=false" @keyup.up="getFocus('cash_pay')" @keyup.down="getFocus('add_chq')">
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
                    <div class="col-md-12 col-12" v-for="(val,index) in chqList" :key="index">
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
                      <button id="add_chq" class="btn btn-primary" @click="showChq=true,resetChq(),isEditChq=false" @keyup.down="getFocus('add_b')" @keyup.up="getFocus('add_cr')">
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
                    <div class="col-md-12 col-12" v-for="(val,index) in bankTransList" :key="index">
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
                              <i
                                class="material-icons"
                                @click="showBank=true,isEditBank=true,pullBank(index)"
                              >edit</i>
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
                      <button id="add_bank" class="btn btn-primary" @click="showBank=true,resetBank(),isEditBank=false" @keyup.down="getFocus('add_doc')" @keyup.up="getFocus('add_chq')">
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
                          <p class="tax-head">อัตราภาษีมูลค่าเพิ่ม : {{taxrate}} %</p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <p
                            class="tax-head"
                          >จำนวนเงินก่อนภาษี : {{ convertToBaht(payment_type) }} บาท</p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <p class="tax-head">ภาษีมูลค่าเพิ่ม : {{ convertToBaht(cal_VAT) }} บาท</p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <p class="tax-summary">มูลค่ารวมภาษี : {{ convertToBaht(total_VAT) }} บาท</p>
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
                        :disabled="feeType==''||balance<0||balance>0||payment==null||payment==0"
                        @keyup.left="getFocus('bank_pay')"  
                        @keyup.up="getFocus('bank_pay')" 
                        @click="createDepositNoApi(),confirm=true;"
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
                            :hidden="(feeType!=''&&balance>=0)||feeType==''"
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
                      <input id="cr_ref_no" class="form-control" v-model="validateCreditCardNo" maxlength="6" @keypress="isNumber(event)" ref="refNo" @keyup.enter="getFocus('bank_no')" @keyup.down="getFocus('bank_no')" @keyup.up="getFocus('cr_no')">
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
                      <input id="bank_no" class="form-control" v-model="creditBank" @keyup.enter="getFocus('cr_type')" @keyup.down="getFocus('cr_type')" @keyup.up="getFocus('cr_ref_no')">
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
                      <input id="cr_type" class="form-control" v-model="creditType" @keyup.enter="getFocus('credit_price')" @keyup.down="getFocus('credit_price')" @keyup.up="getFocus('bank_no')">
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
                      <money id="credit_price" class="form-control" v-model.number="creditPrice" v-bind="money" v-on:keyup.native.enter="getFocus('cr_charge')" v-on:keyup.native.down="getFocus('cr_charge')" v-on:keyup.native.up="getFocus('cr_type')"></money>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-12">
                <div class="row">
                  <p class="method-set col-lg-4 col-md-12 col-12">ค่า Charge :</p>
                  <div class="col-lg-7 col-md-12 col-12">
                    <p>
                      <input id="cr_charge" class="form-control" v-model="cardCharge" @change="chargeCal" @keyup.enter="getFocus('cr_notice')" @keyup.down="getFocus('cr_notice')" @keyup.up="getFocus('credit_price')">
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-12" v-if="isEditCr==false">
                <div class="row">
                  <p class="method-set col-lg-4 col-md-12 col-12">หมายเหตุ :</p>
                  <div class="col-lg-7 col-md-12 col-12">
                    <p>
                      <textarea id="cr_notice" class="form-control" v-model.number="creditNotice" rows="2" ref="crNotice" @keyup.enter="getFocus('submit_cr')" @keyup.down="getFocus('submit_cr')" @keyup.up="getFocus('cr_charge')"></textarea>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-12" v-if="isEditCr==true">
                <div class="row">
                  <p class="method-set col-lg-4 col-md-12 col-12">หมายเหตุ :</p>
                  <div class="col-lg-7 col-md-12 col-12">
                    <p>
                      <textarea id="cr_notice" class="form-control" v-model.number="creditNotice" rows="2" ref="crNotice" @keyup.enter="getFocus('submit_cr')" @keyup.down="getFocus('submit_cr')" @keyup.up="getFocus('cr_charge')"></textarea>
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
                @click="createCreditCard(),resetCredit(),showCredit = false"
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
                    <input id="chq_no" class="form-control" v-model="checkNumber" @keyup.enter="getFocus('chq_prize')" @keyup.down="getFocus('chq_prize')">
                  </p>
                </div>
              </div>
              <div class="row">
                <p class="method-set col-lg-4 col-md-12 col-12">
                  <span style="color:red">*</span> มูลค่าเช็ค :
                </p>
                <div class="col-lg-7 col-md-12 col-12">
                  <p>
                    <money id="chq_prize" class="form-control" min="0" v-model.number="chqPrize" v-bind="money" v-on:keyup.native.enter="getFocus('bank')" v-on:keyup.native.down="getFocus('bank')" v-on:keyup.native.up="getFocus('chq_no')"></money>
                  </p>
                </div>
              </div>
              <div class="row">
                <p class="method-set col-lg-4 col-md-12 col-12">
                  <span style="color:red">*</span> ธนาคาร :
                </p>
                <div class="col-lg-7 col-md-12 col-12">
                  <p>
                    <input id="bank" class="form-control" v-model="checkBankId"  @keyup.enter="getFocus('chq_pay')" @keyup.down="getFocus('chq_day')" @keyup.up="getFocus('chq_prize')">
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
                    <money id="chq_pay" class="form-control" min="0" v-model.number="checkPayment" v-bind="money"  v-on:keyup.native.enter="getFocus('chq_notice')" v-on:keyup.native.down="getFocus('chq_notice')" v-on:keyup.native.up="getFocus('bank')"></money>
                  </p>
                </div>
              </div>
              <div class="form-group row" v-if="isEditChq==false">
                <p class="method-set col-lg-4 col-md-12 col-12">หมายเหตุ :</p>
                <div class="col-lg-7 col-md-12 col-12">
                  <p>
                    <textarea id="chq_notice" class="form-control" v-model.number="chqNotice" rows="2" @keyup.down="getFocus('submit_chq')" @keyup.up="getFocus('chq_pay')"></textarea>
                  </p>
                </div>
              </div>
              <div class="form-group row" v-if="isEditChq==true">
                <p class="method-set col-lg-4 col-md-12 col-12">หมายเหตุ :</p>
                <div class="col-lg-7 col-md-12 col-12">
                  <p>
                    <textarea id="chq_notice" class="form-control" v-model.number="chqNotice" rows="2" @keyup.down="getFocus('submit_chq')" @keyup.up="getFocus('chq_pay')"></textarea>
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
                    <input id="bank_acc" class="form-control" v-model="bankAccount" @keyup.enter="getFocus('bank_day')" @keyup.down="getFocus('bank_day')">
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
                    <money id="bank_pay" class="form-control" min="0" v-model.number="bankPayment" v-bind="money"  v-on:keyup.native.enter="getFocus('chq_notice')" v-on:keyup.native.down="getFocus('bank_notice')" v-on:keyup.native.up="getFocus('bank')"></money>
                  </p>
                </div>
              </div>
              <div class="form-group row" v-if="isEditBank==false">
                <p class="method-set col-lg-4 col-md-12 col-12">หมายเหตุ :</p>
                <div class="col-lg-7 col-md-12 col-12">
                  <p>
                    <textarea id="bank_notice" class="form-control" v-model.number="bankNotice" rows="2" @keyup.down="getFocus('submit_bank')" @keyup.up="getFocus('bank_pay')"></textarea>
                  </p>
                </div>
              </div>
              <div class="form-group row" v-if="isEditBank==true">
                <p class="method-set col-lg-4 col-md-12 col-12">หมายเหตุ :</p>
                <div class="col-lg-7 col-md-12 col-12">
                  <p>
                    <textarea id="bank_notice" class="form-control" v-model.number="bankNotice" rows="2" @keyup.down="getFocus('submit_bank')" @keyup.up="getFocus('bank_pay')"></textarea>
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

        <md-dialog :md-active="confirm">
          <span>ยื่นยันการบันทึกข้อมูลใบรับเงินมัดจำ</span>
          <div style="display:flex; align-items:center; justify-content:center;">
            <button class="btn btn-success" @click="createDepositDocApi(),createPrintData(),confirm=false">ตกลง</button>
            <button class="btn btn-danger" @click="confirm=false">ยกเลิก</button>
          </div>
        </md-dialog>
      </md-step>


      <md-step id="third" to md-label="สรุปใบรับเงินมัดจำ">
        <div>
          <div>
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12 card-control big-margin">
                <div class="card">
                  <div class="card-header deposit-header">
                    <span>ใบเสร็จรับเงินมัดจำ</span>
                  </div>
                  <div class="deposit-border">
                    <div class="row">
                      <div class="col-12">
                        <div class="row">
                          <div class="col-4">
                            <div style="color:grey">บิลถึงลูกค้า</div>
                            <div>รหัสลูกค้า : {{customerCode}}</div>
                            <div>ชื่อลูกค้า : {{customerName}}</div>
                          </div>
                          <div class="col-4">
                            <div style="color:grey">เลขที่เอกสาร</div>
                            <div>{{serialNo}}</div>
                          </div>
                          <div class="col-4" style="text-align:right">
                            <div style="color:grey">มูลค่ารวมภาษี</div>
                            <div>
                              <h2>{{convertToBaht(totalPayment)}} บาท</h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="row" style="padding-top:3%">
                          <div class="tax-bottom-part finish-button col-8">
                            <button
                              class="btn btn-primary finish-button search-icon"
                              @click="goindex('/depositlist')"
                            >สิ้นสุด</button>
                          </div>
                          <div class="tax-bottom-part print-button col-4">
                            <form
                              :action="php + '/vue_sale/report_pdf/report_deposit.php'"
                              method="post"
                              target="_blank"
                            >
                              <input type="hidden" name="depData">
                              <button type="submit" class="btn btn-primary search-icon">Print</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </md-step>
    </md-steppers>
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
import {Money} from 'v-money';

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
      reserveNo:"",
      customerDetail: [],
      reserveDetail:[],
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
      chqDate:"",
      chqNotice: "",
      chqList: [],
      bankAccount:"",
      bankTransDate:"",
      bankTransList:[],
      bankNotice:"",
      billType: "0",
      saleType: "0",//setting.data().setting_saleType
      eCreditPo: null,
      eChqPo: null,
      eBankPo:null,
      feeType: "1",//setting.data().setting_feeType
      project: "",
      allocate: "",
      companyId: 1,
      branchId: "1",//setting.data().setting_branchId
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
          decimal: '.',
          thousands: ',',
          prefix: '',
          suffix: ' บาท',
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
    isNumber: function(evt) {
      evt = evt ? evt : window.event;
      var charCode = evt.which ? evt.which : evt.keyCode;
      if (
        charCode > 31 &&
        (charCode < 48 || charCode > 57) &&
        charCode !== 46
      ) {
        evt.preventDefault();
      } else {
        return true;
      }
    },
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
      api.searchDepById(
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
          this.cashPayment = result.data.cash_amount;
          this.chqList = result.data.chq;
          this.payment = result.data.total_amount;
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
    resetCredit(){
      this.creditType='';
      this.validateCreditCardNo='';
      this.creditNumber='';
      this.creditPrice=0;
      this.creditBank='';
      this.creditNotice='';
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
      console.log(index)
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
    resetChq(){
      this.checkNumber = "";
      this.chqPrize=0;
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
    createBank(){
      var bank={
        bank_account: this.bankAccount,
        bank_date:this.bankTransDate,
        bank_amount:this.bankPayment
      };
      this.bankTransList.push(bank);
    },
    resetBank(){
      this.bankAccount="";
      this.bankTransDate=this.getDate();
      this.bankPayment=0;
    },
    pullBank(index){
      this.eBankPo=index;
      this.bankAccount=this.bankTransList[index].bank_account;
      this.bankTransDate=this.bankTransList[index].bank_date;
      this.bankPayment=this.bankTransList[index].bank_amount;
    },
    editBank(){
      this.bankTransList[eBankPo].bank_account=this.bankAccount;
      this.bankTransList[eBankPo].bank_date=this.bankTransDate;
      this.bankTransList[eBankPo].bank_amount=this.bankPayment;
    },
    removeBank(index) {
      console.log(index)
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
    searchReserveKeyApi(){
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
    searchReserve(val){
      this.reserveNo=val.doc_no;
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
      if (val == "/depositlist") {
        this.$router.push({ name: "depositlist" });
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
    checkLength(){
      return console.log(this.creditNumber.length)
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
        ref_no:this.reserveNo,
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
    createPrintData(){
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
      document.getElementsByName('depData')[0].value = JSON.stringify(payload)
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
    totalBankPayment(){
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
    checkLength(){
      return console.log(this.validateCreditCardNo.length)
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

<style>
@media screen and (max-width: 990px) {
  .stickydestop {
    position: relative !important;
  }
}
span,
label,
h1,
h2,
h3,
h4,
p,
option,
select,
div {
  font-family: "Kanit", sans-serif !important;
}
.big-margin {
  margin-top: 1%;
  margin-bottom: 1%;
}
.deposit-border {
  border-color: #448aff;
  padding: 0% 2%;
}
.deposit-header {
  margin-bottom: 5%;
  background-color: #448aff;
  color: #fff;
  text-align: left;
  font-size: 24px;
}
.icon-margin {
  padding: 15%;
}
.tax-header {
  margin-bottom: 2.5%;
  background-color: #448aff;
  color: #fff;
  text-align: right;
  font-size: 24px;
}
.information-part {
  margin-bottom: 5%;
}
.tax-head-part {
  margin-top: 5%;
}
.tax-bottom-part {
  margin-bottom: 5%;
}
.article-set {
  text-align: right;
  margin-left: 5px;
}
.method-set {
  text-align: right;
  margin-left: 5px;
}
.tax-head {
  text-align: right;
}
.tax-summary {
  font-weight: bold;
  text-align: right;
  text-decoration: underline;
  text-decoration-style: double;
}
.tax-border {
  padding: 0% 4%;
}
.tax-button {
  text-align: right;
}
.table-pointer {
  cursor: pointer;
}
.search-icon {
  color: #fff !important;
}
.text-danger {
  text-align: center;
  font-size: 24px;
  margin: 12px;
}
.payment-sub-header {
  margin-left: 5%;
  margin-top: 1px;
}

.finish-button {
  text-align: left;
}

.print-button {
  text-align: right;
}

.next-button {
  float: right;
}

.edit {
  margin-right: 15px;
}

.form-control[readonly] {
  text-align: left !important;
}

.form-control:disabled {
  text-align: left !important;
}

@media (max-width: 991px) {
  .method-set {
    text-align: left;
  }
}

@media (max-width: 600px) {
  .md-ripple .md-stepper-label {
    display: none;
  }
}

@media (max-width: 767px) {
  .article-set,
  .tax-header,
  .tax-head,
  .tax-summary {
    text-align: left !important;
  }
  .tax-button {
    text-align: center;
  }
}
</style>
