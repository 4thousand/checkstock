<template>
  <div>
    <div class="md-size-5 md-small-size-5" style="margin-left:-15px;margin-right:35px">
      <md-button @click="HisCustomer(searchcus)" class="md-icon-button md-raised md productadd">
        <md-icon>history</md-icon>
      </md-button>
    </div>
    <div>
      <md-dialog :md-active.sync="showDialogHisCus">
        <md-dialog-title>ประวัติการวางบิล</md-dialog-title>
        <md-tabs id="none" md-dynamic-height>
          <md-tab md-label>
            <md-field>
              <h5>
                <span>{{searchcus}}</span>
              </h5>
            </md-field>
            <div class="table-responsive" style="overflow-y: auto;">
              <table class="table table-hover">
                <thead align="center">
                  <tr>
                    <th style="white-space: nowrap;">ลำดับ</th>
                    <th style="overflow:auto;white-space: nowrap;">วันที่เอกสาร</th>
                    <th style="white-space: nowrap;">เลขที่เอกสาร</th>
                    <th style="white-space: nowrap;">พนักงานขาย</th>
                    <th style="white-space: nowrap;">มูลค่าทั้งหมด</th>
                  </tr>
                </thead>
                <tbody v-for="(val,index) in datahiscustomer" :key="index" id>
                  <tr style="text-align:center;cursor:pointer">
                    <td>{{index+1}}</td>
                    <td v-if="typepage==='invoice'">{{val.doc_date}}</td>
                    <td v-if="typepage==='invoice'">{{val.doc_no}}</td>
                    <td v-if="typepage==='invoice'">{{val.sale_name}}</td>
                    <td v-if="typepage==='invoice'">{{val.total_amount}}</td>

                    <td v-if="typepage==='quotation'">{{val.DocDate}}</td>
                    <td v-if="typepage==='quotation'">{{val.DocNo}}</td>
                    <td v-if="typepage==='quotation'">{{val.SaleName}}</td>
                    <td v-if="typepage==='quotation'">{{val.TotalAmount}}</td>

                    <td v-if="typepage==='saleorder'">{{val.DocDate}}</td>
                    <td v-if="typepage==='saleorder'">{{val.DocNo}}</td>
                    <td v-if="typepage==='saleorder'">{{val.SaleName}}</td>
                    <td v-if="typepage==='saleorder'">{{val.TotalAmount}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </md-tab>
        </md-tabs>

        <md-dialog-actions>
          <md-button class="md-primary" @click="showDialogHisCus = false">Close</md-button>
          <!-- <md-button class="md-primary" @click="showDialogcus = false">Save</md-button> -->
        </md-dialog-actions>
      </md-dialog>
    </div>
  </div>
</template>

<script>
  import Vue from "vue";
  import api from "../../service/service.js";
  import {
    Money
  } from "v-money";
  import {
    isLong
  } from 'long';
  export default {
    name: "searchhiscustomer",
    props: {
      typepage: "",
      searchcus: ""
    },
    data() {
      return {
        isLoading: false,
        datahiscustomer: [],
        showDialogHisCus: false,
      };
    },
    methods: {
      HisCustomer(searchcus) {
        console.log(searchcus);
        console.log(this.typepage);
        let payload = {
          ar_code: searchcus,
          page: this.typepage
        };
        this.isLoading = true;
        console.log(payload);
        api.searchHisCustomer(
          payload,
          result => {
            this.isLoading = false;
            console.log(result.data);
            console.log(result.data.length);
            this.showDialogHisCus = true;
            this.datahiscustomer = result.data;
          },
          error => {
            this.isLoading = false;
            console.log(JSON.stringify("มันเสียนะ", error));
            alertify.error("ข้อผิดพลาด");
          }
        );
      }
    },
    mounted() {}
  };
</script>
