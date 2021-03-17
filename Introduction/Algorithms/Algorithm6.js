// 1 Return the given array, after setting any negative values to zero.  For example resetNegatives( [1,2,-1, -3]) should return [1,2,0,0].
function resetNegatives(arr) {
	for (let i = 0; i < arr.length; i++) {
		if (arr[i] < 0) {
			arr[i] = 0;
		}
	}
	return arr;
}
resetNegatives([1, 2, -1, -3]);

// 2. Given an array, move all values forward by one index, dropping the first and leaving a ‘0’ value at the end.  For example moveForward( [1,2,3]) should return [2,3,0].
function moveForward(arr) {
	let newArr = [];
	for (let i = 0; i < arr.length; i++) {
		// console.log(i)
		if (i < arr.length - 1) {
			newArr[i] = arr[i + 1];
		} else if (i === arr.length - 1) {
			newArr[i] = 0;
		}
	}
	return newArr;
}
moveForward([1, 2, 3]);

// 3. Given an array, return an array with values in a reversed order.  For example, returnReversed([1,2,3]) should return [3,2,1].
function returnReversed(arr) {
	let newArr = [];
	for (let i = arr.length - 1; i >= 0; i--) {
		newArr[arr.length - 1 - i] = arr[i];
	}
	return newArr;
	// let temp;
	// for (let i = 0; i < arr.length; i++) {
	// 	if(arr.length > i) {
	// 		temp = arr[i];
	// 		arr[i] = arr[arr.length - 1 - i];
	// 	} else if (arr.length < i) {

	// 	}
	// }
	// return arr;
}
returnReversed([1, 2, 3, 7, 8]);

// 4 Create a function that changes a given array to list each original element twice, retaining original order.  Have the function return the new array.  For example repeatTwice( [4,”Ulysses”, 42, false] ) should return [4,4, “Ulysses”, “Ulysses”, 42, 42, false, false].
function repeatTwice(arr) {
    let newArr = [];
    let count = 0;
    for(let i = 0; i < arr.length; i++ ) {
        for(let x = 0; x < arr.length / 2; x++ ) {
            count += 1;
            newArr[count - 1] = arr[i]
        }
    }
    return newArr;
}
repeatTwice( [4,"Ulysses", 42, false] )