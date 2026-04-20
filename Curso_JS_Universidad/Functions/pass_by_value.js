/*
This program shows how the pass by value works

Author: Lalo Téllez
*/

function cambiarValor(numero){
    numero = 20;
}

let argumento = 10;
cambiarValor(argumento);
console.log(argumento);
