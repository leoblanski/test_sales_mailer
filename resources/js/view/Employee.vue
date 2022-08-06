<template>
    <div>
        <h3>Vendedores</h3>

        <div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">% Comissão</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="employee in employees" :key="employee.id">
                        <th scope="row">{{employee.id}}</th>
                        <td>{{employee.name}}</td>
                        <td>{{employee.email}}</td>
                        <td>{{employee.comission_percentage}}</td>
                        <td><button type="button" class="btn btn-danger" v-on:click="this.delete(employee.id)">Excluir</button></td>
                        <td><button type="button" class="btn btn-primary">Editar</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
    export default {
       name: "Employee",
        data() {
            return {
            employees: {},
            };
        },
        created() {
            this.getEmployees();
        },
        methods: {
            getEmployees() {
                axios
                .get('/api/employee/get-all')
                .then((res) => {
                    this.employees = res.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
            },
            delete(id) {
                axios
                .delete('/api/employee/delete/' + id)
                .then((res) => {
                    this.getEmployees();
                    alert("Vendedor deletado.");
                })
                .catch((error) => {
                    alert(error.response.data.message);
                    console.log(error);
                });
            }
        }, 
    }
</script>