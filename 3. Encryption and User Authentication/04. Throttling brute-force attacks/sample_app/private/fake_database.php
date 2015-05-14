<?php
// Fake database functions
// For demonstration purposes, it is not worth setting up a whole 
// database. So these functions will fake it by putting a 
// database-like associative array in the session.
// Obviously, in real life, you would use a database and remove
// this file.

function initialize_fake_database() {
	if(!isset($_SESSION['fake_database'])) {
		$users = [
		  [
				'id' => 1, 
				'username' => 'kskoglund', 
				'hashed_password' => password_hash('secret', PASSWORD_BCRYPT)
			], [
				'id' => 2, 
				'username' => 'jsmith',
				'hashed_password' => password_hash('Never73#Guess', PASSWORD_BCRYPT)
			], [
				'id' => 3, 
				'username' => 'ljohnson',
				'hashed_password' => password_hash('Not+A+Password', PASSWORD_BCRYPT)
			]
		];
		$blacklisted_ips = [
			['ip' => '5.5.5.5'], 
			['ip' => '6.6.6.6'], 
			['ip' => '7.7.7.7']
		];
		// There are 3 fake tables in our fake database.
		$_SESSION['fake_database'] = [
			'users' => $users,
			'failed_logins' => [],
			'blacklisted_ips' => $blacklisted_ips
		];
	}
}

function remove_fake_database() {
	$_SESSION['fake_database'] = null;
}

// Search our fake database $table for all records
// where the specified $key has the given $value.
// Returns an array, even if only one record is found.
function find_all_in_fake_db($table, $key, $value) {
	$fake_db = $_SESSION['fake_database'];
	$fake_table = $fake_db[$table];
	$results = [];
  foreach($fake_table as $record) {
    if (isset($record[$key]) && $record[$key] == $value) {
			// This is a matching record, add it to results array
      $results[] = $record;
    }
  }
  return $results;
}

// Returns first matching record or null
function find_one_in_fake_db($table, $key, $value) {
	$results = find_all_in_fake_db($table, $key, $value);
	$result = count($results) > 0 ? $results[0] : null;
  return $result;
}

// Add a new record to the specified fake table
function add_record_to_fake_db($table, $record) {
	$fake_db = $_SESSION['fake_database'];
	$fake_table = $fake_db[$table];

	$fake_table[] = $record;

	// replace old data with updated versions
	$fake_db[$table] = $fake_table;
	$_SESSION['fake_database'] = $fake_db;
	return true;
}

// Update an existing record in fake table
// You must specify the key used to identify the record
// to be updated.
function update_record_in_fake_db($table, $key, $new_record) {
	$fake_db = $_SESSION['fake_database'];
	$fake_table = $fake_db[$table];
	$value = $new_record[$key];
	
	// use a reference (&) so that the update happens to
	// the record in the table.
  foreach($fake_table as &$record) {
    if (isset($record[$key]) && $record[$key] == $value) {
      // This is the record to update
			$record = array_merge($record, $new_record);
    }
  }
	
	// replace old data with updated versions
	$fake_db[$table] = $fake_table;
	$_SESSION['fake_database'] = $fake_db;
	return true;
}

?>
