<template>
  <loader v-if="this.loading"></loader>
  <div class="mt-3">
    <div class="row no-gutters d-flex">
      <h5 class="mr-auto bt-1 mb-1">Vendas ({{ orders.length }})</h5>
      <button
        class="btn btn-sm btn-default mt-1 mb-1 mr-2"
        title="Filtros"
        v-on:click="this.openModalFilters()"
      >
        <i class="bi bi-filter-square-fill"></i>
      </button>
      <button
        class="btn btn-sm btn-default mt-1 mb-1 mr-2"
        title="Configurações"
        v-on:click="this.openModalSettings()"
      >
        <i class="bi bi-gear-fill"></i>
      </button>
      <button
        class="btn btn-sm btn-success mt-1 mb-1"
        v-on:click="this.openModalCreateOrder()"
      >
        Nova venda
      </button>
    </div>
    <div>
      <table class="table table-striped">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Código</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Valor Venda</th>
            <th scope="col">Valor Comissão</th>
            <th scope="col">Data</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="order in orders" :key="order.id">
            <th scope="row">{{ order.id }}</th>
            <td>{{ order.employee_name }}</td>
            <td>{{ order.employee_email }}</td>
            <td>R$ {{ this.formatMoney(order.amount) }}</td>
            <td>R$ {{ this.formatMoney(order.commission_amount) }}</td>
            <td>{{ order.order_date }}</td>
          </tr>
        </tbody>
        <tfoot v-if="orders.length > 0">
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th>R$ {{ this.formatMoney(this.totalAmount) }}</th>
            <th>R$ {{ this.formatMoney(this.totalComission) }}</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  <!-- Modal Nova Venda -->
  <div
    class="modal fade"
    id="orderModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="orderModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="orderModalLabel">Registrar nova venda</h5>
          <button
            type="button"
            class="close"
            data-bs-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formOrder" action="#">
          <div class="modal-body">
            <div class="mb-2">
              <label for="employee_id" class="form-label"
                >Vendedor:&nbsp;</label
              >
              <select
                class="form-select form-select-lg"
                required
                v-model="newOrder.employee_id"
                aria-label="Default select example"
              >
                <option
                  v-for="employee in employees"
                  :key="employee.id"
                  :value="employee.id"
                >
                  {{ employee.name }}
                </option>
              </select>
            </div>
            <div class="mb-3">
              <label for="amount" class="form-label">Total da venda</label>
              <input
                type="text"
                required
                v-model="newOrder.amount"
                v-on:keyup="this.formatInputMoney()"
                class="form-control"
                id="amount"
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
              v-on:click="this.saveOrder()"
            >
              Registrar Venda
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Filtros -->
  <div
    class="modal fade"
    id="filterModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="filterModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="filterModalLabel">Filtros relatório</h5>
          <button
            type="button"
            class="close"
            data-bs-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formFilter" action="#">
          <div class="modal-body">
            <div class="mb-2">
              <label for="employee_id" class="form-label"
                >Vendedor:&nbsp;</label
              >
              <select
                class="form-select form-select-lg"
                v-model="filters.employee_id"
                aria-label="Default select example"
              >
                <option
                  v-for="employee in employees"
                  :key="employee.id"
                  :value="employee.id"
                >
                  {{ employee.name }}
                </option>
              </select>
            </div>
            <div class="mb-3">
              <label for="amount" class="form-label">Nome Vendedor</label>
              <input
                type="text"
                v-model="filters.employee_name"
                class="form-control"
                id="amount"
              />
            </div>
            <div class="mb-3">
              <label for="config_email" class="form-label">Email</label>
              <input
                type="email"
                required
                v-model="filters.employee_email"
                class="form-control"
                id="config_email"
                aria-describedby="emailHelp"
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
              class="btn btn-danger"
              v-on:click="this.clearFilters()"
            >
              Limpar Filtros
            </button>
            <button
              type="button"
              class="btn btn-primary"
              data-bs-dismiss="modal"
              v-on:click="this.getOrders()"
            >
              Filtrar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- modal configuração email-->
  <ModalConfig />
</template>
<script>
import ModalConfig from "./components/ModalConfig.vue";
export default {
  name: "Orders",
  components: {
    ModalConfig,
  },
  data() {
    return {
      loading: false,
      totalAmount: 0,
      totalComission: 0,
      orders: {},
      employees: {},
      config: {},
      newOrder: {
        employee_id: "",
        amount: "",
      },
      filters: {
        employee_name: "",
        employee_id: "",
        employee_email: "",
      },
      newEmployee: true,
    };
  },
  created() {
    this.getInitial();
  },
  methods: {
    getInitial() {
      this.loading = true;
      this.getEmployees();
      this.getOrders();
    },
    getEmployees() {
      axios
        .get("/api/employee/get-all")
        .then((res) => {
          this.employees = res.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getOrders() {
      axios
        .get("/api/order/get-all", {
          params: this.filters
        })
        .then((res) => {
          this.orders = res.data.data;
          this.calcTotals();
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
          this.loading = false;
        });
    },
    openModalCreateOrder() {
      $("#orderModal").modal("show");
    },
    saveOrder() {
      $("#formOrder")[0].reportValidity();

      this.loading = true;

      var params = {
        amount: (this.newOrder.amount = this.unformatInputMoney(
          this.newOrder.amount
        )),
        employee_id: this.newOrder.employee_id,
      };

      axios
        .post("/api/order/create", params)
        .then((res) => {
          if (res.data.status == "success") {
            alert("Venda cadastrada com sucesso.");
          }
          $("#orderModal").modal("hide");
          this.loading = false;

          this.newOrder.employee_id = "";
          this.newOrder.amount = "";
          params = {};

          this.getOrders();
        })
        .catch((error) => {
          console.log(error);
          this.loading = false;
        });
    },
    calcTotals() {
      this.orders.forEach((element) => {
        this.totalAmount += parseFloat(element.amount);
        this.totalComission += parseFloat(element.commission_amount);
      });
    },
    formatMoney(value) {
      return parseFloat(value).toLocaleString("pt-br", {
        minimumFractionDigits: 2,
      });
    },
    formatInputMoney() {
      var v = this.newOrder.amount.replace(/\D/g, "");
      v = (v / 100).toFixed(2) + "";
      v = v.replace(".", ",");
      v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
      v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
      this.newOrder.amount = v;
    },
    unformatInputMoney(val) {
      var locale = "pt-br";

      var group = new Intl.NumberFormat(locale).format(1111).replace(/1/g, "");
      var decimal = new Intl.NumberFormat(locale).format(1.1).replace(/1/g, "");
      var reversedVal = val.replace(new RegExp("\\" + group, "g"), "");
      reversedVal = reversedVal.replace(new RegExp("\\" + decimal, "g"), ".");
      return Number.isNaN(reversedVal) ? 0 : reversedVal;
    },
    openModalSettings() {
      $("#configModal").modal("show");
    },
    openModalFilters() {
      $("#filterModal").modal("show");
    },
    clearFilters() {
      this.filters.employee_id = '';
      this.filters.employee_name = '';
      this.filters.employee_email = '';
    }
  },
};
//Validação para travar envio formulário
$(document).ready(function () {
  var form = document.getElementById("formOrder");

  if (form) {
    document
      .getElementById("formOrder")
      .addEventListener("click", function (event) {
        event.preventDefault();
      });
  }
});
</script>