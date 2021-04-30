<template>
  <div class="card">
    <div class="card-header">
      <h4>Gráfico de estadias no período</h4>
    </div>
    <div class="card-body">
      <canvas id="grouped-stays-chart" width="400" height="400"></canvas>
    </div>
  </div>
</template>

<script>
const Chart = require('chart.js');

export default {
  name: "grouped-stays-chart",

  props: {
    graphicData: {
      type: Object,
    }
  },

  mounted() {
    this.createChart()
  },

  watch: {
    graphicData() {
      this.updateData(this.chart);
    }
  },

  data() {
    return {
      chart: null,
    }
  },

  methods: {
    updateData(chart) {
      chart.data.labels = this.graphicData.labels;
      chart.data.datasets[0].data = this.graphicData.data;
      chart.data.datasets[0].backgroundColor = this.graphicData.colors;
      chart.data.datasets[0].borderColor = this.graphicData.borderColors;

      this.chart.update();
    },

    createChart() {
      this.chart = new Chart(document.getElementById('grouped-stays-chart'), {
        type: 'bar',
        data: {
          labels: this.graphicData.labels,
          datasets: [{
            label: 'Novas estadias',
            data: this.graphicData.data,
            backgroundColor: this.graphicData.colors,
            borderColor: this.graphicData.borderColors,
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              display: true,
              ticks: {
                beginAtZero: true,
                min: 0
              }
            }]
          }
        }
      })
    }
  }
}
</script>

<style scoped>
.margin-b-30 {
  margin-bottom: 30px !important;
}
</style>