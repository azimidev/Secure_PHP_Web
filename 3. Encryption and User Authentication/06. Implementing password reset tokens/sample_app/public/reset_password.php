<?php require_once("../private/initialize.php"); ?>
<?php

// Rather than require setting up a real database, 
// we can fake one instead.
initialize_fake_database();

$message = "";
$token = $_GET['token'];

// Confirm that the token sent is valid
$user = find_user_with_token($token);
if(!isset($user)) {
	// Token wasn't sent or didn't match a user.
	redirect_to('forgot_password.php');
}

if(request_is_post() && request_is_same_domain()) {
	
  if(!csrf_token_is_valid() || !csrf_token_is_recent()) {
  	$message = "Sorry, request was not valid.";
  } else {
    // CSRF tests passed--form was created by us recently.

		// retrieve the values submitted via the form
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    
		if(!has_presence($password) || !has_presence($password_confirm)) {
			$message = "Password and Confirm Password are required fields.";
		} elseif(!has_length($password, ['min' => 8])) {
			$message = "Password must be at least 8 characters long.";
		} elseif(!has_format_matching($password, '/[^A-Za-z0-9]/')) {
			$message = "Password must contain at least one character which is not a letter or a number.";
		} elseif($password !== $password_confirm) {
			$message = "Password confirmation does not match password.";
		} else {
			// password and password_confirm are valid
			// Hash the password and save it to the fake database
			$hashed_password = password_hash($password, PASSWORD_BCRYPT);
			$user['hashed_password'] = $hashed_password;
			update_record_in_fake_db('users', 'username', $user);
			delete_reset_token($user['username']);
			redirect_to('login.php');
		}

	}
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reset Password</title>
  </head>
  <body>

    <?php
      if($message != "") {
        echo '<p>' . h($message) . '</p>';
      }
    ?>

    <p>Set your new password.</p>
    
		<?php $url = "reset_password.php?token=" . u($token); ?>
    <form action="<?php echo $url; ?>" method="POST" accept-charset="utf-8">
      <?php echo csrf_token_tag(); ?>
      Password: <input type="password" name="password" value="" /><br />
			<br />
      Confirm Password: <input type="password" name="password_confirm" value="" /><br />
			<br />
      <input type="submit" name="submit" value="Set password" />
    </form>

<?php
// Uncomment if you want to examine the contents of the fake database
echo "<br /><br />";
echo "--- fake database contents ---";
var_dump($_SESSION['fake_database']);
echo "------------------------------";
?>

  </body>
</html>
