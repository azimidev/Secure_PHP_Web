<?php require_once("../private/initialize.php"); ?>

<?php
	// To be private, page must require user to be 
	// considered logged in and session must be valid.
	// If not, these functions will redirect the user 
	// to login.php.
	confirm_user_logged_in();
	confirm_session_is_valid();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Private page</title>
  </head>
  <body>
    <p>This is a private page. It is only accessible when logged in.</p>
    <p>You can <a href="logout.php">log out</a>.
  </body>
</html>
