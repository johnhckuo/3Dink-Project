<html lang="zh-tw">
<!DOCTYPE html>
<meta charset="utf-8" />
<head>
<title>列印進度</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<link rel="stylesheet" type="text/css" href="../css/fixbar.css" >
<link rel="stylesheet" type="text/css" href="../css/print_inquiry.css" >
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
	$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	if (isset($_POST['order'])) {
		$orderNo=$_POST['order'];

	}
	else if (isset($_GET[orderNo])) {
		$orderNo=$_GET[orderNo];
	}
	$sql="SELECT * FROM order_info where orderNo='$orderNo' ";  
	
	$result= $db->query($link,$sql);
	if($result)//訂單資訊
	{
		$row= mysqli_fetch_assoc($result);
		$orderStatus=$row['orderStatus'];
		$productNo=$row['productNo'];
	}
	$sql2="SELECT   `productName` ,  ` videoLink` ,  `printStatus`  FROM product WHERE productNo='$productNo' ";
	$result2= $db->query($link,$sql2);
	if ($result2)//產品資訊
	{
		$row2= mysqli_fetch_row($result2);
		$productName=$row2[0];
		$videoLink=$row2[1];
		$printStatus=$row2[2];
	}
	$sql3="SELECT paymentStatus FROM income WHERE productionNo='$productNo' ";
	$result3= $db->query($link,$sql3);
	if ($result3)//付款狀態
	{
		$row3= mysqli_fetch_row($result3);
		$paymentStatus=$row3[0];
	}
?>
<style type="text/css">
.print_cancle{
	position: absolute;
	left: 770px;
	top: 670px

}
</style>
</head>
<body style="overflow-x: hidden;margin:0 0 0 0 ;background-color:#333333;">
	<div class='frame' id='frame'>
		<div class="navbar navbar-fixed-top" id="headerlink">
			<div class="navbar-inner" id="navbar-inner">
				<div class="navcontainer" >
					<?php include('../zhen/login_success.php')  ?>
					<ul class="nav searchbox">
						<li><input type="text" id='searchbox'  placeholder="搜尋" style="font-color:#a1a1a1" onkeydown="search()"></li>
					</ul> 
					<ul class="nav button">
						<li><a href="../three"><img src="img/forum.png"></a></li>
						<li><a href="../jsstl-master/index.php"><img src="img/print.png"></a></li>
						<li><a href="../newShowmode/index.php"><img src="img/platform.png"></a></li>
						<li><a href="../zhen/forum/forum_index.php"><img src="img/forum.png"></a></li>	
					</ul>
					<span class="logo"><a href="../index.php"><img src="../img/print_img/choose.png"></a></span>
					<span class="nav uploadbutton" ><a href="/showMode/file_upload.php"><img src="../img/upload.png"></a></span>
				</div>
			</div>
		</div>

		<div class="middle">
			<div class="product_name">
				<?php echo $productName?>
			</div>
			<div class="video_Link">
				<div  class="order_status">
					進度：
					<?php 

						if($paymentStatus==0 )
						{
							echo "尚未付款";
						}
						else if( $printStatus==0)
						{
							echo "等待列印";
						}
						else if($printStatus==1)
						{
							echo "列印中";
						}
						else if( $printStatus==2)
						{
							echo "列印完成";
						}
					?>
				</div>
			<img src="http://140.127.220.81:8080/?action=stream" <!--id='embed' -->/>
		<!--	<div id="printer_introduce"><embed src="Produce.mp4" width="640" height="480"  autostart="true"></embed></div> -->
			</div>
		</div>
		<div class='payment' id='payment' style="display:none">
			<a href="manage.php"  class="button2" style="width:70px;">付款完成</a>
		</div>
		<div class="previous_page">
			<a href="manage.php"  class="button2">上一頁</a>
		</div>
		<div class="print_cancle" id="print_cancle">
			<a href="" class="button2" style="width:70px;">取消列印</a>
		</div>
	</div>
	<script type="text/javascript" src="../js/search.js"></script>
	<script type="text/javascript" >
		var orderStatus= <?php echo $orderStatus?>;
		var printStatus=<?php echo $printStatus?>;
		//var paymentStatus=<?echo $paymentStatus[0]; ?>;
		var embed=document.getElementById('embed');
		var printer_introduce=document.getElementById('printer_introduce');
		var print_cancle=document.getElementById('print_cancle');
		var payment=document.getElementById('payment');
		if(printStatus==0 ){
			embed.style.display='none';//即時影像隱藏
		}
		else if(printStatus==1 ){
			printer_introduce.style.display='none';//介紹影片影藏
		}
		else if(printStatus==2 ){
			embed.style.display='none';//即時影像隱藏
		}
		/*
		if(paymentStatus==1){
			payment.style.display='none';
		}*/
	
	</script>
	
</body>
</html>