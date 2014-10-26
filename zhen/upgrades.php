<?php
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
	require("../db/dblogin.php");
	require("../db/dbconnect.php");
	$db=new DB();
	$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	
	$memberNo=$_SESSION['No'];
	$addsql="INSERT INTO income (spacePurchase,memberNo) values ('999','$memberNo')";
	$result = $db->query($link,$addsql);
	if($result)
	{
		//$_SESSION['capacity']=10;
		echo "<script language='javascript'>";
		echo "alert('購買成功 付款後空間將延長一年');";
		echo "window.location.assign('../index.php');";
		echo "</script>";
	}


?>