<?php // Sanitize functions
// Make sanitizing easy and you will do it often

// Sanitize for HTML output 
function h($string) {
	return htmlspecialchars($string);
}

// Sanitize for JavaScript output
function j($string) {
	return json_encode($string);
}

// Sanitize for use in a URL
function u($string) {
	return urlencode($string);
}

// Usage examples, leave commented out
// echo h("<h1>Test string</h1><br />");
// echo j("'}; alert('Gotcha!'); //");
// echo u("?title=Working? Or not?");

?>
