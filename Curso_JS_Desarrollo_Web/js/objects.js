// Objetos

// Forma tradicional de declarar variables
const productName = "Monitor 20 Pulgadas"
const price = 300;
const avaible = true;

// Declaracion de objeto
const product = {
    productName : "Monitor 20 pulgadas",
    price: 300,
    avaible: true
}

// Para agregar nuevas propiedades
product.image = 'image.jpg';

// Eliminar propiedades
delete product.avaible;
console.log(product);