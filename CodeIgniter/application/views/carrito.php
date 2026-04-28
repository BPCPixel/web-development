<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Caja - Eduardo Market</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap_3_4/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
</head>
<body>

<div class="container carrito-page">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            <!-- Encabezado de la sección de pago -->
            <div class="page-header" style="border-bottom: 1px solid #334155;">
                <h1 class="logo">Finalizar Pedido</h1>
                <p class="subtitulo">Revisa tus productos antes de realizar el pago</p>
            </div>

            
            <button class="btn btn-link subtitulo" onclick="location.href='<?php echo base_url(); ?>index.php/tienda'">
                <span class="glyphicon glyphicon-arrow-left"></span> Seguir comprando
            </button>
            <br><br>
            
            
            <div id="lista"></div>
            

            <div id="area-total" class="panel panel-default" style="background: #1e293b; border: 1px solid #334155; border-radius: 15px; padding: 20px;">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <h3 style="color: #cbd5e1; margin-top: 10px;">Total a pagar:</h3>
                        </div>
                        <div class="col-xs-6 text-right">
                            <h2 id="total" class="total-carrito" style="margin-top: 5px; font-weight: bold;"></h2>
                        </div>
                    </div>
                    <hr style="border-top: 1px solid #334155;">
                    <button class="btn btn-block btn-lg btn-finalizar" onclick="comprar()">
                        <span class="glyphicon glyphicon-credit-card"></span> Pagar Ahora
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
let carrito = JSON.parse(localStorage.getItem("carrito")) || [];
const lista = document.getElementById("lista");
const totalTexto = document.getElementById("total");

function mostrarCarrito() {
    lista.innerHTML = "";
    let total = 0;

    if (carrito.length === 0) {
        
        lista.innerHTML = `
            <div class="alert text-center" style="background: #1e293b; color: #cbd5e1; border: 1px solid #334155; border-radius: 15px; padding: 40px 20px;">
                <span class="glyphicon glyphicon-shopping-cart" style="font-size: 48px; color: #d4af37; margin-bottom: 15px;"></span>
                <p style="font-size: 18px;">Tu carrito de compras está vacío</p>
            </div>`;
        document.getElementById("area-total").style.display = "none";
        return;
    }

    document.getElementById("area-total").style.display = "block";

    carrito.forEach(function(item, index) {
        let sub = item.precio * item.cantidad;
        total += sub;

        let div = document.createElement("div");
        
        div.className = "item-carrito table-responsive";
        div.innerHTML = `
            <table class="table" style="margin-bottom: 0; background: transparent;">
                <tbody>
                    <tr>
                        <td style="border: none; vertical-align: middle;">
                            <strong style="font-size: 18px; color: #111827;">${item.nombre}</strong><br>
                            <span class="text-muted">Precio unitario: $${item.precio}</span>
                        </td>
                        <td class="text-center" style="border: none; vertical-align: middle;">
                            <span class="badge" style="background: #1e293b; color: #f9fafb; padding: 6px 12px; font-size: 14px;">Cant: ${item.cantidad}</span>
                        </td>
                        <td class="text-right" style="border: none; vertical-align: middle;">
                            <span style="font-size: 20px; font-weight: bold; color: #111827; margin-right: 20px;">$${sub}</span>
                            <div class="btn-group" role="group">
                                <button class="btn btn-default btn-sm" onclick="cambiar(${index}, 1)" style="font-weight: bold;">+</button>
                                <button class="btn btn-default btn-sm" onclick="cambiar(${index}, -1)" style="font-weight: bold;">-</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        `;
        lista.appendChild(div);
    });
    totalTexto.textContent = "$" + total;
}

function cambiar(idx, d) {
    carrito[idx].cantidad += d;
    if (carrito[idx].cantidad <= 0) carrito.splice(idx, 1);
    localStorage.setItem("carrito", JSON.stringify(carrito));
    mostrarCarrito();
}

function comprar() {
    let sub = 0;
    carrito.forEach(i => sub += (i.precio * i.cantidad));
    let iva = sub * 0.16;
    let total = sub + iva;

    let tkt = `EDUARDO MARKET \n----------------------\n`;
    carrito.forEach(i => tkt += `${i.nombre} x${i.cantidad} ... $${i.precio * i.cantidad}\n`);
    tkt += `----------------------\nSubtotal: $${sub.toFixed(2)}\nIVA (16%): $${iva.toFixed(2)}\nTOTAL: $${total.toFixed(2)}\n----------------------\n¡Gracias por tu compra!`;
    
    alert(tkt);
    localStorage.removeItem("carrito");
    location.href = "<?php echo base_url(); ?>index.php/tienda";
}

mostrarCarrito();
</script>
</body>
</html>