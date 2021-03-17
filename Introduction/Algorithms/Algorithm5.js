// 1 Given an array and a value Y, count and print the number of array values greater than Y.
function countValueGreaterThanY(arr, val) {
	let count = 0;
	for (let i = 0; i < arr.length; i++) {
		if (val > arr[i]) {
			count += 1;
		}
	}
	return count;
}
count = countValueGreaterThanY([2, 5, 3, 1, 9, 6], 6);
console.log(count); // 4

// Given an array, print the max, min and average values for that array.
function minMax(x) {
	let max, min;
	for (let i = 0; i < x.length; i++) {
		if (!min) min = x[i];
		if (!max) max = x[i];
		if (min > x[i]) {
			min = x[i];
		}
		if (max < x[i]) {
			max = x[i];
		}
	}
	console.log("Max", max);
	console.log("Min", min);
}
minMax([6, 2, 3, 4, 5]);

// 3 Given an array of numbers, create a function that returns a new array where negative values were replaced with the string ‘Dojo’.   For example, replaceNegatives( [1,2,-3,-5,5]) should return [1,2, "Dojo", "Dojo", 5].
function replaceNegatives(arr) {
	for (let i = 0; i < arr.length; i++) {
		if (arr[i] < 0) {
			arr[i] = "Dojo";
		}
	}
	return arr;
}
replaceNegatives([-6, -2, 13, 4, 25]);

// 4 Given array, and indices start and end, remove values in that index range, working in-place (hence shortening the array).  For example, removeVals([20,30,40,50,60,70],2,4) should return [20,30,70].
function removeVals(arr, start, end) {
	let newArr = [];
	for (let i = 0; i < arr.length; i++) {
		if (start > i || end < i) {
			newArr.push(arr[i]);
		}
	}
	return newArr;
}
removeVals([20, 30, 40, 50, 60, 70], 2, 4);
