<?php require_once("../private/initialize.php"); ?>

<?php

// Rather than require setting up a real database, 
// we can fake one instead.
initialize_fake_database();

// initialize variables to default values
$username = "";
$password = "";
$message = "";

if(request_is_post() && request_is_same_domain()) {
	
  if(!csrf_token_is_valid() || !csrf_token_is_recent()) {
  	$message = "Sorry, request was not valid.";
  } else {
    // CSRF tests passed--form was created by us recently.

		// retrieve the values submitted via the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    
		if(has_presence($username) && has_presence($password)) {
			
			// Search our fake database to retrieve the user data
			$sqlsafe_username = sql_prep($username);
			$user = find_one_in_fake_db('users', 'username', $sqlsafe_username);
	
	    if($user && password_verify($password, $user['hashed_password'])) {
	    	// successful login
	      after_successful_login();
	      redirect_to('private.php');
	    } else {
	      // failed login
	      $message = "Username/password combination not found.";
	    }

		} else {
			// username or password left blank, just re-display the form.
		}
  }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Log in</title>
  </head>
  <body>
    
    <?php
      if($message != "") {
        echo '<p>' . h($message) . '</p>';
      }
    ?>
    
    <p>Please log in.</p>
    
    <form action="login.php" method="POST" accept-charset="utf-8">
      <?php echo csrf_token_tag(); ?>
      Username: <input type="text" name="username" value="<?php echo h($username); ?>" /><br />
			<br />
      Password: <input type="password" name="password" value="" /><br />
			<br />
      <input type="submit" name="submit" value="Log in" />
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
