// Declaración de objeto
const product = {
    productName : "Monitor 20 pulgadas",
    price: 300,
    avaible: true
}

// Declaración de un segundo objeto
const dimensions = {
    weight : '1kg',
    dimension : '1m'
}

// Uniendo los dos objetos
const newProduct = { ... product, ... dimensions};

console.log(product);
console.log(newProduct);
