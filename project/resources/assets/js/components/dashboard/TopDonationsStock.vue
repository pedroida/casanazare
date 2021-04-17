<template>
  <div class="card gradient-bottom">
    <div class="card-header">
      <h4>Top 5 Doações em estoque</h4>
    </div>
    <div class="card-body" id="top-5-scroll" tabindex="2" style="height: 315px; overflow: hidden; outline: none;">
      <ul class="list-unstyled list-unstyled-border">
        <li class="media">
          <i class="fas fa-utensils mr-3 bg-primary rounded-circle p-3 text-white"></i>
          <div class="media-body">
            <div class="media-title">Nome do item</div>
            <div class="mt-1">
              <div class="budget-price">
                <div class="budget-price-label">Categoria</div>
              </div>
              <div class="budget-price">
                <div class="budget-price-label">Unidade</div>
              </div>
            </div>
          </div>
        </li>
        <li class="media">
          <i class="fas fa-utensils mr-3 bg-primary rounded-circle p-3 text-white"></i>
          <div class="media-body">
            <div class="media-title">Nome do item</div>
            <div class="mt-1">
              <div class="budget-price">
                <div class="budget-price-label">Categoria</div>
              </div>
              <div class="budget-price">
                <div class="budget-price-label">Unidade</div>
              </div>
            </div>
          </div>
        </li>
        <li class="media">
          <i class="fas fa-utensils mr-3 bg-primary rounded-circle p-3 text-white"></i>
          <div class="media-body">
            <div class="media-title">Nome do item</div>
            <div class="mt-1">
              <div class="budget-price">
                <div class="budget-price-label">Categoria</div>
              </div>
              <div class="budget-price">
                <div class="budget-price-label">Unidade</div>
              </div>
            </div>
          </div>
        </li><li class="media">
        <i class="fas fa-utensils mr-3 bg-primary rounded-circle p-3 text-white"></i>
        <div class="media-body">
          <div class="media-title">Nome do item</div>
          <div class="mt-1">
            <div class="budget-price">
              <div class="budget-price-label">Categoria</div>
            </div>
            <div class="budget-price">
              <div class="budget-price-label">Unidade</div>
            </div>
          </div>
        </div>
      </li>

      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: "stays"
}
</script>

<style scoped>
.margin-b-30 {
  margin-bottom: 30px !important;
}
</style>