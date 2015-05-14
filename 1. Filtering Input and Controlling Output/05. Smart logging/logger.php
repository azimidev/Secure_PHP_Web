<?php

// log file must exist and have permissions set that allow writing
// Example in Unix: chmod 777 errors.log
$log_file = 'errors.log';

// An ultra-simple file logger
function logger($level="ERROR", $msg="") {
	global $log_file;
	
	// Ensure all messages have a final line return
	$log_msg = $level . ": " . $msg . PHP_EOL;
	
	// FILE_APPEND adds content to the end of the file
	// LOCK_EX forbids writing to the file while in use by us
	file_put_contents($log_file, $log_msg, FILE_APPEND | LOCK_EX);
}

logger("ERROR", "An unknown error occurred");
logger("DEBUG", "x is 1");

echo "Logged";


// Other loggers you can try:
// https://github.com/apache/logging-log4php
// https://github.com/katzgrau/KLogger
// https://github.com/Seldaek/monolog
// https://github.com/jbroadway/analog

// Frameworks have their own logging:
// http://framework.zend.com/manual/1.12/en/zend.log.html

?>
