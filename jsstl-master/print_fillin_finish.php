<?php
	session_start();
	if( !isset($_SESSION['No']) )
	{
		echo "<script language='javascript'>";
		echo "alert('尚未登入，請重新登入');";	
		echo "window.location.assign('../zhen/login.php');";
		echo "</script>";
		exit;
		//header('../index.php');
		//exit;
	}
	
	require_once("../db/dblogin.php");
	require_once("../db/dbconnect.php");
	$db=new DB();
	$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	
	$memberNo = $_SESSION['No'];
	$receiverName = $_POST['receiverName'];
	$receiverAddress = $_POST['receiverAddress'];
	$receiverTelephone = $_POST['receiverTelephone'];
	$printCost=$_POST['printCost'];
	$freight=$_POST['freight'];
	$productNo=$_POST['productNo'];

	$addsql="INSERT INTO receiver_info(receiverName,receiverAddress,receiverTelephone,memberNo) VALUES ('$receiverName','$receiverAddress','$receiverTelephone','$memberNo')";
	$result = $db->query($link,$addsql);//新增收件資訊
	$searchsql="SELECT receiverNo FROM receiver_info WHERE memberNo='$memberNo' ORDER BY receiverNo DESC limit  1";
	$result2 = $db->query($link,$searchsql); 
	$receiverNo = mysqli_fetch_row($result2);//剛剛新增的收件資訊編號

	$addsql2="INSERT INTO  order_info(productNo,receiverNo) VALUES ('$productNo','$receiverNo[0]')";
	$result3 = $db->query($link,$addsql2);//新增訂單*/

	$searchsq2="SELECT orderNo FROM order_info WHERE receiverNo='$receiverNo[0]' ORDER BY orderNo DESC limit  1";
	$result4 = $db->query($link,$searchsq2);//搜尋訂單編號
	$orderNo= mysqli_fetch_row($result4);

	$addsql3="INSERT INTO  income(printingCost,Freight,memberNo,productionNo) VALUES ('$printCost','$freight','$memberNo','$productNo')";
	$result5 = $db->query($link,$addsql3);//新增收入

	if($result && $result2 && $result3 && $result4 && $result5){
		$url="../zhen/print_inquiry.php?orderNo=".$orderNo[0];
		echo "<script language='javascript'>";
		echo "alert('付款後進入列印排程');";	
		echo "window.location.assign('$url');";
		echo "</script>";
		//header("Location:$url");
	}
?>