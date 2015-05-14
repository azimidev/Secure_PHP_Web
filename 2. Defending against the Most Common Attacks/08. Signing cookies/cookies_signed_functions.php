<?php
// Signed cookie example

function sign_string($string) {
	// Using $salt makes it hard to guess how $checksum is generated
	// Caution: changing salt will invalidate all signed strings
	$salt = "Simple salt";
	$checksum = sha1($string.$salt); // Any hash algorithm would work
	// return the string with the checksum at the end
	return $string.'--'.$checksum;
}

function signed_string_is_valid($signed_string) {
	$array = explode('--', $signed_string);
	
	if(count($array) != 2) {
		// string is malformed or not signed
		return false;
	}
	
	// Sign the string portion again. Should create same 
	// checksum and therefore the same signed string.
	$new_signed_string = sign_string($array[0]);
	if($new_signed_string == $signed_string) {
		return true;
	} else {
		return false;
	}
}

// Uncomment to demonstrate usage

// $string = "This is a test.";
// echo "Original: " . $string . "<br />";
// echo "<br />";
// 
// $signed_string = sign_string($string);
// echo "Signed: " . $signed_string . "<br />";
// echo "<br />";
// 
// $valid = signed_string_is_valid($signed_string);
// echo "Valid? " . ($valid ? 'true' : 'false') . "<br />";
// echo "<br />";
// 
// $tampered_string = "This was a test.--521d61df5d4c239a1f5a191ff3803826b60587a9";
// echo "Tampered: " . $tampered_string . "<br />";
// echo "<br />";
// 
// $valid = signed_string_is_valid($tampered_string);
// echo "Valid? " . ($valid ? 'true' : 'false') . "<br />";
// echo "<br />";

?>
