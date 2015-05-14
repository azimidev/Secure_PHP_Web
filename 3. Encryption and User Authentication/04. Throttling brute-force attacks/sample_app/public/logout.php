<?php
	require_once("../private/initialize.php");

	// Do the logout processes and redirect to login page.
	after_successful_logout();
	redirect_to('login.php');

?>
