<template>
  <section class="section">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12">
        <filter-selection></filter-selection>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <meals></meals>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 d-flex margin-b-30">
        <stays></stays>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8">
        <grouped-stays-chart></grouped-stays-chart>
      </div>
      <div class="col-lg-4">
        <top-donations-stock></top-donations-stock>
      </div>
    </div>
  </section>
</template>

<script>
import FilterSelection from './dashboard/FilterSelection'
import GroupedStaysChart from './dashboard/GroupedStaysChart'
import TopDonationsStock from './dashboard/TopDonationsStock'
import Meals from './dashboard/Meals'
import Stays from './dashboard/Stays'

export default {
  name: "admin-dashboard",

  components: {
    'filter-selection': FilterSelection,
    'top-donations-stock': TopDonationsStock,
    'grouped-stays-chart': GroupedStaysChart,
    'meals': Meals,
    'stays': Stays,
  },


}
</script>

<style scoped>

</style>