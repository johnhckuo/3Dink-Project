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
	if(isset($_SESSION['No']))
	{
		$memberNo=$_SESSION['No'];				
	}
	else 
	{
		echo "<script language='javascript'>";
		echo "alert('尚未登入，請重新登入');";	
		echo "window.location.assign('../index.php');";
		echo "</script>";
		//header("Location: ../index.php"); 
		exit;
	}
	$serialNumber=$_SESSION['serialNumber'];
	$paymentStatus=$_POST['paymentStatus'];
	$paymentTime=$_POST['paymentTime'];
	$afterfiveYards=$_POST['afterfiveYards'];

	$sql = "UPDATE income SET paymentStatus='$paymentStatus', paymentTime='$paymentTime', transferafterfiveYards='$afterfiveYards' WHERE serialNumber='$serialNumber'";
	$result = $db->query($link,$sql);        
	if($result)
	{
		header("Location: total_edit.php"); 
	}

		
?>