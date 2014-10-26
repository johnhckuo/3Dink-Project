<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php session_start();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
</head>
<body>
<?php
	//$Account = $_POST['Account'];
	//$Password = $_POST['Password'];
	$Account='zxc';

	require_once("../db/dblogin.php");
	require_once("../db/dbconnect.php");
	$db=new DB();
	$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	$sql="SELECT * FROM member where Account = '$Account' ";
	$result = $db->query($link,$sql);
	echo print_r ($result);
	

/*
	if($Account != null && $Password != null && $row["Account"] == $Account && $row["Password"] == $Password)
	{
		$_SESSION['Account'] = $Account;
		$_SESSION['No'] = $row["memberNo"];
		echo '登入成功';
		//header("Location:../index.php" );
		exit();
	}
	else
	{
		echo '登入失敗，請重新登入';
		//header("Location:login.php" );
		exit();
	}*/
?>
</body>
</html>



