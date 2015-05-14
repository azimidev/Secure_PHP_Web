<?php
// Form upload functions

// Configuration

// Where to store uploaded files?
// Choose a directory outside of the public path, unless the file 
// should be publicly visible/accessible.
// Examples:
//   job application => private
//   website profile photo => public
// Of course, when outside the public path, you need PHP code that can
// access those files. The browser can't access them directly.
$upload_path = "/Users/kevinskoglund/Sites/04_defenses/file_uploads";


// Provides plain-text error messages for file upload errors.
function file_upload_error($error_integer) {
	$upload_errors = array(
		// http://php.net/manual/en/features.file-upload.errors.php
		UPLOAD_ERR_OK 			=> "No errors.",
		UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
		UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
		UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
		UPLOAD_ERR_NO_FILE 		=> "No file.",
		UPLOAD_ERR_NO_TMP_DIR 	=> "No temporary directory.",
		UPLOAD_ERR_CANT_WRITE 	=> "Can't write to disk.",
		UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
	);
	return $upload_errors[$error_integer];
}

// Sanitizes a file name to ensure it is harmless
function sanitize_file_name($filename) {
	// Remove characters that could alter file path.
	// I disallowed spaces because they cause other headaches.
	// "." is allowed (e.g. "photo.jpg") but ".." is not.
	$filename = preg_replace("/([^A-Za-z0-9_\-\.]|[\.]{2})/", "", $filename);
	// basename() ensures a file name and not a path
	$filename = basename($filename);
	return $filename;
}

// Returns the file permissions in octal format.
function file_permissions($file) {
	// fileperms returns a numeric value
	$numeric_perms = fileperms($file);
	// but we are used to seeing the octal value
	$octal_perms = sprintf('%o', $numeric_perms);
	return substr($octal_perms, -4);
}


// Runs file being uploaded through a series of validations.
// If file passes, it is moved to a permanent upload directory
// and its execute permissions are removed.
function upload_file($field_name) {
	global $upload_path;
	
	if(isset($_FILES[$field_name])) {

		// Sanitize the provided file name.
		$file_name = sanitize_file_name($_FILES[$field_name]['name']);
		
		// Even more secure to assign a new name of your choosing.
		// Example: 'file_536d88d9021cb.png'
		// $unique_id = uniqid('file_', true); 
		// $new_name = "{$unique_id}.{$file_extension}";
		
		$file_type = $_FILES[$field_name]['type'];
		$tmp_file = $_FILES[$field_name]['tmp_name'];
		$error = $_FILES[$field_name]['error'];
		$file_size = $_FILES[$field_name]['size'];

		// Prepend the base upload path to prevent hacking the path
		// Example: $file_name = '/etc/passwd' becomes harmless
		$file_path = $upload_path . '/' . $file_name;

		if($error > 0) {
			// Display errors caught by PHP
			echo "Error: " . file_upload_error($error);
		
		} elseif(!is_uploaded_file($tmp_file)) {
			echo "Error: Does not reference a recently uploaded file.<br />";	

		} elseif(file_exists($file_path)) {
			// if destination file exists it will be over-written
			// by move_uploaded_file()
			echo "Error: A file with that name already exists in target location.<br />";
			// Could rename or force user to rename file.
			// Even better to store in uniquely-named subdirectories to
			// prevent conflicts.
			// For example, if the database record ID for an image is 1045: 
			// "/uploads/profile_photos/1045/uploaded_image.png"
			// Because no other profile_photo has that ID, the path is unique.

		} else {
		
			// Success!
			echo "File was uploaded without errors.<br />";
			echo "File name is '{$file_name}'.<br />";
			echo "File references an uploaded file.<br />";
			echo "Uploaded file size was {$file_size} bytes.<br />";
			echo "Temp file location: {$tmp_file}<br />";
		
			// move_uploaded_file has is_uploaded_file() built-in
			if(move_uploaded_file($tmp_file, $file_path)) {
				echo "File moved to: {$file_path}<br />";

				// remove execute file permissions from the file
				if(chmod($file_path, 0644)) {
					echo "Execute permissions removed from file.<br />";
					$file_permissions = file_permissions($file_path);
					echo "File permissions are now '{$file_permissions}'.<br />";
				} else {
					echo "Error: Execute permissions could not be removed.<br />";
				}

			}
		}
	
	}

}

?>
