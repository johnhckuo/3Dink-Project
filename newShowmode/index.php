<html lang="en">
<!DOCTYPE html>
<meta charset="utf-8" />

<head>
    <title></title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		
    <meta name="viewport" content="initial-scale=1.0, user-scalable=0" />
    <link rel=stylesheet type="text/css" href="../css/fixbar.css" >
	<link rel="stylesheet" href="css/style.css" media="screen" />
	<style type="text/css">
		button{	
			border:none;
			background:none;
		}
	

		.container {
			position:relative;
			top:-5%;
			width:1000px;
			height:1000px; 
			margin-left: auto; 
			margin-right:auto;
			-webkit-perspective: 1200px;  
			-webkit-transition:all 1s;
			-webkit-perspective-origin-y:50%;
			-webkit-transform-origin:center center;
			-webkit-transition:all 1s;
		}
		#p{
			overflow:hidden;
			text-overflow:ellipsis;
			white-space: nowrap;
		}
		#carousel {
			width: 100%;
			height: 100%;
			position: absolute;
			left:50%;
			top:50%;
			width:1000px;
			height:1000px;
			margin-top: -700px;  
			margin-left: -500px;  
			-webkit-transform-style: preserve-3d; 
			-webkit-transform-origin:center bottom;
			-webkit-transition:all 0.5s;
		}
		#carousel figure {
			display: block;
			position: absolute;
			left:50%;
			top:50%;
			margin-top: -55px;  
			margin-left: -55px;  	
			font-size: 80px;
			font-weight: bold;
			color: white;
			text-align: center;
			-webkit-transition:all 1s;
	*		opacity:0; 
			-webkit-backface-visibility: hidden;
		}
		#carousel figure div{
			margin-top:20px; 
			width:115px; 
			height:115px;	
		}
		#carousel figure div span{
			-webkit-transition:all 0.5s;
			padding-top:2.5px;
			padding-left:2.5px;
			padding-right:2.5px;
			padding-bottom:2.5px;
			position:absolute;
			width:110px;
			height:110px;
			background:black;
			opacity:0;
			color:#ffffff;
			font-size:5px;
			text-align:center;
			
		} 
		#carousel figure div:hover span{
			opacity:0.7;
		}
		#carousel figure div img{ 
			width:100%; 
			height:100%;
			
		}
		#previous{
			position:absolute;
			left:0px;
			top:350px;
			outline:none;
			
		}
		#next{
			position:absolute;
			right:0px;
			top:350px;
			outline:none;
		}
		#previous>img{
			width:300px;
			height:300px;
		}
		#next>img{
			width:300px;
			height:300px;
		}
		.category{
			position:relative;
			top:120px;
			width:940px;
			margin-left:auto;
			margin-right:auto;
			z-index:1000;
		}
		.category_title{
			*background-image:url(../img/frame.png);
			background:-webkit-linear-gradient(top,rgba(30,30,30,0.3),rgba(250,250,250,0.3));
			*opacity:0.6;
			background-size:100% 100%;
			width:720px;
			*height:50px;
			padding-top:10px;
			font-family:Microsoft JhengHei;
			cursor: pointer;
			margin-left:auto;
			margin-right:auto;
		}
		.category_title>span{
			height:30px;
			width:120px;
			margin-left:auto;
			margin-right:auto;
			font-weight: bold;
			font-size:28px;
			color:#fed116;
			opacity:0.6;
			display:block;
			text-align:center;
			text-decoration:none;
		}
		.category_content{
			background-image:url(../img/frame.png);
			background-size:100% 100%;
			position:absolute;
			left:110px;
			width:720px;
			height:220px;
			font-weight: bold;
			font-size:28px;
			color:#FFFFFF;
			font-family:Microsoft JhengHei;
			text-align:center;
			overflow-x:auto;	
			transation:0.3sec;
			-webkit-animation: none 1s;

		}
		
		.category_content>div{
			color:#FFFFFF;
			text-decoration:none;
			height:100px;
			width:25px;
			margin:10px 20px 10px 20px;
			border-width : 1px;
			-webkit-border-top-left-radius:5px;
			-webkit-border-top-right-radius:5px;
			-webkit-border-bottom-left-radius:5px;
			-webkit-border-bottom-right-radius:5px;
			cursor: pointer;
			opacity: 0.3;
			float:left;
		}
		.category_content>div:hover{
			color:#fed116;
			opacity:1;
			
		}
		
		.content_hidden{
			display:none;
		}
		.categoryhr{
			position:relative;
			background-color:#fed116;
			size:2;
			border:0;
			height:1px;
			*opacity:0.6;
			margin-top:10px;
			margin-bottom:0px;
		}

	
	</style>
	<script language="javascript" type="text/javascript">
	
		function http_request(num){
			var xhr = new XMLHttpRequest;
				xhr.onreadystatechange = function(){
				if (xhr.readyState == 4){
					if(xhr.status==200)
					{	
						
						var string = xhr.responseText.split('+');
						var flag = 0;
						var content='';
						content+="<figure id='"+flag/3+"'>";
						for (var i  in string){
							string[i]=string[i].trim();
							if (i%6 == 1)
								content+= "<div><a href='../showMode/index.php?categoryNo="+string[i];
							else if (i%6 ==2)
								content+="&pictureNo="+string[i]+"'>";
							else if (i%6 ==3)
								content+="<span>"+string[i]+"<p>說明：";
							else if (i%6 ==4)
								content+=string[i]+"</p></span>";
							else if (i%6 ==5){
								content+="<img src='../showMode/"+string[i]+"' /></a></div>";
								flag++;
								if (flag%3 == 0 && i!=(string.length-1))
									content+="</figure><figure id='"+flag/3+"'>";
									
							}
						}   
						content+= "</figure>";
						$('carousel').innerHTML=content;
						init(Math.ceil(flag/3));   
					}	
				}
				
			}
				xhr.open("GET","newShowmode_content.php?category="+num,true);
				xhr.send(null);
			
		}
		
		var divID = "category_content";
		function CollapseExpand(obj,num) {
			var divObject = document.getElementById(divID);
			var currentCssClass = divObject.className;
			
			if (obj != null && num!=null){
				$('collapseTitle').innerHTML=obj.innerHTML;
				http_request(num);	
				
			}
				
				
			/*if(location.search){
				$('collapseTitle').innerHTML=location.search;
			}*/
			if (divObject.className == "category_content"){
				//divObject.className = "content_opacity";
				divObject.style.WebkitAnimationName = 'fadin';
				setTimeout(function () {  
					divObject.className = "content_hidden";
				}, 1000);  
			}
			else{
				divObject.style.WebkitAnimationName = 'fadout';
				divObject.className = "category_content";
			}
		}
		
		
	</script>
	
</head>

<body style="overflow-x: hidden;margin:0 0 0 0 ;background-color:#333333;">
		<?php $memberNo=0;?>
		<div class='frame' id='frame'>
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
			<div id="category" class="category">
				<!--<input id="Button1" type="button" value="Collapse/Expand" onclick="return CollapseExpand()" />-->
				<div class="category_title" type="button"  onclick="return CollapseExpand()">
					<span id="collapseTitle">熱門</span>
					<hr class="categoryhr">
				</div>
				<div id="category_content" class="content_hidden">
					
					<div  type="button"  onclick="CollapseExpand(this,1)">玩具</div>
					<div  type="button"  onclick="CollapseExpand(this,2)">公仔</div>
					<div  type="button"  onclick="CollapseExpand(this,3)">服飾</div>
					<div  type="button"  onclick="CollapseExpand(this,4)">零件</div>
					<div  type="button"  onclick="CollapseExpand(this,5)">醫療</div>
					<div  type="button"  onclick="CollapseExpand(this,6)">建築</div>
					<div  type="button"  onclick="CollapseExpand(this,7)">藝術設計</div>
					<div  type="button"  onclick="CollapseExpand(this,8)">生活用品</div>
					<div  type="button"  onclick="CollapseExpand(this,9)">客製化</div>
					<div  type="button"  onclick="CollapseExpand(this,10)">特殊</div>
					<div  type="button"  onclick="CollapseExpand(this,0)">熱門</div>
					
					
				</div>
			</div>
			<section class="container" id="container">
				<div id="carousel" class="target-paused">
					<?php include('newShowmode_content.php'); ?>
				</div>
			</section>

			<section id="options">
				<p id="navigation">
				  <button  id="previous" data-increment="-1"><img src='../img/arrow.png' style='height:75px;width:75px;transform:rotate(180deg);'  data-increment="-1"></button>
				  <button  id="next" data-increment="1"><img src='../img/arrow.png' style='height:75px;width:75px;' data-increment="1"></button>
				</p>
			</section>
	

		</div>
	<script src="js/utils.js"></script>
	<script src="js/createList.js"></script>
	<script src="js/init.js"></script>
	<script type="text/javascript" src="../js/search.js"></script>
    <script type="text/javascript">
		
		var count=0;
		var list = new List();
		var listCurrent;

		function $(id){
			return document.getElementById(id);
		}
		(function start(){
			http_request(0);
		})();
	//	window.addEventListener( 'DOMContentLoaded', init, false);
    </script>

</body>
</html>


