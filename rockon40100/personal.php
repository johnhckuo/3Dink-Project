<!--置中，左右margin:auto版-->
<html lang="zh-tw">
<!DOCTYPE html>
<meta charset="utf-8" />

<head>
	<title>個人頁面</title>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=0" /> 
	<link rel=stylesheet type="text/css" href="../css/fixbar.css" >
	<link rel=stylesheet type="text/css" href="../css/roll.css" >
	<style type="text/css">
		.personal_mid{
			position:relative;
			width:940px;
			top:60%;
			margin-left:auto;
			margin-right:auto;
			*float:right;
		}
		.personal_bottom{
			position:relative;
			width:940px;
			*height:200px;
			top:60%;
			margin-left:auto;
			margin-right:auto;
			margin-bottom:80px;
		}
		.bottomhr{
			position:relative;
			top:60%;
			background-color:#fed116;
			size:2;
			width:85%;
			border:0;
			height:1px;
			opacity:0.6;
			margin-top:20px;
			margin-bottom:20px;
		}
		.personal_folder{
			display:inline-block;
		}
		.personal_folderName{
			color:#999999;
			font-family:Microsoft JhengHei;
			font-size:16px;
			width:188px;
			text-align:center;
			overflow:hidden;
			text-overflow:ellipsis;
			white-space: nowrap;
		}
		.personal_folderNo{
			color:#999999;
			font-family:Microsoft JhengHei;
			font-size:16px;
			width:188px;
			text-align:center;
		}
		.personal_folderImg{
			width:188px;
			margin:0 0 0 0;
			float:left;
		}
		.personal_folderImg>a>img{
			width:168px;
			height:168px;
			margin:10px 10px 10px 10px;
			background-color:#999999;
			border-width : 1px;
			-webkit-border-top-left-radius:5px;
			-webkit-border-top-right-radius:5px;
			-webkit-border-bottom-left-radius:5px;
			-webkit-border-bottom-right-radius:5px;
			cursor: pointer;
		}
		.personal_introduce{
			position:relative;
			padding:10 10 10 10;
		}
		.personal_introduce>div{
			*float:right;
			color:#999999;
			font-family:Microsoft JhengHei;
			font-size:16px;
			*height:70px;
			*width:170px;
			*padding-top:10px;
		}
		
		.personal_pic>img{
			width:100px;
			height:100px;
			border:1px solid gray;
			margin:10 10 10 10;
			float:left;
		}
		.mid_about{
			color:#fed116;
			font-size:26px;
			font-family:Microsoft JhengHei;
			font-weight:bold;
			margin-left:20px;
		}
		.bottom_foler{
			color:#fed116;
			font-size:26px;
			font-family:Microsoft JhengHei;
			font-weight:bold;
			margin:10 10 10 30;
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
						<li><a href=""><img src="img/forum.png"></a></li>	
					</ul>
					<span class="logo"><a href="../index.php"><img src="../img/print_img/choose.png"></a></span>
					<span class="nav uploadbutton" ><a href="/showMode/file_upload.php"><img src="../img/upload.png"></a></span>
				</div>
			</div>
		</div>
	
	
		<div id='personal_top' style='position:relative;width:940px;height:800px; margin:40 auto 0 auto;overflow:hidden;'><!--卷軸-->
			<div class="scroll" >
			<section class="container">
					<div id="carousel">
					</div>
				<section id="options">
					<p id="navigation">
						<div id="next"><a  onclick="onNavButtonClick(1,1); " ><img src="../img/next.png"  width="50" height="50"/> </a></div>
						<div id="previous"><a  onclick="onNavButtonClick(-1,1); " ><img src="../img/previous.png"  width="50" height="50"/> </a></div>
					</p>
				</section>
			</section>
			</div>
		</div>
		<div class='personal_mid' id='personal_mid'><!--中間介紹區-->
			<hr class="bottomhr">
			<div class='personal_introduce' style='overflow-x: auto'>
				<?php include('personal_introduce.php'); ?>
			</div>
			<hr class="bottomhr">
		</div>
		<div class='personal_bottom' ><!--下方資料夾區-->
			<div class='personal_folder' style='overflow-x: auto'>
				<div class='bottom_foler'>資料夾</div>
				<?php include('personal_category.php');?>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="../js/search.js"></script>
	<script type="text/javascript" src="../js/utils.js"></script>
	<!--<script type="text/javascript" src="../js/roll.js"></script>-->
	
	<script type="text/javascript" src="js/roll.js"></script>
	<script type="text/javascript">
	var memberNo=<?php echo $_GET['memberNo'];?>;
	window.addEventListener("DOMContentLoaded", init(memberNo) ,false);
		var timer1;
		function autoScroll(){
			timer1 = setTimeout("autoScroll()", 3000);
			onNavButtonClick(1,-1); 
		}
		
		autoScroll();
		
	</script>

</body>
</html>

<?php
/*Q1:螢幕縮小時，不會自動下推，因為卷軸圖片不占空間的樣子
*/
	
?>