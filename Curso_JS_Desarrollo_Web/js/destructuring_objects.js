// Declaracion de objeto
const product = {
    productName : "Monitor 20 pulgadas",
    price: 300,
    avaible: true
}

// Si solamente quiero usar una propiedad del objeto se hace de la sig forma
const nameProduct = product.productName;
console.log(nameProduct);

const priceProduct = product.price;
console.log(priceProduct);

const avaibleProduct = product.avaible;
console.log(avaibleProduct);

// Usando Destructuring
// const {productName} = product;
// const {price} = product;
// const {avaible} = product;

// Forma mas conveniente de usar Destructuring
const {productName, price, avaible} = product;
console.log(productName);
console.log(price);
console.log(avaible);