/*
This is an exercise to practice the while loop.
The goal is to calculate and display the sum of the first 5 numbers.

Author: Lalo Téllez
*/

let sum = 0, counter = 1;

while(counter <= 5){
    console.log(`${sum} + ${counter} = ${sum + counter}`);
    sum += counter;
    counter ++;
}

console.log("Final result:", sum);