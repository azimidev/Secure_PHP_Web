<?php
require_once('validation_functions.php');

// http://localhost/~amir/validation_tests.php?test=s
$value = $_GET['test'];

if(has_presence($value)) {
	echo "Present.";
} else {
	echo "Not present.";
}
echo "<br />";

if(has_length($value, ['min' => 3, 'max' => 5])) {
	echo "Valid length.";
} else {
	echo "Invalid length.";
}
echo "<br />";

if(has_format_matching($value, '/\d{4}/')) {
	echo "Valid format.";
} else {
	echo "Invalid format.";
}
echo "<br />";

if(has_number($value, ['min' => 100, 'max' => 1000])) {
	echo "Valid number.";
} else {
	echo "Invalid number.";
}
echo "<br />";

if(has_inclusion_in($value, [1,3,5,7,9])) {
	echo "Included in the set.";
} else {
	echo "Not included in the set.";
}
echo "<br />";

if(has_exclusion_from($value, [1,3,5,7,9])) {
	echo "Excluded from the set.";
} else {
	echo "Not excluded from the set.";
}
echo "<br />";

?>