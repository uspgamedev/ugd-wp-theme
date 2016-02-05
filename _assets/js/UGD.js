

function SECTIONS() {
	var obj = {};

	// Private Attributes
	var Selected;
	var Sections;
	var Size;
	var Menu;

	// Private Methods
	function update() {
		console.log( 'Section: ' + Selected + '/' + (Size-1) );
		// DO STUFF HERE
		for (var i = 0; i < Size; i++) {
			Menu.update(i, Selected, 'close');
			animate(i);
		}
	}

	function animate(index) {
		// Moves Sections to display Selected Section
		Sections[index].style.setProperty("-moz-transform", "translate3D( " + (index - Selected)*100 + "%, 0, 0)");
		Sections[index].style.setProperty("-ms-transform", "translate3D( " + (index - Selected)*100 + "%, 0, 0)");
		Sections[index].style.setProperty("-o-transform", "translate3D( " + (index - Selected)*100 + "%, 0, 0)");
		Sections[index].style.setProperty("-webkit-transform", "translate3D( " + (index - Selected)*100 + "%, 0, 0)");
		Sections[index].style.setProperty("transform", "translate3D( " + (index - Selected)*100 + "%, 0, 0)");
		if ( Sections[index].classList.contains('juicy') ) {
			setTimeout(function() { Sections[index].classList.remove('juicy') }, 400);
		}
		
	}

	// Public Methods
	obj.load = function() {
		// CALL THIS FUNCTION FOR THINGS TO WORK

		// Setting Private Attr Values
		Selected = 0;
		Sections = document.getElementsByClassName('section');
		Menu = MENU();
		Size = Sections.length;

		// Loading Controllers
		INPUT(obj);
		update();
	}

	obj.set = function(target_index) {
		// If something sets it to a crazy number, it goes back to a decent one.
		Selected = Math.abs( target_index % Size );
		update();
	}
	obj.next = function() {
		Selected += 1;
		if (Selected >= Size) Selected = Size-1;
		update();
	}
	obj.prev = function() {
		Selected -= 1;
		if (Selected < 0) Selected = 0;
		update();
	}

	return obj;
}

function QUERY() {
	var obj = {};

	// Private Attributes
	var next_btn;
	var prev_btn;
	var data;
	var loading = document.getElementById('loading');

	// Private Methods
	function update_next_action(button) {
		button.onclick = function() {
			set_data(this, 'next');
			
			var container = $('#query-' + data.query_id).parent();
			container.fadeOut(200);
			loading.classList.remove('hidden');
			loading.classList.remove('juicy');
			console.log('requesting new page...');
			
			$.post(
				ajaxurl,
				data,
				function (returnedData) {
					container.empty();
					container.append(returnedData);
					container.fadeIn(200);
					loading.classList.add('juicy');
					setTimeout(function() {
						loading.classList.add('hidden');
					}, 200)
					
					obj.load();
					console.log('new page gotten!');
				}
			);
		}
	}
	function update_prev_action(button) {
		button.onclick = function() {
			set_data(this, 'prev');

			var container = $('#query-' + data.query_id).parent();
			container.fadeOut(200);
			loading.classList.remove('hidden');
			loading.classList.remove('juicy');
			console.log('requesting new page...');
			
			$.post(
				ajaxurl,
				data,
				function (returnedData) {
					container.empty();
					container.append(returnedData);
					container.fadeIn(200);
					loading.classList.add('juicy');
					setTimeout(function() {
						loading.classList.add('hidden');
					}, 200)
					
					obj.load();
					console.log('new page gotten!');
				}
			);
		}
	}
	function set_data(button, intention) {
		var params = document.getElementById( button.getAttribute('params') );
		data = {
			action: 'changepage',
			intention: intention,
			query_id: params.getAttribute('query-id'),
			current_page: params.getAttribute('current-page'),
			page_limit: params.getAttribute('page-limit')
		}
	}
	function update() {
		for (var i = 0; i < next_btn.length; i++) {
			update_next_action( next_btn[i], i );
		};
		for (var i = 0; i < prev_btn.length; i++) {
			update_prev_action( prev_btn[i], i );
		};
	}
	
	// Public Methods
	obj.load = function() {
		next_btn = document.getElementsByClassName('query-nav-btn-next');
		prev_btn = document.getElementsByClassName('query-nav-btn-prev');
		update();
	}

	return obj;
}

function INPUT(logic) {
	// Private Methods
	function load_hammer() {
		// SWIPE CONTROLS

		// hammer lib class
		var ham = new Hammer( document.getElementById('content') );
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
			// Do Action Here
			logic.next();
		});
		ham.on("swiperight", function(ev) {
			console.log(ev.type);
			// Do Action Here
			logic.prev();
		});
	}
	function load_keyboard() {
		// KEYBOARD CONTROLS

		// Konami Code Vars
		var secret = "38384040373937396665";
		var input = "";
		var timer;

		document.onkeyup = function(e) {
			// setting up section navigation
			checkNavigationControls(e);
			// setting up konami code activation
			//checkKonamiCode(e);
		}
		function checkKonamiCode(e) {
			// initialises konami code interpreting
			var key = e.which;
			input += key.toString();
		   	console.log(input);
		   	clearTimeout(timer);
		   	timer = setTimeout(function() { input = ""; }, 500);
		   	
		   	// check input
		    if (input == secret) {
		        alert("well hello there");
		    }
		}
		function checkNavigationControls(e) {
			// checks navigation input
			var key = e.which;
			if (key == 37) {
				// LEFT
				logic.prev();
			} else if (key == 39) {
				// RIGHT
				logic.next();
			}
		}
	}
	function load_menu_items() {
		var menu_items = document.getElementsByClassName('navigation-menu-item');
		function add_menu_item_action(item, index) {
			item.onclick = function() {
				logic.set(index);
			}
		}
		for (var i = 0; i < menu_items.length; i++) {
			add_menu_item_action(menu_items[i], i);
		};
	}

	// START UP
	load_hammer();
	load_keyboard();
	load_menu_items();
}

// Dropdown Toggle Menu

function MENU() {
	var obj = {};
	
	// Private Attributes
	var toggler = document.getElementById('nav-btn');
	var togglees = {
		navbar: document.getElementById('navigation-menu'),
		content: document.getElementById('content')
	}
	var menu_items = document.getElementsByClassName('navigation-menu-item');
	var open = false;

	// Private Methods
	function open_menu() {
		togglees.navbar.classList.add('displace');
		togglees.content.classList.add('displace');
		open = true;
	}
	function close_menu() {
		togglees.navbar.classList.remove('displace');
		togglees.content.classList.remove('displace');
		open = false;
	}
	function toggle_menu() {
		if (open) {
			close_menu();
		} else {
			open_menu();
		}
	}
	function colorize(index, selected) {
		// Makes Navigation Menu show which Section is Selected
		menu_items[index].classList.remove('greenlue-text');
		menu_items[index].classList.add('white-text');
		menu_items[selected].classList.add('greenlue-text');
		menu_items[selected].classList.remove('white-text');	
	}

	// Public Methods
	obj.update = function(index, selected, state) {
		colorize(index, selected);
		if (state == 'open') {
			open_menu();
		} else if (state == 'close') {
			close_menu();
		} else {
			if (open) {
				close_menu();
			} else {
				open_menu();
			}
		}
	}

	// START UP
	toggler.onclick = toggle_menu;
	togglees.content.onclick = close_menu;
	//window.onresize = close_menu;	

	return obj;
};


function SINGLE() {
	var obj = {};

	// Private Attributes
	var thumbnails;
	var data;
	var loading = $('#loading');

	function set_data(button, intention) {
		var params = document.getElementById( button.getAttribute('params') );
		data = {
			action: 'get_post',
			post_id: params.id
		}
	}
	function update() {
		for (var i = 0; i < next_btn.length; i++) {
			update_next_action( next_btn[i], i );
		};
		for (var i = 0; i < prev_btn.length; i++) {
			update_prev_action( prev_btn[i], i );
		};
	}
	
	// Public Methods
	obj.load = function() {
		thumbnails = document.getElementsByClassName('post-permalink');
		update();
	}

	return obj;
}
