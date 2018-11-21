<template>
    <div>
        <div class="container">
            <div class="col-md-12">
                <h1>
                    Dashboard
                </h1>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Graph</h4>
                        <p class="card-text">Some example text.</p>
                        <a href="#" class="btn btn-primary">See Profile</a>
                    </div>
                </div>
            </div>
            <div>
                <apexcharts width="100%" type="line" :options="chartOptions" :series="ser"></apexcharts>
            </div>
        </div>
    </div>
</template>
<script>
import VueApexCharts from "vue-apexcharts";
export default {
  data() {
    return {
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
    };
  },
  components: {
    apexcharts: VueApexCharts
  }
};
</script>
<style>
</style>