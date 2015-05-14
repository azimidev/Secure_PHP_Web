<?php
session_start();
require_once 'csrf_request_type_functions.php';
require_once 'csrf_token_functions.php';

if(request_is_post()) {
	if(csrf_token_is_valid()) {
		$message = "VALID FORM SUBMISSION";
		if(csrf_token_is_recent()) {
			$message .= " (recent)";
		} else {
			$message .= " (not recent)";
		}
	} else {
		$message = "CSRF TOKEN MISSING OR MISMATCHED";
	}
} else {
	// form not submitted or was GET request
	$message = "Please login.";
}

?>
<html>
	<head>
		<title>CSRF Demo</title>
	</head>
	<body>
		<?php echo $message; ?><br />
		<form action="" method="post">
			<?php echo csrf_token_tag(); ?>
			Username: <input type="text" name="username" /><br />
			Password: <input type="password" name="password"><br />
			<input type="submit" value="Submit" />
		</form>
	</body>
</html>
