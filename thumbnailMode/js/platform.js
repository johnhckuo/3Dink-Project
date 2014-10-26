var current = 0;
var arr=new Array();
	arr[0]="translateX(-2050px) ";
	arr[1]="translateX(150px) ";
	arr[2]="translateX(2100px) ";
	arr[3]="translateX(4050px)";
	arr[4]="translateX(5950px)";
var panelCount = $("galleries").children.length;
function $(id){
	return document.getElementById(id);
}
	

function init(){
	
	for (var i=0;i<panelCount;i++){                                                                    //initializing
			$("gallery"+i).style.webkitTransform = arr[i+1];
		}
	if (current == (panelCount-1) )
		$("nextGallery").className = "off";
	else if (current == 0)
		$("previousGallery").className = "off";
	else{
		$("nextGallery").className = "on";
		$("previousGallery").className = "on"
	}
}

function delayOpacity(i){
	$('gallery'+i).style.opacity = 1;
}

function loadXMLFile(increment){
	if (increment == 1){
		for (var i=panelCount-1;i>=0;i--){             
			
		
			//initializing
			$("gallery"+i).style.webkitTransition = " all 1s";		
			var tempPos = parseInt($('gallery'+i).style.webkitTransform.match(/[-]{0,1}[0-9]{3,4}/))-1950;
			$("gallery"+i).style.webkitTransform = "translateX(" + tempPos + "px)";			;
			
		}
	current++;
	}
	else if (increment == -1){
		for (var i=panelCount-1 ; i>=0 ; i--){             
			$("gallery"+i).style.webkitTransition = " all 1s";		
			$('gallery'+i).style.opacity = 0.5;
			setTimeout("delayOpacity("+i+")",500);
			var tempPos = parseInt($('gallery'+i).style.webkitTransform.match(/[-]{0,1}[0-9]{3,4}/))+1950;
			$("gallery"+i).style.webkitTransform = "translateX(" + tempPos + "px)";			;
			
		}
	current--;
	}
	if (current == (panelCount-1) )
		$("nextGallery").className = "off";
	else if (current == 0)
		$("previousGallery").className = "off";
	else{
		$("nextGallery").className = "on";
		$("previousGallery").className = "on"
	}
}
window.addEventListener( 'DOMContentLoaded', init, false);