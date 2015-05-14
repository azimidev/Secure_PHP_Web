<?php
	require_once('file_upload_functions.php');
?>

<html>
	<head>
		<title>File Upload Example</title>
	</head>
	<body>
		<form action="" method="POST" enctype="multipart/form-data">
			<p>Choose a photo for your profile picture:</p>
			<input type="file" name="profile_picture" /><br />
			<input type="submit" name="submit" value="Upload file" />
		</form>

<?php

// Inspect the values PHP retrieves in $_FILES
echo "<hr />";
var_dump($_FILES);
echo "<hr />";

upload_file('profile_picture');

?>
	</body>
</html>
