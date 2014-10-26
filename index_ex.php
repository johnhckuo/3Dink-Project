<html lang="zh-tw">
<!DOCTYPE html>
<meta charset="utf-8" />
<!--新增自動刷新-->
<head>
	<title>首頁</title>
	<link rel="shortcut icon" href="favicon.ico">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script><!--自動refresh-->
	
	<script>
		//自動refresh
		$(window).resize(function(){
			window.location.reload();
		  });
	</script>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=0" /> 
	<link rel="stylesheet" type="text/css" href="css/fixbar_ex.css" >
	<link rel="stylesheet" type="text/css" media="screen and (max-width: 1299px)" href="css/fixbar1280x1024.css" >
	<link rel="stylesheet" type="text/css" media="screen and (min-width: 1300px) and (max-width: 1399px)" href="css/fixbar1366x768.css" >
	<link rel="stylesheet" type="text/css" media="screen and (min-width: 1400px) and (max-width: 1550px)" href="css/fixbar1440x900.css" >
	<link rel="stylesheet" type="text/css" media="screen and (min-width: 1551px) and (max-width: 1899px)" href="css/fixbar1600x900.css" >
	<link rel="stylesheet" type="text/css" media="screen and (min-width: 1900px)" href="css/fixbar1920x1080.css" >
	<link rel="stylesheet" type="text/css" href="css/roll.css" >
	<style type="text/css">
		.backtothetop{
				position:absolute;
				top:2300px;
				left:900px;
				color:white;
		}
		#side-nav {
			position: fixed;
			z-index: 1000;
			top: 50%;
			right: 100px;
			width: 20px;
			margin-top: -77px;
			padding: 0;
		}
		#side-nav ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
		}
		#side-nav ul li {
			margin: 12px 0;
		}
		#side-nav ul li a {
			display: block;
			width: 12px;
			text-indent: 100%;
			white-space: nowrap;
			overflow: hidden;
			opacity: 0.5;
			-webkit-transition: all linear 0.25s;
			transition: all linear 0.25s;
		}
		#side-nav ul li a:hover, #side-nav ul li a:focus, #side-nav ul li a.curr {
			opacity: 1;
		}
		#side-nav ul li a.pointnav {
			height: 12px;
			padding: 0;
			background: #fff;
			-webkit-border-radius: 7px;
			border-radius: 7px;	
		}

		</style>
</head>

<body style="overflow-x: hidden;">
		<?php $memberNo=0;?>

		<div class="navbar navbar-fixed-top" id="headerlink">
			<div class="navbar-inner" id="navbar-inner">
				<div class='fixbarleft' id='fixbarleft'><img src='img/fixbar_left.png'></div>
				<div class="navcontainer" >
					<?php include('./zhen/login_success.php')  ?>
					<ul class="nav searchbox">
						<li><input type="text" id='searchbox'  placeholder="搜尋" style="font-color:#a1a1a1" onkeydown="search()"></li>
					</ul> 
					<ul class="nav button">
						<li><a href="../jsstl-master/index.php"><img src="img/print.png"></a></li>
						<li><a href="../displayPlatform/index.php"><img src="img/platform.png"></a></li>
						<li><a href="../zhen/forum/forum_index.php"><img src="img/forum.png"></a></li>
					</ul>
					<span class="logo"><a href="../index.php"><img src="img/print_img/choose.png"></a></span>
					<span class="nav uploadbutton" ><a href="/showMode/file_upload.php"><img src="img/upload.png"></a></span>
				</div>
				<div class='fixbarright' id='fixbarright'><img src='img/fixbar_right.png'></div>
			</div>
		</div>
	<span class='platformlink' id='platformlink'><a href="/displayPlatform/index.php"><img src="img/print_img/choose.png"></a></span>
	<span class='printlink' id='printlink'><a href="../jsstl-master/index.html"><img src="img/print_img/choose.png"></a></span>
	<span class='forumlink' id='forumlink'><a href="/zhen/forum/forum_index.php"><img src="img/print_img/choose.png"></a></span>
	<!--<a href="#" class="backtothetop" >back to the top</a>-->
	
	<img src="img/bg.png" width=100% style="float:left;">

	<div>
		<div class="scroll" ><!--設個邊邊吧~-->
		<section class="container">
				<div id="carousel">
					<figure id="figure0" class="opa" style="-webkit-transform:translateX(-1700px) ;-webkit-filter: grayscale(1);  -webkit-transition: all 1s;" ><img src="img/pic1.jpg"  width="180" height="240" alt=""><span id="imageInfo0" style='opacity:0;'></span></figure>
					<figure id="figure1" class="opa" style="-webkit-transform:translateX(-1400px) ;-webkit-filter: grayscale(1); -webkit-transition: all  1s;" ><img src="img/pic2.jpg"  width="180" height="240" alt=""><span id="imageInfo1" style='opacity:0;'></span></figure>
					<figure id="figure2" class="opa" style="-webkit-transform:translateX(-1100px) ;-webkit-filter: grayscale(1);  -webkit-transition: all 1s;"><img src="img/pic3.jpg"  width="180" height="240" alt=""><span id="imageInfo2" style='opacity:0;'></span></figure>
					<figure id="figure3" class="opa" style="-webkit-transform:translateX(-800px) ;-webkit-filter: grayscale(1);  -webkit-transition: all 1s;"><img src="img/pic4.jpg"  width="180" height="240" alt=""><span id="imageInfo3" style='opacity:0;'></span></figure>
					<figure id="figure4" class="opa" style="-webkit-transform:translateX(-500px) ;-webkit-filter: grayscale(1);  -webkit-transition: all 1s;"><img src="img/pic5.jpg"  width="180" height="240" alt=""><span id="imageInfo4" style='opacity:0;'></span></figure>	
					<figure id="figure5"  class="middleopa" style="-webkit-transform:translateX(-200px) rotateY( -45deg ) translateZ( 100px );-webkit-filter: grayscale(1); -webkit-transition: all  1s;"><img src="img/pic6.jpg"  width="180" height="240" alt=""><span id="imageInfo5" style='opacity:0;'></span></figure>
					<figure id="figure6"  class="nonopa" style="-webkit-transform: rotateY(0deg) translateZ( 200px );  -webkit-filter: grayscale(0); -webkit-transition: all  1s;"><img src="img/pic7.jpg"  width="180" height="240" alt=""><span id="imageInfo6" style='opacity:0.8;'>Figure6</span></figure>
					<figure id="figure7" class="middleopa"  style="-webkit-transform: translateX(200px) rotateY(45deg)  translateZ(100px);-webkit-filter: grayscale(1); -webkit-transition: all  1s;"><img src="img/pic8.jpg"  width="180" height="240" alt=""><span id="imageInfo7" style='opacity:0;'></span></figure>
					<figure id="figure8" class="opa"  style="-webkit-transform:translateX(500px);-webkit-filter: grayscale(1); -webkit-transition: all  1s;"><img src="img/emily.jpg"  width="180" height="240" alt=""><span id="imageInfo8" style='opacity:0;'></span></figure>
					<figure id="figure9" class="opa"  style="-webkit-transform:translateX(800px);-webkit-filter: grayscale(1); -webkit-transition:all 1s;"><img src="img/pic1.jpg"  width="180" height="240" alt=""><span id="imageInfo9" style='opacity:0;'></span></figure>
					<figure id="figure10" class="opa"  style="-webkit-transform:translateX(1100px);-webkit-filter: grayscale(1); -webkit-transition: all  1s;"><img src="img/pic3.jpg"  width="180" height="240" alt=""><span id="imageInfo10" style='opacity:0;'></span></figure>
					<figure id="figure11" class="opa"  style="-webkit-transform:translateX(1400px);-webkit-filter: grayscale(1); -webkit-transition: all  1s;"><img src="img/pic4.jpg"  width="180" height="240" alt=""><span id="imageInfo11" style='opacity:0;'></span></figure>
					<figure id="figure12" class="opa"  style="-webkit-transform:translateX(1700px);-webkit-filter: grayscale(1); -webkit-transition:all 1s;"><img src="img/pic5.jpg"  width="180" height="240" alt=""><span id="imageInfo12" style='opacity:0;'></span></figure>
				</div>
			<section id="options">
				<p id="navigation">
					<div id="next"><a  onclick="onNavButtonClick(1,1); " ><img src="img/next.png"  width="50" height="50"/> </a></div>
					<div id="previous"><a  onclick="onNavButtonClick(-1,1); " ><img src="img/previous.png"  width="50" height="50"/> </a></div>
				</p>
			</section>
		</section>
		</div>
	</div>
	<nav id="side-nav" role="navigation">
		<ul>
			<li><a class="pointnav href0" href="#headerlink" >head</a>
			</li>
			<li><a class="pointnav href1" href="#platformlink" >mid1</a>
			</li>
			<li><a class="pointnav href2" href="#printlink" >mid2</a>
			</li>
			<li><a class="pointnav href3" href="#forumlink" >mid3</a>
			</li>
			<li><a class="pointnav href4" href="#4" >bottom</a>
			</li>
		</ul>
	</nav>
	
	<div class='ads_purchase'>
		<a href="javascript: return false;" onclick="openwin()">購買廣告</a>
	</div>
	
	<script type="text/javascript" src="js/utils.js"></script>
	<script type="text/javascript" src="js/roll.js"></script>
	<script type="text/javascript" src="http://demonstration.abgne.tw/jquery/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script type="text/javascript" src="js/search.js"></script>
	<script type="text/javascript">
		var timer1;
		function autoScroll(){
			timer1 = setTimeout("autoScroll()", 3000);
			onNavButtonClick(1,-1); 
		}
		autoScroll();
		//fixbar左右補齊
		document.getElementById("fixbarleft").style.width = (document.getElementById("headerlink").clientWidth-940)/2;
		document.getElementById("fixbarright").style.width = (document.getElementById("headerlink").clientWidth-940)/2;
		//小白點定位
		$(function(){
				$('a.href0').click(function(){
					var $wholepage = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
					
					$wholepage.animate({
						scrollTop: $('#headerlink').offset().top //可+-運算，不可用50%等
						//scrollTop:500
					},1000);
			
					return false;
				});
		});
		$(function(){
				$('a.href1').click(function(){
					var $wholepage = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
					
					$wholepage.animate({
						scrollTop: $('#platformlink').offset().top -300//可+-運算，不可用50%等
						//scrollTop:500
					},1000);
			
					return false;
				});
		});
		$(function(){
				$('a.href2').click(function(){
					var $wholepage = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
					
					$wholepage.animate({
						scrollTop: $('#printlink').offset().top -250//可+-運算，不可用50%等
						//scrollTop:500
					},1000);
			
					return false;
				});
		});
		$(function(){
				$('a.href3').click(function(){
					var $wholepage = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
					
					$wholepage.animate({
						scrollTop: $('#forumlink').offset().top -480//可+-運算，不可用50%等
						//scrollTop:500
					},1000);
			
					return false;
				});
		});
		$(function(){
				$('a.href4').click(function(){
					var $wholepage = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
					
					$wholepage.animate({
						scrollTop: $('#4').offset().top//可+-運算，不可用50%等
						//scrollTop:500
					},1000);
			
					return false;
				});
			});
	
		//登入控制
		function openwin() { 
			var memberNo = "<?php echo $memberNo;?>";
			if(memberNo == '0')
			{

					alert("尚未登入請重新登入");
					//window.location = 'zhen/login.php';
					window.location.assign("zhen/login.php");
					//window.location.replace("zhen/login.php");
			}　　
			else
			{
				window.location = 'zhen/ads_purchase.php';
			}
		}
		//搜尋輸入
		
	</script>

</body>
</html>
