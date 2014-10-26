<?php

/* RECEIVE VALUE */
$validateValue=$_REQUEST['fieldValue'];
$validateId=$_REQUEST['fieldId'];


$validateError= "This username is already taken";
$validateSuccess= "This username is available";

/* RETURN VALUE */
	$arrayToJs = array();
	$arrayToJs[0] = $validateId;

require("/var/www/db/dblogin.php");
require("/var/www/db/dbconnect.php");
$db=new DB();
$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);

$sql="SELECT Account FROM member WHERE Account='$validateValue'";
$result=$db->query($link,$sql);
$row=mysqli_fetch_row($result);
	

if($validateValue != $row[0]){		// validate??
	$arrayToJs[1] = true;			// RETURN TRUE
	echo json_encode($arrayToJs);			// RETURN ARRAY WITH success
}else{
	for($x=0;$x<1000000;$x++){
		if($x == 990000){
			$arrayToJs[1] = false;
			echo json_encode($arrayToJs);		// RETURN ARRAY WITH ERROR
		}
	}
	
}

?>