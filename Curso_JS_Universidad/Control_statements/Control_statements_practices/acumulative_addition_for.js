/*
This is an exercise to practice the for loop.
The goal is to calculate and display the sum of the first 5 numbers.

Author: Lalo Téllez
*/

let sum = 0;

for (let counter = 1; counter <= 5; counter++) {
    console.log(`${sum} + ${counter} = ${sum + counter}`);
    sum += counter;
}

console.log("Final result:", sum);