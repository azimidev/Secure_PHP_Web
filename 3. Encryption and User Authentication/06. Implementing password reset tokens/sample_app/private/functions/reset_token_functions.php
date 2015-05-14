<?php
// Reset token functions

// This function generates a string that can be
// used as a reset token.
function reset_token() {
	return md5(uniqid(rand()));
}

// Looks up a user and sets their reset_token to
// the given value. Can be used both to create and
// to delete the token.
function set_user_reset_token($username, $token_value) {
	$user = find_one_in_fake_db('users', 'username', sql_prep($username));
	
	if($user) {
		$user['reset_token'] = $token_value;
		update_record_in_fake_db('users', 'username', $user);
		return true;
	} else {
		return false;
	}
	
}

// Add a new reset token to the user
function create_reset_token($username) {
	$token = reset_token();
	return set_user_reset_token($username, $token);
}

// Remove any reset token for this user.
function delete_reset_token($username) {
	$token = null;
	return set_user_reset_token($username, $token);
}

// Returns the user record for a given reset token.
// If token is not found, returns null.
function find_user_with_token($token) {
	if(!has_presence($token)) {
		// We were expecting a token and didn't get one.
		return null;
	} else {
		$user = find_one_in_fake_db('users', 'reset_token', sql_prep($token));
		// Note: find_one_in_fake_db returns null if not found.
		return $user;
	}
}

// A function to email the reset token to the email
// address on file for this user.
// This is a placeholder since we don't have email
// abilities set up in the demo version.
function email_reset_token($username) {
	$user = find_one_in_fake_db('users', 'username', sql_prep($username));
	
	if($user) {
		// This is where you would connect to your emailer
		// and send an email with a URL that includes the token.
		return true;
	} else {
		return false;
	}
}

?>
