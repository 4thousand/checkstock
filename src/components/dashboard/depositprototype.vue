    <template>
  <div>
    <md-steppers md-sync-route md-dynamic-height :md-active-step.sync="active">
      <md-step id="first" md-label="ฟอร์มใบรับเงินมัดจำ" :md-done.sync="first">
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
                          <select
                            v-model="branchId"
                            class="form-control"
                            @change="createDepositNoApi"
                          >
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
                          <select
                            v-model="saleType"
                            @change="createDepositNoApi"
                            class="form-control"
                          >
                            <option value="0">ขายหน้าร้าน</option>
                            <option value="1">ขายโครงการ</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-12">
                      <div class="form-group row">
                        <p class="article-set col-md-3 col-12">
                          <span style="color:red">*</span> รหัสลูกค้า :
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
                  <div class="row">
                    <div class="col-md-12 col-12">
                      <div class="form-group row">
                        <p class="article-set col-md-3 col-12">
                          <span style="color:red">*</span> ชื่อลูกค้า :
                        </p>
                        <div class="col-md-8 col-12">
                          <input type="text" disabled v-model="customerName" class="form-control disable-control">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-12">
                      <div class="form-group row">
                        <p class="article-set col-md-3 col-12">
                          <span style="color:red">*</span> เลขที่ใบเงินมัดจำ :
                        </p>
                        <div class="col-md-8 col-12">
                          <input
                            type="text"
                            class="form-control disable-control"
                            disabled
                            v-model="serialNo"
                            @change="createDepositNoApi"
                          >
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-12">
                      <div class="form-group row">
                        <p class="article-set col-md-3 col-12">
                          <span style="color:red">*</span> เลขที่ใบกำกับภาษี :
                        </p>
                        <div class="col-md-8 col-12">
                          <input
                            type="text"
                            disabled
                            v-model="taxNo"
                            @change="createDepositNoApi"
                            class="form-control disable-control"
                          >
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
                    <div class="col-md-12 col-12">
                      <div class="form-group row">
                        <p class="article-set col-md-3 col-12">
                          <span style="color:red">*</span> วันที่ใบกำกับภาษี :
                        </p>
                        <div class="col-md-8 col-12">
                          <vue-ctk-date-time-picker
                            locale="th"
                            format="YYYY-MM-DD"
                            v-model="taxApplyDate"
                            :disable-time="true"
                          ></vue-ctk-date-time-picker>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-12">
                      <div class="form-group row">
                        <p class="article-set col-md-3 col-12">เลขที่ใบจอง :</p>
                        <div class="col-md-8 col-12">
                          <input type="text" v-model="preemptionNo" class="form-control" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-12">
                      <div class="form-group row">
                        <p class="article-set col-md-3 col-12">
                          <span style="color:red">*</span> รหัสพนักงานขาย :
                        </p>
                        <div class="col-md-8 col-12">
                          <input
                            type="text"
                            disabled
                            v-model="profile.sale_code"
                            class="form-control disable-control"
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-12">
                      <div class="form-group row">
                        <p class="article-set col-md-3 col-12">
                          <span style="color:red">*</span> ชื่อพนักงานขาย :
                        </p>
                        <div class="col-md-8 col-12">
                          <input
                            type="text"
                            disabled
                            v-model="profile.username"
                            class="form-control disable-control"
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-12">
                      <div class="form-group row">
                        <p class="article-set col-md-3 col-12">
                          <span style="color:red">*</span> แผนก :
                        </p>
                        <div class="col-md-8 col-12">
                          <select
                            v-model="department"
                            class="form-control"
                          >
                            <option value="1">ค้าปลีกสาขา 1</option>
                            <option value="2">ค้าปลีกสาขา 2</option>
                            <option value="3">ค้าส่งและขายโครงการ</option>
                          </select>
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
                            :disabled="saleType==''||customerCode==''||customerName==''||department==''"
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
                    class="form-control"
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
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          class="table-pointer"
                          @click="searchCustomer(val),showDialog = false"
                          v-for="(val,index) in customerDetail"
                          style="text-align:center;cursor:pointer"
                        >
                          <td>{{index+1}}</td>
                          <td class="md-xsmall-hide">{{val.code}}</td>
                          <td>{{val.name}}</td>
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
          </div>
        </div>
      </md-step>
      <md-step id="second" to md-label="ช่องทางการชำระเงิน" :md-done.sync="second">
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
                            <select v-model="feeType" class="form-control">
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
                            <input class="form-control" min="0" type="number" v-model.number="payment">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <div class style="margin-left:6%">
                            <span class="col-sm-12">
                              <md-switch v-model="cashPaymentPart" @change="payment_validation">เงินสด</md-switch>
                            </span>
                            <span class="col-sm-12">
                              <md-switch v-model="creditPaymentPart" @change="payment_validation">บัตรเครดิต/บัตรเดบิต</md-switch>
                            </span>
                            <span class="col-sm-12">
                              <md-switch v-model="checkPaymentPart" @change="payment_validation">เช็ค</md-switch>
                            </span>
                            <span class="col-sm-12">
                              <md-switch v-model="transferPaymentPart" @change="payment_validation">เงินโอน</md-switch>
                            </span>
                            <span class="col-sm-12">
                              <md-switch v-model="QRPaymentPart">QR Code</md-switch>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row" v-if="cashPaymentPart==true">
                      <hr class="col-10">
                      <h4 class="payment-sub-header information-part col-12">เงินสด</h4>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> จำนวนเงิน :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <input
                              class="form-control"
                              min="0"
                              v-model.number="cashPayment"
                              pattern="[0-9]"
                              type="number"
                              @change="payment_validation"
                              required
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row" v-if="creditPaymentPart==true">
                      <hr class="col-10">
                      <h4 class="payment-sub-header information-part col-12">บัตรเครดิต/บัตรเดบิต</h4>
                     
               
                    <!-- v-for -->
                      <div class="col-md-12 col-12" v-for="(val,index) in creditCardList">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            บัตรที่{{ index + 1}} :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <div class="alert alert-info">
                              <a class="close" data-dismiss="alert" aria-label="close" @click="removeCreditCard(val,index)">&times;</a>
                              <span class="fontsize">ชื่อหน้าบัตร : {{val.creditCardName}}</span> 
                              <span class="fontsize">เลขบัตร : {{val.creditNumber}}</span> 
                              <span class="fontsize">จำนวนเงิน : {{convertToBaht(val.creditPayment)+" บาท"}}</span> 
                            </div>
                          </div>
                        </div>
                      </div>

                      

                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> ชื่อหน้าบัตร :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input class="form-control" v-model="creditCardName">
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> เลขที่บัตรเครดิต :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input
                                class="form-control"
                                v-model="creditNumber"
                                v-payment:formatCardNumber
                              >
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> เลขที่อนุมัติ :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input
                                class="form-control"
                                v-model="creditNumber"
                                v-payment:formatCardNumber
                              >
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> รหัสธนาคาร :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input
                                class="form-control"
                                v-model="creditNumber"
                                v-payment:formatCardNumber
                              >
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> สาขาธนาคาร :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input
                                class="form-control"
                                v-model="creditNumber"
                                v-payment:formatCardNumber
                              >
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> วันที่ถึงกำหนด :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input
                                class="form-control"
                                v-model="creditNumber"
                                v-payment:formatCardNumber
                              >
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> ยอดบัตรเครดิต :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input
                                class="form-control"
                                v-model="creditNumber"
                                v-payment:formatCardNumber
                              >
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> ประเภทบัตร :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input
                                class="form-control"
                                v-model="creditNumber"
                                v-payment:formatCardNumber
                              >
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> % Charge :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input
                                class="form-control"
                                v-model="creditNumber"
                                v-payment:formatCardNumber
                              >
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> Charge บาท :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input
                                class="form-control"
                                v-model="creditNumber"
                                v-payment:formatCardNumber
                              >
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> ยอด Charge :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input
                                class="form-control"
                                v-model="creditNumber"
                                v-payment:formatCardNumber
                                disabled
                              >
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> จำนวนเงิน :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input class="form-control" min="0" 
                                v-model.number="creditPayment" 
                                pattern="[0-9]"
                                type="number"
                                @change="payment_validation"
                                disabled
                              >
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            หมายเหตุ :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <textarea
                                class="form-control"
                                v-model.number="checkPayment"
                                rows="5"
                              ></textarea>
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="tax-bottom-part tax-button col-md-12 col-12">
                        <button
                          :disabled="creditCardName==''||creditNumber==''||creditPayment==null||typeof(this.creditPayment)=='string'"
                          @click="createCreditCard()"
                          class="btn btn-primary"
                        >
                          <span>เพิ่ม</span>
                        </button>
                      </div>
                    </div>
                    <div class="row" v-if="checkPaymentPart==true">
                      <hr class="col-10">
                      <h4 class="payment-sub-header information-part col-12">เช็ค</h4>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> เลขที่เช็ค :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input class="form-control" v-model="checkNumber">
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> มูลค่าเช็ค :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input class="form-control" v-model="checkNumber">
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> ลงวันที่ :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <vue-ctk-date-time-picker
                                format="YYYY-MM-DD"
                                locale="th"
                                v-model="checkDate"
                                :disable-time="true"
                              ></vue-ctk-date-time-picker>
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> ธนาคาร :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input class="form-control" v-model="checkBankName">
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> สาขา :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input class="form-control" v-model="checkBankBranch">
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> จำนวนเงิน :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input
                                class="form-control"
                                min="0"
                                v-model.number="checkPayment"
                                pattern="[0-9]"
                                type="number"
                                @change="payment_validation"
                              >
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            หมายเหตุ :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <textarea
                                class="form-control"
                                v-model.number="checkPayment"
                                rows="5"
                              ></textarea>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row" v-if="transferPaymentPart==true">
                      <hr class="col-10">
                      <h4 class="payment-sub-header information-part col-12">เงินโอน</h4>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> ชื่อบัญชีผู้โอนเงิน :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input class="form-control" v-model="transferName">
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> เลขที่บัญชีผู้โอนเงิน :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input class="form-control" type="number" v-model="transferAccountNo">
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> ธนาคารผู้โอนเงิน :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input class="form-control" v-model="bankTransfererName">
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> สาขาผู้โอนเงิน :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input class="form-control" v-model="bankTransfererBanch">
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> ชื่อบัญชีที่โอนเงิน :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input class="form-control" v-model="receiveName">
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> เลขที่บัญชีที่โอนเงิน :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input
                                class="form-control"
                                type="number"
                                v-model="bankReceiveAccountNo"
                              >
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> ธนาคารที่โอนเงิน :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input class="form-control" v-model="bankReceiveName">
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> สาขาที่โอนเงิน :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input class="form-control" v-model="bankReceiverBranch">
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> จำนวนเงิน :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <p>
                              <input
                                class="form-control"
                                min="0"
                                type="number"
                                v-model.number="transferPayment"
                                pattern="[0-9]"
                                @change="payment_validation"
                              >
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group row">
                          <p class="method-set col-lg-4 col-md-12 col-12">
                            <span style="color:red">*</span> วัน/เวลาที่ชำระเงิน :
                          </p>
                          <div class="col-lg-7 col-md-12 col-12">
                            <vue-ctk-date-time-picker
                              @input="check_date_p(transferDate)"
                              locale="th"
                              v-model="transferDate"
                            ></vue-ctk-date-time-picker>
                          </div>
                        </div>
                      </div>
                    </div>
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
                          <p class="tax-head">จำนวนเงินก่อนภาษี : {{ convertToBaht(payment_type) }} บาท</p>
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
                        :disabled="feeType==''||balance<0||payment==null||typeof(this.totalPayment)=='string'||totalPayment==null"
                        @click="setDone('second', 'third'),createDepositDocApi()"
                        class="btn btn-primary"
                      >
                        <span>บันทึก</span>
                      </button>
                    </div>
                    <div class="row tax-bottom-part">
                      <div class="col-md-12">
                        <div class="form-group">
                          <p class="tax-head" style="color:red" :hidden="balance>=0">*ยอดชำระไม่เพียงพอ</p>
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
      <md-step id="third" to md-label="สรุปใบรับเงินมัดจำ" :md-done.sync="third">
        <div>
          <div>
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12 card-control big-margin">
                <div class="card">
                  <div class="card-header deposit-header">
                    <span>Invoice</span>
                  </div>
                  <div class="deposit-border">
                    <div>รหัสลูกค้า : {{customerCode}}</div>
                    <div>ชื่อลูกค้า : {{customerName}}</div>
                    <div>เลขที่เอกสาร : {{serialNo}}</div>
                    <div>มูลค่ารวมภาษี : {{convertToBaht(totalPayment)}} บาท</div>
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
                              :action="php + '/vue_sale/report_pdf/report_deposit.html'"
                              method="post"
                              target="_blank"
                            >
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

export default {
  data() {
    return {
      serialNo: "",
      taxNo: "",
      id: "",
      customerID: "",
      customerCode: "",
      customerName: "",
      customerAddress:"",
      customerPhone:'',
      customerCreditDay:'',
      customerDueDate:'',
      documentDate: this.getDate(),
      taxApplyDate: this.getDate(),
      creditDate:"",
      checkDate: "",
      transferDate: "",
      preemptionNo: "",
      employeeID: "",
      employeeCode: "",
      employeeName: "",
      department: "",
      departmentData: [],
      taxrate: setting.data().setting_taxRate,
      click: false,
      searchCustomerInput: "",
      searchEmployeeInput: "",
      php: "http://" + document.domain,
      customerDetail: [],
      cashPaymentPart: false,
      creditPaymentPart: true,
      checkPaymentPart: true,
      transferPaymentPart: false,
      QRPaymentPart: false,
      cashPayment: null,
      creditPayment: null,
      checkPayment: null,
      transferPayment: null,
      payment:null,
      creditCardName: "",
      creditNumber: "",
      validateCreditCardNo:"",
      creditType:"",
      percentCardCharge:"",
      bahtCardCharge:"",
      creditNotice:"",
      creditCardList:[],
      checkBankName: "",
      checkBankBranch: "",
      checkNumber: "",
      chqPrize:"",
      chqNotice:"",
      transferName: "",
      transferAccountNo: "",
      bankTransfererName: "",
      bankTransfererBanch: "",
      receiveName: "",
      bankReceiveAccountNo: "",
      bankReceiveName: "",
      bankReceiverBranch: "",
      billType: "0",
      saleType: "",
      //setting.data().setting_saleType
      feeType: "",
      //setting.data().setting_feeType
      companyId: 1,
      branchId: "",
      showDialog: false,
      active: "first",
      first: false,
      second: false,
      third: false,
      profile: JSON.parse(localStorage.Datauser)
    };
  },
  components: {
    VueCtkDateTimePicker,
    ModelSelect
  },
  use: {
    VueStripePayment
  },
  methods: {
    setDone(id, index) {
      this[id] = true;

      this.secondStepError = null;

      if (index) {
        this.active = index;
      }
    },
    check_date_p(e) {
      alert(e);
    },
    convertToBaht(val) {
      var result = numeral(val).format("0,0.00");
      // console.log(typeof result)
      return result;
    },
    // searchDepartmentApi() {
    //   var payload = {
    //     keyword: this.department
    //   };
    //   console.log(JSON.stringify(payload));
    //   api.searchdepartment(
    //     payload,
    //     result => {
    //       console.log(JSON.stringify(result.data));
    //       if (result.data.length == 0) {
    //         this.departmentData = result.data;
    //         alertify.error("ไม่มีข้อมูลของแผนกนี้");
    //         return;
    //       }
    //       if (result.data.length > 0) {
    //         this.departmentData = result.data;
    //         return;
    //       }
    //     },
    //     error => {
    //       console.log(error);
    //     }
    //   );
    // },
    createCreditCard(){
      var creditcard = {
        creditCardName: this.creditCardName,
        creditNumber: this.creditNumber,
        creditPayment:this.creditPayment
      };
      this.creditCardName=''
      this.creditNumber=''
      this.creditPayment=''     
      console.log(JSON.stringify(creditcard));
      this.creditCardList.push(creditcard);
      console.log(JSON.stringify(this.creditCardList));
    },
    removeCreditCard(val,index){
      // console.log(val)
      this.creditCardList.splice(index);
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
    searchCustomer(val) {
      console.log(JSON.stringify(val));
      this.customerID = val.id;
      this.customerCode = val.code;
      this.customerName = val.name;
      this.customerAddress = val.address;
      this.customerPhone = val.telephone;
      this.customerCreditDay=val.bill_credit;
      this.customerDueDate=this.getDate(val.bill_credit);

      this.showDialogCustomer = false;
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
    getDueDate(val){
      const toTwoDigits = num => (num < 10 ? "0" + num : num);
      let today = new Date();
      today.setDate(today.getDate()+val)
      let year = today.getFullYear();
      let month = toTwoDigits(today.getMonth() + 1);
      let day = toTwoDigits(today.getDate());
      return `${year}-${month}-${day}`;
    },
    setzero(){
      if(this.cashPayment==null){
        this.cash=0;
      }
      else if(this.cashPayment!=null){
        this.cash==this.cashPayment
      }
      if(this.creditPayment==null){
        this.credit=0;
      }
      else if(this.creditPayment!=null){
        this.credit==this.creditPayment
      }
      if(this.checkPayment==null){
        this.cash=0;
      }
      else if(this.checkPayment!=null){
        this.check==this.checkPayment
      }
      if(this.transferPayment==null){
        this.transfer=0;
      }
      else if(this.transferPayment!=null){
        this.transfer==this.transferPayment
      }
    },
    payment_validation(){
      if(this.cashPaymentPart==false){
        this.cashPayment=null;
      }
      if(this.creditPaymentPart==false){
        this.creditPayment=null;
      }
      if(this.checkPaymentPart==false){
        this.checkPayment=null;
      }
      if(this.transferPaymentPart==false){
        this.transferPayment=null;
      }
    },
    createDepositDocApi() {
      let payload = {
        doc_no: this.serialNo,
        company_id: this.companyId,
        branch_id: parseInt(this.branchId),
        // taxNo: this.taxNo,
        tax_type: parseInt(this.feeType),
        ar_id: parseInt(this.customerID),
        ar_name:this.customerName,
        ar_code: this.customerCode,
        ar_bill_address: this.customerAddress,
        ar_telephone: this.customerPhone,
        // documentDate: this.documentDate,
        // taxApplyDate: this.taxApplyDate,
        // preemptionNo: this.preemptionNo,
        sale_id: parseInt(this.profile.id),
        sale_name:this.profile.username,
        sale_code: this.profile.sale_code,
        depart_id: this.department,
        bill_type: parseInt(this.saleType),
        tax_rate: this.taxrate,
        //   cashPaymentPart: this.cashPaymentPart,
        cash_amount: this.cashPayment,
        creditcard_amount: this.creditPayment,
        //   creditCardName: this.creditCardName,
        //   creditNumber: this.creditNumber,
        //   checkPaymentPart: this.checkPaymentPart,
        //   checkBankName: this.checkBankName,
        //   checkBankBranch: this.checkBankBranch,
        //   checkNumber: this.checkNumber,
        //   checkDate: this.checkDate,
        chq_amount: this.checkPayment,
        //   transferName: this.transferName,
        //   transferAccountNo: this.transferAccountNo,
        //   bankTransfererName: this.bankTransfererName,
        //   bankTransfererBanch: this.bankTransfererBanch,
        //   receiveName: this.receiveName,
        //   bankReceiveAccountNo: this.bankReceiveAccountNo,
        //   bankReceiveName: this.bankReceiveName,
        //   bankReceiverBranch: this.bankReceiverBranch,
        bank_amount: this.transferPayment,
        //   balance: 0
        total_amount: this.payment,
        create_by: this.profile.rolename
      };
      console.log(JSON.stringify(payload));
      api.createdeposit(
        payload,
        result => {
          console.log(JSON.stringify(result));
          alertify.success(
            "บันทึกข้อมูลใบรับเงินมัดจำเรียบร้อย"
          );
        },
        error => {
          console.log(JSON.stringify(error));
          alertify.error(
            "การส่งข้อมูลผิดพลาด"
          );
        }
      );
    }
  },
  computed: {
    totalPayment() {
      // console.log(this.feeType);
      // console.log(this.cashPayment);
      // console.log(this.creditPayment);
      // console.log(this.checkPayment);
      // console.log(this.transferPayment);
      
      if (this.cashPayment!=null||this.creditPayment!=null||this.checkPayment!=null||this.transferPayment != null) {
        return (
          this.cashPayment +
          this.totalCreditPayment +
          this.checkPayment +
          this.transferPayment
        );
      }
    },
    totalCreditPayment(){
      return this.creditCardList.reduce((sum,item)=>{
        return(sum+item.creditPayment)
      },0)
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
    balance(){
      // console.log(typeof(this.totalPayment))
      // console.log(typeof(this.cashPayment))
      // console.log(this.total_VAT)
      return this.totalPayment-this.total_VAT
    }
  },
  mounted() {
    this.setDone('first', 'second')
    // this.setDone('second', 'third')

    console.log(this.profile);
    console.log(JSON.stringify(this.getDueDate(1)));
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

.form-control[readonly] {
  text-align: left !important;
}

.form-control:disabled{ 
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
