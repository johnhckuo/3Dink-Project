<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel=stylesheet type="text/css" href="../../css/fixbar.css">
<?php
session_start();
require("../../db/dblogin.php");
require("../../db/dbconnect.php");
$db=new DB();
$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
?>
<title>3D列印討論區</title>
</head>

<body style="overflow-x: hidden;background-image:url(../../img/bgcolor.png); ">
<div class="navbar navbar-fixed-top" id='headerlink'>
			<div class="navbar-inner" >
				<div class='fixbarleft' id='fixbarleft'><img src='../../img/fixbar_left.png'></div>
				<div class="navcontainer" >
					<?php include('../login_success.php')?>
					<ul class="nav searchbox">
						<li><input type="text"  placeholder="搜尋" style="font-color:#a1a1a1"></li>
					</ul> 
					<ul class="nav button">
						<li><a href="../../jsstl-master/index.php"><img src="../img/print.png"></a></li>
						<li><a href="../../displayPlatform/index.html"><img src="../../img/platform.png"></a></li>
						<li><a href="../../zhen/forum/forum_index.php"><img src="../../img/forum.png"></a></li>
					</ul>
					<span class="logo"><a href="../../index.php"><img src="../img/print_img/choose.png"></a></span>
					<span class="nav uploadbutton" ><a href="../../showMode/file_upload.html"><img src="../../img/upload.png"></a></span>
				</div>
				<div class='fixbarright' id='fixbarright'><img src='../../img/fixbar_right.png'></div>
			</div>
		</div>
		<?php  //include('visitors.php');   
				echo $_SESSION['No'];?>
<div style=margin-top:300px>
<input type="button" value="發表新主題" onclick="location.href='article_new.php'">
</div>

</body>
<script type="text/javascript">
	document.getElementById("fixbarleft").style.width = ((window.innerWidth  - 940)/2).toString() + "px";
	document.getElementById("fixbarright").style.width = ((window.innerWidth  - 940)/2).toString() + "px";
	document.writeln('位元像素：'+ocument.getElementById("fixbarright").style.width);
</script>
</html>
