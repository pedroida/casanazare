<template>
  <div class="card card-statistic-2">
    <div class="card-stats">
      <div class="card-stats-title text-center">
        Refeições
      </div>
      <div class="card-stats-items">
        <div class="card-stats-item">
          <div class="card-stats-item-count">{{ meals.breakfasts }}</div>
          <div class="card-stats-item-label">Cafés</div>
        </div>
        <div class="card-stats-item">
          <div class="card-stats-item-count">{{ meals.lunches }}</div>
          <div class="card-stats-item-label">Almoços</div>
        </div>
        <div class="card-stats-item">
          <div class="card-stats-item-count">{{ meals.dinners }}</div>
          <div class="card-stats-item-label">Jantas</div>
        </div>
      </div>
    </div>
    <div class="card-icon shadow-primary bg-primary">
      <i class="fas fa-utensils"></i>
    </div>
    <div class="card-wrap">
      <div class="card-header">
        <h4>Total no período</h4>
      </div>
      <div class="card-body">
        {{ meals.total }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "meals",

  props: {
    meals: {
      type: Object,
    }
  }
}
</script>

<style scoped>

</style>