<?php
session_start();
	if( !isset($_SESSION['No']))
	{
		echo "<script language='javascript'>";
		echo "alert('尚未登入，請重新登入');";	
		echo "window.location.assign('../index.php');";
		echo "</script>";
		exit;
	}
	//require_once("../db/dblogin.php");
	//require_once("../db/dbconnect.php");
	if(isset($_GET['value'])){
		$db=new DB();
		$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	//
	$sql2 = "UPDATE  `3dprinter`.`platform` SET  `Score` =  '$row[0]',`rateNumber` =  '$row[1]' WHERE  `pictureNo` = '$no'";
		$result = $db->query($link,$sql2);
		
	}else{
		echo "Connection Failure";
	}
	


?>