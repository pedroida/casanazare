<template>
  <div class="row">
    <template v-if="false">
      <div v-if="false" class="form-group col-md-6 col-sm-12" :class="{'is-invalid' : hasErrors('zip_code') }">
        <label class="col-form-label">
          CEP *
        </label>

        <input
            ref="zipCode"
            id="zipCode"
            type="text"
            :name="getFieldName('zip_code')"
            data-mask-cep
            :class="{'form-control-danger' : hasErrors('zip_code') }"
            class="form-control mask-cep">
        <div v-if="hasErrors('zip_code')" class="invalid-feedback">
          {{ this.getErrorMessage('zip_code') }}
        </div>
      </div>
      <div class="col-md-6 col-sm-12">
        <div class="form-group" :class="{'is-invalid' : hasErrors('street') }">
          <label class="col-form-label">
            Rua/Avenida *
          </label>

          <input
              type="text"

              :name="getFieldName('street')"
              class="form-control"
              :class="{'form-control-danger' : hasErrors('street') }"
              v-model="address.street">

          <div v-if="hasErrors('street')" class="invalid-feedback">
            {{ this.getErrorMessage('street') }}
          </div>
        </div>
      </div>
      <div class="col-md-2 col-sm-12">
        <div class="form-group" :class="{'is-invalid' : hasErrors('number') }">
          <label class="col-form-label">
            Número *
          </label>

          <input
              type="text"
              ref="addressNumber"
              :name="getFieldName('number')"

              class="form-control"
              :class="{'form-control-danger' : hasErrors('number') }"
              v-model="address.number">

          <div v-if="hasErrors('number')" class="invalid-feedback">
            {{ this.getErrorMessage('number') }}
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-12">
        <div class="form-group" :class="{'is-invalid' : hasErrors('district') }">
          <label class="col-form-label">
            Bairro *
          </label>

          <input
              type="text"

              :name="getFieldName('district')"
              class="form-control"
              :class="{'form-control-danger' : hasErrors('district') }"
              v-model="address.district">

          <div v-if="hasErrors('district')" class="invalid-feedback">
            {{ this.getErrorMessage('district') }}
          </div>
        </div>
      </div>
    </template>

    <div class="form-group floating-addon col-sm-6" :class="{'is-invalid' : hasErrors('state') }">
      <label>
        Estado <span class="text-danger ml-1">*</span>
      </label>

      <select
          :class="{'is-invalid' : hasErrors('state') }"
          class="form-control custom-select"
          v-model="stateSelected">
        <option v-for="state in states" :value="state.value">
          {{ state.text }}
        </option>
      </select>

      <div v-if="hasErrors('state')" class="invalid-feedback">
        {{ this.getErrorMessage('state') }}
      </div>
    </div>

    <div class="form-group floating-addon col-sm-6" :class="{'is-invalid' : hasErrors('city_id') }">
      <label>
        Cidade <span class="text-danger ml-1">*</span>
      </label>

      <select
          :name="getFieldName('city_id')"

          :class="{'is-invalid' : hasErrors('city_id') }"
          class="form-control custom-select"
          v-model="citySelected">
        <option v-for="city in cities" :value="city.value">
          {{ city.text }}
        </option>
      </select>

      <div v-if="hasErrors('city_id')" class="invalid-feedback">
        {{ this.getErrorMessage('city_id') }}
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "address-component",

    props: {
      edit: {
        required: false,
      },
      errorsBag: {
        required: true,
      },
      old: {
        required: true,
      },
      isRegistering: {
        type: Boolean,
        default: false,
      },

      resource: {
        default: [],
      },
      isAdmin: {
        type: Boolean,
      }
    },

    mounted() {
      let vm = this;
      let zipCode = this.$refs.zipCode;
      $(zipCode).val(this.getOld('zip_code'));
      $(zipCode).focus(function () {
        vm.address.zip_code = $(zipCode).val();
      });

      $(zipCode).on('keyup', (event) => {
        vm.address.zip_code = $(event.target).val();
      });
    },

    data() {
      return {
        prefix: undefined,
        states: [],
        stateSelected: null,
        citySelected: null,
        cities: [],
        address: {
          type: this.getOld('type'),
          street: this.getOld('street'),
          district: this.getOld('district'),
          city_id: this.getOld('city_id', 'city_id'),
          zip_code: this.getOld('zip_code'),
          number: this.getOld('number'),
          complement: this.getOld('complement'),
          state: this.getOld('state', 'city.state.abbr'),
        },
      }
    },

    created() {
      this.getStates().then(success => {
        this.states = success.data.map(element => {
          return {
            text: element.name,
            value: element.abbr,
          };
        });
      }).then(() => {
        if (this.address.state) {
          this.stateSelected = this.address.state;
        }
      });
    },

    watch: {
      stateSelected: function () {
        this.getCities().then(success => {
          this.cities = success.data.map(element => {
            return {
              text: element.name,
              value: element.id
            };
          });
        }).then(() => {
          if (this.address.city_id) {
            const city = this.cities.find(
              city => city.text === this.address.city_id || city.value === parseInt(this.address.city_id)
            );
            this.citySelected = (!!city) ? city.value : null;
          }
        });
      },

      'address.zip_code'() {
        this.getCEP();
      },
    },

    methods: {
      getOld(name, resourcePath) {
        let value = '';
        if (this.prefix) {
          if (this.old[this.prefix]) {
            value = this.old[this.prefix][name];
          }
        }

        value = (value == '') ? this.old[name] : value;

        if (!value && resourcePath)
          value = _.get(this.resource, resourcePath);

        return value;
      },

      getFieldPath(name) {
        if (!!(this.prefix))
          return `${this.prefix}.${name}`;

        return name;
      },

      getFieldName(name) {

        return name;
      },

      getErrorMessage(name) {
        name = this.getFieldPath(name);

        return this.errorsBag[name].toString();
      },

      hasErrors(name) {
        name = this.getFieldPath(name);

        return !!(this.errorsBag[name]);
      },

      getCEP() {
        if (this.address.zip_code && this.address.zip_code.length == 9) {
          this.getAddress(this.address.zip_code.replace('-', '')).then((success) => {
            let data = success.data;
            if (!data.error) {
              this.setAddress(data);
              this.$refs.addressNumber.focus();
            }
          }).catch((error) => {
          });
        }
      },

      setAddress(data) {
        this.address.street = data.logradouro;
        this.address.district = data.bairro;
        this.address.city_id = data.localidade;
        this.address.state = data.uf;

        this.stateSelected = data.uf;
      },

      getAddress(cep) {
        axios.defaults.headers.common = null;

        const url = window.location.origin;
        let protocol = 'http';

        if (url && url.match(/^https/)) {
          protocol = 'https';
        }

        return axios.get(`${protocol}://viacep.com.br/ws/${cep}/json/`, {
          transformRequest: [function (data, headers) {
            delete headers['X-Socket-Id'];
            return data;
          }]
        });
      },

      getStates() {
        const route = this.isAdmin ? '/admin/address/states' : '/voluntario/address/states';
        return axios.get(route);
      },

      getCities() {
        const route = this.isAdmin
          ? `/admin/address/${this.stateSelected}/cities`
          : `/voluntario/address/${this.stateSelected}/cities`;
        return axios.get(route);
      }
    }
  }
</script>
