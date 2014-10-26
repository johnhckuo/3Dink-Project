<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel=stylesheet type="text/css" href="../../css/fixbar.css">
<link rel=stylesheet type="text/css" href="../../css/forum_index.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script><!--自動refresh-->
	
	<script>
		//自動refresh
		$(window).resize(function(){
			window.location.reload();
		  });
	</script>
<?php
//session_start();
require("../../db/dblogin.php");
require("../../db/dbconnect.php");
$db=new DB();
$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
?>
<title>討論區</title>
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
						<li><a href="../../displayPlatform/index.php"><img src="../../img/platform.png"></a></li>
						<li><a href="../../zhen/forum/forum_index.php"><img src="../../img/forum.png"></a></li>
					</ul>
					<span class="logo"><a href="../../index.php"><img src="../img/print_img/choose.png"></a></span>
					<span class="nav uploadbutton" ><a href="../../showMode/file_upload.html"><img src="../../img/upload.png"></a></span>
				</div>
				<div class='fixbarright' id='fixbarright'><img src='../../img/fixbar_right.png'></div>
			</div>
		</div>

<ul id="ex">
<div class="up">
</div>
<div class="middle">
<li><a href='3Dprint.php' class="float">3D列印</a></li>
<li><a href='3Ddrawing.php'class="float">3D繪圖</a></li>
<li><a href='general.php'class="float">綜合討論區</a></li>
<li><a href='q&a.php'class="float">客服Q & A</a></li>
</div>
<div class="bottom">
<table>
  <tr>
    <th>有關硬體的各式問題，如：各種3D印表機的優劣、各種3D印表機零件、操作上的問題、列印的細節設定</th>
    <th>有關軟體的各式問題，如：各種繪圖軟體的優劣、繪製的技巧、繪製問題處理、素材討論</th>
    <th>所有相關3D列印與繪圖的新聞、資訊分享</th>
    <th>對於我們網站、系統有任何問題，皆可以在此反應</th>
  </tr>
</ul>
<script type="text/javascript">
	document.getElementById("fixbarleft").style.width = ((window.innerWidth  - 940)/2).toString() + "px";
	document.getElementById("fixbarright").style.width = ((window.innerWidth  - 940)/2).toString() + "px";
	document.writeln('位元像素：'+ocument.getElementById("fixbarright").style.width);
</script>
</body>

</html>
