<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../css/fixbar.css" >
	<link rel="stylesheet" type="text/css" href="../css/total.css" >
	<style type="text/css">

	</style>
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
	?>
</head>
<body style="overflow-x: hidden;background-image:url(../img/loginbg.jpg); ">
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
						<li><a href=""><img src="img/forum.png"></a></li>	
					</ul>
					<span class="logo"><a href="../index.php"><img src="../img/print_img/choose.png"></a></span>
					<span class="nav uploadbutton" ><a href="/showMode/file_upload.php"><img src="../img/upload.png"></a></span>
				</div>
			</div>
		</div>
	<?php
		if(isset($_SESSION['No']))
			{
				$memberNo=$_SESSION['No'];
				$sql="SELECT * FROM member WHERE memberNo = '$memberNo' ";
			}
		$result = $db->query($link,$sql);
		$row = mysqli_fetch_assoc($result);
		if($row['authority']==0)
		{
			header("Location: ../index.php"); 
			exit;
		}
		$sql2="SELECT * FROM income";
		$result2 = $db->query($link,$sql2);
		//$row2= mysqli_fetch_assoc($result2);
		$sql3="SELECT * FROM ads_purchase";
		$result3 = $db->query($link,$sql3);
		//$row3= mysqli_fetch_assoc($result3);
	?>
	
		<div class='transaction_total'>
			<table class="total_table" rules="all" >
				<tr><td>收入編號</td><td>購買人</td><td>購買類型</td><td>金額</td><td>付款狀態</td><td>付款時間</td><td>匯款後五碼</td></tr>
				<?php
					while($row2= mysqli_fetch_assoc($result2))
					{		
						echo "<tr><td>".$row2['serialNumber']."</td>";
							if($row2['memberNo']!=NULL && $row2['ads_purchaseNo']==NULL && $row2['print_authorizationNo']==NULL)
							{
								$sql5="SELECT Nickname FROM member WHERE memberNo = '$row2[memberNo]'";
								$result5=$db->query($link,$sql5);
								$Nickname=mysqli_fetch_assoc($result5);		
								echo "<td>".$Nickname['Nickname']."</td>";	
								if($row2['spacePurchase']!=NULL && $row2['printingCost']==NULL)
								{
									if($row2['paymentStatus']==0)
									{
										echo "<td>空間購買</td><td>$".$row2['spacePurchase']."</td><td>未付款</td><td></td><td></td></tr>";
									}
									else
									{
										echo "<td>空間購買</td><td>$".$row2['spacePurchase']."</td><td>已付款</td><td>".$row2['paymentTime']."</td><td>".$row2['transferafterfiveYards']."</td></tr>";
									}
								}
								else if ($row2['spacePurchase']==NULL && $row2['printingCost']!=NULL)
								{
									if($row2['paymentStatus']==0)
									{
										echo "<td>列印費用</td><td>$".$row2['printingCost']."</td><td>未付款</td><td></td><td></td></tr>";
									}
									else
									{
										echo  "<td>列印費用</td><td>$".$row2['printingCost']."</td><td>已付款</td><td>".$row2['paymentTime']."</td><td>".$row2['transferafterfiveYards']."</td></tr>";
									}
								}
									
							}
							else if ($row2['memberNo']==NULL && $row2['ads_purchaseNo']!=NULL && $row2['print_authorizationNo']==NULL)
							{
								$sql4="SELECT member.* FROM member,ads_purchase WHERE purchaseNo='$row2[ads_purchaseNo]' AND ads_purchase.buyerNo=member.memberNo";
								$result4=$db->query($link,$sql4);
								$adsBuyer= mysqli_fetch_assoc($result4);
								if($row2['paymentStatus']==0)	
								{
									echo "<td>".$adsBuyer['Nickname']."</td><td>廣告購買</td><td>$".$row2['adsPurchase']."</td><td>未付款</td><td></td><td></td></tr>";
								}
								else
								{
									echo   "<td>".$adsBuyer['Nickname']."</td><td>廣告購買</td><td>$".$row2['adsPurchase']."</td><td>已付款</td><td>".$row2['paymentTime']."</td><td>".$row2['transferafterfiveYards']."</td></tr>";
								}
							}
							else if ($row2['memberNo']==NULL && $row2['ads_purchaseNo']==NULL && $row2['print_authorizationNo']!=NULL)
							{
								$sql6="SELECT member.* FROM member,print_authorization WHERE printauthorizationNo='$row2[print_authorizationNo]' AND print_authorization.Purchaser=member.memberNo";
								$result6=$db->query($link,$sql6);
								$adsBuyer= mysqli_fetch_assoc($result6);	
								if($row2['paymentStatus']==0)
								{
									echo "<td>".$adsBuyer['Nickname']."</td><td>列印授權佣金</td><td>$".$row2['printauthorizeCommission']."</td><td>未付款</td><td></td><td></td></tr>";
								}
								else
								{
									echo "<td>".$adsBuyer['Nickname']."</td><td>列印授權佣金</td><td>$".$row2['printauthorizeCommission']."</td><td>已付款</td><td>".$row2['paymentTime']."</td><td>".$row2['transferafterfiveYards']."</td></tr>";
								}
							}
					}

						
				?>
			</table>
			<a href="total_edit.php" class="button1" >編輯</a>
		</div>
	</div>
	<script type="text/javascript">

		document.getElementById("fixbarleft").style.width = (window.innerWidth  - 940)/2;
		document.getElementById("fixbarright").style.width = (window.innerWidth  - 940)/2;
	</script>
</body>
</html>