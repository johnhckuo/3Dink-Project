<?php

/* RECEIVE VALUE */
$accountValue=$_REQUEST['Account'];
$passwordValue=$_REQUEST['Password'];


$validateError= "This username is already taken";
$validateSuccess= "This username is available";

	/* RETURN VALUE */
	$arrayToJs = array();
	$arrayToJs[0] = array();
	$arrayToJs[1] = array();

require("/var/www/db/dblogin.php");
require("/var/www/db/dbconnect.php");
$db=new DB();
$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);

$sql="SELECT Account,Password FROM member WHERE Account='$accountValue'";
$result=$db->query($link,$sql);
$row=mysqli_fetch_row($result);

	
if($userValue == $row[0]){		// validate??
	$arrayToJs[0][0] = 'Account';
	$arrayToJs[0][1] = true;			// RETURN TRUE
	$arrayToJs[0][2] = "This user is available";
			// RETURN ARRAY WITH success
}else{
	$arrayToJs[0][0] = 'Account';
	$arrayToJs[0][1] = false;
	$arrayToJs[0][2] = "This user is already taken";
}

if($nameValue ==$row[1]){		// validate??
	$arrayToJs[1][0] = 'Password';
	$arrayToJs[1][1] = true;			// RETURN TRUE
			// RETURN ARRAY WITH success
}else{
	$arrayToJs[1][0] = 'Password';
	$arrayToJs[1][1] = false;
	$arrayToJs[1][2] = "This name is already taken";
}




	echo json_encode($arrayToJs);

?>