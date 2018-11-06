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
                                            <button class="btn btn-primary icon-margin">
                                                <md-icon>search</md-icon>
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
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">เลขที่ใบกำกับภาษี:</p>
                                        <div class="col-7">
                                            <input type="number" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">ประเภทภาษี:</p>
                                        <div class="col-7">
                                            <select class="form-control">
                                                <option value="1">ภาษีแยกนอก</option>
                                                <option value="2">ภาษีรวมใน</option>
                                                <option value="3">ภาษีอัตราศูนย์</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">รหัสลูกค้า:</p>
                                        <div class="col-7">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">วันที่ออกเอกสาร:</p>
                                        <div class="col-7">
                                            <input type="date" v-model="date" @change="checkdate" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">วันที่ใบกำกับภาษี:</p>
                                        <div class="col-7">
                                            <input type="date" v-model="date" @change="checkdate" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">ชื่อในการออกบิล:</p>
                                        <div class="col-7">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">ที่อยู่ในการออกบิล:</p>
                                        <div class="col-7">
                                            <textarea class="form-control" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">เลขที่ใบจอง:</p>
                                        <div class="col-7">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">รหัสพนักงานขาย:</p>
                                        <div class="col-7">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row information-part">
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">แผนก:</p>
                                        <div class="col-7">
                                            <input class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group row">
                                        <p class="article-set col-4">วันที่ส่งของ:</p>
                                        <div class="col-7">
                                            <input type="date" class="form-control">
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
                                        <!-- <input type="number" class="form-control tax-head" v-model="taxrate"> -->
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p class="tax-head">จำนวนเงินก่อนภาษี {{ convertToBaht(valueBTax) }} บาท</p>
                                        <!-- <input type="number" class="form-control tax-head" v-model.number="valueBTax"> -->
                                        <!-- <button @click="calltestapi" class="btn btn-primary" >คำนวณ</button> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p class="tax-head">ภาษีมูลค่าเพิ่ม {{ convertToBaht(VAT) }} บาท</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p class="tax-summary">มูลค่ารวมภาษี {{ convertToBaht(includeVAT) }} บาท</p>
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
                                <button class="btn btn-primary"><span>บันทึก</span></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="searchModal">
                    <div class="modal-dialog modal-lg">
    
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">ค้นหาเลขที่ใบมัดจำ</h4>
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
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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
      taxrate: 7.0,
      valueBTax: 100.0,
      balance: 0,
      click: false,
      username: "",
      company: "",
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
      ]
    };
  },
  methods: {
    checkdate() {
      alert(this.date);
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
      alert(this.depositSerial[e-1].serialNo);
    }
  },
  computed: {
    VAT() {
      return this.valueBTax * (this.taxrate / 100);
    },
    includeVAT() {
      return this.valueBTax + this.VAT;
    }
  }
};
</script>

<style>
span,
  label,
  input,
  h1,p {
    font-family: "Kanit", sans-serif !important;
  }
.big-margin {
  margin-top: 4%;
}
.deposit-border {
  border-color: #448aff;
  padding: 0% 2%;
}
.deposit-header {
  margin-bottom: 5%;
  background-color: #448aff;
  color: aliceblue;
  text-align: left;
  font-size: 24px;
}
.icon-margin {
  padding: 2%;
}
.tax-header {
  margin-bottom: 2.5%;
  background-color: #448aff;
  color: aliceblue;
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
.search-icon{
    color: aliceblue;
}
.md-icon-font{
    color: aliceblue !important;
}
</style>
