				var camera, scene, renderer,
				geometry, material, mesh, light1, stats;
				

        function $(id){
          return document.getElementById(id);
        }


				function trim (str) {
					str = str.replace(/^\s+/, '');
					for (var i = str.length - 1; i >= 0; i--) {
						if (/\S/.test(str.charAt(i))) {
							str = str.substring(0, i + 1);
							break;
						}
					}
					return str;
				}

				

				function dragInit(){
					$("first").addEventListener("dragenter" , dragEnter2 , false);
					$("first").addEventListener("dragover" , dragOver2 , false);
					$("first").addEventListener("drop" , drop2 , false);
					$("first").addEventListener("dragleave" , dragLeave2 , false);
				}
				
				function dragLeave2(e){
					e.preventDefault();
					e.stopPropagation();
					e.target.style.opacity=0.4;
				}
				
				function dragEnter2(e){
					e.preventDefault();
					e.stopPropagation();
				}
				function dragOver2(e){
					e.preventDefault();
					e.stopPropagation();
					e.target.style.opacity=1;
				}

				function drop2(e){
					e.preventDefault();
					e.stopPropagation();
					$("first").removeEventListener("dragenter" , dragEnter2 , false);
					$("first").removeEventListener("dragover" , dragOver2 , false);
					$("first").removeEventListener("drop" , drop2 , false);
					$("first").removeEventListener("dragleave" , dragLeave2 , false);
					
					var files = e.dataTransfer.files;
					var xhr = new XMLHttpRequest;
					var fd = new FormData();
					var imageSize=files[0].size; //3D圖檔檔案大小
					//alert(files[0].type); //use for debug
					var re = /\.(stl|STL)$/i;  //允許的圖片副檔名
    				

					if(imageSize>40000000)
					{
						alert('圖檔過大請重新上傳');
						document.location.href="file_upload.php";
						exit;
					}
					
				    if (!re.test(files[0].type)){
				        alert("只允許上傳stl檔，請重新上傳");
				        document.location.href="file_upload.php";
						exit;
				    } 
					

					document.getElementById("dragSize").value=imageSize;//3D圖檔檔案大小
					xhr.open("POST","upload.php");
					xhr.onload=function(){
						$("firstdragData").value = files[0].name; 
						geoInit(files[0].name);
					};

					xhr.upload.onprogress=function(e){
					  if (e.lengthComputable){
						var progress = (e.loaded/e.total)*100;
						if (progress == 100){
						  progress = 99.9;
						  
						 }
						$("firstProgress").style.height=progress*($("first").style.height/100)+"px";                    // depend on the height of the progress height
					  }
					};
					for (var i in files){
						  fd.append("ff[]",files[i]);
						
					}
					
					xhr.send(fd);
				}
				


				function geoInit(path){
				
					$("firstdragData").style.opacity=0;				
				//	$("firstnormData").style.opacity=0;
					$("modelDisplay").style.opacity=1;
					// Notes:
					// - STL file format: http://en.wikipedia.org/wiki/STL_(file_format)
					// - 80 byte unused header
					// - All binary STLs are assumed to be little endian, as per wiki doc
					
					init(path);
					animate();
				}
				
			
					
			
				
				function init(path) {

					//Detector.addGetWebGLMessage();

					scene = new THREE.Scene();

					camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 1, 10000 );
					camera.position.set(0,0,100);
					scene.add( camera );

					var directionalLight = new THREE.DirectionalLight( 0xFFFFFF );
					directionalLight.position.x = 0;
					directionalLight.position.y = 0;
					directionalLight.position.z = 1;
					directionalLight.position.normalize();
					scene.add( directionalLight );

	/*				var xhr = new XMLHttpRequest();
					xhr.onreadystatechange = function () {
						if ( xhr.readyState == 4 ) {
							if ( xhr.status == 200 || xhr.status == 0 ) {
								var rep = xhr.response; // || xhr.mozResponseArrayBuffer;
								console.log(rep);
								parseStlBinary(rep);
								//parseStl(rep);
								mesh.rotation.x = 5;
								mesh.rotation.z = .25;
								console.log('done parsing');
							}
						}
					}
					xhr.onerror = function(e) {
						console.log(e);
					}

					xhr.open( "GET", 'upload/'+path, true );
					xhr.responseType = "arraybuffer";
					//xhr.setRequestHeader("Accept","text/plain");
					//xhr.setRequestHeader("Content-Type","text/plain");
					//xhr.setRequestHeader('charset', 'x-user-defined');
					xhr.send( null );                                                                           */
					
					var loader = new THREE.STLLoader();
					loader.addEventListener( 'load', function ( event ) {

						var geometry = event.content;
						var material = new THREE.MeshPhongMaterial( { ambient: 0xff5533, color: 0xff5533, specular: 0x111111, shininess: 200 } );
						mesh = new THREE.Mesh( geometry, material );

						mesh.position.set( 0, 0, 0 );
						mesh.castShadow = true;
						mesh.receiveShadow = true;
						scene.add( mesh );
					} );
					loader.load( 'upload/'+path );

					
					renderer = new THREE.WebGLRenderer(); //new THREE.CanvasRenderer();
					renderer.setSize( 540, 370 );
					$("modelDisplay").appendChild( renderer.domElement );

				}

				function animate() {

					// note: three.js includes requestAnimationFrame shim
					requestAnimationFrame( animate );
					render();

				}

				function render() {

					//mesh.rotation.x += 0.01;
					if (mesh) {
						mesh.rotation.y += 0.02;
					}
					//light1.position.z -= 1;

					renderer.render( scene, camera );
					document.addEventListener( 'mousewheel' ,  zoom , false);

				}
				function zoom(event){
					if (event.wheelDelta >=120){
						mesh.scale.x +=0.05;
						mesh.scale.y +=0.05;
						mesh.scale.z +=0.05;
					}
					else if(event.wheelDelta <=-120){
						mesh.scale.x -=0.05;
						mesh.scale.y -=0.05;
						mesh.scale.z -=0.05	;
						
				}

					return false;
				}
				window.addEventListener("DOMContentLoaded", dragInit , false);