<template>
  <div class="modal fade" id="mealModal" ref="mealModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Refeição</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="row">

            <div class="col-md-8 col-12">
             <div v-if="!editingMeal" class="form-group">
               <label for="day">Dia</label>
               <datepicker
                 id="day"
                 name="entry_date"
                 :language="$root.ptBr"
                 input-class="form-control"
                 wrapper-class="w-100"
                 format="dd/MM/yyyy"
                 :inline="true"
                 v-model="meal.day">
               </datepicker>
             </div>

              <div v-else class="form-group">
                <label for="day">Dia</label>
                <input id="day" type="text" :value="meal.day_formatted" class="form-control" disabled>
              </div>
            </div>

            <div class="col-md-4 col-12">

              <div class="form-group">
                <label for="breakfasts">Cafés da manhã</label>
                <input id="breakfasts" type="number" v-model="meal.breakfasts" min="0" class="form-control">
              </div>

              <div class="form-group">
                <label for="lunches">Almoços</label>
                <input id="lunches" type="number" v-model="meal.lunches" min="0" class="form-control">
              </div>

              <div class="form-group">
                <label for="dinners">Jantas</label>
                <input id="dinners" type="number" v-model="meal.dinners" min="0" class="form-control">
              </div>

            </div>

          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-success btn-block" @click="submitMeal">
            <i class="fas fa-check"></i>
            Salvar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "meal-modal",

    props: {
      storeUrl: String,
      updateUrl: String,
    },

    mounted() {
      this.$root.$on('createMeal', () => {
        this.resetMeal();
        $(this.$refs.mealModal).modal('toggle');
      });

      this.$root.$on('editMeal', (meal) => {
        this.meal = meal;

        $(this.$refs.mealModal).modal('toggle');
      })
    },

    computed: {
      editingMeal() {
        return !!_.get(this.meal, 'id');
      }
    },

    data() {
      return {
        meal: {
          breakfasts: 0,
          lunches: 0,
          dinners: 0,
          day: new Date(),
        },
      }
    },

    methods: {
      flashMessage(type, message) {
        this.$swal({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          type: type,
          title: message
        });
      },

      submitMeal() {
        if (this.editingMeal) {
          let mealData = this.formatBeforeSubmit();
          return axios.put(this.meal.links.edit, mealData)
            .then((response) => {
              this.flashMessage(response.data.type, response.data.message);

              this.resetMeal();
              this.$root.$emit('reload-data');
              $(this.$refs.mealModal).modal('toggle');
            });
        } else {
          const {day, breakfasts, lunches, dinners} = this.meal;
          return axios.post(this.storeUrl, {
            day: day.toLocaleDateString(),
            breakfasts,
            lunches,
            dinners
          })
            .then((response) => {
              this.flashMessage(response.data.type, response.data.message);
              this.resetMeal();
              this.$root.$emit('reload-data');
              $(this.$refs.mealModal).modal('toggle');
            })
            .catch((error) => {
              const requestErrors = _.get(error.response, 'data.errors');

              if (!requestErrors)
                this.flashMessage('error', 'Tivemos um problema ao cadastrar a refeição.');

              Object.values(requestErrors).map((errorField) => {
                this.flashMessage('error', errorField[0]);
              });
            });
        }
      },

      formatBeforeSubmit() {
        return {
          breakfasts: this.meal.breakfasts,
          lunches: this.meal.lunches,
          dinners: this.meal.dinners,
          day: this.meal.day_formatted,
        }
      },

      resetMeal() {
        this.meal = {
          breakfasts: 0,
          lunches: 0,
          dinners: 0,
          day: new Date(),
        };
      }
    }
  }
</script>

<style scoped>

</style>
