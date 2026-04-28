<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eduardo Market</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap_3_4/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
</head>
<body>

<nav class="navbar-custom">
    <div class="container">
        <div class="row">

            <div class="col-xs-6">
                <h2 class="logo">Eduardo Market</h2>
                <p class="subtitulo">Los mejores precios</p>
            </div>

            <div class="col-xs-6 text-right carrito-area">
                <div class="carrito-box" id="abrirCarrito">
                    Carrito
                    <span id="contador" class="contador">0</span>
                </div>

                <div id="miniCarrito" class="mini-carrito"></div>
            </div>

        </div>
    </div>
</nav>

<header class="hero-section text-center">
    <div class="container">
        <h1>Bienvenido a Eduardo Market</h1>
        <p>Productos seleccionados con la mejor calidad</p>
    </div>
</header>

<div class="container">
    <div class="row">

        <div class="col-md-4">
            <div class="producto-card">
                <img src="https://images.unsplash.com/photo-1563636619-e9143da7973b" class="producto-img">
                <h3>Leche</h3>
                <p class="precio">$25</p>
                <button class="btn-premium agregar">Agregar</button>
            </div>
        </div>

        <div class="col-md-4">
            <div class="producto-card">
                <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff" class="producto-img">
                <h3>Pan</h3>
                <p class="precio">$30</p>
                <button class="btn-premium agregar">Agregar</button>
            </div>
        </div>

        <div class="col-md-4">
            <div class="producto-card">
                <img src="https://images.unsplash.com/photo-1587486913049-53fc88980cfc" class="producto-img">
                <h3>Huevos</h3>
                <p class="precio">$50</p>
                <button class="btn-premium agregar">Agregar</button>
            </div>
        </div>

        <div class="col-md-4">
            <div class="producto-card">
                <img src="https://images.unsplash.com/photo-1586201375761-83865001e31c" class="producto-img">
                <h3>Arroz</h3>
                <p class="precio">$20</p>
                <button class="btn-premium agregar">Agregar</button>
            </div>
        </div>

        <div class="col-md-4">
            <div class="producto-card">
                <img src="https://images.unsplash.com/photo-1515543904379-3d757afe72e4" class="producto-img">
                <h3>Frijoles</h3>
                <p class="precio">$28</p>
                <button class="btn-premium agregar">Agregar</button>
            </div>
        </div>

        <div class="col-md-4">
            <div class="producto-card">
                <img src="https://images.unsplash.com/photo-1622484212850-eb596d769edc" class="producto-img">
                <h3>Chocolate</h3>
                <p class="precio">$18</p>
                <button class="btn-premium agregar">Agregar</button>
            </div>
        </div>

    </div>
</div>

<script src="<?= base_url('assets/js/main.js'); ?>"></script>

</body>
</html>