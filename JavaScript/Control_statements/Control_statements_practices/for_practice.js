/*
This is an exercise to practice the for loop.
The goal is to:
1. Print numbers from 1 to 10 in steps of 3
2. Print numbers from 1 down to -10 in steps of 3

Author: Lalo Téllez
*/

const MAX = 10;
const MIN = -10;

// Ascending sequence
for (let counter = 1; counter <= MAX; counter += 3) {
    console.log(counter);
}

// Descending sequence
for (let counter = 1; counter >= MIN; counter -= 3) {
    console.log(counter);
}