// 1) Analyze an array’s values and return the average of its values.
function printAverage(x){
    sum = 0;
    for(let i = 0; i < x.length; i++) {
        sum = sum + x[i];
    }
    return sum / x.length;
 }
 y = printAverage([1,2,3]);
 console.log(y); // should log 2
   
 y = printAverage([2,5,8]);
 console.log(y); 

 // 2) Create an array with all the odd integers between 1 and 255 (inclusive)
 function returnOddArray(){
    let x = [];
    for(let i = 1; i <= 255; i++) {
        if(i % 2 === 1) {
            x.push(i);
        }
    }
    return x;
 }
 y = returnOddArray();
 console.log(y); // should log [1,3,5,...,253,255]

// 3) Square each value in a given array, returning that same array with changed values.
 function squareValue(x){
    for(let i = 0; i < x.length; i++) {
        x[i] = x[i] * x[i]
    }
    return x;
 }
 y = squareValue([1,2,3]);
 console.log(y); // should log [1,4,9]
   
 y = squareValue([2,5,8]);
 console.log(y); // should log [4,25,64]