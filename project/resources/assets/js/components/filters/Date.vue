<template>
  <div class="form-group">
    <label for="filter_by_date">Filtrar por data</label>
    <datepicker
      id="filter_by_date"
      :language="$root.ptBr"
      input-class="form-control"
      wrapper-class="w-100"
      :clear-button="true"
      clear-button-icon="fas fa-times"
      @input="dateSelected"
      format="dd/MM/yyyy">
    </datepicker>
  </div>
</template>

<script>
  import filter from './FilterMixin';

  export default {
    name: 'filter-date',

    mixins: [filter],

    data: function () {
      return {
        payload: undefined,
      }
    },

    methods: {
      dateSelected(payload) {
        this.submit((payload) ? new Date(payload).toLocaleDateString('pt-BR') : undefined);
      },
    },
  }
  ;
</script>

<style>
  .vdp-datepicker__clear-button {
    position: absolute;
    top: 0;
    right: 20px;
  }
</style>
