<template>
    <loader v-if="this.loading"></loader>
    <div class="mt-3">
        <div class="row no-gutters d-flex">
            <h5 class="mr-auto bt-1 mb-1">Vendedores ({{employees.length}})</h5>
            <button class="btn btn-sm btn-success mt-1 mb-1" v-on:click="this.openModal(null)">Novo vendedor</button>
        </div>
        <div>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">% Comissão</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="employee in employees" :key="employee.id">
                        <th scope="row">{{employee.id}}</th>
                        <td>{{employee.name}}</td>
                        <td>{{employee.email}}</td>
                        <td>{{employee.comission_percentage}}</td>
                        <td>
                            <button type="button" class="btn btn-danger" v-on:click="this.delete(employee.id)">Excluir</button>&nbsp;
                            <button type="button" class="btn btn-primary" v-on:click="this.openModal(employee)">Editar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Cadastro/Edição-->
    <div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="employeeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="employeeModalLabel">{{!this.newEmployee ? 'Editar vendedor' : 'Cadastrar vendedor'}}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formEmployee" action="#">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="employee_name" class="form-label">Nome completo</label>
                            <input type="text" required v-model="editForm.name" class="form-control" id="employee_name">
                        </div>
                        <div class="mb-3">
                            <label for="employee_comission" class="form-label">Comissão</label>
                            <input type="text" readonly value="8.0" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="employee_email" class="form-label">Email</label>
                            <input type="email" required v-model="editForm.email" class="form-control" id="employee_email" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" v-on:click="this.saveEmployee()">{{!this.newEmployee ? 'Editar' : 'Cadastrar'}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
       name: "Employee",
        data() {
            return {
                loading: false,
                employees: {},
                editForm: {
                    'id': null,
                    'name': '',
                    'email': ''
                },
                newEmployee: true,
                errors: [],
            };
        },
        created() {
            this.getEmployees();
        },
        methods: {
            getEmployees() {
                this.loading = true;

                axios
                .get('/api/employee/get-all')
                .then((res) => {
                    this.employees = res.data.data;
                    this.loading = false;
                })
                .catch((error) => {
                    console.log(error);
                    this.loading = false;
                });
            },
            openModal(employee) {
                this.newEmployee = employee == null ? true : false;

                if (this.newEmployee) {
                    this.editForm.id = null;
                    this.editForm.name = '';
                    this.editForm.email = '';
                } else {
                    this.editForm.id = employee.id;
                    this.editForm.name = employee.name;
                    this.editForm.email = employee.email;
                }

                $('#employeeModal').modal('show'); 
            },
            saveEmployee() {
                $("form")[0].reportValidity();

                this.loading = true;
 
                //Edição
                if (this.editForm.id != null) {
                    axios.post('/api/employee/update/' + this.editForm.id, this.editForm)
                    .then((res) => {
                        if (res.data.status == 'success') {
                            $('#employeeModal').modal('hide'); 
                            alert("Vendedor editado com sucesso.");
                        }
                        this.loading = false;
                        this.getEmployees();
                    })
                    .catch((error) => {
                        console.log(error);
                        this.loading = false;
                    });
                } else {
                //Cadastro
                    axios.post('/api/employee/create', this.editForm)
                    .then((res) => {
                        if (res.data.status == 'success') {
                            alert("Vendedor cadastrado com sucesso.");
                        }
                        $('#employeeModal').modal('hide'); 
                        this.loading = false;
                        this.getEmployees();
                    })
                    .catch((error) => {
                        console.log(error);
                        this.loading = false;
                    });
                }
            },
            delete(id) {
                if (confirm("Deseja deletar o vendedor? ")) {
                    axios.delete('/api/employee/delete/' + id)
                    .then((res) => {
                        this.getEmployees();
                        alert("Vendedor deletado.");
                    })
                    .catch((error) => {
                        alert(error.response.data.message);
                        console.log(error);
                    });
                }
            }
        }, 
    }
    //Validação para travar envio formulário
    $( document ).ready(function() {
        var form = document.getElementById("formEmployee");

        if (form) {
            document.getElementById("formEmployee").addEventListener("click", function(event){
                event.preventDefault()
            });
        }
    });

</script>