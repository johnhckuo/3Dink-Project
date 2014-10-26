<?php
$uploaddir="upload";
foreach ($_FILES["ff"]["error"] as $key => $error) {
		if ($error == UPLOAD_ERR_OK) {
			$tmp_name = $_FILES["ff"]["tmp_name"][$key];
			$name = $_FILES["ff"]["name"][$key];
			move_uploaded_file($tmp_name, "$uploaddir/$name");
		}
}
?>


