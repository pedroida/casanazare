import VueSweetalert2 from 'vue-sweetalert2';
import ptBr from 'vuejs-datepicker/src/locale/translations/pt-BR';

require('./bootstrap');
require('./commons');

window.Vue = require('vue');
require('@/components');

const app = new Vue({
  el: '#app',

  data() {
    return {
      ptBr: ptBr,
    }
  },
});

Vue.use(VueSweetalert2);