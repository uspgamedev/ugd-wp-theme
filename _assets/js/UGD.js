

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

	// Private Methods
	
	// Public Methods

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

	return obj;
};














