<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-8 big-margin">
                    <div class="card">
                        <div class="card-header deposit-header">
                             <span>ใบรับเงินมัดจำ</span>    
                        </div>
                        <div class="deposit-border">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">ค้นหา:</p>
                                        <div class="col-7  text-left" data-toggle="modal" data-target="#searchModal">
                                            <button class="btn btn-primary icon-margin search-icon">
                                                <md-icon class="search-icon">search</md-icon>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">เลขที่ใบเงินมัดจำ:</p>
                                        <div class="col-7">
                                            <input type="text" class="form-control" v-model="serialNo">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">เลขที่ใบกำกับภาษี:</p>
                                        <div class="col-7">
                                            <input type="number" v-model="taxNo" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">ประเภทภาษี:</p>
                                        <div class="col-7">
                                            <select @change="calFee" v-model="feeType" class="form-control">
                                                <option value="0">ภาษีแยกนอก</option>
                                                <option value="1">ภาษีรวมใน</option>
                                                <option value="2">ภาษีอัตราศูนย์</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">รหัสลูกค้า:</p>
                                        <div class="col-7">
                                            <input type="text" v-model="customerID" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">วันที่ออกเอกสาร:</p>
                                        <div class="col-7">
                                            <input type="date" v-model="documentDate" @change="checkdate" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">วันที่ใบกำกับภาษี:</p>
                                        <div class="col-7">
                                            <input type="date" v-model="taxApplyDate" @change="checkdate" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">เลขที่ใบจอง:</p>
                                        <div class="col-7">
                                            <input type="text" v-model="subNo" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">รหัสพนักงานขาย:</p>
                                        <div class="col-7">
                                            <input type="text" v-model="billerNo" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row information-part">
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">แผนก:</p>
                                        <div class="col-7">
                                            <input v-model="department" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4 big-margin">
                    <div class="card">
                        <div class="card-header tax-header">
                            <span>สรุปยอดเงิน</span> 
                        </div>
                        <div class="tax-border">
                            <div class="row tax-head-part">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p class="tax-head">อัตราภาษีมูลค่าเพิ่ม: {{taxrate}} %
                                        <input :disabled="feeType==''||feeType=='2'" type="number" class="form-control tax-head" v-model="taxrate">
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p class="tax-head" v-if="feeType=='0'||feeType==''">จำนวนเงินก่อนภาษี: {{ convertToBaht(valueBTax) }} บาท</p>
                                        <p class="tax-head" v-if="feeType=='1'">จำนวนเงินก่อนภาษี: {{ convertToBaht(priceNonTaxCOM) }} บาท</p>
                                        <p class="tax-head" v-if="feeType=='2'">จำนวนเงินก่อนภาษี: {{ convertToBaht(priceNonTaxCOM) }} บาท</p>
                                        <input v-if="feeType==''" :disabled="feeType == ''" type="number" class="form-control tax-head" v-model.number="valueBTax">
                                        <input v-if="feeType=='0'" type="number" class="form-control tax-head" v-model.number="valueBTax">
                                        <input v-if="feeType=='1'" :disabled="feeType == '1'" type="number" class="form-control tax-head" v-model.number="priceNonTaxCOM">
                                        <input v-if="feeType=='2'" :disabled="feeType == '2'" type="number" class="form-control tax-head" v-model.number="priceNonTaxCOM">
                                        <!-- <button @click="calltestapi" class="btn btn-primary" >คำนวณ</button> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p class="tax-head" v-if="feeType==''||feeType=='0'">ภาษีมูลค่าเพิ่ม: {{ convertToBaht(externalVAT) }} บาท</p>
                                        <p class="tax-head" v-if="feeType=='1'||feeType=='2'">ภาษีมูลค่าเพิ่ม: {{ convertToBaht(internalVAT) }} บาท</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p class="tax-summary" v-if="feeType==''||feeType=='1'||feeType=='2'">มูลค่ารวมภาษี {{ convertToBaht(includeVAT) }} บาท</p>
                                        <p class="tax-summary" v-if="feeType=='0'">มูลค่ารวมภาษี {{ convertToBaht(includeVAT) }} บาท</p>
                                        <input v-if="feeType==''" :disabled="feeType == ''" type="number" class="form-control tax-head" v-model.number="includeVAT">
                                        <input v-if="feeType=='0'" :disabled="feeType == '0'" type="number" class="form-control tax-head" v-model.number="priceWithTaxCOM">
                                        <input v-if="feeType=='1'" type="number" class="form-control tax-head" v-model.number="includeVAT">
                                        <input v-if="feeType=='2'" type="number" class="form-control tax-head" v-model.number="includeVAT">
                                    </div>
                                </div>
                            </div>
                            <div class="row tax-bottom-part">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p class="tax-head">ยอดเงินคงเหลือ {{ balance }} บาท</p>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="alert alert-danger" role="alert">
                            ชื่อ {{username}} บริษัท {{company}}
                            </div> -->
                            <div class="tax-bottom-part tax-head">
                                <button :disabled="feeType==''" data-toggle="modal" data-target="#saveModal" class="btn btn-primary"><span>บันทึก</span></button>
                            </div>
                            <div class="tax-bottom-part tax-head">
                                <button data-toggle="modal" data-target="#updateModal" class="btn btn-primary"><span>test</span></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="searchModal">
                    <div class="modal-dialog modal-lg">
    
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><span>ค้นหาเลขที่ใบมัดจำ</span></h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">          
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>เลขที่ใบมัดจำ</th>
                                                <th>เลขที่ใบกำกับภาษี</th>
                                                <th>รหัสลูกค้า</th>
                                                <th>วันที่ออกเอกสาร</th>
                                                <th>วันที่ใบกำกับภาษี</th>
                                                <th>ชื่อในการออกบิล</th>
                                                <th>เลขที่ใบจอง</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="table-pointer" v-for="row in depositSerial"  @click="selectDeposit(row.id)">
                                                <td>{{row.serialNo}}</td>
                                                <td>{{row.taxNo}}</td>
                                                <td>{{row.customerID}}</td>
                                                <td>{{row.documentDate}}</td>
                                                <td>{{row.taxApplyDate}}</td>
                                                <td>{{row.billerName}}</td>
                                                <td>{{row.subNo}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><span>Close</span></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="updateModal">
                    <div class="modal-dialog modal-lg">
    
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><span>บันทึกข้อมูลเลขที่ใบมัดจำ</span></h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">เลขที่ใบเงินมัดจำ:</p>
                                        <div class="col-7">
                                            <input type="text" class="form-control" v-model="serialNo">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">เลขที่ใบกำกับภาษี:</p>
                                        <div class="col-7">
                                            <input type="number" v-model="taxNo" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">ประเภทภาษี:</p>
                                        <div class="col-7">
                                            <select @change="calFee" v-model="feeType" class="form-control">
                                                <option value="0">ภาษีแยกนอก</option>
                                                <option value="1">ภาษีรวมใน</option>
                                                <option value="2">ภาษีอัตราศูนย์</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">รหัสลูกค้า:</p>
                                        <div class="col-7">
                                            <input type="text" v-model="customerID" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">วันที่ออกเอกสาร:</p>
                                        <div class="col-7">
                                            <input type="date" v-model="documentDate" @change="checkdate" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">วันที่ใบกำกับภาษี:</p>
                                        <div class="col-7">
                                            <input type="date" v-model="taxApplyDate" @change="checkdate" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">เลขที่ใบจอง:</p>
                                        <div class="col-7">
                                            <input type="text" v-model="subNo" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">รหัสพนักงานขาย:</p>
                                        <div class="col-7">
                                            <input type="text" v-model="billerNo" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">แผนก:</p>
                                        <div class="col-7">
                                            <input v-model="department" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">จำนวนเงินก่อนภาษี: {{ convertToBaht(valueBTax) }} บาท</p>
                                        <div class="col-7">
                                            <input type="number" class="form-control" v-model.number="valueBTax">
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <p class="tax-head">จำนวนเงินก่อนภาษี: {{ convertToBaht(valueBTax) }} บาท</p>
                                            <input type="number" class="form-control tax-head" v-model.number="valueBTax">
                                            <!-- <button @click="calltestapi" class="btn btn-primary" >คำนวณ</button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal" @click="addDeposit"><span>Save</span></button>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span>Cancel</span></button>
                            </div>
                        </div>
                    
                    </div>
                </div>
                <div class="modal fade" id="saveModal">
                    <div class="modal-dialog modal-lg">
    
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><span>บันทึกข้อมูลเลขที่ใบมัดจำ</span></h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">          
                                    <div class="text-danger">
                                        <span>เซฟข้อมูลแล้วไม่สามารถแก้ไขข้อมูลเก่าได้</span>
                                    </div>
                                    <div class="text-danger">
                                        <span>
                                            แน่ใจว่าจะเซฟ?
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal" @click="addDeposit"><span>Save</span></button>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span>Close</span></button>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import api from "../../service/service.js";

export default {
  data() {
    return {
      serialNo: "",
      taxNo: "",
      customerID: "",
      documentDate: "",
      taxApplyDate: "",
      subNo: "",
      billerNo: "",
      department: "",
      taxrate: 0.0,
      valueBTax: 0.0,
      includeVAT: 0.0,
      balance: 0,
      click: false,
      //   username: "",
      //   company: "",
      date: "",
      depositSerial: [
        {
          id: "1",
          serialNo: "51234",
          taxNo: "SE5647",
          customerID: "S4545",
          documentDate: "2018-11-01",
          taxApplyDate: "2018-11-01",
          billerName: "Ariya Indhabhandhu",
          subNo: "ASE234"
        },
        {
          id: "2",
          serialNo: "31279",
          taxNo: "SE5487",
          customerID: "S4566",
          documentDate: "2018-12-01",
          taxApplyDate: "2018-12-01",
          billerName: "Ariya Indhabhandhu",
          subNo: "ASE232"
        },
        {
          id: "3",
          serialNo: "75424",
          taxNo: "SE7896",
          customerID: "S4545",
          documentDate: "2018-11-05",
          taxApplyDate: "2018-11-05",
          billerName: "Ariya Indhabhandhu",
          subNo: "ASE215"
        }
      ],
      feeType: "",
      nextTodoId: 4,
      oldId: "",
      oldList: ""
    };
  },
  methods: {
    calFee() {
      //alert(this.feeType);
      if (this.feeType == "0") {
      }
      if (this.feeType == "1") {
      }
      if (this.feeType == "2") {
        this.taxrate = 0;
      }
    },
    checkdate() {
      alert(this.date);
    },
    selectDepositList() {
      this.oldId = this.nextTodoId;
    },
    convertToBaht(val) {
      var result = numeral(val).format("0,0.00");
      // console.log(typeof result)
      return result;
    },
    calltestapi() {
      var payload = {
        name: "ddd"
      };
      api.loginAX(
        "livermoo",
        "1234",
        result => {
          this.username = result.data.username;
          this.company = result.data.company_name;
        },
        error => {
          console.log(error);
        }
      );
    },
    selectDeposit(e) {
      alert(this.depositSerial[e - 1].serialNo);
    },
    addDeposit() {
      if (this.feeType == 0) {
        this.depositSerial.push({
          id: this.nextTodoId++,
          serialNo: this.serialNo,
          taxNo: this.taxNo,
          feeType: this.feeType,
          customerID: this.customerID,
          documentDate: this.documentDate,
          taxApplyDate: this.taxApplyDate,
          subNo: this.subNo,
          billerNo: this.billerNo,
          department: this.department,
          taxrate: this.taxrate,
          valueBTax: this.valueBTax,
          includeVAT: this.priceWithTaxCOM,
          VAT: this.externalVAT,
          balance: 0,
        });
      }
      if (this.feeType == 1 || this.feeType == 2) {
        this.depositSerial.push({
          id: this.nextTodoId++,
          serialNo: this.serialNo,
          taxNo: this.taxNo,
          feeType: this.feeType,
          customerID: this.customerID,
          documentDate: this.documentDate,
          taxApplyDate: this.taxApplyDate,
          subNo: this.subNo,
          billerNo: this.billerNo,
          department: this.department,
          taxrate: this.taxrate,
          valueBTax: this.priceNonTaxCOM,
          includeVAT: this.includeVAT,
          VAT: this.internalVAT,
          balance: 0
        });
      }
    }
  },
  computed: {
    //ภาษีแยกนอก
    externalVAT() {
      return this.valueBTax * (this.taxrate / 100);
    },
    priceWithTaxCOM() {
      return this.valueBTax + this.externalVAT;
    },
    //ภาษีรวมใน
    internalVAT() {
      return this.includeVAT - this.priceNonTaxCOM;
    },
    priceNonTaxCOM() {
      return this.includeVAT - this.includeVAT * (this.taxrate / 100);
    }
  }
};
</script>

<style>
span,
label,
BToAinput,
h1,
p,
option,
select {
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
  padding: 2%;
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
</style>
