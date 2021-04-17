<template>
  <div class="card card-statistic-1 m-auto">
    <div class="card-icon bg-primary">
      <i class="fas fa-calendar-plus"></i>
    </div>
    <div class="card-wrap">
      <div class="card-header">
        <h4>Novas Estadias no período</h4>

      </div>
      <div class="card-body">
        {{ staysCount }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "stays",

  props: {
    staysCount: {
      type: Number,
    }
  }
}
</script>

<style scoped>
.margin-b-30 {
  margin-bottom: 30px !important;
}
</style>