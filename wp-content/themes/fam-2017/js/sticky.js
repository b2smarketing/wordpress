(() => {
	var featureTest = function ( property, value, noPrefixes ) {
	  // Thanks Modernizr!
	  var prop = property + ':',
	      el = document.createElement( 'test' ),
	      mStyle = el.style;
	  
	  if( !noPrefixes ) {
	      mStyle.cssText = prop + [ '-webkit-', '-moz-', '-ms-', '-o-', '' ].join( value + ';' + prop ) + value + ';';
	  } else {
	      mStyle.cssText = prop + value;
	  }    
	  return mStyle[ property ];
	}

	window.go_sticky = (selector) => {
		var menu = document.querySelector(selector);

		// Testar suporte por position-sticky
		var supportsSticky = !!featureTest('position', 'sticky');

		if (supportsSticky) {
			menu.style.position = 'sticky';
			return;
		}

		var menuPosition = menu.getBoundingClientRect();
		var placeholder = document.createElement('div');
		placeholder.style.width = menuPosition.width + 'px';
		placeholder.style.height = menuPosition.height + 'px';
		var isAdded = false;

        menu.parentNode.insertBefore(placeholder, menu);
        placeholder.style.visibility = isAdded ? 'visible' : 'hidden';

		window.addEventListener('scroll', function() {
		    if (window.pageYOffset >= menuPosition.top && !isAdded) {
		        menu.classList.add('sticky');
		        // menu.parentNode.insertBefore(placeholder, menu);

		        isAdded = true;
        		placeholder.style.visibility = isAdded ? 'visible' : 'hidden';
		    } else if (window.pageYOffset < menuPosition.top && isAdded) {
		        menu.classList.remove('sticky');
		        // menu.parentNode.removeChild(placeholder);

		        isAdded = false;
        		placeholder.style.visibility = isAdded ? 'visible' : 'hidden';
		    }
		});
	}
})();