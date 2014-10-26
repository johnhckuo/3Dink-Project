<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
	<style type="text/css">
		.member_pic>a>img{
			width:46px;
			height:46px;
			border:1px solid gray;
			float:right;
			margin-top:25px;
			margin-right:15px;
		}
		
		.text-right{
			position:relative;
			float:right;
			width:140px;
			word-wrap: break-word;
			word-break: normal;
			vertical-align:bottom;
			margin-top:22px;
			margin-right:45px;
		}
		.navbar .nav.login_right{
			float:right;
			-webkit-padding-start: 0px;
			
		}
		.login_right>li{
			color:#999999;
			text-shadow:0 -1px 0 rgba(0, 0, 0, 0.25);
			font-family:Microsoft JhengHei;
			font-size:18px;
			padding-right:4px;
			overflow:hidden;
			text-overflow:ellipsis;
			white-space: nowrap;
			width:120px;
		}
		.login_right>li>a{
			text-decoration:none;
			color:#999999;
		}
		.login_right_a{
			-webkit-padding-start: 0px;
			float:right;
		}
		.login_right_a>li{
			
			color:#999999;
			text-shadow:0 -1px 0 rgba(0, 0, 0, 0.25);
			font-family:Microsoft JhengHei;
			*font-size:18px;
			padding-right:4px;
		}
		.login_right_a>li>a{
			padding:0px 5px 5px 5px;
			color:#999999;
			text-decoration:none;
			text-shadow:0 -1px 0 rgba(0, 0, 0, 0.25);
			font-family:Microsoft JhengHei;
			font-size:16px;
			
		}
	
	</style>
</head>
<body>
<?php 
			//ini_set('display_errors', 'On');//debug用	
			//include('space_size.php');
			if(isset($_SESSION['Account']))
			{	
				$Account=$_SESSION['Account'];
				$memberNo=$_SESSION['No'] ;
				require_once("/var/www/db/dblogin.php");
				require_once("/var/www/db/dbconnect.php");
				$db=new DB();
				$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
				$sql="SELECT * FROM member where Account = '$Account' ";
				$result = $db->query($link,$sql);
				$row = mysqli_fetch_row($result);
				$sql2= "SELECT `3dimageSize(kb)` FROM platform WHERE memberNo='$memberNo' ";
				$searchsql="SELECT paymentStatus,paymentTime FROM income WHERE memberNo='$memberNo'AND spacePurchase!='NULL' ORDER BY serialNumber DESC LIMIT 1";
				$result2 = $db->query($link,$sql2);
				$result3=$db->query($link,$searchsql);
				$paymentStatus = mysqli_fetch_row($result3);			
				$sizeSum=0;
				while($row2= mysqli_fetch_row($result2))
				{
					$sizeSum=$sizeSum+$row2[0];
				}
				
				$kb=$sizeSum/1024;
				$mb=$kb/1024;
				$gb=$mb/1024;
				$kb = number_format($kb, 2);
				$mb = number_format($mb, 2);
				$gb = number_format($gb, 2);
				$today=date("Y-m-d ");
				if($paymentStatus[0]==1)
				{
					$capacity=10;
					$paymentTime=date($paymentStatus[1]);
					if(date('Y-m-d',strtotime("{$today} -1 year")<=$paymentTime )){
						$capacity=2;
					}
					
				}
				elseif($paymentStatus[0]==0) {
					$capacity=2;
				}
				
?>
				<div class='text-right'>		
				<ul class='nav login_right'>
				<!--<li ><div class="name_field" id="name_field" type="button"  onclick="return Expand();"><?php echo $row[10]?></div></li>/*隱藏區塊點擊後顯示*/-->
				<li ><a href="/rockon40100/personal.php?memberNo=<?php echo $_SESSION['No']?>"><?php echo $row[10]?></a></li>
				</ul>
				<ul class='nav login_right_a'>
				<li ><a href='/zhen/logout.php' >登出</a></li>
				<li ><a href='/zhen/manage.php' >會員中心</a></li>
				</ul>
				</div>
				<span class='member_pic'><a href='/rockon40100/personal.php?memberNo=<?php echo $_SESSION['No']?>'><img src='<?php echo $row[6]?>'></a></span>
			
<?php			
			}		
			else if(isset($_SESSION['id']))
			{
				$facebookID=$_SESSION['id'];
				$memberNo=$_SESSION['No'] ;
				require_once("/var/www/db/dblogin.php");
				require_once("/var/www/db/dbconnect.php");
				$db=new DB();
				$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
				$sql="SELECT * FROM member where facebookID = '$facebookID' ";
				$result = $db->query($link,$sql);
				$row = mysqli_fetch_row($result);
				$sql2= "SELECT `3dimageSize(kb)` FROM platform WHERE memberNo='$memberNo' ";
				$searchsql="SELECT paymentStatus,paymentTime FROM income WHERE memberNo='$memberNo'AND spacePurchase!='NULL' ORDER BY serialNumber DESC LIMIT 1";
				$result2 = $db->query($link,$sql2);
				$result3=$db->query($link,$searchsql);
				$paymentStatus = mysqli_fetch_row($result3);			
				$sizeSum=0;
				while($row2= mysqli_fetch_row($result2))
				{
					$sizeSum=$sizeSum+$row2[0];
				}
				
				$kb=$sizeSum/1024;
				$mb=$kb/1024;
				$gb=$mb/1024;
				$kb = number_format($kb, 2);
				$mb = number_format($mb, 2);
				$gb = number_format($gb, 2);
				if($paymentStatus[0]==1)
				{
					$capacity=10;
					$paymentTime=date($paymentStatus[1]);
					$today=date("Y-m-d ");
				}
				elseif($paymentStatus[0]==0) {
					$capacity=2;
				}
				
?>
				<div class='text-right'>		
				<ul class='nav login_right'>
				<li ><a href="/rockon40100/personal.php?memberNo=<?php echo $_SESSION['No']?>"><?php echo $row[10]?></a></li>
				</ul>
				<ul class='nav login_right'>
				<li ><a href='/zhen/logout.php' >登出</a></li>
				<li ><a href='/zhen/manage.php' >會員中心</a></li>
				</ul>
				</div>
				<span class='member_pic'><a href="/rockon40100/personal.php?memberNo=<?php echo $_SESSION['No']?>"><img src='http://graph.facebook.com/<?php echo$facebookID;?>/picture'></a></span>			
<?php
			}
			else
			{
				echo"<div class='text-right'>";
				echo"<ul class=' pull-right'>";
				echo"<li ><a href='/zhen/login.php' >登入</a></li>";
				echo"<li ><a href='/zhen/register.php'>註冊</a></li>";
				echo"</ul>";
				echo"</div>";

			}
?>			
</body>
<script language="javascript" type="text/javascript">

		//var divID = "name_content";
		function Expand(obj) {
			var divObject = document.getElementById( "name_content");
			var divtest1=document.getElementById( "space_use");
			var divtest2=document.getElementById( "quota_graph_container");
			if (obj != null)
			{		
				$('nameTile').innerHTML=obj.innerHTML;
			}
			//divObject.className = "name_hidden";	
			if (divObject.className == "name_content"){
				divObject.className = "name_hidden";
				divtest1.style.display="none";
				divtest2.style.display="none";
			}
			else{			
				divObject.className = "name_content";
				divObject .style.display="block";
				divtest1.style.display="block";
				divtest2.style.display="block";
			}
		}		 

		//升級控制
//		function test1() { 
//			if(confirm('確定升級'))
//			{
					
//					window.location.assign("/zhen/upgrades.php");
				
//			}　　
			
//		}
		
	
		
		
		
</script>
</html>