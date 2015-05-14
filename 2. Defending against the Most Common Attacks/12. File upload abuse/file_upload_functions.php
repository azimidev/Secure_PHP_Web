<?php
// Form upload functions

// Provides plain-text error messages for file upload errors.
function file_upload_error($error_integer) {
	$upload_errors = array(
		// http://php.net/manual/en/features.file-upload.errors.php
		UPLOAD_ERR_OK 				=> "No errors.",
		UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
	  UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
	  UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
	  UPLOAD_ERR_NO_FILE 		=> "No file.",
	  UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
	  UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
	  UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
	);
	return $upload_errors[$error_integer];
}

// Runs file being uploaded through a series of validations.
// If file passes, it is moved to a permanent upload directory
// and its execute permissions are removed.
function upload_file($field_name) {
	
	if(isset($_FILES[$field_name])) {

		$file_name = $_FILES[$field_name]['name'];
		$file_type = $_FILES[$field_name]['type'];
		$tmp_file  = $_FILES[$field_name]['tmp_name'];
		$error 		 = $_FILES[$field_name]['error'];
		$file_size = $_FILES[$field_name]['size'];

		if($error > 0) {
			// Display errors caught by PHP
			echo "Error: " . file_upload_error($error);
		
		} else {
			// Success!
			echo "File was uploaded without errors.<br />";
			echo "File name is '{$file_name}'.<br />";
			echo "Uploaded file size was {$file_size} bytes.<br />";
			echo "Temp file location: {$tmp_file}<br />";
		}
	}
	
}

?>
