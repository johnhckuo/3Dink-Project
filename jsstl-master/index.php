<html lang="zh-tw">
<!DOCTYPE html>
<meta charset="utf-8" />
<head>
	<title>stl viewer</title>
	<meta charset="utf-8">

	<meta name="viewport" content="initial-scale=1.0, user-scalable=0" />
	<link rel="stylesheet" type="text/css" href="../css/fixbar.css" >
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script><!--自動refresh-->

	<style>
		#modelDisplay{
			position:absolute;
			-webkit-transition:all 2s;
			opacity:0;
			margin-left:-100px;
			margin-left:0;
			margin-top:0;
		}
		#dragArea{
			position:absolute;
			margin-left:0;
			margin-top:0;
			border-style:dashed;
			border-color:#23D5D7;
			background-color:#000000;
			opacity:.3;
			
			width:450px;
			height:450px;
			-webkit-border-top-left-radius:5px;
			-webkit-border-top-right-radius:5px;
			-webkit-border-bottom-left-radius:5px;
			-webkit-border-bottom-right-radius:5px;
			-webkit-transition:all 1s;
		}
		#progress{
			position:absolute;
			margin-top:0px;
			margin-left:0px;
			width:300px;
			*background:#00F7FA;
			-webkit-border-top-left-radius:5px;
			-webkit-border-top-right-radius:5px;
			-webkit-border-bottom-left-radius:5px;
			-webkit-border-bottom-right-radius:5px;
			
		}
		.dragArea_text{
			position:absolute;
			top:45%;
			left:30%;
			font-family:Microsoft JhengHei;
			font-weight: bold;
			font-size:24px;
			color:#ffffff;
			display:block;
			*text-align:center;
		}
		#form{
			height:540px;
			color:#999999;
			font-family:Microsoft JhengHei;
			font-size:17px;
			border-style:solid;
			border-width : 0px;
			-webkit-border-radius: 5px;
			float:right;
			opacity:0;
		}
		
		.printform{
			color:#999999;
		}
		.printformul{
			list-style:none;
			font-family:Microsoft JhengHei;
			-webkit-border-radius:5px;
			border-width : 1px;
			outline:none;
		}
		
		.printformul>li>input{
			font-family:Microsoft JhengHei;
			-webkit-border-radius:5px;
			background-color:transparent;
			color:#999999;
			outline:none;
			font-size:13px;
		}
		
		.formbutton{
			position:relative;
			top:390px;
			*left:10px;
			list-style:none;
			-webkit-padding-start: 0px;
		}
		
		.formbutton>li{
			display:inline;
			
		}
		.formbutton>li>input{
			font-size:20px;
			height:28px;
			width:98px;
			-webkit-border-radius: 5px;
			background-image:url('../../img/print.png');
			background-size:100%;
			float:right;
			margin-top:20px;
			margin-right:20px;
		}
		.formbutton>li>a>input{
			font-size:20px;
			height:28px;
			width:98px;
			-webkit-border-radius: 5px;
			background-image:url('../../img/backbutton.png');
			background-size: 100%;
			float:right;
			margin-top:20px;
			margin-right:20px;
		}
		.previewframe{
			
			background-image:url('../../img/printframe.png');
			background-size:100% 100%;
			width:730px;
			height:530px;
			margin-top:150px;
			margin-right:auto;
			margin-left:auto;
			padding: 10px;
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
						<li><a href="../zhen/forum/forum_index.php"><img src="../img/forum.png"></a></li>	
					</ul>
					<span class="logo"><a href="../index.php"><img src="../img/print_img/choose.png"></a></span>
					<span class="nav uploadbutton" ><a href="/showMode/file_upload.php"><img src="../img/upload.png"></a></span>
				</div>
			</div>
		</div>
		<div class='previewframe'>
			<div id = "modelDisplay"></div>
			<div id = "form">
				<form action='print_fillin.php' method='POST' class='printform'>
					<ul class='printformul'>
						<li>作品名稱： <input id='dragName' type="text" name="productName" /></li>
						<li><br/></li>
						<li>列印密度： <input type="text" name="name"  maxlength="5" />&nbsp%</li>
						<li><br/></li>
						<li>作品大小： <input id='dragSize' type="text" name="name"  maxlength="5" disabled/>&nbspBytes</li>
					</ul>
					<ul class='formbutton'>
						<li><input type="submit" value=''></li>
						<li><a href='index.php'><input type="button" value=""></a></li>
					</ul>
				</form>
			</div>
			
			<script src="three.js"></script>
			<script src="stats.js"></script>
			<script src="detector.js"></script>
			<script src="STLLoader.js"></script>
			<script src="stlviewer.js"></script>
			<script type="text/javascript" src="../js/search.js"></script>
			<?php if (empty($_GET['path'])){
							echo "<div id='dragArea'>
									<span class='dragArea_text'>將檔案拖曳上傳</span>
									<div id = 'progress'></div>
									</div>
									<script>window.addEventListener('DOMContentLoaded', dragInit , false);</script>";
						}else{ 
							echo "<div id='dragArea' style='display:none;'></div><script>(function(){geoInit('".$_GET['path']."');})(); </script>";
						}
			?>
		</div>
	</div>
	<script type="text/javascript">
		//document.getElementById("frame").style.height =  window.innerHeight -150 +'px';	
	</script>
</body>
</html>
