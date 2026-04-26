let carrito = JSON.parse(localStorage.getItem("carrito")) || [];

const botones = document.querySelectorAll(".agregar");
const contador = document.getElementById("contador");
const mini = document.getElementById("miniCarrito");
const abrirCarrito = document.getElementById("abrirCarrito");

function guardar()
{
    localStorage.setItem("carrito", JSON.stringify(carrito));
}

function actualizarContador()
{
    if(!contador) return;

    let total = 0;

    carrito.forEach(function(p){
        total += p.cantidad;
    });

    contador.textContent = total;
}

function renderMiniCarrito()
{
    if(!mini) return;

    if(carrito.length === 0)
    {
        mini.innerHTML = "<p>Tu carrito está vacío</p>";
        return;
    }

    let html = "";
    let total = 0;

    carrito.forEach(function(item, i){

        let subtotal = item.precio * item.cantidad;

        total += subtotal;

        html += `
        <div>
            <strong>${item.nombre}</strong>
            <p>$${subtotal}</p>

            <button onclick="sumar(${i})">+</button>
            <button onclick="restar(${i})">-</button>
            <button onclick="eliminar(${i})">x</button>
        </div>
        `;
    });

    html += `
        <hr>
        <h4>Total: $${total}</h4>

        <button onclick="window.location.href='http://localhost/web-development/CodeIgniter/index.php/tienda/carrito'">
            Ver carrito
        </button>
    `;

    mini.innerHTML = html;
}

function sumar(i)
{
    carrito[i].cantidad++;

    guardar();
    actualizarContador();
    renderMiniCarrito();
}

function restar(i)
{
    carrito[i].cantidad--;

    if(carrito[i].cantidad <= 0)
    {
        carrito.splice(i,1);
    }

    guardar();
    actualizarContador();
    renderMiniCarrito();
}

function eliminar(i)
{
    carrito.splice(i,1);

    guardar();
    actualizarContador();
    renderMiniCarrito();
}

function comprar()
{
    alert("Compra realizada");

    localStorage.removeItem("carrito");

    carrito = [];
}

botones.forEach(function(boton){

    boton.addEventListener("click", function(){

        let nombre = boton.parentElement.querySelector("h3").textContent;

        let precio = parseFloat(
            boton.parentElement.querySelector(".precio")
            .textContent.replace("$","")
        );

        let existe = carrito.find(function(p){
            return p.nombre === nombre;
        });

        if(existe)
        {
            existe.cantidad++;
        }
        else
        {
            carrito.push({
                nombre:nombre,
                precio:precio,
                cantidad:1
            });
        }

        guardar();
        actualizarContador();
        renderMiniCarrito();
    });
});

if(abrirCarrito)
{
    abrirCarrito.addEventListener("click", function(){

        if(mini.style.display === "block")
        {
            mini.style.display = "none";
        }
        else
        {
            renderMiniCarrito();
            mini.style.display = "block";
        }
    });
}

actualizarContador();