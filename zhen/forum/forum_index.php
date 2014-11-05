<html lang="zh-tw" >
<!DOCTYPE html>
<meta charset="utf-8" />
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../../css/fixbar.css" >
	<link rel="stylesheet" type="text/css" href="../../css/forum_index.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script><!--自動refresh-->
	<?php
	//session_start();
	require("../../db/dblogin.php");
	require("../../db/dbconnect.php");
	$db=new DB();
	$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	?>
	<title>討論區</title>
</head>

<body style="overflow-x: hidden;margin:0 0 0 0 ;background-color:#333333;">
	<div class='frame' id='frame'>
		<div class="navbar navbar-fixed-top" id="headerlink">
			<div class="navbar-inner" id="navbar-inner">
				<div class="navcontainer" >
					<?php include('../../zhen/login_success.php')  ?>
					<ul class="nav searchbox">
						<li><input type="text" id='searchbox'  placeholder="搜尋" style="font-color:#a1a1a1" onkeydown="search()"></li>
					</ul> 
					<ul class="nav button">
						<li><a href="../../three"><img src="../../img/forum.png"></a></li>
						<li><a href="../../jsstl-master/index.php"><img src="../../img/print.png"></a></li>
						<li><a href="../../newShowmode/index.php"><img src="../../img/platform.png"></a></li>
						<li><a href="forum_index.php"><img src="../../img/forum.png"></a></li>	
					</ul>
					<span class="logo"><a href="../../index.php"><img src="../../img/print_img/choose.png"></a></span>
					<span class="nav uploadbutton" ><a href="../../showMode/file_upload.php"><img src="../../img/upload.png"></a></span>
				</div>
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
				</table>
			</div>
		</ul>
	</div>
	<script type="text/javascript" src="../../js/search.js"></script>

</body>

</html>
