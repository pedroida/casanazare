<template>
  <section class="section">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12">
        <filter-selection @filterChanged="getData"></filter-selection>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <meals :meals="meals"></meals>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 d-flex margin-b-30">
        <stays :stays-count="staysCount"></stays>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8">
        <grouped-stays-chart></grouped-stays-chart>
      </div>
      <div class="col-lg-4">
        <received-donations :donations="donations"></received-donations>
      </div>
    </div>
  </section>
</template>

<script>
import FilterSelection from './dashboard/FilterSelection'
import GroupedStaysChart from './dashboard/GroupedStaysChart'
import Meals from './dashboard/Meals'
import Stays from './dashboard/Stays'
import ReceivedDonations from "./dashboard/ReceivedDonations";

export default {
  name: "admin-dashboard",

  components: {
    ReceivedDonations,
    FilterSelection,
    GroupedStaysChart,
    Meals,
    Stays,
  },

  props: {
    getDataUrl: {
      type: String
    }
  },

  mounted() {
    this.getData()

    this.$on('filterChanged', (payload) => {
      this.getData()
    })
  },

  data() {
    return {
      meals: {},
      donations: [],
      staysCount: 0,
    }
  },

  methods: {
    async getData(params = {}) {
      let response = await axios.post(this.getDataUrl, {
        type: params.filterBy || 'month',
        date: params.date || new Date().toLocaleDateString()
      })

      if(response.data) {
        this.setData(response.data);
      }
    },

    setData(data) {
      this.meals = data.meals;
      this.donations = data.donations;
      this.staysCount = data.stays_count;
    }
  }
}
</script>

<style scoped>

</style>