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

// Reciving a random number
let randomID = Math.floor(Math.random() * 100 );
console.log(randomID);

// Name in uppercase and lowercase
console.log(user.userName.toUpperCase());
console.log(user.userName.toLowerCase());

// Length of the userName
console.log(`Length of ${user.userName}: ${user.userName.length}`);

// Creating a Menu with do-while statement
let option = 4;

    
    do{
        console.log("1) See user");
        console.log("2) Change name");
        console.log("3) Change age");
        console.log("4) Out");
        switch(option){
            case 1:
                console.log(user);
            break;
            case 2:
                user.userName = 'Pepito'
                if(user.userName = ""){
                    console.log("You must write a name");
                }else{
                    console.log(user.userName);
                }
            break;
            case 3:
                user.userAge = 25
                if(user.userAge < 18){
                    isAdult = false;
                }
                console.log(`isAdult: ${isAdult}`);
                console.log(user.userAge);
            break;
            case 4:
                console.log("Goodbye!");
            break;
            default:
                console.log("Try again");
        }
    }while(option != 4);

