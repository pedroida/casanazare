<template>
  <div class="modal fade" tabindex="-1" role="dialog" :id="modalIdentifier" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <form method="POST" :action="postUrl" id="import-spreadsheet-form" enctype="multipart/form-data">
            <input type="hidden" name="_token" :value="csrf">
            <div class="custom-file">
              <input name="file" type="file" accept=".xlsx,.xls" class="custom-file-input" id="import-spreadsheet-input">
              <label class="custom-file-label" for="import-spreadsheet-input">Selecione a planilha</label>
            </div>
          </form>
        </div>

        <div class="modal-footer bg-whitesmoke br justify-content-between">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <a :href="exportDefaultUrl" type="button" class="btn btn-info text-white">Exportar exemplo</a>
          <button form="import-spreadsheet-form" type="submit" class="btn btn-primary">Importar</button>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "import-spreadsheet-modal",

  props: {
    inputLabel: {
      type: String,
    },
    modalIdentifier: {
      type: String,
      default: () => 'import-spreadsheet-modal'
    },
    postUrl: {
      type: String,
    },
    exportDefaultUrl: {
      type: String,
    }
  },

  computed: {
    csrf() {
      return $('meta[name="csrf-token"]').attr('content');
    }
  }
}
</script>

<style scoped>
</style>