    <template>
    <div>
        <md-steppers md-sync-route md-dynamic-height :md-active-step.sync="active" >
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
                                                <p class="article-set col-md-3 col-12"><span style="color:red">*</span> รหัสลูกค้า :</p>
                                                <div class="col-md-8 col-12">
                                                    <div class="input-group">
                                                        <input type="text" disabled v-model.number="customerCode" class="form-control">
                                                        <div class="input-group-append">
                                                        <button class="btn btn-primary icon-margin search-icon" @click="showDialog = true">
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
                                                <p class="article-set col-md-3 col-12"><span style="color:red">*</span> ชื่อลูกค้า :</p>
                                                <div class="col-md-8 col-12">
                                                    <input type="text" disabled v-model="customerName"  class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group row">
                                                <p class="article-set col-md-3 col-12"><span style="color:red">*</span> ประเภทการขาย :</p>
                                                <div class="col-md-8 col-12">
                                                    <select v-model="saleType" @change="createDepositNoApi" class="form-control">
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
                                                <p class="article-set col-md-3 col-12"><span style="color:red">*</span> เลขที่ใบเงินมัดจำ :</p>
                                                <div class="col-md-8 col-12">
                                                    <input type="text" class="form-control" disabled v-model="serialNo" @change="createDepositNoApi">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group row">
                                                <p class="article-set col-md-3 col-12"><span style="color:red">*</span> เลขที่ใบกำกับภาษี :</p>
                                                <div class="col-md-8 col-12">
                                                    <input type="text" disabled v-model="taxNo" @change="createDepositNoApi" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group row">
                                                <p class="article-set col-md-3 col-12"><span style="color:red">*</span> วันที่ออกเอกสาร :</p>
                                                <div class="col-md-8 col-12">
                                                    <vue-ctk-date-time-picker locale="th" format="YYYY-MM-DD" v-model="documentDate" :disable-time="true"></vue-ctk-date-time-picker>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group row">
                                                <p class="article-set col-md-3 col-12"><span style="color:red">*</span> วันที่ใบกำกับภาษี :</p>
                                                <div class="col-md-8 col-12">
                                                    <vue-ctk-date-time-picker locale='th' format="YYYY-MM-DD" v-model="taxApplyDate" :disable-time="true"></vue-ctk-date-time-picker>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group row">
                                                <p class="article-set col-md-3 col-12">เลขที่ใบจอง :</p>
                                                <div class="col-md-8 col-12">
                                                    <input type="text" v-model="subNo" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group row">
                                                <p class="article-set col-md-3 col-12"><span style="color:red">*</span> รหัสพนักงานขาย :</p>
                                                <div class="col-md-8 col-12">
                                                    <input type="text" disabled v-model="profile.sale_code" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group row">
                                                <p class="article-set col-md-3 col-12"><span style="color:red">*</span> ชื่อพนักงานขาย :</p>
                                                <div class="col-md-8 col-12">
                                                    <input type="text" disabled v-model="profile.username" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group row">
                                                <p class="article-set col-md-3 col-12"><span style="color:red">*</span> สาขาที่ขาย :</p>
                                                <div class="col-md-8 col-12">
                                                    <select v-model="profile.branch_id" class="form-control" @change="createDepositNoApi">
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
                                                <p class="article-set col-md-3 col-4"><span style="color:red"></span></p>
                                                <div class="tax-bottom-part tax-head col-md-8 col-7">
                                                    <button :disabled="saleType==''||customerCode==''||customerName==''" @click="setDone('first', 'second')" class="btn btn-primary"><span>ถัดไป</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <md-dialog :md-active.sync="showDialog">
                            <md-dialog-content class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><span>ค้นหาลูกค้า</span></h4>
                                    <button type="button" class="close" @click="showDialog = false">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <label>รหัสลูกค้า</label> 
                                    <input class="form-control" @keyup.enter="searchCustomerAllKeyApi" v-model="searchCustomerInput">
                                    <div class="table-responsive">          
                                        <table class="table table-hover">
                                            <thead align="center">
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>รหัสลูกค้า</th>
                                                    <th>ชื่อลูกค้า</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="table-pointer" @click="searchCustomer(val),showDialog = false" v-for="(val,index) in customerDetail" style="text-align:center;cursor:pointer">
                                                    <td>{{index+1}}</td>
                                                    <td>{{val.code}}</td>
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
            <md-step  id="second" to="" md-label="ช่องทางการชำระเงิน" :md-done.sync="second">
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
                                                    <p class="article-set col-md-3 col-12"><span style="color:red">*</span> ประเภทภาษี :</p>
                                                    <div class="col-md-8 col-12">
                                                        <select v-model="feeType" @change="createDepositNoApi" class="form-control">
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
                                                    <div class style="margin-left:6%">
                                                        <span class="col-sm-12">
                                                            <md-switch v-model="cashPaymentPart">เงินสด</md-switch>
                                                        </span>
                                                        <span class="col-sm-12">
                                                            <md-switch v-model="creditPaymentPart">บัตรเครดิต/บัตรเดบิต</md-switch>
                                                        </span>
                                                        <span class="col-sm-12">
                                                            <md-switch v-model="checkPaymentPart">เช็ค</md-switch>
                                                        </span>
                                                        <span class="col-sm-12">
                                                            <md-switch v-model="transferPaymentPart">เงินโอน</md-switch>
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
                                                    <p class="method-set col-lg-4 col-md-12 col-12"><span style="color:red">*</span> จำนวนเงิน :</p>
                                                    <div class="col-lg-7 col-md-12 col-12">
                                                        <input class="form-control" min=0 v-model.number="cashPayment" pattern="[0-9]" type="number">
                                                    </div>                                        
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" v-if="creditPaymentPart==true">
                                            <hr class="col-10">
                                            <h4 class="payment-sub-header information-part col-12">บัตรเครดิต/บัตรเดบิต
                                            </h4>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group row">
                                                    <p class="method-set col-lg-4 col-md-12 col-12"><span style="color:red">*</span> ชื่อหน้าบัตร :</p>
                                                    <div class="col-lg-7 col-md-12 col-12">
                                                        <p>
                                                            <input class="form-control" v-model="creditCardName">
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group row">
                                                    <p class="method-set col-lg-4 col-md-12 col-12"><span style="color:red">*</span> เลขบัตร :</p>
                                                    <div class="col-lg-7 col-md-12 col-12">
                                                        <p>
                                                            <input class="form-control" v-model="creditNumber" v-payment:formatCardNumber>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group row">
                                                    <p class="method-set col-lg-4 col-md-12 col-12"><span style="color:red">*</span> จำนวนเงิน :</p>
                                                    <div class="col-lg-7 col-md-12 col-12">
                                                        <p>
                                                            <input class="form-control" min=0 v-model.number="creditPayment">
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" v-if="checkPaymentPart==true">
                                            <hr class="col-10">
                                            <h4 class="payment-sub-header information-part col-12">เช็ค
                                            </h4>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group row">
                                                    <p class="method-set col-lg-4 col-md-12 col-12"><span style="color:red">*</span> ธนาคาร :</p>
                                                    <div class="col-lg-7 col-md-12 col-12">
                                                        <p>
                                                            <input class="form-control" v-model="checkBankName">
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group row">
                                                    <p class="method-set col-lg-4 col-md-12 col-12"><span style="color:red">*</span> สาขา :</p>
                                                    <div class="col-lg-7 col-md-12 col-12">
                                                        <p>
                                                            <input class="form-control" v-model="checkBankBranch">
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group row">
                                                    <p class="method-set col-lg-4 col-md-12 col-12"><span style="color:red">*</span> เลขที่เช็ค :</p>
                                                    <div class="col-lg-7 col-md-12 col-12">
                                                        <p>
                                                            <input class="form-control" v-model="checkNumber">
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group row">
                                                    <p class="method-set col-lg-4 col-md-12 col-12"><span style="color:red">*</span> ลงวันที่ :</p>
                                                    <div class="col-lg-7 col-md-12 col-12">
                                                        <p>
                                                            <vue-ctk-date-time-picker format="YYYY-MM-DD" locale="th" v-model="checkDate" :disable-time="true"></vue-ctk-date-time-picker>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group row">
                                                    <p class="method-set col-lg-4 col-md-12 col-12"><span style="color:red">*</span> จำนวนเงิน :</p>
                                                    <div class="col-lg-7 col-md-12 col-12">
                                                        <p>
                                                            <input class="form-control" type="number" min=0 v-model.number="checkPayment">
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" v-if="transferPaymentPart==true">
                                            <hr class="col-10">
                                            <h4 class="payment-sub-header information-part col-12">เงินโอน
                                            </h4>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group row">
                                                    <p class="method-set col-lg-4 col-md-12 col-12"><span style="color:red">*</span> ชื่อบัญชีผู้โอนเงิน :</p>
                                                    <div class="col-lg-7 col-md-12 col-12">
                                                        <p>
                                                            <input class="form-control" v-model="transferName">
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group row">
                                                    <p class="method-set col-lg-4 col-md-12 col-12"><span style="color:red">*</span> เลขที่บัญชีผู้โอนเงิน :</p>
                                                    <div class="col-lg-7 col-md-12 col-12">
                                                        <p>
                                                            <input class="form-control" type="number" v-model="transferAccountNo">
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group row">
                                                    <p class="method-set col-lg-4 col-md-12 col-12"><span style="color:red">*</span> ธนาคารผู้โอนเงิน :</p>
                                                    <div class="col-lg-7 col-md-12 col-12">
                                                        <p>
                                                            <input class="form-control" v-model="bankTransfererName">
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group row">
                                                    <p class="method-set col-lg-4 col-md-12 col-12"><span style="color:red">*</span> สาขาผู้โอนเงิน :</p>
                                                    <div class="col-lg-7 col-md-12 col-12">
                                                        <p>
                                                            <input class="form-control" v-model="bankTransfererBanch">
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group row">
                                                    <p class="method-set col-lg-4 col-md-12 col-12"><span style="color:red">*</span> ชื่อบัญชีที่โอนเงิน :</p>
                                                    <div class="col-lg-7 col-md-12 col-12">
                                                        <p>
                                                            <input class="form-control" v-model="receiveName">
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group row">
                                                    <p class="method-set col-lg-4 col-md-12 col-12"><span style="color:red">*</span> เลขที่บัญชีที่โอนเงิน :</p>
                                                    <div class="col-lg-7 col-md-12 col-12">
                                                        <p>
                                                            <input class="form-control" type="number" v-model="bankReceiveAccountNo">
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group row">
                                                    <p class="method-set col-lg-4 col-md-12 col-12"><span style="color:red">*</span> ธนาคารที่โอนเงิน :</p>
                                                    <div class="col-lg-7 col-md-12 col-12">
                                                        <p>
                                                            <input class="form-control" v-model="bankReceiveName">
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group row">
                                                    <p class="method-set col-lg-4 col-md-12 col-12"><span style="color:red">*</span> สาขาที่โอนเงิน :</p>
                                                    <div class="col-lg-7 col-md-12 col-12">
                                                        <p>
                                                            <input class="form-control" v-model="bankReceiverBranch">
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group row">
                                                    <p class="method-set col-lg-4 col-md-12 col-12"><span style="color:red">*</span> จำนวนเงิน :</p>
                                                    <div class="col-lg-7 col-md-12 col-12">
                                                        <p>
                                                            <input class="form-control" min=0 type="number" v-model.number="transferPayment">
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group row">
                                                    <p class="method-set col-lg-4 col-md-12 col-12"><span style="color:red">*</span> วัน/เวลาที่ชำระเงิน :</p>
                                                    <div class="col-lg-7 col-md-12 col-12">
                                                        <vue-ctk-date-time-picker @input="check_date_p(transferDate)" locale="th" v-model="transferDate"></vue-ctk-date-time-picker>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>        
                                </div>
                            </div>
                            <div class="col-12 col-md-5 col-lg-4 big-margin">
                                <div class="card stickydestop"  style="position: sticky; top: 0;">
                                    <div class="card-header tax-header">
                                        <span>สรุปยอดชำระเงิน</span> 
                                    </div>
                                    <div class="tax-border">
                                        <div class="row tax-head-part">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <p class="tax-head">อัตราภาษีมูลค่าเพิ่ม : {{taxrate}} %
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <p class="tax-head" v-if="feeType==''" @change="feeType">จำนวนเงินก่อนภาษี : {{ convertToBaht(0) }} บาท</p>
                                                    <p class="tax-head" v-if="feeType=='0'" @change="feeType">จำนวนเงินก่อนภาษี : {{ convertToBaht(totalPayment) }} บาท</p>
                                                    <p class="tax-head" v-if="feeType=='1'" @change="feeType">จำนวนเงินก่อนภาษี : {{ convertToBaht(priceBVAT) }} บาท</p>
                                                    <p class="tax-head" v-if="feeType=='2'" @change="feeType">จำนวนเงินก่อนภาษี : {{ convertToBaht(totalPayment) }} บาท</p>
                                                    <!-- <p class="tax-head">จำนวนเงินก่อนภาษี : {{ convertToBaht(priceBVAT) }} บาท</p> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <p class="tax-head" v-if="feeType==''||feeType=='2'">ภาษีมูลค่าเพิ่ม : {{ convertToBaht(0) }} บาท</p>
                                                    <p class="tax-head" v-if="feeType=='0'">ภาษีมูลค่าเพิ่ม : {{ convertToBaht(externalVAT) }} บาท</p>
                                                    <p class="tax-head" v-if="feeType=='1'">ภาษีมูลค่าเพิ่ม : {{ convertToBaht(internalVAT) }} บาท</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <p class="tax-summary" v-if="feeType==''">มูลค่ารวมภาษี : {{ convertToBaht(0) }} บาท</p>
                                                    <p class="tax-summary" v-if="feeType=='0'">มูลค่ารวมภาษี : {{ convertToBaht(priceAVAT) }} บาท</p>
                                                    <p class="tax-summary" v-if="feeType=='1'">มูลค่ารวมภาษี : {{ convertToBaht(totalPayment) }} บาท</p>
                                                    <p class="tax-summary" v-if="feeType=='2'">มูลค่ารวมภาษี : {{ convertToBaht(totalPayment) }} บาท</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row tax-bottom-part">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <p class="tax-head">ยอดเงินคงเหลือ : {{ convertToBaht(balance) }} บาท</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tax-bottom-part tax-button">
                                            <button :disabled="saleType==''" @click="setDone('second', 'third'),createDepositDocApi()" class="btn btn-primary"><span>บันทึก</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </md-step>
            <md-step  id="third" to="" md-label="สรุปใบรับเงินมัดจำ" :md-done.sync="third">
                <div>
                    <div>
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12 card-control big-margin">
                                <div class="card">
                                    <div class="card-header deposit-header">
                                        <span>Invoice</span>    
                                    </div>
                                    <div class="deposit-border">
                                        <div>
                                            รหัสลูกค้า : {{customerCode}}
                                        </div>
                                        <div>
                                            ชื่อลูกค้า : {{customerName}}
                                        </div>
                                        <div>
                                            เลขที่เอกสาร : {{serialNo}}
                                        </div>
                                        <div>
                                            มูลค่ารวมภาษี : {{totalPayment}}
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="tax-bottom-part finish-button col-3">
                                                    <button class="btn btn-primary finish-button search-icon" @click="goindex('/index')">สิ้นสุด</button>
                                                </div>
                                                <div class="tax-bottom-part print-button col-3">
                                                    <button class="btn btn-primary search-icon">Print</button>
                                                </div>
                                                <form :action="php + '/vue_sale/report_pdf/report_quotationpdf.php'" method="post" target="_blank">
                                                    <input type="hidden" name="dataquotation">
                                                    <md-button type="submit" class="md-raised md-primary">PDF</md-button>
                                                        <!-- <button type="submit">กด</button> -->
                                                </form>
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

export default {
  data() {
    return {
      serialNo: "",
      taxNo: "",
      id: "",
      customerID: "",
      customerCode: "",
      date_payment: "",
      customerName: "",
      documentDate: this.getDate(),
      taxApplyDate: this.getDate(),
      checkDate: "",
      transferDate: "",
      subNo: "",
      employeeID: "",
      employeeCode: "",
      employeeName: "",
      department: "",
      departmentData: [],
      zerotax: 0.0,
      taxrate: 7.0,
      valueBTax: 0.0,
      includeVAT: 0.0,
      balance: 0.0,
      click: false,
      date: "",
      searchCustomerInput: "",
      searchEmployeeInput: "",
      php: "http://" + document.domain,
      depositSerial: [
        {
          id: "1",
          serialNo: "51234",
          taxNo: "5647",
          customerID: "S4545",
          documentDate: "2018-11-01",
          taxApplyDate: "2018-11-01",
          employeeID: "Ariya Indhabhandhu",
          subNo: "ASE234"
        },
        {
          id: "2",
          serialNo: "31279",
          taxNo: "SE5487",
          customerID: "S4566",
          documentDate: "2018-12-01",
          taxApplyDate: "2018-12-01",
          employeeID: "Ariya Indhabhandhu",
          subNo: "ASE232"
        },
        {
          id: "3",
          serialNo: "1234567",
          taxNo: "876543",
          saleType: 2,
          customerID: "3345",
          documentDate: "2018-12-04",
          taxApplyDate: "2018-12-11",
          subNo: "5432222222",
          employeeID: "234",
          employeeName: "werrr",
          department: "IT",
          cashPaymentPart: true,
          cashPayment: 1220,
          creditPaymentPart: true,
          creditCardName: "Ariya Indhabhandhu",
          creditNumber: "1234567890000000000987",
          creditPayment: 1244,
          checkPaymentPart: true,
          checkBankName: "AriyaCB",
          checkBankBranch: "IceLan",
          checkNumber: "12345678",
          checkDate: "2018-05-23",
          checkPayment: 111112,
          transferPaymentPart: true,
          transferName: "Ariya Indhabhandhu",
          transferAccountNo: "1234567",
          bankTransfererName: "AriyaBC",
          bankTransfererBanch: "Isuland",
          receiveName: "Suide",
          bankReceiveAccountNo: "45678765",
          bankReceiveName: "SCD",
          bankReceiverBranch: "SCDF",
          transferPayment: 1234567,
          transferDate: "2018-11-10T18:09:00+07:00",
          balance: 0
        }
      ],
      customerDetail: [],
      employeeDetail: [],
      cashPaymentPart: false,
      creditPaymentPart: false,
      checkPaymentPart: false,
      transferPaymentPart: false,
      QRPaymentPart: false,
      cashPayment: null,
      creditPayment: null,
      checkPayment: null,
      transferPayment: null,
      creditCardName: "",
      creditNumber: "",
      checkBankName: "",
      checkBankBranch: "",
      checkNumber: "",
      transferName: "",
      transferAccountNo: "",
      bankTransfererName: "",
      bankTransfererBanch: "",
      receiveName: "",
      bankReceiveAccountNo: "",
      bankReceiveName: "",
      bankReceiverBranch: "",
      billType: "0",
      price: "",
      saleType: "",
      nextTodoId: 4,
      oldId: "",
      oldList: "",
      key_cus: "",
      companyId: 1,
      branchId: "",
      showDialog: false,
      active: "first",
      first: false,
      second: false,
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
    selectDepositList() {
      this.oldId = this.nextTodoId;
    },
    convertToBaht(val) {
      var result = numeral(val).format("0,0.00");
      // console.log(typeof result)
      return result;
    },
    searchDepartmentApi() {
      var payload = {
        keyword: this.department
      };
      console.log(JSON.stringify(payload));
      api.searchdepartment(
        payload,
        result => {
          console.log(JSON.stringify(result.data));
          if (result.data.length == 0) {
            this.departmentData = result.data;
            alertify.error("ไม่มีข้อมูลของแผนกนี้");
            return;
          }
          if (result.data.length > 0) {
            this.departmentData = result.data;
            return;
          }
        },
        error => {
          console.log(error);
        }
      );
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
    searchCustomerNameApi() {
      var payload = {
        keyword: this.customerName
      };

      api.Customerall(
        payload,
        result => {
          console.log(result);
        },
        error => {
          console.log(error);
        }
      );
    },
    searchCustomerIdApi() {
      var payload = {
        id: this.customerID
      };

      api.findCustomerID(
        payload,
        result => {
          console.log(result);
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

      this.showDialogCustomer = false;
    },
    searchEmployeeIdApi() {
      var payload = {
        keyword: this.employeeID
      };

      api.searchcus(
        payload,
        result => {
          console.log(result);
        },
        error => {
          console.log(error);
        }
      );
    },
    searchEmployeeAllKeyApi() {
      var payload = {
        keyword: this.searchEmployeeInput
      };

      api.searchcus(
        payload,
        result => {
          console.log(JSON.stringify(result.data));
          if (result.data.length == 0) {
            this.employeeDetail = result.data;
            alertify.error("ไม่มีข้อมูล");
            return;
          }
          if (result.data.length > 0) {
            this.employeeDetail = result.data;
            alertify.success("พบข้อมูลพนักงาน");
          }
        },
        error => {
          console.log(error);
        }
      );
    },
    searchEmployee(val) {
      console.log(JSON.stringify(val));
      this.employeeID = val.employee_id;
      this.employeeCode = val.sale_code;
      this.employeeName = val.sale_name;

      this.showDialogCustomer = false;
    },
    selectDeposit(VAL) {
      console.log(VAL);
      (this.serialNo = VAL.serialNo),
        (this.taxNo = VAL.taxNo),
        (this.saleType = VAL.saleType),
        (this.customerID = VAL.customerID),
        (this.customerName = VAL.customerName),
        (this.documentDate = VAL.documentDate),
        (this.taxApplyDate = VAL.taxApplyDate),
        (this.subNo = VAL.subNo),
        (this.employeeID = VAL.employeeID),
        (this.employeeName = VAL.employeeName),
        (this.department = VAL.department);
      if (VAL.cashPaymentPart == true) {
        this.cashPayment = VAL.cashPayment;
      }
      if (VAL.creditPaymentPart == true) {
        this.creditCardName = VAL.creditCardName;
        this.creditNumber = VAL.creditNumber;
        this.creditPayment = VAL.creditPayment;
      }
      if (VAL.checkPaymentPart == true) {
        this.checkBankName = VAL.checkBankName;
        this.checkBankBranch = VAL.checkBankBranch;
        this.checkNumber = VAL.checkNumber;
        this.checkDate = VAL.checkDate;
        this.checkPayment = VAL.checkPayment;
      }
      if (VAL.transferPaymentPart == true) {
        this.transferName = VAL.transferName;
        this.transferAccountNo = VAL.transferAccountNo;
        this.bankTransfererName = VAL.bankTransfererName;
        this.bankTransfererBanch = VAL.bankTransfererBanch;
        this.receiveName = VAL.receiveName;
        this.bankReceiveAccountNo = VAL.bankReceiveAccountNo;
        this.bankReceiveName = VAL.bankReceiveName;
        this.bankReceiverBranch = VAL.bankReceiverBranch;
        this.transferDate = VAL.transferDate;
        this.transferPayment = VAL.transferPayment;
      }
    },
    // addDeposit() {
    //   if (this.saleType == 0) {
    //     this.depositSerial.push({
    //       id: this.nextTodoId++,
    //       serialNo: this.serialNo,
    //       taxNo: this.taxNo,
    //       saleType: this.saleType,
    //       customerID: this.customerID,
    //       documentDate: this.documentDate,
    //       taxApplyDate: this.taxApplyDate,
    //       subNo: this.subNo,
    //       employeeID: this.employeeID,
    //       employeeName: this.employeeName,
    //       department: this.department,
    //       //   taxrate: this.taxrate,
    //       //   valueBTax: this.valueBTax,
    //       //   includeVAT: this.priceWithTaxCOM,
    //       //   VAT: this.externalVAT,
    //       cashPaymentPart: this.cashPaymentPart,
    //       cashPayment: this.cashPayment,
    //       creditPaymentPart: this.creditPaymentPart,
    //       creditCardName: this.creditCardName,
    //       creditNumber: this.creditNumber,
    //       checkPaymentPart: this.checkPaymentPart,
    //       checkBankName: this.checkBankName,
    //       checkBankBranch: this.checkBankBranch,
    //       checkNumber: this.checkNumber,
    //       checkDate: this.checkDate,
    //       checkPayment: this.checkPayment,
    //       transferName: this.transferName,
    //       transferAccountNo: this.transferAccountNo,
    //       bankTransfererName: this.bankTransfererName,
    //       bankTransfererBanch: this.bankTransfererBanch,
    //       receiveName: this.receiveName,
    //       bankReceiveAccountNo: this.bankReceiveAccountNo,
    //       bankReceiveName: this.bankReceiveName,
    //       bankReceiverBranch: this.bankReceiverBranch,
    //       transferPayment: this.transferPayment,
    //       balance: 0
    //     });
    //   }
    //   if (this.saleType == 1 || this.saleType == 2) {
    //     this.depositSerial.push({
    //       id: this.nextTodoId++,
    //       serialNo: this.serialNo,
    //       taxNo: this.taxNo,
    //       saleType: this.saleType,
    //       customerID: this.customerID,
    //       documentDate: this.documentDate,
    //       taxApplyDate: this.taxApplyDate,
    //       subNo: this.subNo,
    //       employeeID: this.employeeID,
    //       department: this.department,
    //       //   taxrate: this.taxrate,
    //       //   valueBTax: this.priceNonTaxCOM,
    //       //   includeVAT: this.includeVAT,
    //       //   VAT: this.internalVAT,
    //       cashPaymentPart: this.cashPaymentPart,
    //       cashPayment: this.cashPayment,
    //       creditPaymentPart: this.creditPaymentPart,
    //       creditCardName: this.creditCardName,
    //       creditNumber: this.creditNumber,
    //       checkPaymentPart: this.checkPaymentPart,
    //       checkBankName: this.checkBankName,
    //       checkBankBranch: this.checkBankBranch,
    //       checkNumber: this.checkNumber,
    //       checkDate: this.checkDate,
    //       checkPayment: this.checkPayment,
    //       transferName: this.transferName,
    //       transferAccountNo: this.transferAccountNo,
    //       bankTransfererName: this.bankTransfererName,
    //       bankTransfererBanch: this.bankTransfererBanch,
    //       receiveName: this.receiveName,
    //       bankReceiveAccountNo: this.bankReceiveAccountNo,
    //       bankReceiveName: this.bankReceiveName,
    //       bankReceiverBranch: this.bankReceiverBranch,
    //       transferPayment: this.transferPayment,
    //       balance: 0
    //     });
    //   }
    // },
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
      // localStorage.iddocno = 0

      if (val == "/index") {
        this.$router.push({ name: "index" });
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
    createDepositDocApi() {
      let payload = {
        doc_no: this.serialNo,
        company_id: this.companyId,
        branch_id: parseInt(this.branchId),
        // taxNo: this.taxNo,
        tax_type: parseInt(this.saleType),
        ar_id: parseInt(this.customerID),
        ar_code: this.customerCode,
        // documentDate: this.documentDate,
        // taxApplyDate: this.taxApplyDate,
        // subNo: this.subNo,
        sale_id: parseInt(this.profile.id),
        salec_code: this.profile.sale_code,
        // department: this.department,
        bill_type: parseInt(this.billType),
        tax_rate: this.taxrate,
        //   cashPaymentPart: this.cashPaymentPart,
        cash_amount: this.cashPayment,
        //   creditPaymentPart: this.creditPaymentPart,
        //   creditCardName: this.creditCardName,
        //   creditNumber: this.creditNumber,
        //   checkPaymentPart: this.checkPaymentPart,
        //   checkBankName: this.checkBankName,
        //   checkBankBranch: this.checkBankBranch,
        //   checkNumber: this.checkNumber,
        //   checkDate: this.checkDate,
        //   checkPayment: this.checkPayment,
        //   transferName: this.transferName,
        //   transferAccountNo: this.transferAccountNo,
        //   bankTransfererName: this.bankTransfererName,
        //   bankTransfererBanch: this.bankTransfererBanch,
        //   receiveName: this.receiveName,
        //   bankReceiveAccountNo: this.bankReceiveAccountNo,
        //   bankReceiveName: this.bankReceiveName,
        //   bankReceiverBranch: this.bankReceiverBranch,
        //   transferPayment: this.transferPayment,
        //   balance: 0
        total_amount: this.totalPayment
      };
      console.log(JSON.stringify(payload));
      api.createdeposit(
        payload,
        result => {
          console.log(JSON.stringify(result));
        },
        error => {
          console.log(JSON.stringify(error));
        }
      );
    }
  },
  computed: {
    //ภาษีแยกนอก
    externalVAT() {
      return this.totalPayment * (this.taxrate / 100);
    },
    priceAVAT() {
      return this.totalPayment + this.externalVAT;
    },
    //ภาษีรวมใน
    internalVAT() {
      return this.totalPayment - this.priceBVAT;
    },
    priceBVAT() {
      return this.totalPayment * (100/(100+this.taxrate));
    },
    totalPayment() {
      return (
        this.cashPayment +
        this.creditPayment +
        this.checkPayment +
        this.transferPayment
      );
    }
  },
  mounted() {
    console.log(this.profile);
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

.print-button{
    text-align: right;
}

.next-button {
  float: right;
}

.form-control[readonly] {
  text-align: right !important;
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
    text-align: left;
  }
  .tax-button {
    text-align: center;
  }
}
</style>
