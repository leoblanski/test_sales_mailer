<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light ">
            <a class="navbar-brand" href="#">Tray Test</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"><router-link to="/">Início</router-link></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><router-link to="/employees">Vendedores</router-link></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><router-link to="/orders">Vendas</router-link></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {

    }
</script>