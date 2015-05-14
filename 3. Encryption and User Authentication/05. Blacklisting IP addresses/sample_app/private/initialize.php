<?php

// Perform all initialization here, in private

// Set constants to easily reference public 
// and private directories
define("APP_ROOT", dirname(dirname(__FILE__)));
define("PRIVATE_PATH", APP_ROOT . "/private");
define("PUBLIC_PATH", APP_ROOT . "/public");

session_start();

require_once(PRIVATE_PATH . "/fake_database.php");
require_once(PRIVATE_PATH . "/functions/general_functions.php");

require_once(PRIVATE_PATH . "/functions/blacklist_functions.php");
require_once(PRIVATE_PATH . "/functions/csrf_request_type_functions.php");
require_once(PRIVATE_PATH . "/functions/csrf_token_functions.php");
require_once(PRIVATE_PATH . "/functions/request_forgery_functions.php");
require_once(PRIVATE_PATH . "/functions/session_hijacking_functions.php");
require_once(PRIVATE_PATH . "/functions/sqli_escape_functions.php");
require_once(PRIVATE_PATH . "/functions/throttle_functions.php");
require_once(PRIVATE_PATH . "/functions/validation_functions.php");
require_once(PRIVATE_PATH . "/functions/xss_sanitize_functions.php");

?>
