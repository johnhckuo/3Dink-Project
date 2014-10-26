<?php
	@$Account=$_SESSION['Account'];
	@$facebookID=$_SESSION['id'];
	require_once("/var/www/db/dblogin.php");
	require_once("/var/www/db/dbconnect.php");
	$db=new DB();
	$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	/*if($Account){
		$sql="SELECT introduction FROM member WHERE Account = '$Account' ";
		$sql2="SELECT memberNo FROM member WHERE Account = '$Account' ";
		$sql4="SELECT pPath FROM member WHERE Account = '$Account' ";
	}
	else if($facebookID){
		$sql="SELECT introduction FROM member WHERE facebookID = '$facebookID' ";
		$sql2="SELECT memberNo FROM member WHERE facebookID = '$facebookID' ";
		$sql4="SELECT pPath FROM member WHERE facebookID = '$facebookID' ";
	}*/
	$memberNo=$_GET['memberNo'];//作者編號
	$sql="SELECT introduction FROM member WHERE memberNo = ".$memberNo." ";
	$result = $db->query($link,$sql);//作者介紹
	$row = mysqli_fetch_row($result);
	//$result2 = $db->query($link,$sql2);//作者編號
	//$row2 = mysqli_fetch_assoc($result2);
	$sql3="SELECT Nickname FROM member WHERE memberNo = ".$memberNo." ";
	$result3 = $db->query($link,$sql3);//作者名稱
	$row3 = mysqli_fetch_row($result3);
	$sql4="SELECT pPath,Account,facebookID FROM member WHERE memberNo = ".$memberNo." ";
	$result4 = $db->query($link,$sql4);//作者圖片
	$row4 = mysqli_fetch_row($result4);
	
	if(isset($row4[1])){	
		echo"<span class='personal_pic'><img src='".$row4[0]."'></span>";
	}
	else if(isset($row4[2])){
		//echo"<span class='personal_pic'><img src='http://graph.facebook.com/".$row4[0]."/picture'></span>";
		echo"<span class='personal_pic'><img src='".$row4[0]."'></span>";
	}
	
	if($row['0']){
		echo "<span class='mid_about'>關於".$row3[0]."</span>";
		echo "<div>".@$row['0']."</div>";	
	}
	else{
		echo "<span class='mid_about'>關於".$row3[0]."</span>";
		echo "<div style='padding:10 10 10 10'>";
		echo "你好，我是".$row3[0]."";
		echo "</div>";
	}
	
?>