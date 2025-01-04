/*
 * validator.js
 * Validates the contents of text boxes.
 */
 
// Checks that text box contains data.
function isPresent(textBox, name) {
	if (textBox.value.trim() === "") {
		window.alert("Error! " + name + " is required.");
		return false;
	}
	return true;
}

// Checks that text box contains a number.
function isNumeric(textBox, name) {
	if (isNaN(textBox.value)) {
		window.alert("Error! " + name + " should be a number.");
		return false;
	}
	return true;
}

// Checks that the number in text box is non-negative.
function isNonnegative(textBox, name) {
	if (Number(textBox.value) < 0) {
		window.alert("Error! " + name + " should be non-negative.");
		return false;
	}
	return true;
}

// Checks that contents of text box matches a regular expression pattern.
function matchesPattern(textBox, name, pattern) {
	if (textBox.value.search(pattern) != 0) {
		window.alert("Error! " + name + " should be properly formatted.");
		return false;
	}
	return true;
}
