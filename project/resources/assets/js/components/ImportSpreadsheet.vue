<template>
  <div>
    <a
      @click="showModal"
      class="btn btn-primary" href="#">
      <i class="fas fa-plus fa-fw"></i>
      {{ buttonLabel }}
    </a>

    <import-spreadsheet-modal
      :inputLabel="inputLabel"
      :modal-identifier="modalIdentifier"
      :export-default-url="exportDefaultUrl"
      :post-url="postUrl"/>
  </div>
</template>

<script>
import ImportSpreadsheetModal from "./ImportSpreadsheetModal";

export default {
  name: "import-spreadsheet",

  components: {ImportSpreadsheetModal},

  props: {
    buttonLabel: {
      type: String,
    },
    inputLabel: {
      type: String,
    },
    postUrl: {
      type: String,
    },
    exportDefaultUrl: {
      type: String,
    }
  },

  data() {
    return {
      modalIdentifier: 'import-spreadsheet-modal',
    }
  },

  methods: {
    showModal() {
      $('#' + this.modalIdentifier).appendTo("body").modal('show')
    }
  }
}
</script>

<style scoped>

</style>