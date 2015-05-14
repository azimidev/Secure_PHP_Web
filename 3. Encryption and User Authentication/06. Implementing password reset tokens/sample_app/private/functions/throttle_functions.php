<?php

// Brute force throttling

// IMPORTANT: The session is used for demonstration purposes only.
// A hacker attempting a brute force attack would not bother to send 
// cookies, which would mean that you could not use the session 
// (which is referenced by a cookie).
// In real life, use a real database.

function record_failed_login($username) {
	$failed_login = find_one_in_fake_db('failed_logins', 'username', sql_prep($username));

	if(!isset($failed_login)) {
		$failed_login = [
			'username' => sql_prep($username), 
			'count' => 1, 
			'last_time' => time()
		];
		add_record_to_fake_db('failed_logins', $failed_login);
	} else {
		// existing failed_login record
		$failed_login['count'] = $failed_login['count'] + 1;
		$failed_login['last_time'] = time();
		update_record_in_fake_db('failed_logins', 'username', $failed_login);
	}
	
	return true;
}

function clear_failed_logins($username) {
	$failed_login = find_one_in_fake_db('failed_logins', 'username', sql_prep($username));

	if(isset($failed_login)) {
		$failed_login['count'] = 0;
		$failed_login['last_time'] = time();
		update_record_in_fake_db('failed_logins', 'username', $failed_login);
	}
	
	return true;
}

// Returns the number of minutes to wait until logins 
// are allowed again.
function throttle_failed_logins($username) {
	$throttle_at = 5;
	$delay_in_minutes = 10;
	$delay = 60 * $delay_in_minutes;
	
	$failed_login = find_one_in_fake_db('failed_logins', 'username', sql_prep($username));

	// Once failure count is over $throttle_at value, 
	// user must wait for the $delay period to pass.
	if(isset($failed_login) && $failed_login['count'] >= $throttle_at) {
		$remaining_delay = ($failed_login['last_time'] + $delay) - time();
		$remaining_delay_in_minutes = ceil($remaining_delay / 60);
		return $remaining_delay_in_minutes;
	} else {
		return 0;
	}
}

?>
