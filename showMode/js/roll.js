var count=0;     //first image
var form=-1;
var arr=new Array();

var noArr = new Array();
var nameArr = new Array();
var link3DArr = new Array();
var linkArr = new Array();
var infoArr = new Array();
var scoreArr = new Array();
var ratenumberArr = new Array();
var memberNoArr = new Array();
var NicknameArr = new Array();
var authorizePicArr = new Array();
var panelCount;
var currentIndex;
var averageScore;    //current averageScore
var foldoutKey;
arr[0]="translateX(-800px) translateZ( -100px )";
arr[1]="translateX(-500px) translateZ( -100px )";
arr[2]="translateX(-200px) rotateY( -50deg ) translateZ( 40px )";
arr[3]="rotateY(0deg) translateZ( 125px )";
arr[4]="translateX(200px) rotateY( 50deg ) translateZ( 40px )";
arr[5]="translateX(500px) translateZ( -100px )";
arr[6]="translateX(800px) translateZ( -100px )";
arr[7]="translateX(1100px) translateZ( -100px )";
arr[8]="translateX(1400px) translateZ( -100px )";
arr[9]="translateX(1700px) translateZ( -100px )";



var child = $("starRating").getElementsByTagName("img");  //for rating

var dist = 1;  // leftest img 's  distance to leftleft img

function $(id){
	return document.getElementById(id);
}



function derate(e){
	//var averageScore = Math.round(scoreArr[currentIndex]/ratenumberArr[currentIndex]);
	for (var a =0 ; a<child.length ; a++){
		child[a].setAttribute("style","-webkit-filter:grayscale(100%)");
	}
	for (var a =0 ; a<averageScore ; a++){	
		child[a].setAttribute("style","-webkit-filter:grayscale(0%)");
	}
}


function prerate(e){
	for (var a =0 ; a<child.length ; a++){
		child[a].setAttribute("style","-webkit-filter:grayscale(100%)");
	}
	for (var a = 0 ; a<child.length ; a++){
		child[a].setAttribute("style","-webkit-filter:grayscale(0%)");
	if (child[a] == e.target )
		break;
	}
}


function ratingScore(e){
	var xhr = new XMLHttpRequest;
	var value;
	xhr.onreadystatechange = function(){
	//	if (xhr.readyState == 4)
	//		alert(xhr.responseText);
	};
	xhr.open("GET" , "rate.php?value="+e.target.alt+"&no="+noArr[currentIndex] , true);
	xhr.send(null);
}


function carouselBuilder(){
	for ( var i = 0 ; i <panelCount; i++){
		//var div = document.createElement("div");
		var figure = document.createElement("figure");
		figure.setAttribute("id","figure"+i);
		figure.className="front";
		var img = document.createElement("img");
		img.src=linkArr[i];
		img.width=180;
		img.height=240;
		var span = document.createElement("span");
		
		var box = document.createElement("div");
		var print = document.createElement("div");
		var cube = document.createElement("div");
		var text = document.createElement("div");
		
		
		var printImg = document.createElement("img");
		var boxImg = document.createElement("img");
		var textImg = document.createElement("img");
		
		printImg.onmouseover= function(){this.src = "img/printiconL.png";};
		printImg.onmouseout= function(){this.src = "img/printiconD.png";};
		boxImg.onmouseover= function(){this.src = "img/solidiconL.png";};
		boxImg.onmouseout= function(){this.src = "img/solidiconD.png";};
		textImg.onmouseover= function(){this.src = "img/texticonL.png";};
		textImg.onmouseout= function(){this.src = "img/texticonD.png";};
		
		printImg.src="img/printiconD.png";
		textImg.src="img/texticonD.png";
		boxImg.src="img/solidiconD.png";
		
		print.appendChild(printImg);
		text.appendChild(textImg);
		cube.appendChild(boxImg);
	/*	var figure2 = document.createElement("figure");
		figure2.setAttribute("id","figure3D"+i);
		figure2.className="back";
		geoInit(link3DArr[i],"figure3D"+i);
		
		var button = document.createElement("button");
		button.addEventListener("click",function(){toogleClassName("flipped");},false);
		div.appendChild(button);*/
		
		print.className = "option";
		cube.className = "option";
		text.className = "option";
		
		print.setAttribute("id","print"+i);
		text.setAttribute("id","text"+i);
		cube.setAttribute("id","cube"+i);
		
		box.setAttribute("id","optionBox"+i);
		box.appendChild(print);
		box.appendChild(cube);
		box.appendChild(text);
		
		span.setAttribute("id","imageInfo"+i);
		span.innerHTML = nameArr[i];
		
		figure.appendChild(box);
		figure.appendChild(img);
		figure.appendChild(span);
		$("carousel").appendChild(figure);
	//	div.appendChild(figure2);
		//$("carousel").appendChild(div);
	}
}

function imageRequest(pictureNo,folderNo,categoryNo){
	var xhr = new XMLHttpRequest;
	//var pictureNo=pictureNo;
	//var folderNo=folderNo;
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4){
			var temp = xhr.responseText;
			var res = temp.split("+");
			for ( var i =0 ; i<res.length ; i++){
				if (i%10 == 0 )
					noArr.push(res[i]);
				else if (i%10 == 1)
					nameArr.push(res[i]);
				else if (i%10 == 2)
					link3DArr.push(res[i]);
				else if (i%10 == 3)
					linkArr.push(res[i]);
				else if (i%10 == 4)
					infoArr.push(res[i]);
				else if (i%10 == 5)
					scoreArr.push(res[i]);
				else if (i%10 == 6)
					ratenumberArr.push(res[i]);
				else if (i%10 == 7)
					memberNoArr.push(res[i]);
				else if (i%10 == 8)
					NicknameArr.push(res[i]); 
				else if (i%10 == 9)
					authorizePicArr.push(res[i]);	
			}

		}
	}
	
	xhr.open("GET","info.php?pictureNo="+pictureNo+"&folderNo="+folderNo+"&categoryNo="+categoryNo,false);
	//xhr.open("GET","info.php?pictureNo=5234574&folderNo=1&categoryNo=1",false);
	xhr.send(null);
}


function init (pictureNo,folderNo,categoryNo) {
	imageRequest(pictureNo,folderNo,categoryNo);
	panelCount=linkArr.length;
	carouselBuilder();
	


	for (var i = 0 ; i < panelCount ; i++){
		
		temp = $("figure"+i);
		temp.style.webkitTransform = arr[i];
		temp.style.webkitTransition = "all 1s";
		if (i==(count+dist+2)%arr.length){
					currentIndex = i;
					averageScore = Math.round(scoreArr[i]/ratenumberArr[i]);
					for (var j = 0 ; j < averageScore ; j++){
						child[j].setAttribute("style","-webkit-filter:grayscale(0%)");
					}
					$("starStat").innerHTML = "共 "+ratenumberArr[i]+" 筆評價"
					$("optionBox"+i).style.opacity=1;
					
					var span=$('imageInfo'+i);
					span.style.opacity='0.8';
					span.innerHTML=nameArr[i];
					temp.className='nonopa';
					var text = document.createElement("div");
					
					if(authorizePicArr[i]!='' && authorizePicArr[i]!=-1)
					{
						text.innerHTML="<span class='worksName'>"+nameArr[i]+"</span><span class='worksConcept'>設計理念</span><div class='worksInfo'>"+infoArr[i]+"</div><span class='worksAuthor'> 作者："+NicknameArr[i].link('../rockon40100/personal.php?memberNo='+memberNoArr[i])+"</span><span class='worksPermission'>3D圖授權：$"+authorizePicArr[i]+"</span>";
					}
					else if(authorizePicArr[i]=='')
					{
						text.innerHTML="<span class='worksName'>"+nameArr[i]+"</span><span class='worksConcept'>設計理念</span><div class='worksInfo'>"+infoArr[i]+"</div><span class='worksAuthor'> 作者："+NicknameArr[i].link('../rockon40100/personal.php?memberNo='+memberNoArr[i])+"</span><span class='worksPermission'>3D圖授權：未授權</span>";
					}
					else if(authorizePicArr[i]==-1)
					{
						text.innerHTML="<span class='worksName'>"+nameArr[i]+"</span><span class='worksConcept'>設計理念</span><div class='worksInfo'>"+infoArr[i]+"</div><span class='worksAuthor'> 作者："+NicknameArr[i].link('../rockon40100/personal.php?memberNo='+memberNoArr[i])+"</span><span class='worksPermission'>已授權為創用CC</span>";
					}
					$("info").appendChild(text);
					$("text"+i).setAttribute("onclick","infoDrop()"); 
					$("cube"+i).setAttribute("onclick","foldIn()"); 
					$("print"+i).setAttribute("onclick","printRequest('"+link3DArr[i]+"')"); 

					for (var j = 0 ; j<child.length ; j++){                                    //the rating system initializing
						child[j].addEventListener('mouseover',prerate, false);
						child[j].addEventListener('mouseout',derate, false);
						child[j].addEventListener('click',ratingScore, false);
				//		child[j].onmouseover= prerate;
				//		child[j].onmouseout= derate(i);                  //need i to regenerate average score
					//	child[j].onclick=ratingScore;
					}
					
					
					
				}
				else {
					
					$("optionBox"+i).style.opacity=0;
					var span=$('imageInfo'+i);
					span.style.opacity='0';
					
					temp.className='opa';
					if ((i==(count+dist+1)%arr.length) || (i==(count+dist+3)%arr.length )){
						temp.className='middleopa';
					}
				}
				
				
				
				
	}
	
	
//	var stars = $("starRating").getElementsByTagName("div");
//	for (var i = (stars.length-1) ; i>=0 ; i--){
//		stars[i].onclick=function (){ratingScore(event)};
//	}
	
	
}


function onNavButtonClick(increment){
			initCalculate();
			if (increment == 1){
				//alert("hi");
				next();
			}
			else if (increment == -1){
				previous();
			}
    }
	


function initCalculate(){
	if (count>=0)	
		count=count%(panelCount);	
	else if (count<0)
		count=panelCount-(Math.abs(count)%panelCount);   //count==-1 || -12|| -23 represent figure10
}


function printRequest(path){
	path = "../showMode/"+path;
	window.location.href="../jsstl-master/index.php?path="+path;
	
}


function next(){
			var ram;                 //save figure 10 in the beginning due to the for loop start from figure 10, its first coordinate must be record so that figure 0 know where to follow

			for (var i=(panelCount-1);i>=0;i--){ 
				
				var temp=$("figure"+i);
				
/* ----------- The middle image opacity ----------- */				
				if (i==(count+dist+3)%panelCount){
					currentIndex = i;
					var starChild = $("starRating").getElementsByTagName("img");
					averageScore = Math.round(scoreArr[i]/ratenumberArr[i]);
					for (var j = 0 ; j<starChild.length ; j++){
						starChild[j].setAttribute("style","-webkit-filter:grayscale(100%)");    //reset all score first
					}
					
					for (var j = 0 ; j < averageScore ; j++){
						starChild[j].setAttribute("style","-webkit-filter:grayscale(0%)");
					}
					$("starStat").innerHTML = "共 "+ratenumberArr[i]+" 筆評價</h2>"
				
					$("optionBox"+i).style.opacity=1;
				
					var span=$('imageInfo'+i);
					span.style.opacity='0.8';
					span.innerHTML=nameArr[i];
					temp.className='nonopa';
					
					$("info").removeChild($("info").lastChild);
					var text = document.createElement("div");
					
					if(authorizePicArr[i]!='' && authorizePicArr[i]!=-1)
					{
						text.innerHTML="<span class='worksName'>"+nameArr[i]+"</span><span class='worksConcept'>設計理念</span><div class='worksInfo'>"+infoArr[i]+"</div><span class='worksAuthor'> 作者："+NicknameArr[i].link('../rockon40100/personal.php?memberNo='+memberNoArr[i])+"</span><span class='worksPermission'>3D圖授權：$"+authorizePicArr[i]+"</span>";
					}
					else if(authorizePicArr[i]=='')
					{
						text.innerHTML="<span class='worksName'>"+nameArr[i]+"</span><span class='worksConcept'>設計理念</span><div class='worksInfo'>"+infoArr[i]+"</div><span class='worksAuthor'> 作者："+NicknameArr[i].link('../rockon40100/personal.php?memberNo='+memberNoArr[i])+"</span><span class='worksPermission'>3D圖授權：未授權</span>";
					}
					else if(authorizePicArr[i]==-1)
					{
						text.innerHTML="<span class='worksName'>"+nameArr[i]+"</span><span class='worksConcept'>設計理念</span><div class='worksInfo'>"+infoArr[i]+"</div><span class='worksAuthor'> 作者："+NicknameArr[i].link('../rockon40100/personal.php?memberNo='+memberNoArr[i])+"</span><span class='worksPermission'>已授權為創用CC</span>";
					}					
					$("info").appendChild(text);
					$("text"+i).setAttribute("onclick","infoDrop()");   
					$("cube"+i).setAttribute("onclick","foldIn()"); 
					$("print"+i).setAttribute("onclick","printRequest('"+link3DArr[i]+"')"); 
				}
				else {
					
					var span=$('imageInfo'+i);
					
					$("optionBox"+i).style.opacity=0;
					span.style.opacity='0';
					temp.className='opa';
					if ((i==(count+dist+2)%panelCount) || (i==(count+dist+4)%panelCount )){
						temp.className='middleopa';
						temp.setAttribute("onclick","null");
					}
				}
//--------------------------------------------------------------------------------------------------	
				
					
/* ----------- Disable the animation when the end transform to the front ----------- */
		
				if  (i == (count%panelCount)){
						temp.style.webkitTransition="all  0s";
				}
				if  (i == ((count+(panelCount-1))%panelCount)){
					temp.style.webkitTransition="all  1s";
				}
//--------------------------------------------------------------------------------------------------


/* ----------- In order to let figure 0 follow figure 10 correctly ----------- */
				if  (i==(panelCount-1))
					ram=arr[i];
				if  (i==0 ){				
					arr[i]=ram;
					temp.style.webkitTransform=ram;
					break;
				}
//--------------------------------------------------------------------------------------------------
				

				temp.style.webkitTransform= arr[i-1];
				arr[i]=arr[i-1];
			}
			count++;	          //the left pic figure number
		
}





function previous(){
			var ram;                                     //save figure 0 in the beginning due to the for loop start from figure 0, its first coordinate must be record so that figure 10 know where to follow
			var temp;
			for (var i=0;i<panelCount;i++){ 
				temp=$("figure"+i);		

/* ----------- The middle image opacity ----------- */	
			if (i == (count+dist+1)%panelCount){
					currentIndex = i;
					var starChild = $("starRating").getElementsByTagName("img");
					averageScore = Math.round(scoreArr[i]/ratenumberArr[i]);
					for (var j = 0 ; j<starChild.length ; j++){
						starChild[j].setAttribute("style","-webkit-filter:grayscale(100%)");    //reset all score first
					}
					
					for (var j = 0 ; j < averageScore ; j++){
						starChild[j].setAttribute("style","-webkit-filter:grayscale(0%)");
					}
					$("starStat").innerHTML = "共 "+ratenumberArr[i]+" 筆評價</h2>"
			
					
			
					$("optionBox"+i).style.opacity=1;
					var span=$('imageInfo'+i);
					span.style.opacity='0.8';
					span.innerHTML=nameArr[i];
					temp.className='nonopa';	
					
					$("info").removeChild($("info").lastChild);
					var text = document.createElement("div");
					
					if(authorizePicArr[i]!='' && authorizePicArr[i]!=-1)
					{
						text.innerHTML="<span class='worksName'>"+nameArr[i]+"</span><span class='worksConcept'>設計理念</span><div class='worksInfo'>"+infoArr[i]+"</div><span class='worksAuthor'> 作者："+NicknameArr[i].link('../rockon40100/personal.php?memberNo='+memberNoArr[i])+"</span><span class='worksPermission'>3D圖授權：$"+authorizePicArr[i]+"</span>";
					}
					else if(authorizePicArr[i]=='')
					{
						text.innerHTML="<span class='worksName'>"+nameArr[i]+"</span><span class='worksConcept'>設計理念</span><div class='worksInfo'>"+infoArr[i]+"</div><span class='worksAuthor'> 作者："+NicknameArr[i].link('../rockon40100/personal.php?memberNo='+memberNoArr[i])+"</span><span class='worksPermission'>3D圖授權：未授權</span>";
					}		
					else if(authorizePicArr[i]==-1)
					{
						text.innerHTML="<span class='worksName'>"+nameArr[i]+"</span><span class='worksConcept'>設計理念</span><div class='worksInfo'>"+infoArr[i]+"</div><span class='worksAuthor'> 作者："+NicknameArr[i].link('../rockon40100/personal.php?memberNo='+memberNoArr[i])+"</span><span class='worksPermission'>已授權為創用CC</span>";
					}			
					$("info").appendChild(text);
					$("text"+i).setAttribute("onclick","infoDrop()"); 
					$("cube"+i).setAttribute("onclick","foldIn()"); 
					$("print"+i).setAttribute("onclick","printRequest('"+link3DArr[i]+"')"); 
			}else{ 
				var span=$('imageInfo'+i);
				span.style.opacity='0';
				temp.className='opa';
				$("optionBox"+i).style.opacity=0;
				if  (i==(count+dist)%panelCount || i == (count+dist+2)%panelCount){
						temp.className='middleopa';
						temp.setAttribute("onclick","null");
					}

			}
//--------------------------------------------------------------------------------------------------	

			
/* ----------- Disable the animation when the front transform to the end ----------- */		
				if  (i==((count+(panelCount-1))%panelCount))
					temp.style.webkitTransition="all  0s";

				if  (i==(count%panelCount)){
						temp.style.webkitTransition="all  1s";
					}
						
//--------------------------------------------------------------------------------------------------	

/* ----------- In order to let figure 10 follow figure 0 correctly ----------- */	
				if  (i==0)
					ram=arr[i];
				if  (i==(panelCount-1) ){	
					arr[i]=ram;
					temp.style.webkitTransform=ram;
					break;
				}
//--------------------------------------------------------------------------------------------------
				
				temp.style.webkitTransform = arr[i+1];
				arr[i]=arr[i+1];
			}
			count--;		
}

function infoDrop(){
	var temp = $("info");
	form = form * (-1);
	if  (form == 1){
		temp.style.display="inline";
		setTimeout(function(){temp.className="infoHover";},1);
	}
	else if (form == -1){
		temp.className="infoHoverOut";
		setTimeout(function(){ temp.style.display="none"},500);
	}
}


function partsExtend(flag){
	var temp=$("parts");
	if (flag == 1){
		temp.style.display="inline"
		setTimeout(function(){ 
		temp.style.webkitTransform = "translateY(200px)";
		temp.style.opacity=".8";},1);
	}else{ 
		temp.style.webkitTransform = "translateY(-200px)";
		temp.style.opacity="0";
		setTimeout(function(){temp.style.display="none"} ,500);
	}
}

function disapear(){
	$("options").style.opacity=0;
	$("carousel").style.webkitTransform= "scale(10,10)";
	$("carousel").style.opacity=0;
	$("viewer3D").style.opacity=1;
	$('info').style.display='inline';
	setTimeout("$('carousel').style.display='none'; $('viewer3D').style.display='inline'; geoInit(link3DArr[currentIndex]); $('info').className='infoHover';",500);
}

function appear(){
	for (var i = 0 ; i<panelCount ; i++){
		
		if (i!=currentIndex && i!=(currentIndex+1) && i!=(currentIndex-1))
			$("figure"+i).className= "opa";
		else if (i==(currentIndex+1) || i==(currentIndex-1))
			$("figure"+i).className= "middleopa";
			
		$("figure"+i).style.webkitTransform= arr[i];
	}
	
}



function foldIn(){
		foldoutKey = 0;
		var printImg = document.createElement("img");
		var boxImg = document.createElement("img");
		
		var print = document.createElement("div");
		var cube = document.createElement("div");
		var box = document.createElement("div");
		
		printImg.onmouseover= function(){this.src = "img/printiconL.png";};
		printImg.onmouseout= function(){this.src = "img/printiconD.png";};
		boxImg.onmouseover= function(){this.src = "img/planeiconL.png";};
		boxImg.onmouseout= function(){this.src = "img/planeiconD.png";};
		
		cube.setAttribute("onclick","foldOut()"); 
		cube.setAttribute("onclick","foldOut()"); 
		print.setAttribute("onclick","printRequest('"+link3DArr[currentIndex]+"')"); 
		
		printImg.src="img/printiconD.png";
		boxImg.src="img/planeiconD.png";
		
		print.appendChild(printImg);
		cube.appendChild(boxImg);

		print.className = "tempPrint";
		cube.className = "tempCube";

		box.setAttribute("id","tempBox");
		box.appendChild(print);
		box.appendChild(cube);
		$("info").appendChild(box);
	
	for (var i = 0 ; i<panelCount ; i++){
	
	if  (i<currentIndex){
		for (var j = i ; j<currentIndex ; j++){
			$("figure"+i).style.webkitTransform= arr[j+1];
		}
	}
	else if (i>currentIndex){
		for (var j = i ; j>currentIndex ; j--){
			$("figure"+i).style.webkitTransform= arr[j-1];
		}
	}
	
	//$("figure"+i).style.webkitTransform= arr[currentIndex];
	
	
}
	setTimeout("disapear()",1000);
}

function foldOut(){
	$("info").removeChild($('info').lastChild);
	$('carousel').style.display='inline';
	$('info').className='infoHoverOut';
	setTimeout("$('options').style.opacity=1; $('carousel').style.webkitTransform= 'scale(1,1)'; $('carousel').style.opacity=1; $('viewer3D').style.opacity=0; setTimeout(function(){ $('info').style.display='none'},500);" , 1);
	
	infoDrop();
	setTimeout("appear(); $('viewer3D').style.display='none';  ",500);
	
	foldoutKey = 1;
}




		