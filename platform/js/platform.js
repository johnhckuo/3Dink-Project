	var current=null;             //the ID of the image clicked
	var currentPage=0;            //currentPage's first picture no.
	var root_node;                //gallery.length = the amount of pictures a page have shown
	function $ (id){
		return document.getElementById(id);
	}
	function picScale(id) {
			$("mask").style.opacity="0.2";
			current=id;
			$("scalePicture").src=$(current).src;
			$("scale").style.webkitTransform=" scale(0.8,0.8)";
		}
	function picClose(){
		$("mask").style.opacity="1";
		var temp= $("scale");
		temp.style.webkitTransform=" scale(0,0)";
	//	temp.style.display="none";
	}

	function nextPic(){
		var pictureCount=gallery.children.length;
		if (root_node!=null){
			if ((root_node.length-currentPage)-pictureCount<0){
				pictureCount=root_node.length-currentPage;							//if picture number is less than 12  ,then let the default pictureCount change to the picture left
			}
		}
		var temp=current.split("img");
	//	alert(pictureCount);

			//here
		current="img"+((++temp[1])%pictureCount);
	//	alert(pictureCount);
		$("scalePicture").src=$(current).src;

		}
	function previousPic(){
		var pictureCount=gallery.children.length;
		if (root_node!=null){
			if ((root_node.length-currentPage)-pictureCount<0){
				pictureCount=root_node.length-currentPage;
			}
		}
		var temp=current.split("img");
		if (temp[1]>0)
			current="img"+((--temp[1])%pictureCount);
		else
			current="img"+((--temp[1]+pictureCount)%pictureCount);
		$("scalePicture").src=$(current).src;
		}

		//----------------------------------AJAX--------------------------------------------------------------


	 function loadXMLFile(increment){
		//	var increment = parseInt( event.target.getAttribute('data-increment') );

		$('loadingIMG1').className='on';
		$("gallery").style.opacity="0.2";
      	  // insert AJAX code here
			
		if (increment!=null){
			if (increment==1)
				currentPage=currentPage+$("gallery").children.length;
			else
				currentPage=currentPage-$("gallery").children.length;
		}
		else 
			currentPage=0;    //initializing
		var xmlDoc=loadXMLDoc("gallery.xml?v=1");             //calling loadXMLDoc method
	}
		
		
	function readXML(xmlDoc){
		root_node = xmlDoc.getElementsByTagName('src');   //global variable root _node
		var gallery=$("gallery").children;
		var gallery_node;

		for (var i=currentPage;i<(currentPage+gallery.length);i++){
			//	alert("current"+currentPage);
				gallery_node=i%gallery.length;
				if (root_node.length-i>0){
					gallery[gallery_node].src=root_node[i].childNodes[0].nodeValue;
				}else if  (root_node.length-i<=0){
					gallery[gallery_node].src="";
				}
		}
				//anode.appendChild(tnode);=content;

		$("nextGallery").className="on";                          //remove next or previous arrow when reaching the beginning or the end of the page
		$("previousGallery").className="on";
		if ((currentPage+gallery.length)>=root_node.length)
			$("nextGallery").className="off";
		if ((currentPage-gallery.length)<0)
			$("previousGallery").className="off";
		$('loadingIMG1').className='off';
		$("gallery").style.opacity="1";

	}
	
window.addEventListener( 'DOMContentLoaded', loadXMLFile(null), false);
