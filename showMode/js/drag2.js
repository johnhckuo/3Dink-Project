var DragUpload={};
function $(id){
  return document.getElementById(id);
}

function init(){


  $("first").addEventListener("drop",drop,false);
  $("first").addEventListener("dragenter",dragenter,false);
  $("first").addEventListener("dragleave",dragleave,false);
  $("first").addEventListener("dragover",dragover,false);


  /*$("physical").addEventListener("drop",drop,false);
  $("physical").addEventListener("dragenter",dragenter,false);
  $("physical").addEventListener("dragleave",dragleave,false);
  $("physical").addEventListener("dragover",dragover,false);*/


  $("secondnormData").onchange = function(){preview(this,event);};
  //$("physicalnormData").onchange = function(){preview(this,event);};

  }

function dragenter(e){
  e.preventDefault();
  e.stopPropagation();
  if (e.target.id == "second" || e.target.id == "physical"){
    $(e.target.id).style.opacity=1;
  }
}

function dragover(e)
{
  e.preventDefault();
  e.stopPropagation();
  if (e.target.id == "second" || e.target.id == "physical"){
    $(e.target.id).style.opacity=1;
  }
}

function dragleave(e){
  e.preventDefault();
  e.stopPropagation();
  if (e.target.id == "second" || e.target.id == "physical"){
  //  $(e.target.id).style.opacity=.4;
  }
}

function drop(e){
  if (e.target.id == "second" || e.target.id == "physical"){
    DragUpload.target = {id:e.target.id};
    e.preventDefault();
    e.stopPropagation();
    var files = e.dataTransfer.files;

    var xhr = new XMLHttpRequest();
    var fd = new FormData();

    
  /*  xhr.onload=function(){
		$(DragUpload.target.id+"dragData").value = files[0].name;
		var temp = DragUpload.target.id+"Progress";
		$(temp).style.opacity=0;
        
    };  

    xhr.upload.onprogress=function(e){
      if (e.lengthComputable){
        var progress = (e.loaded/e.total)*100;
        if (progress == 100)
          progress = 99.9;
        var temp = DragUpload.target.id+"Progress";
        $(temp).style.height=progress*(360/100)+"px";                      // depend on the height of the progress height
      }
    };    */ 
	
    for (var i in files){
        var fr = new FileReader();
        fr.onload=openfile;
		fr.readAsDataURL(files[i]);
		fd.append("ff[]",files[i]);
        
    }
	xhr.open("POST","upload.php");
    xhr.send(fd);

  }
}

function openfile(e){
  if ($(DragUpload.target.id+"image") == null){
		var img = document.createElement("img");
		var imgx = e.target.result;
		img.src=imgx;
		img.setAttribute=("id",DragUpload.target.id+"image");
		//img.className="image";
		//$(DragUpload.target.id).innerHTML="<div id='"+DragUpload.target.id+"Progress'></div>";
		$(DragUpload.target.id).appendChild(img);
  }else{
		var imgx = e.target.result;
		$(DragUpload.target.id+"image").src=imgx;
	}
  setTimeout(function(){img.style.opacity=1;$(DragUpload.target.id).style.opacity=1;},500);

  }


function preview(input,e){
  var temp = e.target.parentNode;
 
  temp.childNodes[1].nodeValue = input.files[0].name;
  
  DragUpload.target = {id:temp.id};
  if (input.files && input.files[0]){
    var fr = new FileReader();
    fr.onload = openfile;
    fr.readAsDataURL(input.files[0]);
  }
}

window.addEventListener("DOMContentLoaded",init,false);
