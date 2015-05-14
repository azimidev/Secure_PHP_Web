<?php require_once("../private/initialize.php"); ?>
<?php

// Rather than require setting up a real database, 
// we can fake one instead.
initialize_fake_database();

// Initialize variable to a default value
$token = "none";

// hardcode the username to use since this is just a demo
$username = 'kskoglund';

$user = find_one_in_fake_db('users', 'username', $username);
if($user && isset($user['reset_token'])) {
	$token = $user['reset_token'];
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Password Reset Email</title>
  </head>
  <body>
	
    <p>This page is a simulation of what a password reset token email might look like.</p>
		<hr />
		<p>
			FROM: emailer@sample_app<br />
			TO: <?php echo $username ?>@somewhere.com<br />
			SUBJECT: Reset Password Request
		</p>
		
    <p>You can use the link below to reset your password.</p>
		
		<p>
			<?php $url = "reset_password.php?token=" . u($token); ?>
			<a href="<?php echo $url; ?>"><?php echo $url; ?></a>
		</p>

		<p>If you did not make this request, you do not need to take any action. Your password cannot be changed without clicking the above link to verify the request.</p>
		
		<hr />
  </body>
</html>
