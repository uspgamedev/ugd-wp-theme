var horisec = {};

(function(){

	// control buttons
	var section_btns = document.getElementsByClassName('section-ctrl');

	// section state values
	var state = 0;
	var statemax = section_btns.length;
	
	// hammer lib class
	var ham = new Hammer( document.getElementById('content') );

	// Public Setup Methods

	// setting up key input controls
	horisec.setKeyControls = function() {

		// konami vars
		var secret = "38384040373937396665";
		var input = "";
		var timer;
	
		// button click controls
		for (var i = 0; i < section_btns.length; i++) {
			addsliderctrl( section_btns[i], i );
		};
		function addsliderctrl(enode, n) {
			enode.onclick = function() {
				state = n+1;
				horisec.update();
			}
		}
		
		// keyboard controls
		document.onkeyup = function(e) {
			// setting up konami code activation
			checkKonamiCode(e);
			// setting up section navigation
			checkNavigationControls(e);
		}
		function checkNavigationControls(e) {
			// checks navigation input
			var key = e.which;
			if (key == 37) {
				if (state > 0) state -= 1;
				console.log(state);
				horisec.update();
			} else if (key == 39) {
				if (state < statemax) state += 1;
				console.log(state);
				horisec.update();
			}
		}
		function checkKonamiCode(e) {
			// initialises konami code interpreting
			input += e.which.toString();
		   	console.log(input);
		   	clearTimeout(timer);
		   	timer = setTimeout(function() { input = ""; }, 500);
		   	check_input();
		}
		function check_input() {
		    if (input == secret) {
		        alert("well hello there");
		    }
		};

		// hammer lib controls
		ham.add ( new Hammer.Swipe({
		    event: 'swipeleft',
		    threshold: 15,
		    velocity: 1,
		    direction: Hammer.DIRECTION_HORIZONTAL,
		    preventDefault: true
		} ) );
		ham.add ( new Hammer.Swipe({
		    event: 'swiperight',
		    threshold: 15,
		    velocity: 1,
		    direction: Hammer.DIRECTION_HORIZONTAL,
		    preventDefault: true
		} ) );

		ham.on("swipeleft", function(ev) {
			console.log(ev.type);
			if (state < statemax) state += 1;
			horisec.update();
		});
		ham.on("swiperight", function(ev) {
			console.log(ev.type);
			if (state > 0) state -= 1;
			horisec.update();
		});
	}

	// setting up ajax query pagination
	horisec.setAjaxPagination = function () {
		jQuery('.query-nav-btn').click(function() {
			
			var sectionid = this.parentNode.getAttribute('query-id');
			var where = this.classList.item(1);

			var posts_container = jQuery('#query-'+sectionid);
			var currentpage = posts_container.attr('current-page');
			var pagelimit = posts_container.attr('page-limit');

			var insertnode = posts_container.parent();
			
			console.log("cat id: " + sectionid + "; pagination:" + where + ";");

			jQuery.ajax ({
				type : 'POST',
				url : ajaxurl,
				data : {
					action: 'changepage',
					section: sectionid,
					direction: where,
					current: currentpage,
					limit: pagelimit
				},
				success: function(data, textStatus, XMLHttpRequest) {
					jQuery('#loading').fadeIn(200);
					console.log("the ajax request has been successful");
					console.log("emptying insert node:");
					insertnode.fadeOut(200);
					insertnode.empty();
					function getRequestedContent() {
						insertnode.append(data);
						insertnode.show();
						horisec.update();
					}
					setTimeout( getRequestedContent, 400 );
					
				},
				error: function(MLHttpRequest, textStatus, errorThrown) {
					alert(errorThrown);
				}
			});
		});
	}

	// Update Method
	horisec.update = function() {
		//jQuery('#loading').show();
		update_ctrl();
		update_slider();
		//update_color();
		update_juicy();

		console.log(state);

		//jQuery('.navigation-menu').removeClass('displace');
		document.getElementsByClassName('navigation-menu')[0].classList.remove('displace');
		document.getElementById('content').classList.remove('displace');
		jQuery('#loading').fadeOut(200);
	}

	// Private Update Methods
	// Control Update
	function update_ctrl() {
		var section_btns = document.getElementsByClassName('section-ctrl');
		for (var i = 0; i < section_btns.length; i++) {
			if (state == i+1) {
				section_btns[i].parentNode.classList.add('greenlue-text');
			} else {
				section_btns[i].parentNode.classList.remove('greenlue-text');
			};
		};
	}
	// Slider Update
	function update_slider() {
		var sections = document.getElementsByClassName('sections');
		for (var i = 0; i < sections.length; i++) {
			sections[i].style.webkitTransform = "translate3d(" + ( (i - state) * 100) + "%, 0, 0)";
			sections[i].style.MozTransform = "translate3d(" + ( (i - state) * 100) + "%, 0, 0)";
			sections[i].style.msTransform = "translate3d(" + ( (i - state) * 100) + "%, 0, 0)";
			sections[i].style.OTransform = "translate3d(" + ( (i - state) * 100) + "%, 0, 0)";
			sections[i].style.transform = "translate3d(" + ( (i - state) * 100) + "%, 0, 0)";
			if ( !sections[i].classList.contains('transition') ) sections[i].classList.add('transition');
		};
	}
	// Color Update
	function update_color() {
		var sections = document.getElementsByClassName('sections');
		var sectype = sections[state].getAttribute('section-type');
		if (sectype == "cover") {
			document.getElementById('wrapper').classList.remove('white','grey','red','greenlue');
			document.getElementById('wrapper').classList.add('dark');
			document.getElementById('wrapper').parentNode.classList.remove('dark-text','grey-text','red-text','greenlue-text');
			document.getElementById('wrapper').parentNode.classList.add('white-text');
		} else if (sectype == "query") {
			document.getElementById('wrapper').classList.remove('dark','grey','white','greenlue');
			document.getElementById('wrapper').classList.add('red');
			document.getElementById('wrapper').parentNode.classList.remove('dark-text','grey-text','red-text','greenlue-text');
			document.getElementById('wrapper').parentNode.classList.add('white-text');
		} else {
			document.getElementById('wrapper').classList.remove('white','grey','red','greenlue');
			document.getElementById('wrapper').classList.add('dark');
			document.getElementById('wrapper').parentNode.classList.remove('dark-text','grey-text','red-text','greenlue-text');
			document.getElementById('wrapper').parentNode.classList.add('white-text');
		}
	}
	// Juicy Update
	function update_juicy() {
		var sections = document.getElementsByClassName('sections');
		for (var i = 0; i < sections.length; i++) {
			sections[i].getElementsByClassName('juicy')[0].classList.add('juicy-low');
		}
		sections[state].getElementsByClassName('juicy')[0].classList.remove('juicy-low');
	}
}());