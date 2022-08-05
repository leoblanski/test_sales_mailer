<template>
    <div>
        <router-link to="/">Início</router-link>
        <router-link to="/employees">Vendedores</router-link>
        <router-link to="/orders">Vendas</router-link>

        <div class="container">
            <p>teste</p>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {

    }
</script>