<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="form-group row col-12" style="margin-top:10px">
            <select v-model="selectSheet" style="margin-right:10px">
              <option value="1">
                <span>ส่งข้อความลูกค้า</span>
              </option>
            </select>
            <button class="btn btn-danger" @click="directlink">
              <span>แก้ไขข้อมูล</span>
            </button>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">ชื่อ-สกุล</th>
                <th scope="col">เบอร์โทร</th>
                <th scope="col">แต้ม</th>
                <th scope="col">เลือก</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(val,index) in infoData" :key="index">
                <td>{{ val.name }}</td>
                <td>{{ val.tel }}</td>
                <td>{{ val.point }}</td>
                <td>
                  <input type="checkbox" v-model="val.checkSelect">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group row">
            <div class="col-md-12" style="margin-top:20px">
              <textarea
                outline
                name="message"
                label="ข้อความที่จะส่ง"
                class="form-control"
                v-model="SMSMessage"
                maxlength="120"
              ></textarea>
              {{SMSMessage.length+"/120"}}
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12" style="margin-bottom:10px">
          <button
            class="btn btn-success float-right"
            @click="sendSMS()"
            :disabled="SMSMessage==''||chSearchTel==false"
          >
            <span>ส่ง SMS</span>
          </button>
          <button class="btn btn-warning float-right" style="margin-right:10px" @click="getTel()">
            <span>ดึงข้อมูลลูกค้า SMS</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import smsApi from "../../service/service.js";
export default {
  data() {
    return {
      selectSheet: 1,
      infoData: [],
      checkSelect: true,
      chSearchTel: false,
      SMSMessage: ""
    };
  },
  methods: {
    directlink() {
      if (this.selectSheet == 1) {
        return window.open(
          "https://docs.google.com/spreadsheets/d/1s02Z4FYHaPmsbMwpbsKfVLffHV0tqlzascprsyQe2Z8/edit#gid=0",
          "_blank"
        );
      }
    },
    getTel() {
      smsApi.callTel(
        result => {
          console.log(JSON.stringify(result));
          this.infoData = result;
          this.chSearchTel = true;
        },
        error => {
          console.log(JSON.stringify(error));
        }
      );
    },
    checkTel() {
      console.log(this.infoData);
      console.log(JSON.stringify(this.infoData[0].tel));
      console.log(JSON.stringify(this.infoData.length));
    },
    sendSMS() {
      console.log("test");
      for (let i = 0; i < this.infoData.length; i++) {
        let message = "";
        let word = this.SMSMessage.split("$");
        for (let n = 0; n < word.length; n++) {
          if (word[n] == "name") {
            word[n] = this.infoData[i].name;
          } else if (word[n] == "point") {
            word[n] = this.infoData[i].point;
          }
          message += word[n];
        }
        if (
          this.infoData[i].checkSelect == true ||
          this.infoData[i].checkSelect == "TRUE"
        ) {
          let payload = {
            to: this.infoData[i].tel,
            from: "Nopadol",
            text: message,
            apiKey: "b6c39957-75c1-4234-9fab-f7576bcf24ee",
            apiSecret: "44e49e15-01d4-483e-ab46-358d991cb15a"
          };
          smsApi.sendSMS(
            payload,
            result => {
              console.log(JSON.stringify(result));
            },
            error => {
              console.log(JSON.stringify(error));
            }
          );
        }
      }
    }
  },
  mounted() {
    // this.getTel();
  }
};
</script>
<style>
span,
option {
  font-family: "Kanit", sans-serif;
}
</style>
