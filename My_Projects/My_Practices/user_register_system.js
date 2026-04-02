"use strict"

// Variables
let myName = "Eduardo";
let myAge = 29;
let myCountry = "Mexico";

// Validación
if (myName === "") {
    console.log("Please enter your name.");
} else if (myName !== "Eduardo") {
    console.log("That is not your name.");
} else {
    console.log("Welcome Eduardo\n");
}

// Mostrar datos
console.log(`Name: ${myName}
Age: ${myAge}
Country: ${myCountry}`);

// Objeto
let user = {
    userName: myName,
    userAge: myAge,
    userCountry: myCountry
};

// Propiedades adicionales
user.isAdult = user.userAge >= 18;
user.randomID = Math.floor(Math.random() * 100);

// Strings
console.log(user.userName.toUpperCase());
console.log(user.userName.toLowerCase());
console.log(`Length: ${user.userName.length}`);

// MENÚ
let option;

do {
    console.log("\n1) See user");
    console.log("2) Change name");
    console.log("3) Change age");
    console.log("4) Out");

    option = Number(prompt("Choose an option"));

    switch(option) {

        case 1:
            console.log(user);
        break;

        case 2:
            let newName = prompt("Enter new name");
            if(newName === ""){
                console.log("You must write a name");
            } else {
                user.userName = newName;
                console.log("Name updated:", user.userName);
            }
        break;

        case 3:
            let newAge = Number(prompt("Enter new age"));
            if(newAge <= 0){
                console.log("Invalid age");
            } else {
                user.userAge = newAge;
                user.isAdult = user.userAge >= 18;
                console.log("Age updated:", user.userAge);
                console.log("isAdult:", user.isAdult);
            }
        break;

        case 4:
            console.log("Goodbye!");
        break;

        default:
            console.log("Try again");
    }

} while(option !== 4);