<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>

    <link rel="stylesheet" href="<?= base_url('assets/bootstrap3.4/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css'); ?>">
</head>
<body>

<div class="container carrito-page">

    <h1 class="titulo-carrito text-center">Resumen de Compra</h1>

    <div id="lista"></div>

    <h2 id="total" class="total-carrito"></h2>

    <div class="text-center">
        <button class="btn-premium" onclick="volver()">Volver</button>
        <button class="btn-finalizar" onclick="comprar()">Comprar Ahora</button>
    </div>

</div>

<script>
function volver()
{
    window.location.href = "<?= base_url('index.php/tienda'); ?>";
}
</script>

<script src="<?= base_url('assets/js/main.js'); ?>"></script>

</body>
</html>