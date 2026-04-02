/* 
This program explains the use of comparation operators

Author: Lalo Téllez
*/

// Relational operators (Comparation)
let a = 5;
let b = '5';
console.log(a);
console.log(b);

// Operator equal ==
// Only compares values, makes a convertion if necessary
console.log("a == b ->" , a == b);
// String interpolation
console.log(`${a} == ${b} -> ${a == b}`);

// Operator strict equal ===
// compares value and type
console.log("a === b ->" , a === b);
// String interpolation
console.log(`${a} === ${b} -> ${a === b}`);

// Different operators
// Compares value and converts type of if necessary
console.log(`${a} != ${b} -> ${a != b}`);

// Exact and different operators
// Compares value and converts type of if necessary
console.log(`${a} !== ${b} -> ${a !== b}`);

// Less than
console.log(`${a} < ${b} -> ${a < b}`);

// Less or equal than
console.log(`${a} <= ${b} -> ${a <= b}`);

// Greater than
console.log(`${a} > ${b} -> ${a > b}`);

// Greater or iqual than
console.log(`${a} >= ${b} -> ${a >= b}`);