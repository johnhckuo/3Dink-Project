function  test(){
	//xmlDocs=loadXMLDoc("gallery.xml");
	var xmlDoc=loadXMLDoc("gallery.xml");
	var x=xmlDoc.getElementsByTagName("src");
	for (var i=0;i<x.length;i++){
		document.writeln(x[i].childNodes[0].nodeValue);
	}
}