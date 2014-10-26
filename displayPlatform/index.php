<html>
<head>
<meta charset="utf-8" />
<title>展覽平台</title>
<script type="text/javascript" src="js/utils.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../css/fixbar.css">
<link rel="stylesheet" type="text/css" href="css/platform_test.css">
<!--<link rel="stylesheet" type="text/css" href="css/platform.css">
<link rel="stylesheet" type="text/css" media="screen and (max-width: 1750px)" href="css/responsive.css"/>
<link rel="stylesheet" type="text/css" media="screen and (max-width: 1600px)" href="css/responsive2.css"/>
<link rel="stylesheet" type="text/css" media="screen and (max-width: 1400px)" href="css/responsive3.css"/>
<link rel="stylesheet" type="text/css" media="screen and (max-width: 1100px)" href="css/responsive4.css"/>-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script><!--自動refresh-->
	
<script type="text/javascript">
	//自動refresh
		$(window).resize(function(){
			window.location.reload();
		  });
	var timer1;
	function autoScroll(){
		timer1 = setTimeout("autoScroll()",3000);
		onNavButtonClick(1,-1);
	}
	autoScroll();

	
</script>
</head>
<body style="overflow-x: hidden;background-image:url(../img/bgcolor.png); ">
	<div class="navbar navbar-fixed-top" id='headerlink'>
		<div class="navbar-inner" >
			<div class='fixbarleft' id='fixbarleft'><img src='../img/fixbar_left.png'></div>
			<div class="navcontainer" >
				<?php include('../zhen/login_success.php')?>
				<ul class="nav searchbox">
					<li><input type="text"  placeholder="搜尋" style="font-color:#a1a1a1"></li>
				</ul> 
				<ul class="nav button">
					<li><a href="../jsstl-master/index.php"><img src="../img/print.png"></a></li>
					<li><a href="../displayPlatform/index.php"><img src="../img/platform.png"></a></li>
					<li><a href="../zhen/forum/forum_index.php"><img src="../img/forum.png"></a></li>
				</ul>
				<span class="logo"><a href="../index.php"><img src="../img/print_img/choose.png"></a></span>
				<span class="nav uploadbutton" ><a href="../showMode/file_upload.html"><img src="../img/upload.png"></a></span>
			</div>
			<div class='fixbarright' id='fixbarright'><img src='../img/fixbar_right.png'></div>
		</div>
	</div>
<div class='platform_content'>
	<div id="spinCircle">
		
	</div>
	  <section id="options">
			<p id="navigation">
				<div id="previous"><a href="#" onclick="onNavButtonClick(-1,1); " ><img src="img/previous.png"  width="50" height="50"/> </a></div>
				<div id="next"><a href="#" onclick="onNavButtonClick(1,1); " ><img src="img/next.png"  width="50" height="50"/> </a></div>
			</p>
		</section>
	 <div id="extendInfo">
		<h2>各類別熱門3D作品</h2>
		<hr>
		<div id = "extendText" class="on"></div>
	  </div>
</div>
</body>

<script type="text/javascript" src="js/platform.js"></script>
<script type="text/javascript">
	

	document.getElementById("fixbarleft").style.width = (window.innerWidth  - 940)/2;
	document.getElementById("fixbarright").style.width = (window.innerWidth  - 940)/2;
</script>
</html>
