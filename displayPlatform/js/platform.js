	var current;               // first pic id number 0
	var spin=document.getElementById('spinCircle');
	var panelCount;
	var linkArr = new Array();
	var nameArr = new Array();
	
	var extendLink = new Array();
	var extendName = new Array();
	var extendInfo = new Array();
	
	function $(id){
		return document.getElementById(id);
	}
	
	function buildCarousel(){
		for (var i = 0 ;i<panelCount ; i++){
			var span = document.createElement("span");
			span.setAttribute("id","imageInfo"+(i+1));
			span.innerHTML = nameArr[i];
			var img = document.createElement("img");
			img.src = linkArr[i];
			
			var figure = document.createElement("figure");
			figure.setAttribute("id","figure"+(i+1));
			figure.appendChild(img);
			figure.appendChild(span);
			$("spinCircle").appendChild(figure);
		}
	}
	
	function buildextendInfo(){
		var p = document.createElement("p");
		var panel=4;                                          //panel equal how many picture to be picked in each category
		
		for (var i = 0 ; i<(extendLink.length+10) ; i++){    //for loop upper bound include category img
			
			var img = document.createElement("img");
			var a = document.createElement("a");
			
			if (i%panel==0){                                             
				$("extendInfo").appendChild(p);
				p = document.createElement("p");
				for (var j =0 ; j<10; j++){ 
					if ((i/panel)==j){
						
						img.src="img/"+j+".png";
			//			alert(img.src);
						a.href="../thumbnailMode/platform.html";
						a.appendChild(img);
						p.appendChild(a);
						break;
					}
				}
				a = document.createElement("a");
				img = document.createElement("img");
			}
			
			
			a.href = "http://140.127.233.248/showMode/?no="+extendInfo[i].trim();
			
			img.src = extendLink[i];
			a.appendChild(img);
			p.appendChild(a);
		}
	}
		
	
	function transformInit(){
			current=4;
			
			carouselRequest()
			panelCount=linkArr.length;
			buildCarousel();
			extendinfoRequest();
			buildextendInfo();
			spinning();
	}
	
	function carouselRequest(){
		var xhr = new XMLHttpRequest;
			xhr.onreadystatechange = function(){
				var res = xhr.responseText;
				res = res.split("+");
				for (var i = 0 ;i<res.length ; i++){
					if (i%2 == 0 )
						nameArr.push(res[i]);
					else 
						linkArr.push("../showMode/"+res[i]);
				}
			}
			
			xhr.open("GET","./display.php",false);
			xhr.send(null);
	}
	
	
	function extendinfoRequest(){
		var xhr = new XMLHttpRequest;
			xhr.onreadystatechange = function(){
				var res = xhr.responseText;
				res = res.split("+");
				for (var i = 0 ;i<res.length ; i++){
					if (i%3 == 0 )
						extendInfo.push(res[i]);
					else if (i%3 == 1)
						extendName.push(res[i]);
					else 
						extendLink.push("../showMode/"+res[i]);
				}
			}
			
			xhr.open("GET","./extendInfo.php",false);
			xhr.send(null);
			
	}
	
	
	
	
	
	function delayOpacity(i){
		spin.style.opacity=i;
	}
	
	function spinning(){
		if (spin.children.length != 0){
			for (var i = 0; i<panelCount ; i++){	
					if (i==current){
						spin.children[i].className="on";
						spin.children[i].style.webkitTransform="rotateY(360deg) translateX( 550px )";
					}else if (i == (current+1)%panelCount){
						spin.children[i].className="on";
						spin.children[i].style.webkitTransform="rotateY(270deg) translateX( 550px )";
					}
					else if (((current-1)>=0) && (i== (current-1)%panelCount)){
						spin.children[i].className="on";
						spin.children[i].style.webkitTransform="rotateY(450deg) translateX( 550px )";
					}
					else if  (((current-1)<0) && (i== panelCount-Math.abs(current-1)%panelCount)){     //solve when current==0 end current-1 <0 
						spin.children[i].className="on";
						spin.children[i].style.webkitTransform="rotateY(450deg) translateX( 550px )";
					}else{

						spin.children[i].className="off";
						spin.children[i].style.webkitTransform="rotateY(180deg) translateX( 550px )";
					}		
			}
		}
	}
	
	function rSpinning(){
		for (var i = 0; i<panelCount ; i++){
		
				if (i == current){
					spin.children[i].className="on";
					spin.children[i].style.webkitTransform="rotateY(360deg) translateX( 550px )";
				}else if (i == (current+1)%panelCount){

					spin.children[i].className="on";
					spin.children[i].style.webkitTransform="rotateY(270deg) translateX( 550px )";
				}else if (((current-1)>=0) && (i== (current-1)%panelCount)){
					spin.children[i].className="on";
					spin.children[i].style.webkitTransform="rotateY(450deg) translateX( 550px )";
				}
				else if  (((current-1)<0) && (i== panelCount-Math.abs(current-1)%panelCount)){                       //solve when current==0 end current-1 <0 
					spin.children[i].className="on";
					spin.children[i].style.webkitTransform="rotateY(450deg) translateX( 550px )";
				}
				else{
					
					spin.children[i].className="off";
					spin.children[i].style.webkitTransform="rotateY(180deg) translateX( 550px )";
				}

			}
	}
		
	function onNavButtonClick(increment,flag){
			if (flag == 1)
				clearTimeout(timer1);
			if (increment==1){
				current=(current+1)%panelCount;
				spinning();
			}
			else if (increment==-1){
				current=(current-1)%panelCount;
				if  (current<0)
					current = panelCount-1;
				rSpinning();
			}

			delayOpacity(.3);
			setTimeout("delayOpacity(1)",500);	
          }
    window.addEventListener( 'DOMContentLoaded', transformInit, false);