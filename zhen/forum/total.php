<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../css/fixbar.css" >
	<link rel="stylesheet" type="text/css" href="../css/total.css" >
	<?php
		session_start();
		require("../db/dblogin.php");
		require("../db/dbconnect.php");
		$db=new DB();
		$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	?>
</head>
<body style="overflow-x: hidden;background-image:url(../img/loginbg.jpg); ">
		<div class="navbar navbar-fixed-top" >
		  <div class="navbar-inner" >
			<div class='fixbarleft' id='fixbarleft'><img src='../img/fixbar_left.png'></div>
			<div class="navcontainer" >
				<?php include('login_success.php')?>
				<ul class="nav searchbox">
						<li><input type="text"  placeholder="搜尋" style="font-color:#a1a1a1"></li>
				</ul>  
				<ul class="nav button">
					<li><a href=""><img src="../img/print.png"></a></li>
					<li><a href="../displayPlatform/index.html"><img src="../img/platform.png"></a></li>
					<li><a href="forum/forum_index.php"><img src="../img/forum.png"></a></li>
				</ul>
				<span class="logo"><a href="../index.php"><img src="../img/print_img/choose.png"></a></span>
				<span class="nav uploadbutton" ><a href="../showMode/file_upload.html"><img src="../img/upload.png"></a></span>
			</div>
			<div class='fixbarright' id='fixbarright'><img src='../img/fixbar_right.png'></div>
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
	<table style="border:5px solid ; " rules="all"  width="500">
		<tr><td>收入編號</td><td>購買人</td><td>購買類型</td><td>金額</td><td>付費狀態</td></tr>
		<?php
			while($row2= mysqli_fetch_assoc($result2))
			{		
				echo "<tr><td>".$row2['serialNumber']."</td>";
					if($row2['memberNo']!=NULL && $row2['ads_purchaseNo']==NULL)
					{
						$sql5="SELECT Nickname FROM member WHERE memberNo = '$row2[memberNo]'";
						$result5=$db->query($link,$sql5);
						$Nickname=mysqli_fetch_assoc($result5);		
						echo "<td>".$Nickname['Nickname']."</td>";	
						if($row2['spacePurchase']!=NULL && $row2['printingCost']==NULL)
						{
							echo "<td>空間購買</td><td>".$row2['spacePurchase']."</td><td>".$row2['paymentStatus']."</td></tr>";
						}
						else if ($row2['spacePurchase']==NULL && $row2['printingCost']!=NULL)
						{
							echo "<td>列印費用</td><td>".$row2['printingCost']."</td><td>".$row2['paymentStatus']."</td></tr>";
						}
							
					}
					else if ($row2['memberNo']==NULL && $row2['ads_purchaseNo']!=NULL)
					{
						$sql4="SELECT Buyer FROM ads_purchase WHERE purchaseNo='$row2[ads_purchaseNo]'";
						$result4=$db->query($link,$sql4);
						$adsBuyer= mysqli_fetch_assoc($result4);							
						echo "<td>".$adsBuyer['Buyer']."</td><td>廣告購買</td><td>".$row2['adsPurchase']."</td><td>".$row2['paymentStatus']."</td></tr>";
					}						
				}


		?>
	</table>
</body>
</html>