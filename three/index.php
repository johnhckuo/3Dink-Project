﻿<html>
	<head>
		<title>3Dink</title>
		<link rel="stylesheet" type="text/css" href="css/three.css" >
		<link rel="stylesheet" type="text/css" href="../css/fixbar.css" >
		<style type="text/css">
			
		</style>
	</head>
	<body style="overflow-x: hidden;margin:0 0 0 0 ;background-color:#333333;">
		<div class="navbar navbar-fixed-top" id='headerlink'>
			<div class="navbar-inner" >
			<div class='fixbarleft' id='fixbarleft'><img src='../img/fixbar_left.png'></div>
				<div class="navcontainer" >
					<?php include('../zhen/login_success.php');?>
					<ul class="nav searchbox">
						<li><input type="text" id='searchbox'  placeholder="搜尋" style="font-color:#a1a1a1" onkeydown="search()"></li>
					</ul> 
					<ul class="nav button">
							<li><a href=".."><img src="../img/forum.png"></a></li>
							<li><a href="../jsstl-master/index.php"><img src="../img/print.png"></a></li>
							<li><a href="../newShowmode/index.php"><img src="../img/platform.png"></a></li>
							<li><a href="../zhen/forum/forum_index.php"><img src="../img/forum.png"></a></li>	
					</ul>
					<span class="logo"><a href="../index.php"><img src="../img/print_img/choose.png"></a></span>
					<span class="nav uploadbutton" ><a href="../showMode/file_upload.php"><img src="../img/upload.png"></a></span>
				</div>
				<div class='fixbarright' id='fixbarright'><img src='../img/fixbar_right.png'></div>
			</div>
		</div>
		<script src="js/modernizr.custom.93389.js"></script>
		<script src="js/drag.js"></script>
		<script src="js/THREEx.GeometryUtils.js"></script>
		<script src="js/ThreeText.js"></script>
		<script src="js/three.js"></script>
		<script src="js/FirstPersonControls.js"></script>
		<script src="js/csg.js"></script>
		<script src="js/ThreeCSG.js"></script>
		<script src="js/TrackballControls.js"></script>
		<script src="js/drag.js"></script>
		<script src="js/Stats.js"></script>
		<script src="fonts/helvetiker_bold.typeface.js"></script>
		<script src="fonts/helvetiker_regular.typeface.js"></script>
		<script src="fonts/optimer_bold.typeface.js"></script>
		<script src="fonts/optimer_regular.typeface.js"></script>
		<script src="fonts/gentilis_bold.typeface.js"></script>
		<script src="fonts/gentilis_regular.typeface.js"></script>
		<script src="js/FileSaver.js"></script>
		<script src="js/axes.js"></script>
		<script src="js/STLcreator.js"></script>
		<script src="js/customize.js"></script>
		<script src="js/STLLoader1.js"></script>
		<script src="js/STLreader.js"></script>
	
		
		<script src="js/fundamental.js"></script>
		
		
		<div id="tutorial">
			<div id="tutorialBackground"></div>
			<div id='tutorialContent'>
				<h1>歡迎來到 3D印客 線上3D繪圖模式</h1>
				<h3>使用說明</h3>
				<ul>
					<li>右上角畫面之FPS代表目前瀏覽器處理效能，平均分數為45~60，若低於45，建議重新整理瀏覽器。</li>
					<li>3D繪圖區域僅限於起始畫面所見之透明方格面板，其餘地方無法建模。</li>
					<li>3D模型以及印章可使用滑鼠進行拖曳，並且刪除(針對物件連點兩下)。</li>
					<li>特殊模式(3D手繪模式、MineCraft模式)執行時，若欲切換其他模式，請先關閉目前繪圖模式。</li>
					<li>操作說明</li>
					<ul>
						<li>滑鼠左鍵按住並且移動 → 選轉視角。</li>
						<li>滑鼠右鍵按住並且移動 → 平移視角。</li>
						<li>左鍵點擊3D模型以及印章 → 拖曳物件。</li>
						<li>左鍵快速連點3D模型以及印章 → 刪除物件。</li>
					</ul>
					<li>若完成作品，可開始進行轉檔並列印的步驟。</li>
					<ul>
						<li>按下「STL 轉檔」</li>
						<li>按下「Gcode 轉檔」</li>
						<li>按下「線上列印」，並跳轉至列印設定頁面</li>
					</ul>
					<li>為了您的最佳瀏覽體驗，瀏覽器建議使用Google Chrome 版本 35.0.1916.153 m 或以上版本</li>
			   </ul>
				
			</div>
			<input type='button' id="tutorialButton" class ='threeButton' value='開始繪圖' onclick='stopTutorial();'/>  
		</div>
		
		
		<div id='div1'>
			
			<div id='loading'>
				<img id="img1" src='img/loading.png' />
			</div> 
			
			<div id = "attribute">
				<div id='clickMe'>Attribute</div>
				
				
				
				<div class = 'background'></div>
				<h2> 建立3D模型</h2>
				<div id="textmodel" class="textmodel" onclick="return CollapseExpand1()">
					<h3>3D 文字</h3>
				</div>
				<div id="modeloff1" class="modeloff1">	
					<hr>
					3D 文字：  <input type='text' id='custom' class ='threeText'  placeholder="請輸入英文"/><p>
					文字尺寸： <input type='text' id='textSize' class ='threeText'  value='20' size='3'/>
					文字厚度： <input type='text' id='textHeight' class ='threeText' value='20' size='3'/><p>
					文字字體： 
					<select id="font" >
					 <option value='gentilis'>Gentilis</option>
					 <option value='helvetiker'>Helvetiker</option>
					 <option value='optimer'>Optimer</option>
					</select><p>
					<div class="centerer">
					<input type='button' class ='threeButton' value='產生模型' onclick='customize();'  style="width:100px;  "/>
					</div>
				</div>
				<hr>
				<div id="stampmodel" class="stampmodel" onclick="return CollapseExpand2()">
					<h3>印章模型</h3>
				</div>
				<div id="modeloff2" class="modeloff2">	
					<hr>
					印章文字：<input type='text' id='stampText' class ='threeText' size="8" placeholder="請輸入英文"/>&nbsp &nbsp
					文字尺寸：<input type='text' id='stampTextSize' class ='threeText'  size="4"/><p>
					<div class="centerer">
						<input type='button' class ='threeButton' value='產生模型' onclick='stamp();' style="width:100px;"/> 
					</div>
				</div>
				<hr>
		<!--	<input type='button' class ='threeButton' value='Ring Creator' onclick='ringCreator();'/>
				<input type='button' class ='threeButton' value='Eraser' onclick='lockDown();'/><p>
				<input type='button' class ='threeButton' id='convert' value='JuJu Ring' onclick=" STLreader('1'); "/>
				<input type='button' class ='threeButton' id='convert' value='Empty Ring' onclick=" STLreader('2'); "/>   -->
				<div id="paintmodel" class="paintmodel" onclick="return CollapseExpand3()">
					<h3>3D手繪模式</h3>
				</div>
				<div id="modeloff3" class="modeloff3">	
					<hr>
					3D手繪模式：&nbsp &nbsp <input type='button'  id='3dpaint' class ='threeButton' value='開啟' style="width:180px;" onclick=" reStart(); "/><p>
					<span id='painter'>筆刷粗細</span> &nbsp &nbsp <input type="range" name="rangeInput" min="1" max="5" step="2" onchange="painterCustomize(this.value)" style="width:200px; " ><p>                                                       
					目前所在層數： 第<input type='text' id='currentLayer' class ='threeText'  size="2" value='0'/>層 &nbsp &nbsp
					<input type='button'  id='3dpaintLayer' class ='threeButton' value='上一層' onclick=" paintLayer(1); "/> &nbsp
					<input type='button'  id='3dpaintLayer' class ='threeButton' value='下一層' onclick=" paintLayer(-1); "/><p>
					複製<input type='text' id='fromLayer' class ='threeText'  size="1"/>
					層至<input type='text' id='toLayer' class ='threeText'  size="1"/>層 &nbsp
					<input type='button'  id='layerCopy' class ='threeButton' value='複製單層' onclick=" copyLayer(); "/>
					<input type='button'  id='layersCopy' class ='threeButton' value='複製多層' onclick=" copyLayers(); "/>
				</div>
				<hr>
				<div id="othermodel" class="othermodel" onclick="return CollapseExpand4()">
					<h3>其他3D模型</h3>
				</div>
				<div id="modeloff4" class="modeloff4">
					<hr>
					<input type='button'  class ='threeButton' value='環面結' onclick='torusCreator();'/>&nbsp &nbsp
					<input type='button' class ='threeButton' value='圓球' onclick='sphereCreator();' />&nbsp &nbsp
					<input type='button'  id='minecraft' class ='threeButton' value='MineCraft' onclick=" voxelPainter(); " onmouseover="over();" onmouseout="out();"/><p>
				</div>
				<hr>
				<div id="housemodel" class="housemodel" onclick="return CollapseExpand5()">
					<h3>房屋</h3>
				</div>
				<div id="modeloff5" class="modeloff5">
					<hr>
					<input type='button' class ='threeButton' value='室內瀏覽模式' id='designer' onclick='failDesigner();' />&nbsp &nbsp
					<input type='button' class ='threeButton' value='椅子' onclick='chair();' />&nbsp &nbsp
					<input type='button' class ='threeButton' value='桌子' onclick='desk();' />&nbsp &nbsp 
					<input type='button' class ='threeButton' value='房屋牆壁' onclick='wall();' />&nbsp &nbsp  
					<input type='button' class ='threeButton' value='房屋屋頂' onclick='roof();' />&nbsp &nbsp  
					<input type='button' class ='threeButton' value='門' onclick='door();' />&nbsp &nbsp
					<input type='button' class ='threeButton' value='窗戶' id='window'onclick='windowMaker();' />&nbsp &nbsp
					<input type='button' class ='threeButton' value='刪除物件' onclick="movementProject('delete')" />&nbsp &nbsp  <p>
					房屋高度：<input type='text' id='houseHeight' class ='threeText'  size="1"/>
					房屋寬度：<input type='text' id='houseWidth' class ='threeText'  size="1"/>
					房屋長度：<input type='text' id='houseLength' class ='threeText'  size="1"/>
					<input type='button' class ='threeButton' value='房屋結構' onclick='foundation();' />&nbsp &nbsp
					<input type='button' class ='threeButton' value='樹' id='tree' onclick='addTree();' /></br>
					柵欄寬度：<input type='text' id='fenceLength' class ='threeText' size="1"/>
					<input type='button' class ='threeButton' value='新增柵欄' id='fence' onclick='fence();' />&nbsp &nbsp
				</div>
				<br/><input type='button' id ='outputthreeButton' value='輸出3D圖檔' onclick='save();' style="width:180px; "/> &nbsp
				<input type='button' class ='threeButton' value='清除畫面' onclick='clearObject();' style="width:100px;"/>
				
				
				
			</div>
			
			<div id ="controlPanel">
				<div id='clickControl'>Advanced</div>
				<div class = 'controlBackground'></div>
				<div id="ControlTitle"><h1>進階控制</h1></div>
				
				Translate：<p>
				<input type='button' class ='threeButton' value='X+' onclick="movementProject('translatePX')" style="width:100px;"/>
				<input type='button' class ='threeButton' value='X-' onclick="movementProject('translateNX')" style="width:100px;"/>
				<input type='button' class ='threeButton' value='Y+' onclick="movementProject('translatePY')" style="width:100px;"/>
				<input type='button' class ='threeButton' value='Y-' onclick="movementProject('translateNY')" style="width:100px;"/>
				<input type='button' class ='threeButton' value='Z+' onclick="movementProject('translatePZ')" style="width:100px;"/>
				<input type='button' class ='threeButton' value='Z-' onclick="movementProject('translateNZ')" style="width:100px;"/> <p>
				
				<hr>
				Rotation：<p>
				<input type='button' class ='threeButton' value='X+' onclick="movementProject('rotatePX')" style="width:100px;"/>
				<input type='button' class ='threeButton' value='X-' onclick="movementProject('rotateNX')" style="width:100px;"/>
				<input type='button' class ='threeButton' value='Y+' onclick="movementProject('rotatePY')" style="width:100px;"/>
				<input type='button' class ='threeButton' value='Y-' onclick="movementProject('rotateNY')" style="width:100px;"/>
				<input type='button' class ='threeButton' value='Z+' onclick="movementProject('rotatePZ')" style="width:100px;"/>
				<input type='button' class ='threeButton' value='Z-' onclick="movementProject('rotateNZ')" style="width:100px;"/><p>
				
				
				<hr>
				Scale：<p>
				<input type='button' class ='threeButton' value='X+' onclick="movementProject('scalePX')" style="width:100px;"/>
				<input type='button' class ='threeButton' value='X-' onclick="movementProject('scaleNX')" style="width:100px;"/>
				<input type='button' class ='threeButton' value='Y+' onclick="movementProject('scalePY')" style="width:100px;"/>
				<input type='button' class ='threeButton' value='Y-' onclick="movementProject('scaleNY')" style="width:100px;"/>
				<input type='button' class ='threeButton' value='Z+' onclick="movementProject('scalePZ')" style="width:100px;"/>
				<input type='button' class ='threeButton' value='Z-' onclick="movementProject('scaleNZ')" style="width:100px;"/><p>
				
			
			</div>
			
			
			<div id ="stlViewer">
				<div id='clickSTL'>STL Viewer</div>
				<div class = 'background'></div>
				<div id="stlTitle"><h1>STL 3D預覽</h1></div>
				<div id="stlRenderer"></div>
				<input type='button'  id='print' class ='threeButton' value='確認列印' onclick='printButton();' onmouseover="hoverPrint();"  onmouseout='outPrint();'/>
			</div>
			<!--stl import-->
			<div id="return-category" type=button onclick="returnCategory();">回類別</div>
			<div id="footer">
				
				<div id="category" >
					<ul>
						<li type=button onclick='imageRequest(1);'>
							<img src="img/category/toy_dark.png" name="type1" onmouseout="this.src='img/category/toy_dark.png'" onmouseover="this.src='img/category/toy_ bright.png'">
						</li>
						<li type=button onclick='imageRequest(2);'>
							<img src="img/category/doll_dark.png" name="type2" onmouseout="this.src='img/category/doll_dark.png'" onmouseover="this.src='img/category/doll_bright.png'">
						</li>
						<li type=button onclick='imageRequest(3);'>
							<img src="img/category/clothing_dark.png" name="type3" onmouseout="this.src='img/category/clothing_dark.png'" onmouseover="this.src='img/category/clothing_bright.png'">
						</li>
						<li type=button onclick='imageRequest(4);'>
							<img src="img/category/parts_dark.png" name="type4" onmouseout="this.src='img/category/parts_dark.png'" onmouseover="this.src='img/category/parts_bright.png'">
						</li>
						<li type=button onclick='imageRequest(6);'>
							<img src="img/category/buding_dark.png" name="type6" onmouseout="this.src='img/category/buding_dark.png'" onmouseover="this.src='img/category/buding_bright.png'">
						</li>
						<li type=button onclick='imageRequest(7);'>
							<img src="img/category/art_dark.png" name="type7" onmouseout="this.src='img/category/art_dark.png'" onmouseover="this.src='img/category/art_bright.png'">
						</li>
						<li type=button onclick='imageRequest(8);' >
							<img src="img/category/supplies_dark.png" name="type8" onmouseout="this.src='img/category/supplies_dark.png'" onmouseover="this.src='img/category/supplies_bright.png'">
						</li>
						<li type=button onclick='imageRequest(9);'>
							<img src="img/category/customization_dark.png" name="type9" onmouseout="this.src='img/category/customization_dark.png'" onmouseover="this.src='img/category/customization_bright.png'">
						<!--<li type=button onclick='imageRequest(10);'>
							<img src="img/category/special_dark.png" name="type10" onmouseout="this.src='img/category/special_dark.png'" onmouseover="this.src='img/category/special_bright.png'">
						</li>-->
					</ul>
				</div>
				<div id="categoryimg"></div>
				<div id="arrow">
					<div class="pre" id='pre' onclick='pre();'>
						<img src="img/leftarrowD.png" onmouseout="this.src='img/leftarrowD.png'" onmouseover="this.src='img/leftarrowL.png'">
						
					</div>
					<div class="next" id="next" onclick='next();'>
						<img src="img/rightarrowD.png" onmouseout="this.src='img/rightarrowD.png'" onmouseover="this.src='img/rightarrowL.png'">
						<input type="hidden" id="count" name="count" value="0">
					</div>
				</div>
			</div>
			<!--end stl import-->
		</div>
		
	


		<script>
			init();
			animate();

			//failDesigner();
			//fixbar左右補齊
			document.getElementById("fixbarleft").style.width = (document.getElementById("headerlink").clientWidth-1140)/2 + "px";
			document.getElementById("fixbarright").style.width = (document.getElementById("headerlink").clientWidth-1140)/2 + "px";
			var aaa = document.getElementById("fixbarright").style.width;
			//暫時先用這種智障方法...
			var divID1 = "modeloff1";
		function CollapseExpand1() {
			var divObject = document.getElementById(divID1);
			console.log(divObject);
			var currentCssClass = divObject.className;
			if (divObject.className == "modelon1"){
				divObject.style.WebkitAnimationName = 'fadin';
				setTimeout(function () {  
					divObject.className = "modeloff1";
				}, 100);  
			}
			else{
				divObject.style.WebkitAnimationName = 'fadout';
				setTimeout(function () {  
					divObject.className = "modelon1";
				}, 100);  
			}
		}
			var divID2 = "modeloff2";
		function CollapseExpand2() {
			var divObject = document.getElementById(divID2);
			console.log(divObject);
			var currentCssClass = divObject.className;
			if (divObject.className == "modelon2"){
				divObject.style.WebkitAnimationName = 'fadin';
				setTimeout(function () {  
					divObject.className = "modeloff2";
				}, 100);  
			}
			else{
				divObject.style.WebkitAnimationName = 'fadout';
				setTimeout(function () {  
					divObject.className = "modelon2";
				}, 100);  
			}
		}
			var divID3 = "modeloff3";
		function CollapseExpand3() {
			var divObject = document.getElementById(divID3);
			console.log(divObject);
			var currentCssClass = divObject.className;
			if (divObject.className == "modelon3"){
				divObject.style.WebkitAnimationName = 'fadin';
				setTimeout(function () {  
					divObject.className = "modeloff3";
				}, 100);  
			}
			else{
				divObject.style.WebkitAnimationName = 'fadout';
				setTimeout(function () {  
					divObject.className = "modelon3";
				}, 100);  
			}
		}
			var divID4 = "modeloff4";
		function CollapseExpand4() {
			var divObject = document.getElementById(divID4);
			console.log(divObject);
			var currentCssClass = divObject.className;
			if (divObject.className == "modelon4"){
				divObject.style.WebkitAnimationName = 'fadin';
				setTimeout(function () {  
					divObject.className = "modeloff4";
				}, 100);  
			}
			else{
				divObject.style.WebkitAnimationName = 'fadout';
				setTimeout(function () {  
					divObject.className = "modelon4";
				}, 100);  
			}
		}
			var divID5 = "modeloff5";
		function CollapseExpand5() {
			var divObject = document.getElementById(divID5);
			console.log(divObject);
			var currentCssClass = divObject.className;
			if (divObject.className == "modelon5"){
				divObject.style.WebkitAnimationName = 'fadin';
				setTimeout(function () {  
					divObject.className = "modeloff5";
				}, 100);  
			}
			else{
				divObject.style.WebkitAnimationName = 'fadout';
				setTimeout(function () {  
					divObject.className = "modelon5";
				}, 100);  
			}
		}
		</script>
	
	</body>
	<script src="js/jquery-1.7.1.min.js"></script>
	
	<script src="js/bootstrap-modal.js"></script>
	<script src="js/sugar-1.2.4.min.js"></script>
	<script src="js/gcode-parser.js"></script>
	<script src="js/gcode-model.js"></script>
	<script src="js/Ginit.js"></script>
</html>
