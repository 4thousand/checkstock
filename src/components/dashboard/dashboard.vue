<template>
  <div class="index" style="background: #f4f5f7;">
    <div class="container">
    
      <!-- payloadreal -->

      <div class="row">
        <div class="col-lg-8 col-md-12 col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Graph</h4>
              <p class="card-text">Some example text.</p>
              <apexcharts width="100%" type="line" :options="chartOptions" :series="ser"></apexcharts>
            </div>
          </div>
        </div>
      <div class="col-lg-4 col-md-12 col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">รายการ Backlog</h4>
            <div v-for="val in dataall">
              <div @click="seedetail(val)" class="col-12 showhover" style="cursor: pointer;margin-bottom:10px">
                <md-toolbar class="md-transparent hoverdiv" style="display:block;padding-top:5px;overflow:hidden">
                  <div class="md-layout md-gutter md-alignment-center">
          
                    <div class="md-layout-item">
                      <div class="row">
                        <div class="col-2">
                          <md-avatar class="md-avatar-icon md-primary" :class="'active'+val.module.substring(0, 1)" style="margin:0;">{{ val.module.substring(0, 1) }}</md-avatar>
                        </div>
                        <div class="col-10">
                          <div class="row">
                            <div class="col-10">
                              <span class="md-title">{{val.doc_no}}</span>
                            </div>
                            <div class="col-2">
                              <md-icon v-show="val.is_confirm == 1" style="float:right;color:green">check_circle_outline</md-icon>
                              <md-icon v-show="val.is_cancel == 1" style="float:right;color:red;">cancel</md-icon>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <span style="position: relative;left: 8px;font-size: .875rem;color: #5f6368;" class="md-small-hide">
                                {{ ' ชื่อลูกค้า :' + val.ar_name}}
                              </span>
                              <span style="position: relative;left: 8px;font-size: .875rem;color: #5f6368;" class="md-small-hide">
                              {{' รวมมูลค่าสินค้าทั้งหมด : '+ convertToBaht(val.total_amount) +" บาท"}}
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                          <div class="col-12">
                            <!-- <div @click="val.total_amount = !val.total_amount" v-show="val.total_amount" style="float:right;" class=" starhover">
                              <md-icon>star_border</md-icon>
                            </div>
                            <div class="starhover" @click="val.total_amount = !val.total_amount" v-show="val.total_amount == false" style="float:right;color:red;">
                              <md-icon>star</md-icon>
                            </div> -->
                          </div>
                      </div>
                    </div>
                </md-toolbar>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
      <!-- ข้อมูลใบเสนอราคา -->
    </div>
    <md-speed-dial style="z-index:99" class="md-bottom-right">
      <md-speed-dial-target>
        <md-icon>add</md-icon>
      </md-speed-dial-target>
  
      <md-speed-dial-content>
        <md-button class="md-icon-button">
          <md-icon>folder</md-icon>
        </md-button>
        <md-button class="md-icon-button">
          <md-icon>folder</md-icon>
        </md-button>
        <md-button class="md-icon-button">
          <md-icon>event</md-icon>
        </md-button>
  
        <md-button class="md-icon-button">
          <md-icon>note</md-icon>
        </md-button>
      </md-speed-dial-content>
    </md-speed-dial>
  </div>
</template>
<script>
import api from "../../service/service.js";
import VueApexCharts from "vue-apexcharts";
export default {
  name: 'quotation',
  data () {
    return {
     msg:'',
     star:true,
     Search:'',
     sale_code:JSON.parse(localStorage.Datauser),
     dataall:[],
     keyword_showalldoc:'',
     chartOptions: {
        chart: {
          id: "vuechart-example"
        },
        xaxis: {
          categories: ["11-01-2018", 1992, 1993, 1994, 1995, 1996, 1997, 1998]
        }
      },
      ser: [
        {
          name: "series-1",
          data: [30.1, 40, 45, 50, 49, 60, 70, 91]
        },{
          name: "series-2",
          data: [32.1, 45, 34, 10, 4, 100, 700, 91]
        }
      ]
    }
  },
  methods: {
    changeColor () {
      alert('sadasd')
    },
    convertToBaht(val) {
      var result = numeral(val).format("0,0.00");
      // console.log(typeof result)
      return result;
    },
    seedetail(val){
        console.log(JSON.stringify(val))
        
        this.$router.push({ name : 'quotation', params : { id: val.id}});
    },
    showalldoc () {
        var payload = {
            sale_code : this.sale_code.sale_code,
            keyword: this.keyword_showalldoc
        }
        // v
        console.log(JSON.stringify(payload))
        api.showdocall(payload,
            (result) => {
            console.log(JSON.stringify(result.data))
               this.dataall = result.data
            },
            (error) => {
               console.log(JSON.stringify(error))
               alertify.error('Data ข้อมูลผิดพลาด');
              //  alertify.success('Error login');
              // this.cload()
            })
    },
  },
  mounted () {
      this.showalldoc()
    // console.log(JSON.stringify(this.payload))
  }
};
</script>
<style>


.md-speed-dial .md-button{
      margin: 4px;
}
  .container {
    padding: 5px 0;
  }
  
  .md-title {
    font-weight: 700;
    font-size: 1.075rem;
  }
  
  .datehover,
  .starhover {
    visibility: hidden;
    opacity: 0;
    transition: all 0.5s;
  }
  
  .showhover:hover .datehover,
  .showhover:hover .starhover {
    opacity: 1;
    visibility: visible;
  }
  
  .activeQ {
    background: #3d91ff !important;
  }
  
  .activeS {
    background: #64fc69 !important;
  }
  
  .activeB {
    background: #ff815a !important;
  }
  
  span,
  label,
  input,
  h4 {
    font-family: 'Kanit', sans-serif !important;
  }
  
  .hoverdiv {
    transition: all 1s;
  }

  @media screen and (max-width: 360px){
    .md-title{
      font-size: 14px;
    }
  }

  @media screen and (max-width: 330px){
    .md-title{
      font-size: 14px;
    }
  }

  @media screen and (max-width: 990px){
    .md-title{
      font-size: 16px;
    }
  }

  @media screen and (max-width: 1200px){
    .md-title{
      font-size: 14px;
    }
  }
  
  /* // .hoverdiv:hover {
  //   height: 200px !important;
  // } */
</style>