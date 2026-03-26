"use strict"

// Declaracion de variables
let myName = "Eduardo";
let myAge = "29";
let myCountry = "Mexico"

// Validación sencilla de nombre del usuario
if (myName !== "Eduardo"){
    console.log("That is not your name.");
}

else if(myName === ""){
    console.log("Please enter your name. ");
}

else{
    console.log("Welcome Eduardo \n");
}

// Mostrando variables del usuario
console.log(`Name: ${myName}
Age: ${myAge}    
Country: ${myCountry}`);

// Creando objeto
let user = {
    userName: myName,
    userAge: myAge,
    userCountry: myCountry
}

// Validación de la edad
let isAdult = false;

if (user.userAge >= 18){
    isAdult = true;
}

console.log(`isAdult: ${isAdult}`);

let randomID = Math.floor(Math.random() * 100 );
console.log(randomID);