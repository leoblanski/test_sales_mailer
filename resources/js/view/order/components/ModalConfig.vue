<template>
  <!-- Modal config -->
  <div
    class="modal fade"
    id="configModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="configModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="configModalLabel">Configuração Email</h5>
          <button
            type="button"
            class="close"
            data-bs-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formConfig" action="#">
          <div class="modal-body">
            <div class="mb-3">
              <label for="config_email" class="form-label">Email</label>
              <input
                type="email"
                required
                v-model="configForm.email"
                class="form-control"
                id="config_email"
                aria-describedby="emailHelp"
              />
            </div>
            <div class="mb-3">
              <label for="config_hour" class="form-label">Horário envio email</label>
              <input
                type="string"
                placeholder="00:00"
                required
                v-model="configForm.time"
                class="form-control"
                id="config_time"
              />
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Cancelar
            </button>
            <button
              type="button"
              class="btn btn-primary"
              v-on:click="this.updateConfig()"
            >
              Salvar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "Config",
  data() {
    return {
      loading: false,
      configForm: {
        email: "",
        time: "",
      },
    };
  },
  created() {
    this.getConfig();
  },
  methods: {
    getConfig() {
      this.loading = true;

      axios
        .get("/api/config/get")
        .then((res) => {
          this.configForm.email = res.data.config.email;
          this.configForm.time = res.data.config.time;
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
          this.loading = false;
        });
    },
    updateConfig() {
      this.loading = true;

      axios
        .post("/api/config/update", this.configForm)
        .then((res) => {
          if (res.data.status == "success") {
            alert("Configuração realizada com sucesso.");
          }
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
          this.loading = false;
        });
    }
  },
};

//Validação para travar envio formulário
$(document).ready(function () {
  var form = document.getElementById("formConfig");

  if (form) {
    document
      .getElementById("formConfig")
      .addEventListener("click", function (event) {
        event.preventDefault();
      });
  }
});
</script>