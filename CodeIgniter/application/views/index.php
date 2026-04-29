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

        <?php if (!empty($productos)): ?>
            <?php foreach($productos as $p): ?>
                <div class="col-md-4">
                    <div class="producto-card">
                        <img src="<?php echo $p['url_imagen']; ?>" class="producto-img">
                        <h3><?php echo $p['nombre']; ?></h3>
                        <p class="precio">$<?php echo number_format($p['precio_actual'], 2); ?></p>
                        <button class="btn-premium agregar" 
                                data-id="<?php echo $p['id_producto']; ?>"
                                data-nombre="<?php echo $p['nombre']; ?>"
                                data-precio="<?php echo $p['precio_actual']; ?>">
                            Agregar
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <div class="col-md-12 text-center">
                <p class="subtitulo">Cargando catálogo local...</p>
            </div>
            
            <div class="col-md-4">
                <div class="producto-card">
                    <img src="https://images.unsplash.com/photo-1563636619-e9143da7973b" class="producto-img">
                    <h3>Leche (Local)</h3>
                    <p class="precio">$25.00</p>
                    <button class="btn-premium agregar" data-nombre="Leche" data-precio="25">Agregar</button>
                </div>
            </div>

            <div class="col-md-4">
                <div class="producto-card">
                    <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff" class="producto-img">
                    <h3>Pan (Local)</h3>
                    <p class="precio">$30.00</p>
                    <button class="btn-premium agregar" data-nombre="Pan" data-precio="30">Agregar</button>
                </div>
            </div>

            <div class="col-md-4">
                <div class="producto-card">
                    <img src="https://images.unsplash.com/photo-1587486913049-53fc88980cfc" class="producto-img">
                    <h3>Huevos (Local)</h3>
                    <p class="precio">$50.00</p>
                    <button class="btn-premium agregar" data-nombre="Huevos" data-precio="50">Agregar</button>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<script src="<?= base_url('assets/js/main.js'); ?>"></script>

</body>
</html>
