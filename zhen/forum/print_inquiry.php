<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<link rel="stylesheet" type="text/css" href="../css/fixbar.css" >
<link rel="stylesheet" type="text/css" href="../css/print_inquiry.css" >
<?php
	require_once("../db/dblogin.php");
	require_once("../db/dbconnect.php");
	$db=new DB();
	$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	$orderNo=$_POST['order'];
	$sql="SELECT * FROM order_info where orderNo='$orderNo' ";
	$result= $db->query($link,$sql);
	if($result)
	{
		$row= mysqli_fetch_assoc($result);
		$orderStatus=$row['orderStatus'];
		$productNo=$row['productNo'];
	}
	$sql2="SELECT *FROM product WHERE productNo='$productNo' ";
	$result2= $db->query($link,$sql2);
	if ($result2)
	{
		$row2= mysqli_fetch_assoc($result2);
		$productName=$row2['productName'];
		$videoLink=$row2['videoLink'];
	}
?>
</head>
<body style="overflow-x: hidden;background-image:url(../img/bgcolor.png);  color:white">
<div class="navbar navbar-fixed-top" id='headerlink'>
			<div class="navbar-inner" >
				<div class='fixbarleft' id='fixbarleft'><img src='../img/fixbar_left.png'></div>
				<div class="navcontainer" >
					<?php include('login_success.php')?>
					<ul class="nav searchbox">
						<li><input type="text"  placeholder="搜尋" style="font-color:#a1a1a1"></li>
					</ul> 
					<ul class="nav button">
						<li><a href="../jsstl-master/index.html"><img src="../img/print.png"></a></li>
						<li><a href="../displayPlatform/index.html"><img src="../img/platform.png"></a></li>
						<li><a href="../zhen/forum/forum_index.php"><img src="../img/forum.png"></a></li>
					</ul>
					<span class="logo"><a href="../index.php"><img src="../img/print_img/choose.png"></a></span>
					<span class="nav uploadbutton" ><a href="../showMode/file_upload.html"><img src="../img/upload.png"></a></span>
				</div>
				<div class='fixbarright' id='fixbarright'><img src='../img/fixbar_right.png'></div>
			</div>
		</div>
<div>
<div class="middle">
<div class="product_name">
 <?php echo $productName?>
</div>
<div class="order_status">
進度：<?php echo $orderStatus?>
</div>
<div class="vedio_Link">
<iframe width="640" height="390" src="//www.youtube.com/embed/cyF8XOlNzqE" frameborder="0" allowfullscreen></iframe>
<!--<embed src="檔案網址" width="640" height="480" />!-->
</div>
</div>
</div>
</body>
</html>