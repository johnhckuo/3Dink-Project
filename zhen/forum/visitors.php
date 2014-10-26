<?php
	//session_start();
	require_once("../login_success.php");
	require_once("../../db/dblogin.php");
	require_once("../../db/dbconnect.php");
	$db=new DB();
	$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	
	$memberNo=$_SESSION['Account'];
	
?>