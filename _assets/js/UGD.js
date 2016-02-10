

function SECTIONS() {
	var obj = {};

	// Private Attributes
	var Selected;
	var Sections;
	var Size;
	var Menu;
	var Pagination;
	var input_fields;
	var isInputFocus = false;

	// Private Methods
	function update() {
		console.log( 'Section: ' + Selected + '/' + (Size-1) );
		// DO STUFF HERE
		for (var i = 0; i < Size; i++) {
			Menu.update(i, Selected, 'close');
			animate(i);
			animate_selected();
		}
	}

	function animate_selected() {
		if ( Sections[Selected].classList.contains('juicy') ) {
			setTimeout(function() { Sections[Selected].classList.remove('juicy') }, 200);
		}
	}
	function animate(index) {
		// Moves Sections to display Selected Section
		
		Sections[index].style.setProperty("-moz-transform", "translate3D( " + (index - Selected)*100 + "%, 0, 0)");
		Sections[index].style.setProperty("-ms-transform", "translate3D( " + (index - Selected)*100 + "%, 0, 0)");
		Sections[index].style.setProperty("-o-transform", "translate3D( " + (index - Selected)*100 + "%, 0, 0)");
		Sections[index].style.setProperty("-webkit-transform", "translate3D( " + (index - Selected)*100 + "%, 0, 0)");
		Sections[index].style.setProperty("transform", "translate3D( " + (index - Selected)*100 + "%, 0, 0)");
		
		if (index != Selected) {
			Sections[index].classList.add('juicy');
		};

		/*
		if ( Sections[index].classList.contains('juicy') ) {
			//setTimeout(function() { Sections[Selected].classList.remove('juicy') }, 400);
		}
		*/

		
	}

	// Public Methods
	obj.load = function() {
		// CALL THIS FUNCTION FOR THINGS TO WORK

		// Setting Private Attr Values
		Selected = 0;
		Sections = document.getElementsByClassName('section');
		Size = Sections.length;

		// LOGICS
		Menu = MENU();
		Pagination = QUERY();
		SEARCH(Pagination);
		INPUT(obj);
		
		$('input').focus(
			function() {isInputFocus = true;}
		);
		$('input').blur(
			function() {isInputFocus = false;}
		);

		// Loading Controllers
		update();
	}

	obj.set = function(target_index) {
		if (isInputFocus == true) return;
		// If something sets it to a crazy number, it goes back to a decent one.
		if (Selected == target_index) {
			window.location.href = "?section=" + target_index;
			return;
		}
		Selected = Math.abs( target_index % Size );
		update();
	}
	obj.next = function() {
		if (isInputFocus == true) return;
		Selected += 1;
		if (Selected >= Size) Selected = Size-1;
		update();
	}
	obj.prev = function() {
		if (isInputFocus == true) return;
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
	var container;


	// Private Methods
	function set_container() {
		container = $('#query-' + data.cat_id);
	}
	function fadeout_things() {
		container.fadeOut(200);
		loading.classList.remove('hidden');
		loading.classList.remove('juicy');
		console.log('requesting new page...');
	}
	function fadein_things() {
		container.fadeIn(200);
		loading.classList.add('juicy');
		setTimeout(function() {
			loading.classList.add('hidden');
		}, 200)
	}

	function update_nav_action(button) {
		button.onclick = function() {
			set_data(this);
			set_container();
			fadeout_things();
			
			$.post(
				ajaxurl,
				data,
				function (returnedData) {
					container.empty();
					container.append(returnedData);
					fadein_things();

					obj.load();
					console.log('new page gotten!');
				}
			);
			return false;
		}
	}
	function set_data(button) {
		var category = button.getAttribute('category-id');
		var target = button.getAttribute('target');
		var search = button.getAttribute('search');
		if ( search != undefined || search == "") {
			data = {
				action: 'section_setpage_search',
				cat_id: category,
				target_page: target,
				search_params: search
			}
		} else {
			data = {
				action: 'section_setpage_nosearch',
				cat_id: category,
				target_page: target
			}
		}
	}
	function update() {
		for (var i = 0; i < nav_btn.length; i++) {
			update_nav_action( nav_btn[i], i );
		};
	}
	
	// Public Methods
	obj.load = function() {
		nav_btn = document.getElementsByClassName('query-nav-btn');
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
			checkKonamiCode(e);
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
		        alert("SECRET UNLOCKED");
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

function SEARCH(logic) {
	var data = {
		action: 'section_setpage_search'
	}
	var loading = document.getElementById('loading');
	var container;


	// Private Methods
	function set_container() {
		container = $('#query-' + data.cat_id);
	}
	function fadeout_things() {
		container.fadeOut(200);
		loading.classList.remove('hidden');
		loading.classList.remove('juicy');
		console.log('requesting new page...');
	}
	function fadein_things() {
		container.fadeIn(200);
		loading.classList.add('juicy');
		setTimeout(function() {
			loading.classList.add('hidden');
		}, 200)
	}

	// EVENT LOAD
	function load_search_input() {
		var search_boxes = document.getElementsByClassName('search-form-input');
		console.log('loading search_boxes...');
		for (var i = 0; i < search_boxes.length; i++) {
			check_text_input(search_boxes[i]);
		};
	}

	function update(input, cat_id) {
		set_data(input, cat_id);
		set_container();
		fadeout_things()

		$.post(
			ajaxurl,
			data,
			function(returnedData) {
				container.empty();
				container.append(returnedData);
				fadein_things();

				logic.load();
				console.log('new page gotten!');
			}
		);
	}

	function set_data(input, cat_id) {
		if (input != "") {
			data.action = "section_setpage_search";
		} else {
			data.action = "section_setpage_nosearch";
		}
		data.search_params = input;
		data.cat_id = cat_id;
	}

	function check_text_input(inputbox) {
		console.log(inputbox);
		inputbox.onkeyup = function(e) {
			if (e.which == "13") {
				var text = this.value;
				var cat = this.getAttribute('category-id');
				update(text, cat);
			}
		}
	}

	load_search_input();
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
		menu_items[index].classList.remove('greenlue', 'black-text');
		menu_items[index].classList.add('white-text');
		menu_items[selected].classList.add('greenlue', 'black-text');
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


function METAMENU() {
	var toggler = document.getElementById('meta-nav-btn');
	var togglee = document.getElementById('content');
	var toggle_menu = document.getElementById('masthead');
	function toggle_meta_menu() {
		togglee.classList.toggle('displace-vertical');
		toggle_menu.classList.toggle('displace-vertical');
	}
	toggler.onclick = toggle_meta_menu;
}