<html lang="zh-tw" >
<!DOCTYPE html>
<meta charset="utf-8" />
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=0" /> 
		<link rel="stylesheet" type="text/css" href="css/rollImprove.css" >
		<link rel="stylesheet" type="text/css" href="css/fixbar.css" >
		<style type="text/css">
			.index_frame{
				position:relative;top:0;right:0;left:0;
				margin-left:auto;
				margin-right:auto;
				width:1140px;
				height:3571px;
				overflow:hidden;
				background-image:url('img/bg.jpg');
				background-size:1140px 100%;
				background-repeat:no-repeat;
				background-position:center;
				border-left-style:solid;border-width: 5px;border-color:#999999;
				border-right-style:solid;border-width: 5px;border-color:#999999;
			}
			
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
	
	<body style="overflow-x: hidden;margin:0 0 0 0 ;background-color:#333333;">
		<?php $memberNo=0;?>
		<div class='index_frame' id='frame'>
		<section class="container">
					<div id="carousel">	</div>
				
		</section>
			<div class="navbar navbar-fixed-top" id="headerlink">
				<div class="navbar-inner" id="navbar-inner">
					<div class="navcontainer" >
						<?php include('./zhen/login_success.php')  ?>
						<ul class="nav searchbox">
							<li><input type="text" id='searchbox'  placeholder="搜尋" style="font-color:#a1a1a1" onkeydown="search()"></li>
						</ul> 
						<ul class="nav button">
							<li><a href="../three"><img src="img/forum.png"></a></li>
							<li><a href="../jsstl-master/index.php"><img src="img/print.png"></a></li>
							<li><a href="../newShowmode/index.php"><img src="img/platform.png"></a></li>
							<li><a href="/zhen/forum/forum_index.php"><img src="img/forum.png"></a></li>	
						</ul>
						<span class="logo"><a href="../index.php"><img src="img/print_img/choose.png"></a></span>
						<span class="nav uploadbutton" ><a href="/showMode/file_upload.php"><img src="img/upload.png"></a></span>
					</div>
				</div>
			</div>
			
			<span class='threelink' id='threelink'><a href="three/index.php"><img src="img/print_img/choose.png"></a></span>
			<span class='platformlink' id='platformlink'><a href="newShowmode/index.php"><img src="img/print_img/choose.png"></a></span>
			<span class='printlink' id='printlink'><a href="jsstl-master/index.php"><img src="img/print_img/choose.png"></a></span>			
			<span class='forum' id='forum'><a href="/zhen/forum/forum_index.php"><img src="img/print_img/choose.png"></a></span>			
			<!--<nav id="side-nav" role="navigation">
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
			</nav>-->
			<div class="ads_purchase"><a href="zhen/ads_purchase.php">廣告購買</a></div>
		</div>	
		
		
		
		
	<script type="text/javascript" src="js/search.js"></script>
	
	<script type="text/javascript" src="js/rollImprove.js"></script>
	<script>
		setInterval(function(){
			onNavButtonClick(1);
		},2500);
	</script>
			<!--<img src="img/bg.png" width=100% style="float:left;">-->
	</body>
</html>