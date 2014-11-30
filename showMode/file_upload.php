<html lang="zh-tw" >
<!DOCTYPE html>
<meta charset="utf-8" />
<head>
    <meta charset="UTF-8">
    <title>拖曳多檔案上傳</title>
	<link rel="stylesheet" type="text/css" href="../css/fixbar.css">
	<script type="text/javascript" src="../js/search.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script><!--自動refresh-->
	<script>
		//自動refresh
	//	$(window).resize(function(){
	//		window.location.reload();
	//	  });
	</script>
	<style>
    body {
        font-family:Microsoft JhengHei;
        color:#ffffff;
    }

	.uploadform input, .uploadform select, .uploadform textarea,.uploadform button{
		font-family:Microsoft JhengHei;
		background-color: transparent;
		-webkit-border-radius:0px;
		border-width : 1px;
		font-size:16px;
		border-color:#FFFFFF;
		outline:none;
		color:#999999;
	}

	#first{
		position:absolute;
		*top:170px;
		left:520px;
        -webkit-transition:all 1s;

	}
	#second{
		position:absolute;
		*top:170px;
		left:820px;
        -webkit-transition:all 1s;
	}
	#physical{
		position:absolute;
		*top:150px;
		left:1000px;
        -webkit-transition:all 1s;
	}
	.upload{
		margin-left:20px;
		text-align:center;
		width: 540px;
		height: 370px;
		background: #4d4d4d;
        -webkit-border-top-left-radius:5px;
        -webkit-border-top-right-radius:5px;
		-webkit-border-bottom-left-radius:5px;
		-webkit-border-bottom-right-radius:5px;
        opacity:.4;
	}

    #first img {
        position:absolute;
        width:300px;
        height:400px;
        margin-top:0px;
        margin-left:0px;
        -webkit-border-top-left-radius:5px;
		-webkit-border-top-right-radius:5px;
		-webkit-border-bottom-left-radius:5px;
		-webkit-border-bottom-right-radius:5px;
        -webkit-transition:opacity 1s;
        opacity:0;
    }

    #second img {
        position:absolute;
        width:270px;
        height:330px;
        margin-top:0px;
        margin-left:0px;
        -webkit-border-top-left-radius:5px;
		-webkit-border-top-right-radius:5px;
		-webkit-border-bottom-left-radius:5px;
		-webkit-border-bottom-right-radius:5px;
        -webkit-transition:opacity 1s;
        opacity:0;
    }


    #physical img {
        position:absolute;
        width:270px;
        height:360px;
        margin-top:0px;
        margin-left:0px;
        -webkit-border-top-left-radius:5px;
		-webkit-border-top-right-radius:5px;
		-webkit-border-bottom-left-radius:5px;
		-webkit-border-bottom-right-radius:5px;
        -webkit-transition:opacity 1s;
        opacity:0;
    }
	#basicInfo{
		position:absolute;
		*top:170px;
       	left:50px;

	}
	#confirm{
		position:relative;
		z-index:1100;
		top:450px;
		margin-right:auto;
		margin-left:auto ;
		text-align: center;
		
	}
	#confirm>input{
		z-index:1100;
	}
    #firstProgress{
        position:relative;
        margin-bottom:0px;
        margin-left:0px;
        width:300px;
        background:#FFFF33;
        -webkit-border-top-left-radius:5px;
		-webkit-border-top-right-radius:5px;
		-webkit-border-bottom-left-radius:5px;
		-webkit-border-bottom-right-radius:5px;

        }
    #secondProgress{
        position:relative;
        margin-bottom:0px;
        margin-left:0px;
        width:300px;
        background:#00F7FA;
        -webkit-border-top-left-radius:5px;
		-webkit-border-top-right-radius:5px;
		-webkit-border-bottom-left-radius:5px;
		-webkit-border-bottom-right-radius:5px;
        }

    #physicalProgress{
        position:relative;
        margin-bottom:0px;
        margin-left:0px;
        width:300px;
        background:#00F7FA;
        -webkit-border-top-left-radius:5px;
		-webkit-border-top-right-radius:5px;
		-webkit-border-bottom-left-radius:5px;
		-webkit-border-bottom-right-radius:5px;

        }
	#secondnormData>input{
		*position:absolute;
*		top:50px;
*		left:70px;
*		margin-left: auto;
*		margin-right: auto;
	}
	#modelDisplay{
		position:relative;
		left:0px;
		top:0px;
	}
	#modelDisplay>canvas{
		z-index:1;
	}
	#auzPrice{
		width:50px;
	}
	#chooseFolder>select{
		width:140px;
	}
	#createFolder{
		position: relative;
		top: 120px;
		left: 65%;
		
	}
	
	#form_frame{
		position:relative;
		margin-top:130px;
		padding-top:10px;
		height:550px;	
	}
	.2dpic{
		position:absolute;opacity:0;
	}

	
	</style>

	</head>

<body style="overflow-x: hidden;margin:0 0 0 0 ;background-color:#333333;">
	<?php
	session_start();
		require_once("../db/dblogin.php");
		require_once("../db/dbconnect.php");
		$db=new DB();
		$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
		if( !isset($_SESSION['No']))
		{
			echo "<script language='javascript'>";
			echo "alert('尚未登入，請重新登入');";	
			echo "window.location.assign('/zhen/login.php');";
			echo "</script>";
			exit;
			//header('../index.php');
			//exit;
		}
	?>
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
						<li><a href=""><img src="../img/forum.png"></a></li>	
					</ul>
					<span class="logo"><a href="../index.php"><img src="../img/print_img/choose.png"></a></span>
					<span class="nav uploadbutton" ><a href="/showMode/file_upload.php"><img src="../img/upload.png"></a></span>
				</div>
			</div>
		</div>
		<div id='form_frame'>
			<form action="upload.php" method="post" name="file" class="uploadform" id="uploadform" enctype="multipart/form-data">
				<div id = "basicInfo">
					作品名稱:：<input type="text" name="name" id="name"/>
					<p>
					選擇分類：
					<select name="category" id="category">
						<option value='1'>玩具</option>
						<option value='2'>公仔</option>
						<option value='3'>服飾</option>
						<option value='4'>零件</option>
						<option value='5'>醫療</option>
						<option value='6'>建築</option>
						<option value='7'>藝術設計</option>
						<option value='8'>生活用品</option>
						<option value='9'>客製化</option>
						<option value='10'>特殊</option>
					</select></p><p class='folder'>
					是否建立資料夾：
					<input type="radio"  name="create"  value="1" onclick="document.getElementById('displayFolder').style.display='block';document.getElementById('chooseFolder').style.display='none'"/>是
					<input type="radio"  name="create"  value="0" onclick="document.getElementById('displayFolder').style.display='none';document.getElementById('chooseFolder').style.display='block'" checked/>否</p><p id="displayFolder"  style="display:none">
					資料夾名稱：<input type="text" name="folderName" id="folderName" ></p><p id='chooseFolder'>
					選擇資料夾：<select name="folder" class='folder' id='folder'>
						<?php include('personal_folder.php');?>
					</select></p><p>
					是否授權此3D作品為創用CC：
					<input type="radio" name="creativeCommons" value="1" onclick="document.getElementById('authorization').style.display='none'"checked/>是
					<input type="radio" name="creativeCommons"  value="0" onclick="document.getElementById('authorization').style.display='block'" />否</p><p id="authorization"  style="display:none">
					是否授權此3D作品：
					<input type="radio" name="authorization" value="1" onclick="document.getElementById('displayPrice').style.display='block'"/>是
					<input type="radio" name="authorization"  value="0" onclick="document.getElementById('displayPrice').style.display='none'" checked/>否</p><p id="displayPrice"  style="display:none">
					請輸入授權金額：$<input type="text" name="auzPrice" id="auzPrice" ></p><p>
					簡介：<textarea rows="4" cols="50" name="introduction" id='introduction'></textarea></p><p>
					是否有套件？(同一套建三種檔案名稱需相同)
					<input type="radio" name="part" value="yes" />有
					<input type="radio" name="part" value="no" checked />無</p>
					2D圖檔：<input type="file" name="normData2D" style="background-color:transparnt !important;" id="secondnormData" />

				</div>
				
				<div id ="first" class = "upload">
					<input type = "hidden" name="dragData[]" id="firstdragData" / >
					<input type = "hidden" name="dragSize" id="dragSize" / >
					<br/>拖曳STL 3D圖檔(檔案限制40MB)

					<div id="firstProgress"></div>
					<div id = "modelDisplay"></div>
				</div>
				
		<!--		<div id = "second" class = "upload">
					<input type = "hidden" name="dragData[]" id="seconddragData"/ >
					
					<div id="secondProgress"></div>
				</div>                      here-->
				<!--<div id = "physical" class = "upload">
					<input type = "hidden" name="dragData[]" id="physicaldragData"/ >
					拖曳檔案<input type="file" name="normData[]"  id="physicalnormData" />
					<div id="physicalProgress"></div>
				</div>-->
				<div id = "info" ></div>
				<p></p>
				<div id = "confirm">
					<input type="submit" name='submit' value='確定'  onclick='return checkFields(); '/>
					<input type="reset" value="oops" />
				</div>
			
			</form>
		</div>
	</div>

<script src="js/three.js"></script>
<script src="js/stats.js"></script>
<script src="js/detector.js"></script>
<script src="js/STLLoader.js"></script>
<script src="js/stlviewer.js"></script>
<script src="js/uploadform.js"></script>
<script type="text/javascript" src="../js/search.js"></script>
<script type="text/javascript">
	document.getElementById("form_frame").style.height =  window.innerHeight -140 +'px';
	console.log( window.innerHeight);
</script>
</body>

</html>
