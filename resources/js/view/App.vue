<template>
    <div>
        <router-link :to="{name: 'home'}">Início</router-link>
        <router-link :to="{name: 'employees'}">Vendedores</router-link>
        <router-link :to="{name: 'orders'}">Vendas</router-link>

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