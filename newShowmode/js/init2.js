function init(panelCount) {
      var carousel = $('carousel'),
          navButtons = document.querySelectorAll('#navigation button'),
          transformProp = Modernizr.prefixed('transform'),
          theta = 0;
          this.onNavButtonClick = function( event ){
			
          var increment = parseInt( event.target.getAttribute('data-increment') );

           // theta += ( 360 / panelCount ) * increment * -1;
			
			theta +=degree* increment * -1;
		    carousel.style[ transformProp ] = 'rotateY(' + theta + 'deg)';

          };
		 
	  for ( var i = 0 ; i< panelCount ;  i++){
	//	$(i).style[ transformProp ]='rotateY('+(18*i+9)+'deg ) translateZ( 450px )';
		var panelSize = 115;
		
		degree = 360 / panelCount;
		var radius = Math.round( ( panelSize / 2 ) / Math.tan( ( ( Math.PI * 2 ) / panelCount ) / 2 ) );
		$(i).style[ transformProp ]='rotateY('+(degree*i)+'deg ) translateZ( 450px )';
		
		
		
		$(i).Math.random() * 2 + 1;
	  }
		
      for (var i=0; i < 2; i++) {
        navButtons[i].addEventListener( 'click', onNavButtonClick, false);
      }
	  
	  for(var i=0 ; i<panelCount ; i++){
		list.add(i);
		listCurrent = list.listEnd.next;
	  }
	  
	  

}