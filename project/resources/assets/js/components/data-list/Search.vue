<template>
  <div v-if="showSearch" class="search-element">
    <input v-model="query" class="form-control" type="search" :placeholder="placeholder" aria-label="Search" data-width="250"
           style="width: 250px;">
  </div>
</template>

<script>
export default {
  name: "search",

  props: {
    placeholder: {
      type: String,
    }
  },

  mounted() {
    this.$root.$on('DataListPresent', () => this.showSearch = true)
  },

  watch: {
    query() {
      this.search()
    }
  },

  data() {
    return {
      query: '',
      showSearch: false,
    }
  },

  methods: {
    search() {
      this.$root.$emit('SearchTerm', this.query)
    }
  }
}
</script>

<style scoped>

</style>