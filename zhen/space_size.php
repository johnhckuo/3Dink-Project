<?php
	session_start();
	require_once("/var/www/db/dblogin.php");
	require_once("/var/www/db/dbconnect.php");
	$db=new DB();
	$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	if(isset($_SESSION['No']))
	{
		$memberNo=$_SESSION['No'];
	}
	$sql= "SELECT `3dimageSize(kb)` FROM platform WHERE memberNo='$memberNo' ";
	$result = $db->query($link,$sql);
	$sizeSum=0;
	while($row= mysqli_fetch_row($result))
	{
		$sizeSum=$sizeSum+$row[0];
	}
	
	$kb=$sizeSum/1024;
	$mb=$kb/1024;
	$gb=$mb/1024;
	$kb = number_format($kb, 2);
	$mb = number_format($mb, 2);
	$gb = number_format($gb, 2);
	//echo $kb."------\n".$mb."------\n".$gb;
?>
<html>
<head>
<!--
<style type="text/css">
	.quota_graph_bar{
		background: #69b5f2;
		border: 1px solid #5d9fd5;
		height: 4px;
	}
	.quota_graph_container
	{
		border-top: 1px solid #ddd;
		background: #eee;
		height: 5px;
		width: 165px;
	}
	
		.name_field>span{
			font-weight: bold;
			font-size:28px;
			color:#fed116;
			opacity:0.6;
			display:block;
		}
		.name_content{

			background-image:url(../img/Dialog.png);
			background-size:100% 100%;
			width:920px;
			height:220px;
			font-weight: bold;
			font-size:28px;
			*color:#FFFFFF;
			font-family:Microsoft JhengHei;
			text-align:center;
			overflow-x:auto;	
			display:block;
			transation:0.3sec;
			display:none;
		}
		
		.name_content>div{
			height:6px;
			width:100px;
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
		.name_content>div:hover{
			color:#fed116;
			opacity:1;
		}
		.name_hidden{
			display:none;
		}
</style>
-->
</head>
<body>
<!--
<div class='content'>
<?php $gb=1.25?>
	<span>已使用<?php echo $gb;?>GB(剩餘<?php echo 2-$gb;?>GB)</span>
	<div class='quota_graph_container'>
		<div style="width: <?php echo $gb/2*100?>%;" class="quota_graph_bar "></div>
	</div>
<div class="name_field" id="name_field" type="button"  onclick="return CollapseExpand();">
	<span id="nameTile">葉玉楨</span>

<div class= "name_content" id='name_content' >
	<span id='space_use'  style='display:none'>已使用<?php echo $gb;?>GB(剩餘<?php echo 2-$gb;?>GB)</span>
	<div id ='quota_graph_container'class='quota_graph_container' style='display:none'>
		<div style="width: <?php echo $gb/2*100?>%;" class="quota_graph_bar "></div>
	</div>
</div>
<script language="javascript" type="text/javascript">

		//var divID = "name_content";
		function CollapseExpand(obj) {
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

		
		
	</script>

</body>
</html>
-->