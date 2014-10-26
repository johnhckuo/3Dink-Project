<?php 
	if (isset($_GET['value']) && isset($_GET['no'])){
		$no = $_GET['no'];
	
		require_once("../db/dblogin.php");
		require_once("../db/dbconnect.php");
		$db=new DB();
		$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
		$sql = "SELECT Score,rateNumber from platform WHERE pictureNo = '$no'";
		$result = $db->query($link,$sql);
		$row = mysqli_fetch_row($result);
		$row[0]+=$_GET['value'];
		$row[1]++;
		
		
		$sql2 = "UPDATE  `3dprinter`.`platform` SET  `Score` =  '$row[0]',`rateNumber` =  '$row[1]' WHERE  `pictureNo` = '$no'";
		$result = $db->query($link,$sql2);
		
	}else{
		echo "Connection Failure";
	}
		
	
?>