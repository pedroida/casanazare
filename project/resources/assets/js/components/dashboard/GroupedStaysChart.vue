<template>
  <div class="card">
    <div class="card-header">
      <h4>Gráfico de estadias no período</h4>
    </div>
    <div class="card-body">
      <line-chart :chartdata="chartData" :options="chartOptions"></line-chart>
    </div>
  </div>
</template>

<script>
import LineChart from './LineChart'

export default {
  name: "grouped-stays-chart",

  components: {
    'line-chart': LineChart
  },

  mounted() {

  },

  data() {
    return {
      chartOptions: {
        responsive: true,
      },

      chartData: {
        labels: [this.getRandomInt(), this.getRandomInt()],
        datasets: [
          {
            label: 'Data One',
            backgroundColor: '#f87979',
            data: [5, 10]
          }, {
            label: 'Data two',
            backgroundColor: 'red',
            data: [8, 12]
          }
        ]
      }
    }
  },

  methods: {
    getRandomInt () {
      return Math.floor(Math.random() * (50 - 5 + 1)) + 5
    }
  }
}
</script>

<style scoped>
.margin-b-30 {
  margin-bottom: 30px !important;
}
</style>