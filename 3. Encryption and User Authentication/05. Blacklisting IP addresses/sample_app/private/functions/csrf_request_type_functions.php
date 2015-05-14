<?php
// GET requests should not make changes
// Only POST requests should make changes

function request_is_get() {
	return $_SERVER['REQUEST_METHOD'] === 'GET';
}

function request_is_post() {
	return $_SERVER['REQUEST_METHOD'] === 'POST';
}

// Usage:
// if(request_is_post()) {
//   ... process form, update database, etc.
// } else {
//   ... do something safe, redirect, error page, etc.
// }
?>
