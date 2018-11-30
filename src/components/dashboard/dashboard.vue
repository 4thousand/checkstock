<template>
  <div class="index" style="background: #f4f5f7;">
    <div>
      <!-- payloadreal -->
      <div class="row">
        <div class="col-xl-8 col-lg-12 col-md-12 col-12">
          <div class="col-md-12 col-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">ยอดขาย</h4>
                <p class="card-text">เปรียบเทียบยอดขายสินค้ารายปี</p>
                <div id="wrapper">
                  <div id="chart-line">
                    <apexchart
                      type="line"
                      height="160"
                      :options="chartOptionsLine1"
                      :series="series1"
                    />
                  </div>

                  <div id="chart-line2">
                    <apexchart
                      type="line"
                      height="160"
                      :options="chartOptionsLine2"
                      :series="series2"
                    />
                  </div>

                  <div id="chart-area">
                    <apexchart
                      type="area"
                      height="160"
                      :options="chartOptionsArea"
                      :series="series3"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">ยอดขาย</h4>
                <p class="card-text">Some example text.</p>
                <div>
                  <apexchart type="radialBar" height="300" :options="chartOptions" :series="sere"/>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-12 col-md-12 col-12">
          <div class="col-md-12 col-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">รายการ Backlog</h4>
                <div v-for="val in dataall">
                  <div
                    @click="seedetail(val)"
                    class="col-12 showhover"
                    style="cursor: pointer;margin-bottom:10px"
                  >
                    <md-toolbar
                      class="md-transparent hoverdiv"
                      style="display:block;padding-top:5px;overflow:hidden"
                    >
                      <div class="md-layout md-gutter md-alignment-center">
                        <div class="md-layout-item">
                          <div class="row">
                            <div class="col-2">
                              <md-avatar
                                class="md-avatar-icon md-primary"
                                :class="'active'+val.module.substring(0, 1)"
                                style="margin:0;"
                              >{{ val.module.substring(0, 1) }}</md-avatar>
                            </div>
                            <div class="col-10">
                              <div class="row">
                                <div class="col-10">
                                  <span class="bl-title">{{val.doc_no}}</span>
                                </div>
                                <div class="col-2">
                                  <md-icon
                                    v-show="val.is_confirm == 1"
                                    style="float:right;color:green"
                                  >check_circle_outline</md-icon>
                                  <md-icon
                                    v-show="val.is_cancel == 1"
                                    style="float:right;color:red;"
                                  >cancel</md-icon>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-12">
                                  <span
                                    style="position: relative;left: 8px;font-size: .875rem;color: #5f6368;"
                                    class="md-small-hide"
                                  >{{ ' ชื่อลูกค้า :' + val.ar_name}}</span>
                                  <span
                                    style="position: relative;left: 8px;font-size: .875rem;color: #5f6368;"
                                    class="md-small-hide"
                                  >{{' รวมมูลค่าสินค้าทั้งหมด : '+ convertToBaht(val.total_amount) +" บาท"}}</span>
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
                            </div>-->
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

function generateDayWiseTimeSeries(baseval, count, yrange) {
  var i = 0;
  var series = [];
  while (i < count) {
    var x = baseval;
    var y =
      Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

    series.push([x, y]);
    baseval += 86400000;
    i++;
  }
  return series;
}

Apex = {
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: "straight"
  },
  toolbar: {
    tools: {
      selection: false
    }
  },
  markers: {
    size: 6,
    hover: {
      size: 10
    }
  },
  tooltip: {
    followCursor: false,
    theme: "dark",
    x: {
      show: false
    },
    marker: {
      show: false
    },
    y: {
      title: {
        formatter: function() {
          return "";
        }
      }
    }
  },
  grid: {
    clipMarkers: false
  },
  yaxis: {
    tickAmount: 2
  },
  xaxis: {
    type: "datetime"
  }
};

export default {
  name: "quotation",
  data() {
    return {
      msg: "",
      star: true,
      Search: "",
      sale_code: JSON.parse(localStorage.Datauser),
      dataall: [],
      keyword_showalldoc: "",

      //  chartOptions: {
      //     chart: {
      //       id: "vuechart-example"
      //     },
      //     xaxis: {
      //       categories: ["11-01-2018", 1992, 1993, 1994, 1995, 1996, 1997, 1998]
      //     }
      //   },
      sere: [30, 40, 45, 50],
      series: [44, 55, 67, 83],
      chartOptions: {
        plotOptions: {
          radialBar: {
            dataLabels: {
              name: {
                fontSize: "22px"
              },
              value: {
                fontSize: "16px"
              },
              total: {
                show: true,
                label: "ยอดขาย",
                formatter: function(w) {
                  // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                  return 249;
                }
              }
            }
          }
        }
      },
      series1: [
        {
          data: generateDayWiseTimeSeries(
            new Date("11 Feb 2017").getTime(),
            20,
            {
              min: 10,
              max: 60
            }
          )
        }
      ],
      series2: [
        {
          data: generateDayWiseTimeSeries(
            new Date("11 Feb 2017").getTime(),
            20,
            {
              min: 10,
              max: 30
            }
          )
        }
      ],
      series3: [
        {
          data: generateDayWiseTimeSeries(
            new Date("11 Feb 2017").getTime(),
            20,
            {
              min: 10,
              max: 90
            }
          )
        }
      ],
      chartOptionsLine1: {
        chart: {
          id: "fb",
          group: "social"
        },
        colors: ["#008FFB"]
      },
      chartOptionsLine2: {
        chart: {
          id: "tw",
          group: "social"
        },
        colors: ["#546E7A"]
      },
      chartOptionsArea: {
        chart: {
          id: "yt",
          group: "social"
        },
        colors: ["#00E396"]
      }
    };
  },
  methods: {
    changeColor() {
      alert("sadasd");
    },
    convertToBaht(val) {
      var result = numeral(val).format("0,0.00");
      // console.log(typeof result)
      return result;
    },
    seedetail(val) {
      console.log(JSON.stringify(val));

      this.$router.push({ name: "quotation", params: { id: val.id } });
    },
    showalldoc() {
      var payload = {
        sale_code: this.sale_code.sale_code,
        keyword: this.keyword_showalldoc
      };
      // v
      console.log(JSON.stringify(payload));
      api.showdocall(
        payload,
        result => {
          console.log(JSON.stringify(result.data));
          this.dataall = result.data;
        },
        error => {
          console.log(JSON.stringify(error));
          alertify.error("Data ข้อมูลผิดพลาด");
          //  alertify.success('Error login');
          // this.cload()
        }
      );
    }
  },
  components: {
    apexchart: VueApexCharts
  },
  mounted() {
    this.showalldoc();
    // console.log(JSON.stringify(this.payload))
  }
};
</script>
<style>
.md-speed-dial .md-button {
  margin: 4px;
}
.container {
  padding: 5px 0;
}

.bl-title {
  font-weight: 700;
  font-size: 0.85rem !important;
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
  font-family: "Kanit", sans-serif !important;
}

.hoverdiv {
  transition: all 1s;
}

@media screen and (max-width: 360px) {
  .bl-title {
    font-size: 14px;
  }
}

@media screen and (max-width: 330px) {
  .bl-title {
    font-size: 14px;
  }
}

@media screen and (max-width: 990px) {
  .bl-title {
    font-size: 16px;
  }
}

@media screen and (max-width: 1200px) {
  .md-title {
    font-size: 14px;
  }
}

/* // .hoverdiv:hover {
  //   height: 200px !important;
  // } */
</style>