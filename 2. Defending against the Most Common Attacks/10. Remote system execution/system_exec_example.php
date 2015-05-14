<?php
// Remote System Execution example

// escapeshellcmd() escapes characters that might be unsafe for shell commands.
// Characters preceded by a backslash: #&;`|*?~<>^()[]{}$\, \x0A and \xFF.
// ' and " are escaped only if they are not paired.
// In Windows, all these characters plus % are replaced by a space instead.
// Example: exec(escapeshellcmd('ls ~/Desktop'))

// escapeshellarg() makes a string safe for passing to a shell function 
// as a single argument. Does two things:
// 1) adds single quotes around a string
// 2) escapes any existing single quotes in the string
// Example: exec('ls ' . escapeshellarg('~/Desktop'))


$user_input = "echo 'hello'";
// $user_input = "echo 'hello'; echo 'Gotcha!'";
// $user_input = "echo 'hello'; head -n 2 /etc/passwd;";
// $user_input = escapeshellcmd($user_input);

echo "Command: " . $user_input . "<br />";
echo "<br />";

$result = exec($user_input);
echo "Result: " . $result . "<br />";

?>
