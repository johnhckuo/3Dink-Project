var check = 0 ;
var pioneerCube;
var voxelNumber = 0 , voxelCoordinate = [] , voxel = [];
var voxelX , voxelY , voxelZ;
var currentObject = [] , objectOffset = [],voxelFlag = 0,paintFlag=0 , tubePosition = [];
var universalFlag=0;   //for 關閉模式 開啟模式
var layerLine,layerText,layerText2,paintObjects=[] ;
var layerOffset = 3;
var customeSize=20,customeHeight=20,customeFont;
var tubeThickness=3;
function customize() {
	
	var customGeom, material;
	

		
	custom = document.getElementById('custom').value;

	//var custom =  e.keyCode;
		
	var x = document.getElementById("font").selectedIndex;
	customeFont = document.getElementsByTagName("option")[x].value;
	customeSize = document.getElementById('textSize').value;
	customeHeight = document.getElementById('textHeight').value;
	
	scene.remove (textMesh);
	material = new THREE.MeshPhongMaterial({
			color: textColor
	});
	customGeom = new THREE.TextGeometry( custom, {
			font: customeFont,
			size: customeSize,
			height: customeHeight
	});
		
	var j=objects.indexOf(textMesh);
		
	textMesh = new THREE.Mesh( customGeom, material );
	customGeom.computeBoundingBox();
	var textWidth = customGeom.boundingBox.max.x - customGeom.boundingBox.min.x;	
	textMesh.position.set( 0, 0, 0);  
	textMesh.rotation.x=Math.PI*1.5;
	sumCreator(textMesh,0);
	if (j!=-1)
		objects[j]=textMesh;
		

	
}


function stamp(){ 	
	
	var textSize = document.getElementById('stampTextSize').value;
	var text = document.getElementById('stampText').value;
	var length = 50;
	var textColor=0xdddddd, height=3 ,textFont='helvetiker';
	var textMaterial = new THREE.MeshPhongMaterial({
				color: textColor
	});
	var textGeom = new THREE.TextGeometry( text, {
				font: textFont,
				size: textSize,
				height: height,
				curveSegments: 2
	});
	var textMesh = new THREE.Mesh( textGeom, textMaterial );
	var textMeshFront = new THREE.Mesh( textGeom, textMaterial );
	textMesh.rotation.y = Math.PI;
	textMeshFront.rotation.y = Math.PI;
	
	textGeom.computeBoundingBox();
	var textWidth = textGeom.boundingBox.max.x - textGeom.boundingBox.min.x;	
	var textHeight = textGeom.boundingBox.max.y - textGeom.boundingBox.min.y;
	textMesh.position.set(textWidth/2,-textHeight/2,length/2+height);
	textMeshFront.position.set(textWidth/2,-textHeight/2,-length/2+height);
	var text_bsp = new ThreeBSP( textMesh );
	var textFront_bsp = new ThreeBSP( textMeshFront );
	
	
	
	
	var material = new THREE.MeshPhongMaterial( {ambient: 0xffff00, color: 0xffffff, specular: 0x555555, shininess: 30} );
	var cube = new THREE.CubeGeometry(textWidth+5, textHeight+5, length);     //here (textWidth+5, textHeight+5, length)
	var cube_mesh = new THREE.Mesh(cube,material);
	var cube_bsp = new ThreeBSP( cube_mesh );

	
	cube_bsp = logoCreator(cube_bsp,textHeight);
	
	console.time('operation');
	
	cube_bsp = cube_bsp.subtract( textFront_bsp );
	var union = cube_bsp.union( text_bsp );
	console.timeEnd('operation');
	console.time('mesh');
	var mesh = new THREE.Mesh( union.toGeometry(), material );
	
	sumCreator(mesh,(textHeight+5)/2);                                                //here textHeight+5/2
}

function logoCreator(cube_bsp,height){
	var textSize = 5;
	var textColor=0xdddddd, textHeight=5 ,textFont='helvetiker';
	
	var textGeom = new THREE.TextGeometry( "3Dink", {
				font: textFont,
				size: textSize,                                                      //here
				curveSegments: 2, 
				height: textHeight                                             //HERE TEXTHEIGHT                  
	});
	var textMaterial = new THREE.MeshPhongMaterial({
				color: textColor
	});
	textGeom.computeBoundingBox();
	var textWidth = textGeom.boundingBox.max.x - textGeom.boundingBox.min.x;	
	var textHeight = textGeom.boundingBox.max.y - textGeom.boundingBox.min.y;
	
	var textMesh = new THREE.Mesh( textGeom, textMaterial );
	textMesh.rotation.x = Math.PI*1.5;
	textMesh.position.set(-textWidth/2,height/2,0);
	var text_bsp = new ThreeBSP( textMesh );
	cube_bsp = cube_bsp.subtract( text_bsp );                                           //here
	
	
	
	var textMesh2 = new THREE.Mesh( textGeom, textMaterial );
	textMesh2.rotation.x = Math.PI/2;
	textMesh2.position.set(-textWidth/2,-height/2,0);
	var text_bsp2 = new ThreeBSP( textMesh2 );
	cube_bsp = cube_bsp.subtract( text_bsp2 );
	return cube_bsp;
}

function torusCreator(){
	var geometry = new THREE.TorusKnotGeometry( 10, 3, 100, 16 );
	var material = new THREE.MeshPhongMaterial( {ambient: 0xff5533, color:0xffffff, specular: 0x111111, shininess: 200 } );
	var torusKnot = new THREE.Mesh( geometry, material );
	torusKnot.position.set(0,0,0);
	sumCreator(torusKnot , 16);


}

function sphereCreator(){
	var material = new THREE.MeshPhongMaterial({ambient: 0xffff00, color: 0xffffff, specular: 0x555555, shininess: 30});

	var objectRadius = 10;
	var segments = 8;

	var sphereGeometry = new THREE.SphereGeometry( objectRadius, 32, 32 );		
	var sphere = new THREE.Mesh( sphereGeometry, material );
	
	sumCreator(sphere,objectRadius); 

	
//	currentOffset = objectRadius;
}

function ringCreator(){
	var stl_bsp, text_bsp , STLGeometry;
	var loader = new THREE.STLLoader();
	var text = document.getElementById("ringText").value.split("");
	var textSize = 10 , radius=10 ,textMesh ;
//	var totalGeometry = new THREE.TorusGeometry( radius, 1,25,25);
//	var text = ['E','W','.','I','l','y','j','o','h','n'];
	text = text.reverse();
	var xPos,yPos,count = Math.floor(4*radius/text.length ), currentX=radius ,  currentY= 0 , averageDegree = (180/text.length)*(Math.PI/180) ,averageCharNumber = Math.ceil(text.length/4) , section=1 , charCount=0;
	var coordinateX = [],coordinateY = [];
	
	var material = new THREE.MeshPhongMaterial({
		color: 0xffffff,
		shininess: 30,
		specular: 0x555555
	});
	
	loader.addEventListener( 'load', function ( event ) {

		STLGeometry = event.content;	
	//	STLGeometry.computeBoundingBox();
		var mesh = new THREE.Mesh( STLGeometry, material ); 
		mesh.position.set( 0, 0, 0 );
		var csgMesh = THREE.CSG.toCSG(mesh);
		var boundingBox = mesh.geometry.boundingBox.clone();
			alert('bounding box coordinates: ' + 
			'(' + boundingBox.min.x + ', ' + boundingBox.min.y + ', ' + boundingBox.min.z + '), ' + 
			'(' + boundingBox.max.x + ', ' + boundingBox.max.y + ', ' + boundingBox.max.z + ')' );
		
		radius = Math.floor(mesh.geometry.boundingBox.max.x-mesh.geometry.boundingBox.min.x);
		stl_bsp = new ThreeBSP( mesh);
	
		
		
		for (var i=0 ; i < text.length ; i++){

		
		//	alert(text[i]);
			var textGeom = new THREE.TextGeometry( text[i], {
			font: 'optimer',
			size: textSize,
			height: 10
			
			});
			xPos = radius*Math.cos(averageDegree*i);
			yPos = radius*Math.sin(averageDegree*i);
			var tan = Math.atan2(xPos,yPos);
		//	alert(tan)
			textMesh  = new THREE.Mesh( textGeom, material );
			textMesh.position.set(xPos, yPos, 0); 
			textMesh.rotation.x = Math.PI/2
			textMesh.rotation.y = -tan;    		// modify character angle slightly
			
			var csgText = THREE.CSG.toCSG(textMesh);
			
			text_bsp = new ThreeBSP( textMesh);
		//	textMesh.rotation.x=Math.PI*1.5;
		//	THREE.GeometryUtils.merge(totalGeometry,textMesh);
			
			csgMesh = csgMesh.union( csgText);
			
			
		}
		
		var geometry = THREE.CSG.fromCSG(csgMesh);
		
		var mesh_union = new THREE.Mesh( stl_bsp.toGeometry() , material );
		
		
	
		
		
		mesh_union.rotation.x=Math.PI*0.5;
		mesh_union.position.set( 0, 0, 0 );
		mesh_union.rotation.set( Math.PI*1.5, 0, 0 );
		mesh_union.scale.set( 1, 1, 1 );

		mesh_union.castShadow = true;
		mesh_union.receiveShadow = true;
		
		
		
		sumCreator(mesh_union,0);

		
	} );
	
	
	
	
	
//	mesh.rotation.x=Math.PI*0.5;
//	mesh.rotation.z=Math.PI/2;


	

//	currentOffset = ;  
loader.load( 'stl/2.STL' );
}
function paintLayer(increment){
	

	if (increment == 1){
		line.position.y += layerOffset;          //tube radius
		plane.position.y +=layerOffset;
	}else{
		line.position.y -= layerOffset;
		plane.position.y -=layerOffset;
	}
	
	scene.remove(layerText);
	var material = new THREE.MeshPhongMaterial({
			color: 0xff0000 , transparent : true , opacity:0.5, side: THREE.DoubleSide
	});
	var textGeom = new THREE.TextGeometry("Tier"+line.position.y/layerOffset, {
			size: 10,
			height: 5
	});
	
	layerText = new THREE.Mesh( textGeom, material );
	layerText.position.set( 0,line.position.y, -100);  
	scene.add(layerText);
	document.getElementById("currentLayer").value= line.position.y/layerOffset;

}

function copyLayer(){
	var layer1 = document.getElementById("fromLayer").value;
	var layer2 = document.getElementById("toLayer").value;
	
	for (var i = 0; i < paintObjects.length ; i++){	

		if (paintObjects[i].position.y/layerOffset == layer1){
			var tube_Mesh = paintObjects[i].clone();
			tube_Mesh.position.y = layer2*layerOffset;
			scene.add(tube_Mesh);
			paintObjects.push(tube_Mesh);
			THREE.GeometryUtils.merge(geometryMerge, tube_Mesh);
			
		}

	}		
}

function copyLayers(){
	var layer1 = parseInt(document.getElementById("fromLayer").value);
	var layer2 = parseInt(document.getElementById("toLayer").value);
	for (var i = 0; i < paintObjects.length ; i++){	

		if (paintObjects[i].position.y/layerOffset == layer1){
			var boundary = Math.abs(layer2-layer1);
			for (var j = 1; j <= boundary ; j++){	
				var tube_Mesh = paintObjects[i].clone();
				if (layer2>layer1){
					tube_Mesh.position.y = (layer1+j)*layerOffset;
				}else 
					tube_Mesh.position.y = (layer1-j)*layerOffset;
				scene.add(tube_Mesh);
				paintObjects.push(tube_Mesh);
				THREE.GeometryUtils.merge(geometryMerge, tube_Mesh);
			}
		}

	}		
}

function painterCustomize(value){
	if (value == 1)
		document.getElementById("painter").innerHTML="小筆刷";
	else if (value == 3)
		document.getElementById("painter").innerHTML="中筆刷";
	else if (value == 5)
		document.getElementById("painter").innerHTML="大筆刷";
		
	tubeThickness = value;
}



function reStart(){
	if (paintFlag){
		geometryMerge = new THREE.Geometry();
		clearObject();
	}
	
	universalFlag = !universalFlag;
	var container = document.getElementById("div1");
	if (universalFlag){
		if (layerLine == null){
			
			var size = 100,step = 10;
			var geometry= new THREE.Geometry();
			var material = new THREE.LineBasicMaterial({color:'red'});
			for (var i = -size ; i<=size ; i+=step){
				geometry.vertices.push(new THREE.Vector3(-size , -0.04 , i));
				geometry.vertices.push(new THREE.Vector3(size , -0.04 , i));
			
				geometry.vertices.push(new THREE.Vector3( i , -0.04 , -size ));
				geometry.vertices.push(new THREE.Vector3( i , -0.04 , size ));
			}
			layerLine = new THREE.Line ( geometry, material, THREE.LinePieces);
			scene.add(layerLine);
	/*		var geometry = new THREE.PlaneGeometry( 200, 200,100,100  );
			var material = new THREE.MeshBasicMaterial( {color: 0xff0000 , transparent : true , opacity:0.5, side: THREE.DoubleSide} );
			layerPlane = new THREE.Mesh( geometry, material );
			layerPlane.position.set(0,0,0);
			layerPlane.rotation.x=Math.PI/2;
			scene.add( layerPlane );  */
		}
		document.getElementById('3dpaint').value="關閉";
		container.addEventListener( 'mousemove', move, false );
		container.addEventListener( 'mousedown', down, false );
		container.addEventListener( 'mouseup', up, false );
		controls.enabled = false;
		document.getElementById('3dpaint').style.color="#ffffff";
		document.getElementById('3dpaint').style.background="red";
	}
	else{

		
		document.getElementById('3dpaint').value="開啟";
		check = 0;
		container.removeEventListener( 'mouseup', up, false );
		container.removeEventListener( 'mousemove', move, false );
		container.removeEventListener( 'mousedown', down, false );
		controls.enabled = true;
		layerLine.position.copy(line.position) ;
		
		
		scene.remove(layerText);
		var material = new THREE.MeshPhongMaterial({
				color: 0xff0000 , transparent : true , opacity:0.5, side: THREE.DoubleSide
		});
		var textGeom = new THREE.TextGeometry("Tier"+layerLine.position.y/layerOffset, {
				size: 10,
				height: 5
		});
		
		layerText2 = new THREE.Mesh( textGeom, material );
		layerText2.position.set( 0,layerLine.position.y, -100);  
		scene.add(layerText2);
		document.getElementById("currentLayer").value= layerLine.position.y/layerOffset;
		document.getElementById('3dpaint').style.color="#999999";
		document.getElementById('3dpaint').style.background="black";
	}
	paintFlag=0;
	
}
function intersectCheck(object,div){
	var container = document.getElementById(div);
	containerWidth = container.clientWidth;
	containerHeight = container.clientHeight;
	var projector = new THREE.Projector() , mouse = new THREE.Vector3();
	mouse.x = 2 * (event.clientX / containerWidth) - 1;
	mouse.y = 1 - 2 * ( event.clientY / containerHeight );
	var raycaster = projector.pickingRay( mouse.clone(), camera );
	var intersects = raycaster.intersectObject( object );
	return intersects;
}
	
	
function down(event){
	event.preventDefault();
	var intersects = intersectCheck( plane , "div1");
	if (intersects.length>0)
		check = 1;

}
function move(event){
	event.preventDefault();
	var length = 3;
	
	if (check && controls.enabled == false ){
		
		var intersects = intersectCheck( plane , "div1");
		
		if (intersects.length>0){
			var geometry = new THREE.BoxGeometry( length, length, length );
			var material = new THREE.MeshPhongMaterial({color: 0xff0000 , transparent : true , opacity:0.5 , side: THREE.DoubleSide});
			var cube = new THREE.Mesh( geometry, material );
			cube.position.copy( intersects[0].point );
			cube.position.y += length/2;
			scene.add( cube);
			currentObject.push(cube); 	
			tubePosition.push(new THREE.Vector3(cube.position.x , 0 , cube.position.z));
		}else {
			return;
		}
		/*
		THREE.GeometryUtils.merge(geometryMerge, cube); */
		
		
	}
	
}
function up(event){
	event.preventDefault();
	
	var intersects = intersectCheck( plane , "div1");
	if (check && intersects.length>0){
		controls.enabled=false;
		
		if (currentObject[0]){
			for (var i in currentObject){
				scene.remove(currentObject[i]);
				objects.splice(currentObject[i]);
			}
		}
		var pipeSpline = new THREE.SplineCurve3(tubePosition);
		var material = new THREE.MeshPhongMaterial({ambient: 0xffff00, color: 0xffffff, specular: 0x555555, shininess: 30, side: THREE.DoubleSide});
		var tube = new THREE.TubeGeometry(pipeSpline, 50, tubeThickness, 3, false);
		
		var tube_Mesh = new THREE.Mesh( tube, material );
		tube_Mesh.position.y = plane.position.y;
		scene.add( tube_Mesh);
		paintObjects.push(tube_Mesh);
		THREE.GeometryUtils.merge(geometryMerge, tube_Mesh);
		tubePosition = [];	
		check = 0;
	//	geometryMerge.rotation.x=Math.PI/2;
	}
}



function voxelPainter(){
	if (voxelFlag)
		geometryMerge = new THREE.Geometry();
	
	if (!voxel[0]){
		clearObject();
	}
	var container = document.getElementById("div1");
	if (controls.enabled){
		document.getElementById('minecraft').value="關閉MineCraft";
		controls.enabled = false;
		container.addEventListener( 'mousemove', voxelMove, false );
		container.addEventListener( 'mousedown', voxelDown, false );
		container.addEventListener( 'mouseup', voxelUp, false );
		document.getElementById('minecraft').style.color="#ffffff";
		document.getElementById('minecraft').style.background="red";
	}else{
		controls.enabled = true;
		document.getElementById('minecraft').value="MineCraft";
		container.removeEventListener( 'mousemove', voxelMove, false );
		container.removeEventListener( 'mousedown', voxelDown, false );
		container.removeEventListener( 'mouseup', voxelUp, false );
		scene.remove(pioneerCube);
		document.getElementById('minecraft').style.color="#999999";
		document.getElementById('minecraft').style.background="black";
	}
	voxelFlag=0;
}
function over(){
	
	if (!controls.enabled){
		container.removeEventListener( 'mousedown', voxelDown, false );
		scene.remove(pioneerCube);
	}
}
function out(){
	if (!controls.enabled){
		container.addEventListener( 'mousedown', voxelDown, false );
		scene.add(pioneerCube);
	}
}

function voxelMove(event){
	event.preventDefault();
	controls.enabled = false;
	updatePioneer();
	
}

function voxelPlacement(x , y ,z ,index){
	voxelX = voxelCoordinate[index].x + x;
	voxelY = voxelCoordinate[index].y + y;
	voxelZ = voxelCoordinate[index].z + z;
}



function voxelDown(event){
	event.preventDefault();
	controls.enabled = false;
	var length = 10;
	var materialArray = [];
/*	materialArray.push(new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture( 'img/grass.jpg' ) }));
	materialArray.push(new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture( 'img/grass.jpg' ) }));
	materialArray.push(new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture( 'img/grasstop.jpg' ) }));
	materialArray.push(new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture( 'img/dirt.jpg' ) }));
	materialArray.push(new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture( 'img/grass.jpg' ) }));
	materialArray.push(new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture( 'img/grass.jpg' ) }));   */     //minecraft style
		
/*	materialArray.push(new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture( 'img/crate.jpg' ) }));
	materialArray.push(new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture( 'img/crate.jpg' ) }));
	materialArray.push(new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture( 'img/crate.jpg' ) }));
	materialArray.push(new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture( 'img/crate.jpg' ) }));
	materialArray.push(new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture( 'img/crate.jpg' ) }));
	materialArray.push(new THREE.MeshBasicMaterial( { map: THREE.ImageUtils.loadTexture( 'img/crate.jpg' ) }));
*/	
	var intersects = intersectDetector(plane);
	var geometry = new THREE.BoxGeometry( length, length, length );
	//var material = new THREE.MeshFaceMaterial(materialArray);
	var material = new THREE.MeshPhongMaterial({ambient: 0xffff00, color: 0xffffff, specular: 0x555555, shininess: 30, side: THREE.DoubleSide});

	var cube = new THREE.Mesh( geometry, material );
	//for (var i in voxelCoordinate){
	//	if (voxelX == voxelCoordinate[i].x && voxelZ == voxelCoordinate[i].z && voxelY == voxelCoordinate[i].y)
	//		voxelY +=voxelY;
		
	//}
	
	cube.position.set( voxelX, voxelY , voxelZ );
	cube.name = "voxel."+voxelNumber;
	voxelNumber++;
	voxelCoordinate.push(cube.position);
	voxel.push(cube);
	scene.add ( cube );
	currentObject.push(cube);
	THREE.GeometryUtils.merge(geometryMerge, cube);
	updatePioneer();
}
function voxelUp(event){
	event.preventDefault();
	updatePioneer();
}

function updatePioneer(){
	scene.remove (pioneerCube);
	var length = 10;
	
	var intersects = intersectDetector(plane);
	var voxelIntersects;

	var geometry = new THREE.BoxGeometry( length, length, length );
	var material = new THREE.MeshBasicMaterial( {color: 0xff0000 , transparent : true , opacity:0.5} );
	pioneerCube = new THREE.Mesh( geometry, material );
	if (voxel.length>0){
		voxelIntersects = intersectsDetector(voxel);
		if (voxelIntersects.length > 0){
			var index = voxelIntersects[0].object.name.split('.')[1];
			if (voxelIntersects[0].point.x == (voxelCoordinate[index].x + length/2 )){
				voxelPlacement(length , 0 , 0 , index);
			}else if (voxelIntersects[0].point.x == (voxelCoordinate[index].x - length/2)){
				voxelPlacement(-length , 0 , 0 , index);
			}
			if (voxelIntersects[0].point.y == (voxelCoordinate[index].y + length/2 )){
				voxelPlacement(0 , length , 0 , index);
			}else if (voxelIntersects[0].point.y == (voxelCoordinate[index].y - length/2)){
				voxelPlacement(0 , -length , 0 , index);
			}
			if (voxelIntersects[0].point.z == (voxelCoordinate[index].z + length/2 )){
				voxelPlacement(0 , 0 , length , index);
			}else if (voxelIntersects[0].point.z == (voxelCoordinate[index].z - length/2)){
				voxelPlacement(0 , 0 , -length , index);
			}
		}else if (intersects.length > 0){
		
			voxelX = Math.ceil(intersects[0].point.x/length)*length;
			voxelY = length/2;
			voxelZ = Math.ceil(intersects[0].point.z/length)*length;
		}
	}else{
		voxelX = Math.ceil(intersects[0].point.x/length)*length;
		voxelY = length/2;
		voxelZ = Math.ceil(intersects[0].point.z/length)*length;
	}

	pioneerCube.position.set( voxelX, voxelY , voxelZ );
	scene.add ( pioneerCube );
}
function intersectDetector(object){
	var container = document.getElementById("div1");
	var containerWidth = container.clientWidth;
	var containerHeight = container.clientHeight;
	
	var projector = new THREE.Projector(), mouse = new THREE.Vector3();
	mouse.x = 2 * (event.clientX / containerWidth) - 1;
	mouse.y = 1 - 2 * ( event.clientY / containerHeight );
	var raycaster = projector.pickingRay( mouse.clone(), camera );
	var intersects = raycaster.intersectObject( object );
	return intersects;
}
function intersectsDetector(objects){
	var container = document.getElementById("div1");
	var containerWidth = container.clientWidth;
	var containerHeight = container.clientHeight;
	
	var projector = new THREE.Projector(), mouse = new THREE.Vector3();
	mouse.x = 2 * (event.clientX / containerWidth) - 1;
	mouse.y = 1 - 2 * ( event.clientY / containerHeight );
	var raycaster = projector.pickingRay( mouse.clone(), camera );
	var intersects = raycaster.intersectObjects( objects );
	return intersects;
}


function gCode(){

	var xhr = new XMLHttpRequest();

	xhr.onreadystatechange = function(){
        if(xhr .readyState == 4){
            if (xhr.status === 200)
                Gbegin(xhr.responseText.trim());
				
        }
//	window.location = "http://140.127.220.81/exec.php";
	};
	xhr.open( 'GET', 'toGcode.php', true );
	xhr.send( null );

}



function clearObject(){
	geometryMerge = new THREE.Geometry();
	voxel = [];
	voxelCoordinate = [];
	voxelNumber = 0;
	if (currentObject[0]){
		for (var i in currentObject){
			scene.remove(currentObject[i]);
		}
		objects=[];
	}
	if (paintObjects[0]){
		for (var i in paintObjects){
			scene.remove(paintObjects[i]);
		}
		paintObjects=[];
	}
}

function sumCreator(object,offset){
	voxelFlag = 1;
	paintFlag = 1;
	clearObject();
	THREE.GeometryUtils.merge(geometryMerge, object);
	object.name = "obj."+objectCount++;         //dot for string exploit
	object.position.set( 0,offset,0 );
	object.geometry.computeFaceNormals();
	currentObject.push(object);
	scene.add( object );
	objectOffset.push(offset);
	objects.push(object);
}

