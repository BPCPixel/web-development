/* 
This is program explains how switch statement works
*/

let day = 1;

switch(day){
    case 1:
        console.log(`Monday -> ${day}`);
    break;
    case 2:
        console.log(`Tuesday -> ${day}`);
    break;
    case 3:
        console.log(`Wednesday -> ${day}`);
    break;
    case 4:
        console.log(`Thursday -> ${day}`);
    break;
    case 5:
        console.log(`Friday -> ${day}`);
    break;
    case 6:
        console.log(`Saturday -> ${day}`);
    break;
    case 7:
        console.log(`Sunday -> ${day}`);
    break;
    default:
        console.log(`Invalid number ${day}`)
}

