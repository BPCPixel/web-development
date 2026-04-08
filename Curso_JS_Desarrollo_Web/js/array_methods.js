// Ejemplo de los diferentes métodos para los arreglos

const numeros = [10,20,30,40,50];
console.log(numeros);

const meses = ['Enero', 'Febrero', 'Marzo' ,'Abril', 'Mayo'];
console.log(meses);

// Agregar elemento al final de un arreglos
numeros.push(60);
console.log(numeros);

// Agrega numeros al inicio del arreglo
numeros.unshift(-1);
numeros.unshift(-2);
numeros.unshift(-4, -3);

// Mostrar el arreglo en una tabla
console.table(numeros);

// Eliminar el último elemento de un arreglo
meses.pop();
console.table(meses);

// Eliminar el primer elemento de un arreglo
meses.shift();
console.table(meses);

// Eliminar uno o varios elementos en especifico
meses.splice(2,1); // Indice, # de elementos a borrar
console.table(meses); // Febrero y Marzo porque ya eliminamos Enero y Mayo

// Dejando el arreglo meses como estaba
meses.unshift('Enero');
meses.push('Abril', 'Mayo');
console.table(meses);

// Rest Operator o Spread Operator
// Más recomendable que el push
const nuevoArreglo = [...meses, 'Junio'];
console.table(nuevoArreglo);



