/* 
This program explains the use of increment/decrement of a value

Author: Lalo Téllez
*/

let a, b, c;

a = 0;

// Pre-increment
++a;
console.log(a);

// Post-increment
a++;
console.log(a);

// Pre-decrement
--a;
console.log(a);

// Post-decrement
a--;
console.log(a);

// Example
a = 5;
b = 2;
c = ++a * b--;
console.log(c);

// How the variables a and b work

console.log(a);
console.log(b);
