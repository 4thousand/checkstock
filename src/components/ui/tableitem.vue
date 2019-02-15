<template>
  <div style="width:100%">
    <md-card
      v-for="(val,index) in searched"
      :key="index"
      class="md-layout-item md-size-100 md-small-size-100"
    >
      <div class="tables" style="width:100%">
        <md-card-actions  style="width:100%">
          <md-button style="width:10%">{{val.item_code}}</md-button>
          <md-button style="width:20%;    height: auto; 
">
            <div
              style="width:100%;white-space: normal;word-wrap:  text-align-last: left; break-word;      text-align: left;  text-indent: 20px;display: inline-block;height:auto;"
            >{{val.item_name}}</div>
          </md-button>
           <md-button style="width:5%">
            <span>{{val.unit_code}}</span>
          </md-button>
          <md-button style="width:5%">
            <span>{{val.unit_code}}</span>
          </md-button>
          <md-button style="width:5%">
            <span>{{val.qty}}</span>
          </md-button>
          <md-button style="width:5%">
            <span>{{val.price}}</span>
          </md-button>
          <md-button style="width:5%">{{val.discount_word_sub}}</md-button>
          <md-button style="width:5%">{{val.amount}} บาท</md-button>
          <!-- <md-button style="min-width:5%;" @click="testtable(val)">
            <md-icon style="width: 5%;float: right;">edit</md-icon>
          </md-button> -->
          <md-button style="min-width: 5%" class="md-mini" @click="removeitemtable(index)">
            <md-icon style="width:5%;float: right;">delete</md-icon>
          </md-button>
        </md-card-actions>
      </div>
      <div class="tables2">
        <div class="carddiscount">{{val.discount_word_sub}}</div>
        <md-card-header style=" margin-top: 0px;    padding: 5px; width:60%;">
          <div class="md-title" style="    font-size: 15px;">{{val.item_code}}</div>
          <div class="md-subhead">{{val.item_name}}</div>
          <div class="md-subhead">จำนวน : {{val.qty}} {{val.unit_code}}</div>
        </md-card-header>
        <md-card-content style="padding:0px;width:40%;">
          <div style=" height: 100%;  float: right;padding-top:5px">
            <md-menu md-direction="bottom-end">
              <md-button
                class="md-icon-button"
                style="border-radius:0px;  height: 10%;"
                md-menu-trigger
              >
                <md-icon style="width: 50px;float: right;">more_horiz</md-icon>
              </md-button>
              <md-menu-content>
                <md-menu-item style="min-width: 30px;" @click="testtable(val)">
                  <md-icon style="width: 10px;float: right;">edit</md-icon>edit
                </md-menu-item>

                <md-menu-item @click="removeitemtable(index)" style="min-width: 30px;">
                  <md-icon style="width:10px;float: right;">delete</md-icon>delete
                </md-menu-item>
              </md-menu-content>
            </md-menu>
            <div style="text-align:center">
              {{val.amount}}
              <br>บาท
            </div>
          </div>
        </md-card-content>
      </div>
    </md-card>
  </div>
</template>


<script>
import { Money } from "v-money";

export default {
  name: "itemtable",
  props: {
    removeitemtable: Function,
    parentData: [],
    stringProp: [],
    searched: Array
  },
  data() {
    return {};
  },
  methods: {
    seedetail() {},
    showalldoc() {}
  },
  mounted() {}
};
</script>