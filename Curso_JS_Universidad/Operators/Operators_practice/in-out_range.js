/* 
This is an example if a value is in or out of a range
*/

// Define variables
let min = 0; max = 5;

// Value to compare in Range
let dato = 3;

// Validation
let inRange = dato >= min && dato <= max;
console.log(`In Range -> ${inRange}`);

// Value to compare in Range
dato = 8;

// Validation
inRange = dato >= min && dato <= max;
console.log(`In Range -> ${inRange}`);