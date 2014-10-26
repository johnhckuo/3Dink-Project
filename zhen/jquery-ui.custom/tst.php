<?php 
		$Account = $_POST['Account'];
		$Password = $_POST['Password'];
		
		require_once("../../db/dblogin.php");
		require_once("../../db/dbconnect.php");
		$db=new DB();
		$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
		$sql="SELECT * FROM member where Account = '$Account' ";
		$result = $db->query($link,$sql);
		$row = mysqli_fetch_assoc($result);

?>