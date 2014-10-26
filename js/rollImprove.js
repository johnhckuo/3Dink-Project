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

arr[0]="translateX(-750px) translateZ( -100px )";
arr[1]="translateX(-450px) translateZ( -100px )";
arr[2]="translateX(-200px) rotateY( -60deg ) translateZ( 30px )";
arr[3]="rotateY(0deg) translateZ( 150px )";
arr[4]="translateX(200px) rotateY( 60deg ) translateZ( 30px )";
arr[5]="translateX(450px) translateZ( -100px )";
arr[6]="translateX(750px) translateZ( -100px )";
arr[7]="translateX(1050px) translateZ( -100px )";
arr[8]="translateX(1350px) translateZ( -100px )";
arr[9]="translateX(1650px) translateZ( -100px )";

var dist = 1;  // leftest img 's  distance to leftleft img


function carouselBuilder(){
	for ( var i = 0 ; i <panelCount; i++){
		//var div = document.createElement("div");
		var figure = document.createElement("figure");
		figure.setAttribute("id","figure"+i);
		figure.className="front";
		var img = document.createElement("img");
		linkArr[i]="showMode/"+linkArr[i];
		img.src=linkArr[i];		
		img.width=180;
		img.height=240;
		var span = document.createElement("span");
		
	/*	var figure2 = document.createElement("figure");
		figure2.setAttribute("id","figure3D"+i);
		figure2.className="back";
		geoInit(link3DArr[i],"figure3D"+i);
		
		var button = document.createElement("button");
		button.addEventListener("click",function(){toogleClassName("flipped");},false);
		div.appendChild(button);*/
		
		span.setAttribute("id","imageInfo"+i);
		span.innerHTML = nameArr[i];
		figure.appendChild(img);
		figure.appendChild(span);
		document.getElementById("carousel").appendChild(figure);
	//	div.appendChild(figure2);
		//document.getElementById("carousel").appendChild(div);
	}
}

function imageRequest(){
	
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
	
	xhr.open("GET","php/image.php",false);
	//xhr.open("GET","info.php?pictureNo=5234574&folderNo=1&categoryNo=1",false);
	xhr.send(null);
}


(function init () {
	imageRequest();
	panelCount=linkArr.length;
	carouselBuilder();

	for (var i = 0 ; i < panelCount ; i++){
		
		temp = document.getElementById("figure"+i);
		temp.style.webkitTransform = arr[i];
		temp.style.webkitTransition = "all 1s";
		if (i==(count+dist+2)%arr.length){
			currentIndex = i;
				
			var span=document.getElementById('imageInfo'+i);
			span.style.opacity='0.8';
			span.innerHTML=nameArr[i];
			temp.className='nonopa';
		}
		else {
					
			var span=document.getElementById('imageInfo'+i);
			span.style.opacity='0';
			
			temp.className='opa';
			if ((i==(count+dist+1)%arr.length) || (i==(count+dist+3)%arr.length )){
				temp.className='middleopa';
			}
		}
				

	}
	
	
//	var stars = document.getElementById("starRating").getElementsByTagName("div");
//	for (var i = (stars.length-1) ; i>=0 ; i--){
//		stars[i].onclick=function (){ratingScore(event)};
//	}
	
	
})();


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
	window.location.href="http://140.127.233.248/jsstl-master/index.php?path="+path;
	
}


function next(){
			var ram;                 //save figure 10 in the beginning due to the for loop start from figure 10, its first coordinate must be record so that figure 0 know where to follow

			for (var i=(panelCount-1);i>=0;i--){ 
				
				var temp=document.getElementById("figure"+i);
				
/* ----------- The middle image opacity ----------- */				
				if (i==(count+dist+3)%panelCount){
					currentIndex = i;
			
					var span=document.getElementById('imageInfo'+i);
					span.style.opacity='0.8';
					span.innerHTML=nameArr[i];
					temp.className='nonopa';
					
	
				}
				else {
					
					var span=document.getElementById('imageInfo'+i);
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
				temp=document.getElementById("figure"+i);		

/* ----------- The middle image opacity ----------- */	
			if (i == (count+dist+1)%panelCount){
					currentIndex = i;

					var span=document.getElementById('imageInfo'+i);
					span.style.opacity='0.8';
					span.innerHTML=nameArr[i];
					temp.className='nonopa';	
					

			}else{ 
				var span=document.getElementById('imageInfo'+i);
				span.style.opacity='0';
				temp.className='opa';
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







		