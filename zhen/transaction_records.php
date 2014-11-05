<!DOCTYPE>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
	<link rel="stylesheet" type="text/css" href="../css/fixbar.css" >
	<title>交易紀錄</title>
	 
	<style type="text/css">
		.transaction{
			position:relative;
			width:940px;
			margin-left:auto;
			margin-right:auto;
			top:150px;
			font-family:Microsoft JhengHei;
			color:#a1a1a1 !important;
			
		}
		.transaction_table td{
			color:#a1a1a1;
		}
		.transaction_span{
			margin:10px 10px 10px 10px;
			font-family:Microsoft JhengHei;
			font-size:24px;
			color:rgb(255, 184, 0);
			font-weight: bold;
		}
		.transaction_table{
			margin:10px 10px 10px 10px;
			border:2px solid;
			border-color:#a1a1a1;
			text-align:center;
			
		}

		.button_div{
			margin-top:40px;
			margin-left:10px;
			width:100px;
		}
		.button1 {
			opacity:0.7;
			background-color:#000000;
			-webkit-border-radius:3px;
			border-radius:3px;
			border:1px solid #858a88;
			display:inline-block;
			cursor:pointer;
			color:#ffffff;
			font-family:arial;
			font-size:15px;
			font-weight:bold;
			padding:6px 24px;
			text-decoration:none;
			margin-top:20px;
		}
		.button1:hover {
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #0d1515), color-stop(1 , #4d4c4c));
			background:-webkit-linear-gradient(top, #0d1515 10%, #4d4c4c 100%);
			background:linear-gradient(to bottom, #0d1515 10%, #4d4c4c 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#0d1515', endColorstr='#4d4c4c',GradientType=0);
			background-color:#000000;
		}
	</style>
	<?php
	session_start();
		require_once("../db/dblogin.php");
		require_once("../db/dbconnect.php");
		$db=new DB();
		$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
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
	?>

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
		
		<div class='transaction'>	

		<?php
			if(isset($_SESSION['No']))
			{
				$memberNo=$_SESSION['No'];
			}
				$transactionType=$_POST['transactionType'];
				//列印費用
				if ($transactionType==1)
				{
					echo "<table class='transaction_table' rules='all'>";
					echo "<tr><td>作品名稱</td><td>金額</td><td>付款狀態</td><td>付款時間</td></tr>";
					$sql="SELECT * FROM income WHERE printingCost != 'NULL' AND memberNo='$memberNo'";
					$result=$db->query($link,$sql);
					
					while($row= mysqli_fetch_assoc($result))
					{
						$sql2 = "SELECT product.* FROM product,income WHERE product.productNo='$row[productionNo]'";
						$result2=$db->query($link,$sql2);
						$pName= mysqli_fetch_assoc($result2);					
						if($row['paymentStatus']==0)	
						{						
							echo "<tr><td>".$pName['productName']."</td><td>$".$row['printingCost']."</td><td>未付款</td><td></td></tr>";
						}
						else
						{						
							echo "<tr><td>".$pName['productName']."</td><td>$".$row['printingCost']."</td><td>已付款</td><td>".$row2['paymentTime']."</td></tr>";
						}
					}
				}
				//空間購買
				else if ($transactionType==2)
				{
					echo "<table class='transaction_table' rules='all'>";
					echo "<span class='transaction_span'>空間到期時間計算：從付款後開始計算一年</span>";
					echo "<tr><td>金額</td><td>付款狀態</td><td>付款時間</td><td>空間到期時間</td></tr>";
					$sql="SELECT * FROM income WHERE spacePurchase != 'NULL' AND memberNo='$memberNo'";
					$result=$db->query($link,$sql);
					while($row= mysqli_fetch_assoc($result))
					{
						if($row['paymentStatus']==0)	
						{						
							echo "<tr><td>$".$row['spacePurchase']."</td><td>未付款</td><td></td><td>目前無法計算</td></tr>";
						}
						else
						{												
							$paymentTime=date($row['paymentTime']);
							$maturity= date('Y-m-d',strtotime("{$paymentTime} +1 year"));
							$today=date("Y-m-d ");
							echo "<tr><td>$".$row['spacePurchase']."</td><td>已付款</td><td>".$row['paymentTime']."</td><td>".$maturity."</td></tr>";
						}
					}
					$sql2="SELECT paymentTime FROM income WHERE spacePurchase != 'NULL' AND memberNo='$memberNo' ORDER BY serialNumber DESC LIMIT 1";
					$result2=$db->query($link,$sql2);
					$row2= mysqli_fetch_row($result2);
					$paymentTime=date($row2[0]);
					$maturity= date('Y-m-d',strtotime("{$paymentTime} +1 year"));
					//$today=date("Y-m-d ");
					//$date=date("M-d-Y ",mktime(0,0,0,0,0,0000));
					//echo $row2[0]		;		
					if($paymentTime!=NULL &&  $row2[0]!="0000-00-00")
					{
						if(date('Y-m-d',strtotime("{$today} -1 year +10day"))>=$paymentTime)
						{
							echo "<a class='button1' href='javascript: return false;' onclick='confirm1()'>延長空間期限</a>"	;			
						}
					}	
				}
				//廣告購買
				else if ($transactionType==3)
				{				
					echo "<table class='transaction_table' rules='all'>";
					echo "<span class='transaction_span'>廣告到期時間計算：從付款後開始計算</span>";
					echo "<tr><td>廣告大小</td><td>購買天數</td><td>金額</td><td>付款狀態</td><td>付款時間</td><td>廣告到期時間</td></tr>";
					$sql="SELECT income.* FROM income,ads_purchase WHERE income.adsPurchase != 'NULL' AND income.ads_purchaseNo=ads_purchase.purchaseNo AND ads_purchase.buyerNo='$memberNo'";
					$result=$db->query($link,$sql);
					if($result)
					{
						while($row= mysqli_fetch_assoc($result))
						{						
							$sql2="SELECT * FROM ads_purchase WHERE buyerNo=$memberNo";
							$result2=$db->query($link,$sql2);
							$adsType= mysqli_fetch_assoc($result2);		
							if($row['paymentStatus']==0)	
							{						
								echo "<tr><td>".$adsType['adsSize']."</td><td>".$adsType['expirationDate']."天</td><td>$".$row['adsPurchase']."</td><td>未付款</td><td></td><td>目前無法計算</td></tr>";
							}
							else if($row['paymentStatus']==1)	
							{												
								$day=date($row['paymentTime']);
								$maturity= date('Y-m-d',strtotime("{$day} +{$adsType['expirationDate'] } day"));
								echo "<tr><td>".$adsType['adsSize']."</td><td>".$adsType['expirationDate']."天</td><td>$".$row['adsPurchase']."</td><td>已付款</td><td>".$row['paymentTime']."</td><td>".$maturity."</td></tr>";														
							}				
						}	
					}
					/*
					else if($row= mysqli_fetch_assoc($result))
					{	
						echo "<table>";
						echo "<p style='margin-top: 150px; font-family: 微軟正黑體; font-size: larger; color: rgb(255, 184, 0); font-weight: bold;'>目前無交易紀錄</p>";
					}
					*/
				}
				//列印授權費用(支出)
				else if ($transactionType==4)
				{
					echo "<table class='transaction_table' rules='all'>";
					echo "<span class='transaction_span'>金額包含15%的佣金</span>";
					echo "<tr><td>作品名稱</td><td>作品作者</td><td>金額</td><td>付款狀態</td><td>付款時間</td></tr>";
					$sql="SELECT income.* FROM income,print_authorization WHERE income.printauthorizeCommission != 'NULL' AND income.print_authorizationNo=print_authorization.printauthorizationNo AND print_authorization.Purchaser='$memberNo'";
					$result=$db->query($link,$sql);				
					while($row= mysqli_fetch_assoc($result))
						{												
							$sql2="SELECT * FROM print_authorization WHERE printauthorizationNo=$row[print_authorizationNo] ";						
							$result2=$db->query($link,$sql2);
							$p_authorization= mysqli_fetch_assoc($result2);
							$sql3="SELECT product.* FROM product,print_authorization WHERE product.productNo='$p_authorization[product]'";	
							$result3=$db->query($link,$sql3);
							$product= mysqli_fetch_assoc($result3);
							$sql4="SELECT * FROM member WHERE memberNo=$p_authorization[Owner]";
							$result4=$db->query($link,$sql4);
							$ownerName= mysqli_fetch_assoc($result4);
							if($p_authorization['purchaserpaymentStatus']==0)	
							{						
								echo "<tr><td>".$product['productName']."</td><td>".$ownerName['Nickname']."</td><td>$".$p_authorization['authorizationPrice']."</td><td>未付款</td><td></td></tr>";
							}
							else if($p_authorization['purchaserpaymentStatus']==1)	
							{												
								echo "<tr><td>".$product['productName']."</td><td>".$ownerName['Nickname']."</td><td>$".$p_authorization['authorizationPrice']."</td><td>已付款</td><td>".$row['paymentTime']."</td></tr>";														
							}				
						}	
					
				}
				//列印授權費用(收入)
				else if ($transactionType==5)
				{
					echo "<table class='transaction_table' rules='all'>";
					echo "<span class='transaction_span'>金額已扣除15%的佣金，金額相加大於1000本站才會予以匯款</span>";
					echo "<tr><td>作品名稱</td><td>作品購買人</td><td>金額</td><td>匯款狀態</td><td>匯款時間</td></tr>";
					$sql="SELECT income.* FROM income,print_authorization WHERE income.printauthorizeCommission != 'NULL' AND income.print_authorizationNo=print_authorization.printauthorizationNo AND print_authorization.Owner='$memberNo'";
					$result=$db->query($link,$sql);
					$total=0;
					while($row= mysqli_fetch_assoc($result))
						{						
							$sql2="SELECT * FROM print_authorization WHERE printauthorizationNo=$row[print_authorizationNo]"; 					
							$result2=$db->query($link,$sql2);
							$p_authorization= mysqli_fetch_assoc($result2);
							$sql3="SELECT product.* FROM product,print_authorization WHERE product.productNo='$p_authorization[product]'";	
							$result3=$db->query($link,$sql3);
							$product= mysqli_fetch_assoc($result3);
							$sql4="SELECT member.* FROM member, print_authorization WHERE member.memberNo='$p_authorization[Purchaser]'";
							$result4=$db->query($link,$sql4);
							$puchaserName= mysqli_fetch_assoc($result4);						
							if($p_authorization['ownerreceivingState']==0)	
							{						
								$authorizationPrice0=$p_authorization['authorizationPrice']-($p_authorization['authorizationPrice']*0.15);
								echo "<tr><td>".$product['productName']."</td><td>".$puchaserName['Nickname']."</td><td>$".(int)$authorizationPrice0."</td><td>未匯款</td><td></td></tr>";
								$total=$total+(int)$authorizationPrice0;
							}
							else if($p_authorization['ownerreceivingState']==1)	
							{												
								$authorizationPrice1=$p_authorization['authorizationPrice']-($p_authorization['authorizationPrice']*0.15);
								echo "<tr><td>".$product['productName']."</td><td>".$puchaserName['Nickname']."</td><td>$".(int)$authorizationPrice1."</td><td>已匯款</td><td>".$p_authorization['ownerreceivingTime']."</td></tr>";			
							}	
												
						}
					echo"<p class='transaction_span' style='color:#999999;font-size:20px;'>目前累計金額：".$total."元</p>";	
					if($total>=1000)
					{
						echo "<a href='manage.php' class='button1' >結算一次</a>"; //連結路徑未改
					}	
				}
				echo "</table>";
			?>
			
			<div class='button_div'>
				<a href="manage.php" class="button1" >上一頁</a>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="../js/search.js"></script>
	<script type="text/javascript">
		function confirm1(){
			if(confirm('確定升級'))
			{
				location.href='upgrades.php';
			}
		}
	</script>
</body>
</html>	