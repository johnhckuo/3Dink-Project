<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../css/fixbar.css" >
	<link rel="stylesheet" type="text/css" href="../css/total.css" >
	<?php
		session_start();
		require("../db/dblogin.php");
		require("../db/dbconnect.php");
		$db=new DB();
		$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
		if(isset($_SESSION['No'])==False)
		{
			echo "<script language='javascript'>";
			echo "alert('尚未登入，請重新登入');";	
			echo "window.location.assign('login.php');";
			echo "</script>";
			exit;
		}
	?>
	<style type="text/css">
		.middle{
			width:940px;
			margin-top: 10%;
			margin-left:auto;
			margin-right:auto;
			color:#ffffff;	
			font-family: Microsoft JhengHei;	
			opacity: 0.9;
		}
		.middle_topDescription {
			color:#ffffff;			
			font-family: Microsoft JhengHei;
			font-size: 20px;
			font-weight: bold;
			opacity: 0.9;			
		}
		.middle_topDescription>span>a{
			text-decoration:none;
			color:#ffffff;			
			opacity: 0.9;		
		}
		.picture_upload{
			*width: 100px;
			height: 550px; 
		}
		#dropDIV{
			text-align: center; 
			width: 100px;
			height: 500px;        
			border: dashed 2px gray; 
			position: absolute;
			margin-top: 10px;
			
		}
		#imgDIV{
			margin-left: 1px;
		}
		#imgDIV>img{
			*max-height:500px; 
			*max-width:100px;
			width: 100px;
			height: 500px;
			position: absolute;
		}
	</style>
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
			<div class='middle'>
				<div class='middle_topDescription'>
					<span style="float:right;">
						<a href="javascript:void(0);" onclick="MM_openBrWindow('adsDescription.html','adsDescription','500','500')">說明</a>
					</span>
					<span>在3D印客上刊登廣告</span>			
					<hr width='940px'>
				</div>
				<div class='middle_centreForm'>
					<form method="post" action="ads_form.php" enctype="multipart/form-data">				
						<span>購買週數：<input type='text' name='weeks' style='width: 20px;'>&nbsp;周</br></span>
						<span>廣告的連結網址：<input type='text' name='adsUrl'></br></span>	
						<div class='picture_upload'>	
							<span>上傳圖片<input type="file" name="pic" id='pic' accept="image/jpeg" style="width: 200px;" >尺寸100*500</span>
								<input type = "hidden" name="dragData"  id='dragData' >
								<div id="dropDIV" ondragover="dragoverHandler(event)" ondrop="dropHandler(event)">
									或拖曳圖片到此處上傳
									<div id="up_progress"></div>
								</div>
								<div id="imgDIV"></div>
						</div>
					<div class='submit'>	
						<input type='submit' value='送出'>
						<input type='reset' value='取消 '>	
					</div>	
					</form>
				</div>
					
			</div>
		</div>
	<script language="JavaScript" type="text/JavaScript"> 
		document.getElementById("straightlineleft").style.height = document.getElementById("frame").clientHeight;
		document.getElementById("straightlineright").style.height = document.getElementById("straightlineleft").style.height;
		function MM_openBrWindow(theURL,winName,win_width,win_height) { 
		  var PosX = (screen.width-win_width)/2; 
		  var PosY = (screen.height-win_height)/2; 
		  features = "width="+win_width+",height="+win_height+",top="+PosY+",left="+PosX; 
		  var newwin = window.open(theURL,winName,features); 
		} 
		
		 function dragoverHandler(evt) {
            evt.preventDefault();
        }
        function dropHandler(evt) {//evt 為 DragEvent 物件
            //var DragUpload={};
			//DragUpload.target = {id:evt.target.id}; //new
			evt.preventDefault();
            var files = evt.dataTransfer.files;//由DataTransfer物件的files屬性取得檔案物件
            var fd = new FormData();
            var xhr = new XMLHttpRequest();
            var up_progress = document.getElementById('up_progress');       
			var files_name=files[0].name;
			xhr.open('POST', 'ads_form.php');
			document.getElementById("dragData").value=files_name;
			xhr.onload=function(){
				//$(DragUpload.target.id+"dragData").value = files.name;
				//var temp = DragUpload.target.id+"Progress"; //*
				//$(temp).style.opacity=0;
				up_progress.innerHTML = '100 %, 上傳完成';
			};
            xhr.upload.onprogress = function (evt) {
              //上傳進度
              if (evt.lengthComputable) {
                var complete = (evt.loaded / evt.total * 100 | 0);
                if(100==complete){
                    complete=99.9;
                }
                up_progress.innerHTML = complete + ' %';
              }
            }
 
         
            for (var i in files) {
                if (files[i].type == 'image/jpeg') {
                    //將圖片在頁面預覽
                    var fr = new FileReader();
                    fr.onload = openfile;
                    fr.readAsDataURL(files[i]);
                     
                    //新增上傳檔案，上傳後名稱為 ff 的陣列
                    fd.append('ff[]', files[i]);
					
                }
            }
            xhr.send(fd);//開始上傳
        }
        function openfile(evt) {
            var img = evt.target.result;
            var imgx = document.createElement('img');
            //imgx.style.margin = "10px";
            imgx.src = img;
            document.getElementById('imgDIV').appendChild(imgx);
        }    
	</script> 
</body>
</html>		