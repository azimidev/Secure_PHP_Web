<?php
// Put all of your general functions in this file

// header redirection often requires output buffering 
// to be turned on in php.ini.
function redirect_to($new_location) {
  header("Location: " . $new_location);
  exit;
}

?>
