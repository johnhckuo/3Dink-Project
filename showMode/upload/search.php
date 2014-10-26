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
					<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
	<style type="text/css">
		.member_pic>a>img{
			width:46px;
			height:46px;
			border:1px solid gray;
			float:right;
			margin-top:25px;
			margin-right:15px;
		}
		
		.text-right{
			position:relative;
			float:right;
			width:140px;
			word-wrap: break-word;
			word-break: normal;
			vertical-align:bottom;
			margin-top:22px;
			margin-right:45px;
		}
		.navbar .nav.login_right{
			float:right;
			-webkit-padding-start: 0px;
			
		}
		.login_right>li{
			color:#999999;
			text-shadow:0 -1px 0 rgba(0, 0, 0, 0.25);
			font-family:Microsoft JhengHei;
			font-size:18px;
			padding-right:4px;
			overflow:hidden;
			text-overflow:ellipsis;
			white-space: nowrap;
			width:120px;
		}
		.login_right>li>a{
			text-decoration:none;
			color:#999999;
		}
		.login_right_a{
			-webkit-padding-start: 0px;
			float:right;
		}
		.login_right_a>li{
			
			color:#999999;
			text-shadow:0 -1px 0 rgba(0, 0, 0, 0.25);
			font-family:Microsoft JhengHei;
			*font-size:18px;
			padding-right:4px;
		}
		.login_right_a>li>a{
			padding:0px 5px 5px 5px;
			color:#999999;
			text-decoration:none;
			text-shadow:0 -1px 0 rgba(0, 0, 0, 0.25);
			font-family:Microsoft JhengHei;
			font-size:16px;
			
		}
	
	</style>
</head>
<body>
<div class='text-right'><ul class=' pull-right'><li ><a href='/zhen/login.php' >登入</a></li><li ><a href='/zhen/register.php'>註冊</a></li></ul></div>			
</body>
<script language="javascript" type="text/javascript">

		//var divID = "name_content";
		function Expand(obj) {
			var divObject = document.getElementById( "name_content");
			var divtest1=document.getElementById( "space_use");
			var divtest2=document.getElementById( "quota_graph_container");
			if (obj != null)
			{		
				$('nameTile').innerHTML=obj.innerHTML;
			}
			//divObject.className = "name_hidden";	
			if (divObject.className == "name_content"){
				divObject.className = "name_hidden";
				divtest1.style.display="none";
				divtest2.style.display="none";
			}
			else{			
				divObject.className = "name_content";
				divObject .style.display="block";
				divtest1.style.display="block";
				divtest2.style.display="block";
			}
		}		 

		//升級控制
//		function test1() { 
//			if(confirm('確定升級'))
//			{
					
//					window.location.assign("/zhen/upgrades.php");
				
//			}　　
			
//		}
		
	
		
		
		
</script>
</html>					<ul class="nav searchbox">
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
				<html lang="zh-tw">
<!DOCTYPE html>
<meta charset="utf-8" />



            


<span class='search_title'>搜尋結果</span><div class='search_result'>有 0 個項目符合</div>	<script type='text/javascript'>
		function result(){
			location.href='personal.php';
		}
	</script>
</html>			</div>

		</div>
	</div>
		<script type="text/javascript" src="../js/search.js"></script>
	</body>

</html>