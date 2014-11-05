
	// standard global variables

var container, scene,sceneCube, camera, plane, line, renderer, controls , textMesh , textColor=0xdddddd,custom , textSize=10,textHeight=30 ,textFont='helvetiker';
//mouse move detect event
var projector = new THREE.Projector();
var mouseVector = new THREE.Vector3();
var objects = [],objectCount=0;;
var mouse = new THREE.Vector2(),offset = new THREE.Vector3(),INTERSECTED, SELECTED;
var geometryMerge = new THREE.Geometry();
var convertFlag=0;
var exportTarget;
var extended = false , lastTarget;
var checkPrint = 0;
function $(id){
	return document.getElementById(id);
}


function init() {
	if (!Modernizr.webgl) {
		alert('Sorry, you need a WebGL capable browser to use this.\n\nGet the latest Chrome or FireFox.');
		return;
	}

	if (!Modernizr.localstorage) {
		alert("Man, your browser is ancient. I can't work with this. Please upgrade.");
		return;
	 }
	 
	 
	
    // SCENE
    scene = new THREE.Scene();

    // CAMERA

    var VIEW_ANGLE = 45, ASPECT = window.innerWidth/window.innerHeight, NEAR = 0.1, FAR = 20000;
    camera = new THREE.PerspectiveCamera( VIEW_ANGLE, ASPECT, NEAR, FAR);
    scene.add(camera);
    camera.position.set(0,100,200);
	
	//  camera.lookAt(scene.position);
    renderer = new THREE.WebGLRenderer( {antialias:true, alpha: true } );
    renderer.setSize(window.innerWidth, window.innerHeight);
	renderer.setClearColor( 0x000000, 1 );
    container = document.getElementById( 'div1' );
    container.appendChild( renderer.domElement );
	
	
	
	// CONTROLS
	controls = new THREE.TrackballControls( camera, renderer.domElement );
	controls.rotateSpeed = 1.0;
	controls.zoomSpeed = 1.2;
	controls.panSpeed = 0.2;
	 
	controls.noZoom = false;
	controls.noPan = false;
	 
	controls.staticMoving = false;
	controls.dynamicDampingFactor = 0.3;
	 
	controls.minDistance = 0.1;
	controls.maxDistance = 20000;
	 
	controls.keys = [ 16, 17, 18 ]; // [ rotateKey, zoomKey, panKey ]
	


	//stat
    stats = new Stats();
    stats.domElement.style.position = 'absolute';
    stats.domElement.style.right= '10px';
    stats.domElement.style.top = '10px';
    container.appendChild(stats.domElement);

    // LIGHT
    var light = new THREE.PointLight(0xffffff,3);
	light.position.set(100,1000,100);

    scene.add(light);

	
    // add 3D text default

	
/*	for (var i = 0 ;i<3; i++){
		var material = new THREE.MeshPhongMaterial({
			color: textColor,
			shininess: 30,
			specular: 0x555555
		});
		var textGeom = new THREE.TextGeometry( custom[i], {
			font: textFont,
			size: textSize,
			height: textHeight,
			curveSegments: 10,
			bend:true
		});
	
		textMesh[i] = new THREE.Mesh( textGeom, material );
		textMesh[i].name = "obj."+objectCount++;;
		textGeom.computeBoundingBox();
		var textWidth = textGeom.boundingBox.max.x - textGeom.boundingBox.min.x;
		textMesh[i].rotation.x=Math.PI*1.5;
		textMesh[i].position.set( 0, 0, -50+i*10 );  
		scene.add( textMesh[i] );
		objects.push(textMesh[i]);                 //for checking mouseover usage
		objectOffset.push(0);
		
	}  */
//	THREE.GeometryUtils.merge(geometryMerge, textMesh[0]);                     // --------------------STL converter modified
	//plane create
	var geometry = new THREE.PlaneGeometry( 200, 200 );
	var texture = THREE.ImageUtils.loadTexture( 'img/plane.png' );
	var material = new THREE.MeshBasicMaterial( { side: THREE.DoubleSide,map: texture , opacity:0, transparent:true} );
	plane = new THREE.Mesh( geometry, material );
	plane.name = "plane";
	scene.add( plane );
	plane.position.set(0,0,-10);
	plane.rotation.x=Math.PI*1.5;   
	var size = 100,step = 10;
	var geometry= new THREE.Geometry();
	var material = new THREE.LineBasicMaterial({color:'white'});
		for (var i = -size ; i<=size ; i+=step){
			geometry.vertices.push(new THREE.Vector3(-size , -0.04 , i));
			geometry.vertices.push(new THREE.Vector3(size , -0.04 , i));
			
			geometry.vertices.push(new THREE.Vector3( i , -0.04 , -size ));
			geometry.vertices.push(new THREE.Vector3( i , -0.04 , size ));
		}
	line = new THREE.Line ( geometry, material, THREE.LinePieces);
	scene.add(line);
	
	
	
	
	
	
	//fog 
	scene.fog = new THREE.Fog(0xffffff,100,20000);
	
	
	//skybox
	
	var skyGeometry = new THREE.BoxGeometry( 5000, 5000, 5000 );	
	
	/*
	var imagePrefix = "img/";
	var imageSuffix = ".png";
	var materialArray = [];
	
	for (var i = 0; i < 6; i++)
		materialArray.push( new THREE.MeshBasicMaterial({
			map: THREE.ImageUtils.loadTexture( imagePrefix + 'back' + imageSuffix ),
			side: THREE.BackSide
		}));   */
	
	var materialArray = [

					new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture( 'img/skyTexture/px.jpg' ) ,side: THREE.BackSide } ), // right
					new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture( 'img/skyTexture/nx.jpg' ) ,side: THREE.BackSide } ), // left
					new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture( 'img/skyTexture/py.jpg' ) ,side: THREE.BackSide } ), // top
					new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture( 'img/skyTexture/ny.jpg' ) ,side: THREE.BackSide } ), // bottom
					new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture( 'img/skyTexture/pz.jpg' ) ,side: THREE.BackSide } ), // back
					new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture( 'img/skyTexture/nz.jpg' ) ,side: THREE.BackSide } )  // front

				];
	var skyMaterial = new THREE.MeshFaceMaterial( materialArray );
	var skyBox = new THREE.Mesh( skyGeometry, skyMaterial );
	scene.add( skyBox );
	
	//axes
	axes = buildAxes( 2500 );
	scene.add(axes);

	
	
	
	// EventListener
	renderer.domElement.addEventListener( 'mousemove', onDocumentMouseMove, false );
	renderer.domElement.addEventListener( 'mousedown', onDocumentMouseDown, false );
	renderer.domElement.addEventListener( 'mouseup', onDocumentMouseUp, false );
	
	renderer.domElement.addEventListener('dblclick', lockDown , false);
	
	window.addEventListener( 'resize', onWindowResize, false );
	
	document.getElementById("clickMe").addEventListener("click" , extendPanel , false);
	document.getElementById("clickSTL").addEventListener("click" , extendPanel , false);
	
	 document.getElementById("tutorial").setAttribute("style","-webkit-transform:translateY(100px)");
}


function stopTutorial(){
	var temp = document.getElementById("tutorial");
	temp.setAttribute("style","-webkit-transform:translateY(1000px)");
	setTimeout(function(){ temp.style.display='none';},3000);
		
}
	

function extendPanel(event){
	if (event.target.parentNode.id == lastTarget && extended){
		document.getElementById("attribute").setAttribute("style","-webkit-transform:translateX(0px)");
		document.getElementById("stlViewer").setAttribute("style","-webkit-transform:translateX(0px)");
	}else{
		document.getElementById("attribute").setAttribute("style","-webkit-transform:translateX(-65px)");
		document.getElementById("stlViewer").setAttribute("style","-webkit-transform:translateX(-65px)");
		document.getElementById(event.target.parentNode.id).setAttribute("style","-webkit-transform:translateX(365px)");
	}
	extended = !extended;
	lastTarget = event.target.parentNode.id;
}
function extendSTL(){
	document.getElementById("attribute").setAttribute("style","-webkit-transform:translateX(-65px)");
	document.getElementById("stlViewer").setAttribute("style","-webkit-transform:translateX(365px)");
	extended = !extended;
	lastTarget = "stlViewer";
}
function loading(flag){
//	background.style.opacity = 0;
	var div = document.getElementById("loading");
	if (flag == 1){
		div.style.display='inline';
	}else if (flag == 0 ){
		div.style.display='none';
	}
	
}

function onWindowResize() {

	camera.aspect = window.innerWidth / window.innerHeight;
	camera.updateProjectionMatrix();
	renderer.setSize( window.innerWidth, window.innerHeight );

}

function save() {
		var filename = 'model.stl';
		var formData = new FormData();
		checkPrint = 1;
		
		loading(1);
		var stl = startExport();
		var blob = new Blob([stl], {type: 'text/plain'});
		saveAs(blob, filename);                                            //Download File?
		
		formData.append("file", blob ,filename);
		var xhr = new XMLHttpRequest();
		xhr.onload = function () {
		  if (xhr.status == 200) {
			STLviewer(filename);
			extendSTL();
		  } else {
			alert('An error occurred!');
		  }
		  gCode();
		};
		xhr.open("POST", "upload.php",true);
		xhr.send(formData);
		
		
		
		
}

function startExport(){
    exportGeo = removeDuplicateFaces( geometryMerge );
    //THREE.GeometryUtils.triangulateQuads( geometryMerge );
	
    var stl = generateSTL();
	if (convertFlag)
		loading(0);
    return stl;
}

	
function animate() {
	window.requestAnimationFrame( animate );
	stats.update();
	controls.update(); //for cameras
	renderer.render( scene, camera );
}
function hoverPrint(){
	if (checkPrint)
		document.getElementById("print").style.background="#ffffff";
	else
		document.getElementById("print").style.background="#ff0000";
	
	
}
function outPrint(){

	document.getElementById("print").style.background="#000000";
	
}
function printButton(){
	if (checkPrint)
		window.location = "http://140.127.220.81/exec.php";
	else
		alert("抱歉，您尚未點選「輸出3D圖檔」");
}