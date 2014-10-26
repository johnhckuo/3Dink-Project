				var camera, scene, renderer,
				geometry, material, mesh, light1, stats;
				

				function $(id){
				  return document.getElementById(id);
				}


				function geoInit(path) {
					//Detector.addGetWebGLMessage();
					
					scene = new THREE.Scene();

					camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 1, 10000 );
					camera.position.set(0,0,150);
					scene.add( camera );

					var directionalLight = new THREE.DirectionalLight( 0xFFFFFF );
					directionalLight.position.x = 0;
					directionalLight.position.y = 0;
					directionalLight.position.z = 1;
					directionalLight.position.normalize();
					scene.add( directionalLight );

			/*		var xhr = new XMLHttpRequest();
					xhr.onreadystatechange = function () {
						if ( xhr.readyState == 4 ) {
							if ( xhr.status == 200 || xhr.status == 0 ) {
								
								var rep = xhr.response; // || xhr.mozResponseArrayBuffer;
								console.log(rep);
								parseStlBinary(rep);
								//parseStl(xhr.responseText);
								mesh.rotation.x = 5;
								mesh.rotation.z = .25;
								console.log('done parsing');
							}
						}
					}
					xhr.onerror = function(e) {
						console.log(e);
					}

					xhr.open( "GET", path, true );
					xhr.responseType = "arraybuffer";
					//xhr.setRequestHeader("Accept","text/plain");
					//xhr.setRequestHeader("Content-Type","text/plain");
					//xhr.setRequestHeader('charset', 'x-user-defined');
					xhr.send( null );                                                                   */
					
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
					loader.load( path );

					renderer = new THREE.WebGLRenderer(); //new THREE.CanvasRenderer();
					renderer.setSize( 800, 800 );
					
					if ($("viewer3D").firstChild){
						$("viewer3D").removeChild($("viewer3D").firstChild);
					}
					$("viewer3D").appendChild( renderer.domElement );


					stats = new Stats();
					stats.domElement.style.position = 'absolute';
					stats.domElement.style.top = '0px';
			//		stats.domElement.style.left= '50px';
					//document.body.appendChild(stats.domElement);
					
					animate();
				}

				function animate() {

					// note: three.js includes requestAnimationFrame shim
					if (foldoutKey)                                                                      // in roll.js foldoutKey avoid turbo spinning speed when surfing lots of stl
						return;
					requestAnimationFrame( animate );
					render();
					stats.update();

				}

				function render() {
					

					//mesh.rotation.x += 0.01;
					if (mesh) {
						mesh.rotation.y += 0.01;
					}
					//light1.position.z -= 1;
					
				//	setTimeout(function(){mesh=null;},2000);
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

		