<template>
  <div>
    <table class="table table-hover">
      <thead align="center">
        <tr>
          <th>ลำดับ</th>
          <th>เลขที่เอกสาร</th>
          <th>ชื่อลูกค้า</th>
        </tr>
      </thead>
      <tbody id="valuetable">
        <tr
          @click="selecct_doclist(val)"
          v-for="(val,index) in detailcusall"
          :key="index"
          style="text-align:center;cursor:pointer"
        >
          <td>{{index+1}}</td>
          <td>{{val.code}}</td>
          <td>{{val.name}}</td>
          <td>{{val.address}}</td>
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
        keyword:""
    },
    methods:{
      
    }
};
</script>
<style lang="">
</style>