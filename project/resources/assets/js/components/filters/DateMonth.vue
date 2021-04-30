<template>
  <div class="form-group">
    <label v-if="showLabel" for="filter_by_date">Filtrar por mês</label>
    <datepicker
      id="filter_by_date"
      :language="$root.ptBr"
      input-class="form-control"
      wrapper-class="w-100"
      :clear-button="true"
      clear-button-icon="fas fa-times"
      @input="dateSelected"
      minimumView="month"
      maximumView="year"
      :value="defaultValue"
      format="MM/yyyy">
    </datepicker>
  </div>
</template>

<script>
import filter from './FilterMixin';

export default {
  name: 'filter-date-month',

  mixins: [filter],

  props: {
    showLabel: {
      type: Boolean,
      default: true
    },
    defaultValue: {
      default: () => {
        return new Date()
      }
    }
  },

  data() {
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
  top: 1em;
  right: 20px;
}
</style>
