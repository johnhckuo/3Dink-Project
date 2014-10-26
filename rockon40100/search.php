<html lang="zh-tw">
<!DOCTYPE html>
<meta charset="utf-8" />

	<head>
		<title></title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=0" /> 
		<link rel=stylesheet type="text/css" href="../css/fixbar.css" >
		<style type="text/css">
			a{
				text-decoration:none;
			}
			.search_frame{
				position:relative;
				background-image:url(../img/frame.png);
				background-size:940px 100%;
				background-repeat:no-repeat;
				width:940px;
				margin:130px auto 0 auto;
			}
			.search_content{
				position:relative;
				margin:10px 10px 10px 10px;
				padding:10px 10px 10px 10px;
			}
			.search_content:after{
				content: ".";
				display: block;
				height: 0;
				clear: both;
				visibility: hidden;
			}
			.search_title{
				position:relative;
				width:100%;
				font-size:40px;
				color:#fed116;
				font-family:Microsoft JhengHei;
				text-align:center;
				margin:5px 5px 5px 5px;
				display:block;
				float:left;
			}
			.search_div{
				width:900px;
				margin-left:auto;
				margin-right:auto;
				padding:10 10 10 10;
				float:left;
			}
			.search_member{
				width:130px;
				height:155px;
				margin:10px 10px 10px 10px;
				clear:left;
				display:inline-block;
				overflow:hidden;
				text-overflow:ellipsis;
				*white-space: nowrap;
			}
			.search_member>a>img{
				position:relative;
				width:130px;
				height:130px;
				-webkit-border-top-left-radius:5px;
				-webkit-border-top-right-radius:5px;
				-webkit-border-bottom-left-radius:5px;
				-webkit-border-bottom-right-radius:5px;
				cursor: pointer;
			}
			
			.search_img{
				width:130px;
				height:155px;
				margin:10px 10px 10px 10px;
				clear:left;
				display:inline-block;
			}
	
			.search_img>a>img{
				position:relative;
				width:130px;
				height:130px;
				-webkit-border-top-left-radius:5px;
				-webkit-border-top-right-radius:5px;
				-webkit-border-bottom-left-radius:5px;
				-webkit-border-bottom-right-radius:5px;
				cursor: pointer;
				
			}
			.search_name{
				position:relative;
				font-size:16px;
				color:#FFFFFF;
				font-family:Microsoft JhengHei;
				cursor: pointer;
				*opacity: 0.3;
				text-align:center;
				margin:5px 5px 5px 5px;
			}
			.search_result{
				position:relative;
				font-size:16px;
				color:#FFFFFF;
				font-family:Microsoft JhengHei;
				*opacity: 0.3;
				text-align:center;
				margin:15px 5px 10px 5px;
				*float:left;
				*top:180px;
			}
			.search_result::before{
				*clear:both;
			}
			
		</style>

	</head>

<body style="overflow-x: hidden;margin:0 0 0 0 ;background-color:#333333;">
	<div class='frame' id='frame'>
		<div class="navbar navbar-fixed-top" id='headerlink'>
			<div class="navbar-inner" >
				<div class="navcontainer" >
					<?php include('../zhen/login_success.php')?>
					<ul class="nav searchbox">
						<li><input type="text" id='searchbox'  placeholder="搜尋" style="font-color:#a1a1a1" onkeydown="search()"></li>
					</ul> 
					<ul class="nav button">
							<li><a href=".."><img src="img/forum.png"></a></li>
							<li><a href="../jsstl-master/index.php"><img src="img/print.png"></a></li>
							<li><a href="../newShowmode/index.php"><img src="img/platform.png"></a></li>
							<li><a href="../zhen/forum/forum_index.php"><img src="img/forum.png"></a></li>	
					</ul>
					<span class="logo"><a href="../index.php"><img src="../img/print_img/choose.png"></a></span>
					<span class="nav uploadbutton" ><a href="../showMode/file_upload.php"><img src="../img/upload.png"></a></span>
				</div>
			</div>
		</div>
		
		<div class="search_frame">
			<div class='search_content' >
				<?include('search_content.php'); ?>
			</div>

		</div>
	</div>
		<script type="text/javascript" src="../js/search.js"></script>
	</body>

</html>