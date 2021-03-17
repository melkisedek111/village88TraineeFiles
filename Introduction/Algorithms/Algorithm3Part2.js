// print 1 to x
function printUpTo(x) {
	if (x < 0) return false;
	for (let i = 1; i <= x; i++) {
		console.log(i);
	}
}

// PrintSum
function printSum(x) {
	var sum = 0;
	for (let i = 0; i <= x; i++) {
		sum = sum + i;
	}
	return sum;
}
y = printSum(255);
console.log(y);

// printSumArray
function printSumArray(x) {
	var sum = 0;
	for (var i = 0; i < x.length; i++) {
		sum = sum + x[i];
	}
	return sum;
}
console.log(printSumArray([1, 2, 3]));

// LargestElement
function largestElement(x) {
	return x.sort((a, b) => a - b)[x.length - 1];
}
