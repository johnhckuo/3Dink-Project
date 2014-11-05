<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<link rel=stylesheet type="text/css" href="../css/fixbar.css" >
<link rel=stylesheet type="text/css" href="../css/manage.css">

	
<title>會員管理</title>

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
						<li><a href="../three"><img src="../img/forum.png"></a></li>
						<li><a href="../jsstl-master/index.php"><img src="../img/print.png"></a></li>
						<li><a href="../newShowmode/index.php"><img src="../img/platform.png"></a></li>
						<li><a href="/zhen/forum/forum_index.php"><img src="../img/forum.png"></a></li>	
					</ul>
					<span class="logo"><a href="../index.php"><img src="../img/print_img/choose.png"></a></span>
					<span class="nav uploadbutton" ><a href="/showMode/file_upload.php"><img src="../img/upload.png"></a></span>
				</div>
			</div>
		</div>
		
		<div class="middle">  
			<div class="manage">
				<span>個人資料管理</span>
				<div class="mpicture">
					<a href="picture_upload.php" ><?php require_once('member_pPath.php');?></a>
				</div>
				<div class="edit">
					<?php
						
						require_once("../db/dblogin.php");
						require_once("../db/dbconnect.php");
						$db=new DB();
						$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
						if(isset($_SESSION['Account']))
						{
							$Account=$_SESSION['Account'];
							$sql="SELECT * FROM member WHERE Account = '$Account' ";
						}
						else if(isset($_SESSION['id']))
						{
							$facebookID=$_SESSION['id'];
							$sql="SELECT * FROM member WHERE  facebookID='$facebookID'";
						}
						$result = $db->query($link,$sql);
						$row = mysqli_fetch_assoc($result);
						echo "<p>暱稱：".$row['Nickname']."</p>";
						echo "<p>E-mail：</br>".$row['Email']."</p>";		
						
					?>
					<a href="member_edit.php" class="button2" id="member_edit">編輯</a>
				</div>
				<div class= "space_content" id='space_content' >
							<span class="space_use_status">空間使用狀況</span>						
							<div id ='quota_graph_container'class='quota_graph_container' >
								
								<div class='graph_container'>
									<div style="width: <?php echo $gb/$capacity*100?>%; <?php if  ($gb/$capacity*100>=90) {echo "background: #FF0000";}?>" class="quota_graph_bar  "></div>
								</div>						
							</div>
							<span id='space_use'  >已使用<?php echo $gb;?>GB(剩餘<?php echo $capacity-$gb;?>GB)</span><br/>
								<!--<span class='upgrade'>年繳<strong style='color:#FF0000'>NT$999</strong>即可獲得</br>10GB/年使用空間</span>-->
								<?php 
									if($capacity==2 || date('Y-m-d',strtotime("{$today} -1 year")<=$paymentTime ) )
									{
										echo "<span id='upgrade' style='margin-left: 60%;margin-top:3%;'><a class='button2' href='javascript: return false;' onclick='upgrade()' style='margin-top:5%;margin-right:5%'>立即升級</a></span>  ";
									}
									if($paymentTime!=NULL &&  $paymentStatus[1]!="0000-00-00" )
									{
										for($i=0;$i<=10;$i++)
										{
											if(date('Y-m-d',strtotime("{$today} -1 year +".$i."day"))==$paymentTime)
											{
												echo "<span id='upgrade' style='margin-left: 28%;font-size:10px;'>";
												echo "剩餘<strong style='color:#FF0000'>".$i."天</strong>即將到期</span>";	
												echo "<a class='button2' href='javascript: return false;' onclick='upgrade()' style='margin-top:5%;margin-right:5%'>立即延長</a>	";	
											}
										}	
									}
								?>
							
				</div>	
			</div>

			<div class="rightside">
				<div class="print_inquiry">
					<span>列印進度查詢</span>
					<form name="form" class="registerform" method="post" action="print_inquiry.php">
						<select name="order" id="order">
							<option value="0">請選擇訂單</option>
							<?php
								include('order_tracking.php');  
								$orderNo=$row1['orderNo'] ;
								echo "<option value='". $orderNo ."'>". $row1['orderNo'] .$row2['productName']."</option>"; 
								while($row1= mysqli_fetch_assoc($result1)+$row2= mysqli_fetch_assoc($result2) )
								{
									{		
										$orderNo=$row1['orderNo'] ;
										//echo "<option value='".$orderNo."'>". $row1['orderNo'] .$row2['productName']."</option>"; 
										echo "<option value='".$orderNo."'>".$row2['productName']."</option>";		
											
									}
								}
							?>
						</select>
						<input type="submit" class="button2" value="查詢" onclick="return checkOrder();">
						
					</form>
				</div>
				<!--<a href="order_history.php" class="button1" style="margin-top: 30px;">歷史訂單</a>!-->
				<div class="print_inquiry">
				<span>交易紀錄查詢</span>
				<form name="form" class="registerform" method="post" action="transaction_records.php">
					<select name='transactionType' id='transactionType'>
						<option value=0>交易類型</option>
						<option value=1>列印費用</option>
						<option value=2>空間購買費用</option>
						<option value=3>廣告購買費用</option>
						<option value=4>列印授權費用(支出)</option>
						<option value=5>列印授權費用(收入)</option>
					</select>
					<input type="submit" class="button2" value="查詢" onclick="return checkTransactiontype();">
				</form>
				</div>
				<div class="exhibition">
					<span>個人展覽</span>
					<a href="../rockon40100/personal.php?memberNo=<?php echo $_SESSION['No']?>" class="button1">作品管理</a>
					<a href="../showMode/file_upload.php" class="button1">作品上傳</a>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="../js/search.js"></script>
	<script type="text/javascript">
		/*
		//如果是使用臉書登入，就沒有編輯鈕
			var facebookId=<?php echo $_SESSION['id'];?>;
			alert(facebookId);
			if( facebookId !="")
			{
				document.getElementById("member_edit").style.display="none";
			}
		*/	
		
	
		function checkTransactiontype(){
			var transactionType=document.getElementById('transactionType').value;
			
			//alert(transactionType);
			if(transactionType==0)
			{
				alert('尚未選擇類型');
				return false;
			}
			else{
				return true;
			}
		}
		
		function checkOrder(){
			var order=document.getElementById('order').value;
			if(order==0){
				alert('尚未選擇訂單');
				return false;
			
			}
			else{
				return true;
			}
			
		}
		
		//升級控制
		function upgrade() { 
			if(confirm('年繳NT$999即可獲得10GB/年使用空間，確定升級?'))
			{
					
					window.location.assign("/zhen/upgrades.php");
				
			}　　
			
		}
		
	</script>
</body>
</html>