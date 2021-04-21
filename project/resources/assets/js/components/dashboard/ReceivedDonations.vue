<template>
  <div class="card gradient-bottom">
    <div class="card-header">
      <h4>Doações recebidas ou atualizadas no período</h4>
    </div>
    <div class="card-body" id="top-5-scroll" tabindex="2" style="height: 315px; overflow: hidden; outline: none;">
      <ul v-if="donations.length" class="list-unstyled list-unstyled-border">
        <li v-for="(donation, index) in donations" :key="index" class="media">
          <i class="fas fa-hand-holding-heart mr-3 bg-primary rounded-circle p-3 text-white"></i>
          <div class="media-body">
            <div class="media-title">{{ donation.name }}</div>
            <div class="mt-1">
              <div class="budget-price">
                <div class="budget-price-label">{{ donation.category.name }}</div>
              </div>
              <div class="budget-price">
                <div class="budget-price-label">Estoque: {{ donation.quantity }} {{ donation.unit.name }}</div>
              </div>
            </div>
          </div>
        </li>
      </ul>

      <h5 v-else>
        Nenhum registro foi encontrado
      </h5>

    </div>
  </div>
</template>

<script>
export default {
  name: "received-donations",

  props: {
    donations: {
      type: Array,
    }
  }
}
</script>

<style scoped>
.margin-b-30 {
  margin-bottom: 30px !important;
}
</style>