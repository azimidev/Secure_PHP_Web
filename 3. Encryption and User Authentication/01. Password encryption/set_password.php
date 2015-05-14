<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Set Password</title>
  </head>
  <body>

<?php

if(isset($_POST['submit'])) {
	
	$password = $_POST['password'];
	echo "Text password: " . $password . "<br />";
  
	// Encryption example
	$hashed_password = password_hash($password, PASSWORD_BCRYPT);
	echo "Hashed password: " . $hashed_password . "<br />";
	echo "<br />";
	
	// Verification example
	$wrong_password = "anything_else";
	$is_match = password_verify($wrong_password, $hashed_password);
	echo "Attempt 1: " . ($is_match ? 'correct' : 'wrong') . "<br />";

	$is_match = password_verify($password, $hashed_password);
	echo "Attempt 2: " . ($is_match ? 'correct' : 'wrong') . "<br />";
	echo "<br />";
	echo "<hr />";
	
}

?>

    <p>Set your new password.</p>
    
    <form action="set_password.php" method="POST" accept-charset="utf-8">
      Password: <input type="password" name="password" value="" /><br />
			<br />
      <input type="submit" name="submit" value="Set password" />
    </form>

  </body>
</html>
