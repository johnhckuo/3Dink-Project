var DragUpload={};

function $(id){
  return document.getElementById(id);
}

function init(){



  $("first").addEventListener("drop",drop,false);
  $("first").addEventListener("dragenter",dragenter,false);
  $("first").addEventListener("dragleave",dragleave,false);
  $("first").addEventListener("dragover",dragover,false);

 // $("second").addEventListener("drop",drop,false);
 // $("second").addEventListener("dragenter",dragenter,false);
 // $("second").addEventListener("dragleave",dragleave,false);
 // $("second").addEventListener("dragover",dragover,false);


 // $("physical").addEventListener("drop",drop,false);
//  $("physical").addEventListener("dragenter",dragenter,false);
 // $("physical").addEventListener("dragleave",dragleave,false);
 // $("physical").addEventListener("dragover",dragover,false);

  }

function dragenter(e){
  e.preventDefault();
  e.stopPropagation();
  if (e.target.id == "first" || e.target.id == "second" || e.target.id == "physical"){
    $(e.target.id).innerHTML="Drop Here";
    $(e.target.id).style.opacity=1;
  }
}

function dragover(e)
{
  e.preventDefault();
  e.stopPropagation();
  if (e.target.id == "first" || e.target.id == "second" || e.target.id == "physical"){
    $(e.target.id).innerHTML="Drop Here";
    $(e.target.id).style.opacity=1;
  }
}

function dragleave(e){
  e.preventDefault();
  e.stopPropagation();
  if (e.target.id == "first" || e.target.id == "second" || e.target.id == "physical"){
    $(e.target.id).innerHTML="拖曳檔案 or 選擇檔案<input type='file' value='Choose file to upload' >";
    $(e.target.id).style.opacity=.4;
  }
}

function drop(e){
  if (e.target.id == "first" || e.target.id == "second" || e.target.id == "physical"){
    DragUpload.target = {id:e.target.id};

    e.preventDefault();
    e.stopPropagation();
    var files = e.dataTransfer.files[0];
    /*
    var xhr = new XMLHttpRequest();
    var fd = new FormData();


    xhr.open("POST","upload.php");
    xhr.onload=function(){

    }

    xhr.upload.onprogress=function(e){
      if (e.lengthComputable){
        var progress = (e.loaded/e.total)*100;
        if (progress == 100)
          progress = 99.9;
        var temp = DragUpload.target.id+"Progress";
        $(temp).style.height=progress*(350/100)+"px";                    // depend on the height of the progress height
      }
    }
    for (var i in files){
        if (files[i].type =="image/jpeg"){
          fd.append("ff[]",files[i]);
          var fr = new FileReader();
          fr.onload=openfile;
          fr.readAsDataURL(files[i]);
        }
    }
    xhr.send(fd);
    //alert($("3dupload").value);
    alert(e.target.value);*/

    var reader = new FileReader();
    reader.onload = function (e) {
    document.getElementById('base64data').setAttribute('value', e.target.result);
    };
    reader.readAsDataURL(files);
  }
}

function openfile(e){
  var img = document.createElement("img");
  var imgx = e.target.result;
  img.src=imgx;
  //img.setAttribute=("id","image");
  //img.className="image";
  $(DragUpload.target.id).innerHTML="<div id='"+DragUpload.target.id+"Progress'></div>";
  $(DragUpload.target.id).appendChild(img);
  setTimeout(function(){img.style.opacity=1;},500);
  }
window.addEventListener("DOMContentLoaded",init,false);
