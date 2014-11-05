<html>
<meta charset="utf-8" />
<head>
	<title>首頁</title>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=0" /> 
	<link rel=stylesheet type="text/css" href="../css/fixbar.css">
	<link rel=stylesheet type="text/css" href="css/roll.css" >
	<link rel=stylesheet type="text/css" href="css/star.css">
	<script type="text/javascript" src="../js/search.js"></script>
</head>

<body style="overflow-x: hidden;margin:0 0 0 0 ;background-color:#333333;">
		<?php $memberNo=0;?>
		<div class='frame' id='frame' >
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
							<li><a href="../zhen/forum/forum_index.php"><img src="../img/forum.png"></a></li>	
						</ul>
						<span class="logo"><a href="../index.php"><img src="../img/print_img/choose.png"></a></span>
						<span class="nav uploadbutton" ><a href="/showMode/file_upload.php"><img src="../img/upload.png"></a></span>
					</div>
				</div>
			</div>

			<div class="scroll" ><!--設個邊邊吧~-->
			<section class="container">
					<div id="carousel">
						
					</div>
					
				<section id="options">
					<p id="navigation">
						<div id="next"><a  onclick="onNavButtonClick(1); " ><img src="img/next.png"  width="50" height="50"/> </a></div>
						<div id="previous"><a  onclick="onNavButtonClick(-1); " ><img src="img/previous.png"  width="50" height="50"/> </a></div>
					</p>
				</section>
				
			</section>
			<div id="viewer3D">
	
			</div>
			
			</div>
			<div id="info"  class="infoHoverOut" > 
				<div id="starRating">
					<img src="img/star_L.png" alt="1" >
					<img src="img/star_L.png" alt="2" >
					<img src="img/star_L.png" alt="3" >
					<img src="img/star_L.png" alt="4" >
					<img src="img/star_L.png" alt="5" >
				</div>
				<div id = "starStat"></div>
				<div id='fbpost' class="fb-share-button" data-href="" data-type="button"></div>
			</div>
		</div>

		
<script type="text/javascript" src="js/utils.js"></script>
<script src="js/three.js"></script>
<script src="js/stats.js"></script>
<script src="js/detector.js"></script>
<script src="js/STLLoader.js"></script>
<script type="text/javascript" src="js/stlviewer2.js"></script>
<script type="text/javascript" src="js/roll.js"></script>

<?php 
if(isset($_GET['pictureNo']) && isset($_GET['folderNo']))
{
	echo "<script type='text/javascript' >";
	echo "var pictureNo=".$_GET['pictureNo'].";";
	echo "var folderNo=".$_GET['folderNo'].";";
	echo "window.addEventListener('DOMContentLoaded', init(pictureNo,folderNo,-1) ,false);";
	echo "</script>";

}
else if(isset($_GET['pictureNo']) && isset($_GET['categoryNo']))
{
	echo "<script type='text/javascript' >";
	echo "var pictureNo=".$_GET['pictureNo'].";";
	echo "var categoryNo=".$_GET['categoryNo'].";";
	echo "window.addEventListener('DOMContentLoaded', init(pictureNo,-1,categoryNo) ,false);";
	echo "</script>";
}
else if(isset($_GET['pictureNo']) && isset($_GET['categoryNo']) && isset($_GET['search']))//從搜尋頁進入
{
	echo "<script type='text/javascript' >";
	echo "var pictureNo=".$_GET['pictureNo'].";";
	echo "var categoryNo=".$_GET['categoryNo'].";";
	echo "window.addEventListener('DOMContentLoaded', init(pictureNo,-3,categoryNo) ,false);";
	echo "</script>";
}
else{
	echo "<script type=''text/javascript' >";
	echo "window.addEventListener('DOMContentLoaded', init(-2,-2,-2) ,false);";
	echo "</script>";
}
?>




<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&appId=220348348164863&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

</body>

</html>
