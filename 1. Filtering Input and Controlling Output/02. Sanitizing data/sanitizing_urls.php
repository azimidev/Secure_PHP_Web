<?php // URL sanitization

$sanitize = false;

$title = isset($_GET['title']) ? $_GET['title'] : 'nothing yet';

$url_string = "Is URL encoding working? Try it & see.";

if($sanitize) {
	$url_string = urlencode($url_string);
}
?>

Title is: <?php echo $title; ?><br />
<br />
<a href="sanitizing_urls.php?title=<?php echo $url_string; ?>">Add title</a> | 
<a href="sanitizing_urls.php">Clear title</a><br />
