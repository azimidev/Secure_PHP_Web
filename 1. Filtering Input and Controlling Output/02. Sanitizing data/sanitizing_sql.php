<?php // SQL sanitization

$sanitize = false;

$name = isset($_GET['name']) ? $_GET['name'] : "";

if($sanitize) {
	$name = addslashes($name);
	
	// If you have a database configured, mysqli_real_escape_string
	// is a better function to use:
	// $db = mysqli_connect("localhost", "user", "password", "database");
	// $name = mysqli_real_escape_string($db, $name);
}

echo "SELECT * FROM customers WHERE name='{$name}';";

// sanitizing_sql.php?name=Kevin
// sanitizing_sql.php?name=%27+OR+1=1;--
// sanitizing_sql.php?name=%27;+DROP+TABLE+customers;--

?>
