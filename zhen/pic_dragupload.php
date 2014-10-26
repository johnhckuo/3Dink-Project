<?php
/*
foreach ($_FILES["ff"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$tmp_name = $_FILES["ff"]["tmp_name"][$key];
				$name = $_FILES["ff"]["name"][$key];
				move_uploaded_file($tmp_name, "$uploads_dir/$name");
			}
		}*/
	session_start();
	if( !isset($_SESSION['No']))
	{
		echo "<script language='javascript'>";
		echo "alert('尚未登入，請重新登入');";	
		echo "window.location.assign('../index.php');";
		echo "</script>";
		exit;
		//header('../index.php');
		//exit;
	}	
	$uploads_dir = 'ads_picture';	
	$_FILES["ff"]["error"] => $error;
			if ($error == UPLOAD_ERR_OK) {
				$tmp_name = $_FILES["ff"]["tmp_name"];
				$name = $_FILES["ff"]["name"];
				move_uploaded_file($tmp_name, "$uploads_dir/$name");
			}
?>