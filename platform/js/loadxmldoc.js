function loadXMLDoc(filename)
{
	var xhttp = false;                                    //default false
	if(window.XMLHttpRequest) { // Mozilla, Safari, ....
		xhttp = new XMLHttpRequest();
	  }
	else if(window.ActiveXObject) { // IE
		try {
			xhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e) {
		try {
			xhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch (e) {}
		}
	}
	if (!xhttp) {
		alert('Giving up :( Cannot create an XMLHTTP instance');
		return false;
	}
	var  temp=function(){
		if (xhttp.readyState==4){
				if (xhttp.status==200){
				//	alert(xhttp.responseXML);
					readXML(xhttp.responseXML);
				}
		}else{
			alert("There's seems to be something wrong");
		}
	}
	xhttp.onreadystatechange=function(){
		setTimeout(temp,1000);
	}
	xhttp.open("GET",filename,true);
	xhttp.send();
	
}