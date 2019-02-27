<template>
  <div>
    <table class="table table-hover">
      <thead align="center">
        <tr style="text-align:center;cursor:pointer">
          <td>ลำดับ</td>
          <td>เลขที่เอกสาร</td>
          <td>ชื่อลูกค้า</td>
        </tr>
      </thead>
      <tbody id="valuetable">
        <tr
          @click="check(),$emit('selectQTdialogP','selectQTdialog')"
          v-for="(val,index) in collectQT"
          :key="index"
          style="text-align:center;cursor:pointer"
        >
          <td>{{index+1}}</td>
          <td>{{val.doc_no}}</td>
          <td>{{val.ar_name}}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import Vue from "vue";
import api from "../../service/service.js";
export default {
    name: "transferQT",
    props:{
      collectQT:[],
      callQTtoSO:Function,
      selectQTdialogP:''
    },
    methods:{
      check(){
        console.log(JSON.stringify(this.selectQTdialogP))
      }
    },
    mounted(){
      this.check()
      this.selectQTdialogP=false
    }
};
</script>
<style lang="">
</style>