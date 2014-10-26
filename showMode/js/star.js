var child = $("starRating").getElementsByTagName("img");

function $(id){
	return document.getElementById(id);
}


function init(){
	for (var i = 0 ; i<child.length ; i++){
		child[i].onmouseover= function () {prerate(this); };
		child[i].onmouseout= function () {derate(this); };
		child[i].onclick= function () {ratingScore(event); };
	}
}

function derate(obj){
	for (var i =0 ; i<child.length ; i++){
		child[i].setAttribute("style","-webkit-filter:grayscale(100%)");
	}
}


function prerate(obj){
	for (var i = 0 ; i<child.length ; i++){
		child[i].setAttribute("style","-webkit-filter:grayscale(0%)");
	if (child[i] == obj )
		break;
	}
}


function ratingScore(e){
	var xhr = new XMLHttpRequest;
	var value;
	
	var name = $("name").innerHTML;
	
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4)
			alert(xhr.responseText);
	};
	xhr.open("GET" , "rate.php?value="+e.target.title+"&name="+name , true);
	xhr.send(null);
}


window.addEventListener("DOMContentLoaded" , init , false);