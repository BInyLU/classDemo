	windowAddMouseWheel();

	function windowAddMouseWheel() {
		var scrollFunc = function(e) {
			e = e || window.event;
			if (e.wheelDelta) { 
				if (e.wheelDelta > 0) { 
					alert(1)
				}
				if (e.wheelDelta < 0) { 
					alert(1)
				}
			} else if (e.detail) {
				if (e.detail > 0) { 
					alert(1)
				}
				if (e.detail < 0) { 
					alert(1)
				}
			}
		};
		if (document.addEventListener) {
			document.addEventListener('DOMMouseScroll', scrollFunc, false);
		}
		window.onmousewheel = document.onmousewheel = scrollFunc;
	}