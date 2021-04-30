<template>
  <div class="card card-statistic-2">
    <div class="card-stats">
      <div class="card-stats-item filter-by">
        <div class="form-group">
          <label class="card-stats-item-label">Filtrar por: </label>
          <div class="selectgroup w-100">
            <label v-for="(option, index) in filterByOption" :key="index" class="selectgroup-item">
              <input type="radio" name="value" :value="option.value" v-model="filterBy" class="selectgroup-input">
              <span class="selectgroup-button">{{ option.label }}</span>
            </label>
          </div>
        </div>
      </div>

      <div v-show="filterBy === 'month'" class="card-stats-title pt-0">
        Selecionar mês
        <filter-date-month url-key="month" :show-label="false"></filter-date-month>
      </div>

      <div v-show="filterBy === 'year'" class="card-stats-title pt-0">
        Selecionar ano
        <filter-date-year url-key="year" :show-label="false"></filter-date-year>
      </div>
    </div>
  </div>
</template>

<script>

import DateMonth from '../filters/DateMonth'
import DateYear from '../filters/DateYear'
import dayjs from 'dayjs'

export default {
  name: "filter-selection",

  components: {
    'filter-date-month': DateMonth,
    'filter-date-year': DateYear
  },

  mounted() {
    this.$on('setFilter', (payload) => {
      this.selectedDate = payload.value
      this.filterBy = payload.urlKey

      this.updateData()
    })
  },

  watch: {
    filterBy(filter) {
      this.updateData();
    }
  },

  computed: {
    filterByOption() {
      return [
        {label: 'Mês', value: 'month'},
        {label: 'Ano', value: 'year'},
      ]
    }
  },

  data() {
    return {
      filterBy: 'month',
      selectedDate: new Date().toLocaleDateString(),
    }
  },

  methods: {
    updateData() {
      if (this.selectedDate)
        this.$emit('filterChanged', {
          filterBy: this.filterBy,
          date: this.selectedDate
        })
    }
  }
}
</script>

<style scoped>
.card .card-stats .card-stats-item.filter-by {
  width: 100%;
}
</style>