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
	require_once("../db/dblogin.php");
	require_once("../db/dbconnect.php");
	$db=new DB();
	//$result=[];
	//$row=[][];
	$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);

	if(isset($_SESSION['No']))
	{
		echo  $_SESSION['No'];
		$memberNo=$_SESSION['No'];
	}

	$sql="SELECT * FROM member where memberNo='$memberNo' ";
	$sql3="SELECT * FROM receiver_info ";
	$result= $db->query($link,$sql);
	$result3= $db->query($link,$sql3);
	$row= mysqli_fetch_row($result);

	$row3= mysqli_fetch_assoc($result3);
	$sql1="SELECT order_info . * 
					FROM member, receiver_info, order_info
					WHERE member.memberNo='$memberNo'
					AND member.memberNo = receiver_info.memberNo
					AND receiver_info.receiverNo = order_info.receiverNo";	//搜尋該會員的訂單表單
	$sql2="SELECT product. * 
					FROM member, receiver_info, order_info, product
					WHERE member.memberNo='$memberNo'
					AND member.memberNo = receiver_info.memberNo
					AND receiver_info.receiverNo = order_info.receiverNo
					AND order_info.productNo = product.productNo";		//搜尋該會員的產品表單
	
	
	
	$result1= $db->query($link,$sql1);
	$result2= $db->query($link,$sql2);
	
	

	$row1= mysqli_fetch_assoc($result1);
	$row2= mysqli_fetch_assoc($result2);


?>