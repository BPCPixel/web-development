/*
This program shows how the pass by reference works

Author: Lalo Téllez
*/

// Paso por referencia
function cambiarValor(parametro){
    parametro[0] = 20;
}

let arreglo = [10];
console.log(arreglo);
cambiarValor(arreglo);
console.log(arreglo);