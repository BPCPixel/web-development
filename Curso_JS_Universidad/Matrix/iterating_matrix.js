/*
This program shows how an iterating matrix works

Author: Lalo Téllez
*/

// Declaring matrix
let matrix = [[100, 200, 300],[400, 500, 600]];


// ROWS
console.log(`ROWS: ${matrix.length}`);

// COLUMNS
console.log(`COLUMNS: ${matrix[0].length}`);
console.log(`COLUMNS: ${matrix[1].length}`);

// Iterating a matrix
// ROWS
for(let ROW = 0; ROW < matrix.length; ROW++){
    for(let COLUMN = 0; COLUMN < matrix[ROW].length; COLUMN++){
        console.log(`Element[${ROW}][${COLUMN}] = ${matrix[ROW][COLUMN]}`)
    }
}

