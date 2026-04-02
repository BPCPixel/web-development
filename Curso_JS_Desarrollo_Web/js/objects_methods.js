// Con use strict podemos utilizar JS de forma estricta siguiendo buenas practicas de código
"use strict";

// Declaracion de objeto
const product = {
    productName : "Monitor 20 pulgadas",
    price: 300,
    avaible: true
}

product.image = 'image.jpg';
console.log(product.image);

// Método para ya no poder agregar, eliminar o modificar más propiedades
Object.freeze(product);


// Método similar a FREEZE pero si permite modificar las propiedades existentes
Object.seal(product);

// La siguiente propiedad ya no se agregaría al objeto
//product.image2 = 'image2.jpg'; // Con "use strict" ya no permite agregar otra propiedad
