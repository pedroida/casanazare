<script>
  import filter from './FilterMixin';
  import VSelect from 'vue-select';

  export default {
    name: 'filter-select',
    extends: VSelect,

    mixins: [filter],

    data: function() {
      return {
        payload: undefined,
      }
    },

    mounted() {
      this.$on('input', function(payload) {
        if (payload) {
          if (payload.length > 1) {
            let values = payload.map(item => item.id ? item.id : item.value);
            this.submit(values.join(','));
          } else {
            payload = payload[0] ? payload[0] : payload;
            let submit = (payload.value || payload.value === null) ? payload.value : payload;
            if (submit !== null && submit.hasOwnProperty('id')) {
              this.submit(submit.id);
            }
            else {
              this.submit(submit);
            }
          }
        } else {
          this.submit();
        }
      });
    },
  };
</script>
