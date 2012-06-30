<?php
	// If a file path is passed in, open it and get its contents
	if (isset($_GET['file'])) {
		$response = file_get_contents($_GET['file']);
	}
	
	// If file contents are passed in, update the file with the new contents
	if (isset($_POST['code'])) {
		$code = $_POST['code'];
		$file = $_POST['file'];
		
		$code = trim(stripslashes($code));
		
		if (file_put_contents($file, $code) !== false){
			$alert['type'] = "alert-success";
			$alert['message'] = "File saved successfully.";
			$response = 'success';
		}
		else {
			$alert['type'] = "alert-error";
			$alert['message'] = "There was a problem saving the file.";
			$response = 'fail';
		}
	}
	
	echo $response;