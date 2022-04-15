$(function() {
	'use strict'

	var urlController = appURL + "search/";

	// ______________ PAGE LOADING
	$("#global-loader").fadeOut("slow");

	$("#main-search").on("click", function(){
		var categorie = $('#i-search-categorie').val();
		var string = $('#i-main-search').val();

		if(string.length != 0){
			string = string.replace(/ /g, '-');
			window.location.href = urlController + categorie + '/' + string;
		}
	});

	$("#alternative-search").on("click", function(){
		var categorie = $('input[name=search-type]').val();
		var string = $('#i-page-search').val();

		if(string.length != 0){
			string = string.replace(/ /g, '-');
			window.location.href = urlController + categorie + '/' + string;
		}
	});

	$(".search-nav-item").on("click", function(){
		var categorie = $(this).attr("data-value");
		var string = $('#i-page-search').val();

		if(string.length != 0){
			string = string.replace(/ /g, '-');
			window.location.href = urlController + categorie + '/' + string;
		}
	});
	
	// ______________ Card
	const DIV_CARD = 'div.card';
	
	// ______________ Function for remove card
	$(document).on('click', '[data-toggle="card-remove"]', function(e) {
		let $card = $(this).closest(DIV_CARD);
		$card.remove();
		e.preventDefault();
		return false;
	});
	
	// ______________ Functions for collapsed card
	$(document).on('click', '[data-toggle="card-collapse"]', function(e) {
		let $card = $(this).closest(DIV_CARD);
		$card.toggleClass('card-collapsed');
		e.preventDefault();
		return false;
	});
	
	// ______________ Card full screen
	$(document).on('click', '[data-toggle="card-fullscreen"]', function(e) {
		let $card = $(this).closest(DIV_CARD);
		$card.toggleClass('card-fullscreen').removeClass('card-collapsed');
		e.preventDefault();
		return false;
	});
	
	// ______________Main-navbar
	if (window.matchMedia('(min-width: 992px)').matches) {
		$('.main-navbar .active').removeClass('show');
		$('.main-header-menu .active').removeClass('show');
	}
	$('.main-header .dropdown > a').on('click', function(e) {
		e.preventDefault();
		$(this).parent().toggleClass('show');
		$(this).parent().siblings().removeClass('show');
	});
	$('.mobile-main-header .dropdown > a').on('click', function(e) {
		e.preventDefault();
		$(this).parent().toggleClass('show');
		$(this).parent().siblings().removeClass('show');
	});
	$('.main-navbar .with-sub').on('click', function(e) {
		e.preventDefault();
		$(this).parent().toggleClass('show');
		$(this).parent().siblings().removeClass('show');
	});
	$('.dropdown-menu .main-header-arrow').on('click', function(e) {
		e.preventDefault();
		$(this).closest('.dropdown').removeClass('show');
	});
	$('#mainNavShow, #azNavbarShow').on('click', function(e) {
		e.preventDefault();
		$('body').addClass('main-navbar-show');
	});
	$('#mainContentLeftShow').on('click touch', function(e) {
		e.preventDefault();
		$('body').addClass('main-content-left-show');
	});
	$('#mainContentLeftHide').on('click touch', function(e) {
		e.preventDefault();
		$('body').removeClass('main-content-left-show');
	});
	$('#mainContentBodyHide').on('click touch', function(e) {
		e.preventDefault();
		$('body').removeClass('main-content-body-show');
	})
	$('body').append('<div class="main-navbar-backdrop"></div>');
	$('.main-navbar-backdrop').on('click touchstart', function() {
		$('body').removeClass('main-navbar-show');
	});
	
	// ______________Dropdown menu
	$(document).on('click touchstart', function(e) {
		e.stopPropagation();
		var dropTarg = $(e.target).closest('.main-header .dropdown').length;
		if (!dropTarg) {
			$('.main-header .dropdown').removeClass('show');
		}
		if (window.matchMedia('(min-width: 992px)').matches) {
			var navTarg = $(e.target).closest('.main-navbar .nav-item').length;
			if (!navTarg) {
				$('.main-navbar .show').removeClass('show');
			}
			var menuTarg = $(e.target).closest('.main-header-menu .nav-item').length;
			if (!menuTarg) {
				$('.main-header-menu .show').removeClass('show');
			}
			if ($(e.target).hasClass('main-menu-sub-mega')) {
				$('.main-header-menu .show').removeClass('show');
			}
		} else {
			if (!$(e.target).closest('#mainMenuShow').length) {
				var hm = $(e.target).closest('.main-header-menu').length;
				if (!hm) {
					$('body').removeClass('main-header-menu-show');
				}
			}
		}
	});
	
	// ______________MainMenuShow
	$('#mainMenuShow').on('click', function(e) {
		e.preventDefault();
		$('body').toggleClass('main-header-menu-show');
	})
	$('.main-header-menu .with-sub').on('click', function(e) {
		e.preventDefault();
		$(this).parent().toggleClass('show');
		$(this).parent().siblings().removeClass('show');
	})
	$('.main-header-menu-header .close').on('click', function(e) {
		e.preventDefault();
		$('body').removeClass('main-header-menu-show');
	})
	
	// ______________Tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// ______________Toast
	$(".toast").toast();
	
	// ______________Back-top-button
	$(window).on("scroll", function(e) {
		if ($(this).scrollTop() > 0) {
			$('#back-to-top').fadeIn('slow');
		} else {
			$('#back-to-top').fadeOut('slow');
		}
	});
	$(document).on("click", "#back-to-top", function(e) {
		$("html, body").animate({
			scrollTop: 0
		}, 600);
		return false;
	});
	
	// ______________Full screen
	$(document).on("click", ".fullscreen-button", function toggleFullScreen() {
		$('html').addClass('fullscreen');
		if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
			if (document.documentElement.requestFullScreen) {
				document.documentElement.requestFullScreen();
			} else if (document.documentElement.mozRequestFullScreen) {
				document.documentElement.mozRequestFullScreen();
			} else if (document.documentElement.webkitRequestFullScreen) {
				document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
			} else if (document.documentElement.msRequestFullscreen) {
				document.documentElement.msRequestFullscreen();
			}
		} else {
			$('html').removeClass('fullscreen');
			if (document.cancelFullScreen) {
				document.cancelFullScreen();
			} else if (document.mozCancelFullScreen) {
				document.mozCancelFullScreen();
			} else if (document.webkitCancelFullScreen) {
				document.webkitCancelFullScreen();
			} else if (document.msExitFullscreen) {
				document.msExitFullscreen();
			}
		}
	})
	
	// ______________Cover Image
	$(".cover-image").each(function() {
		var attr = $(this).attr('data-image-src');
		if (typeof attr !== typeof undefined && attr !== false) {
			$(this).css('background', 'url(' + attr + ') center center');
		}
	});
	
	
	// ______________Select2-Search
	$('.select2-no-search').select2({
		minimumResultsForSearch: Infinity,
		placeholder: 'All categories',
		width: '100%'
	});

	//document.querySelector('body').style.zoom = `${1 / window.devicePixelRatio * (100)}%`;
	//console.log(`${1 / window.devicePixelRatio * (100)}%`);

	// ______________Horizontal-menu Active Class
	function addActiveClass(element) {
		if (current === "") {
		  if (element.attr('href').indexOf("#") !== -1) {
			element.parents('.main-navbar .nav-item').last().addClass('active');
			if (element.parents('.main-navbar .nav-sub').length) {
			  element.parents('.main-navbar .nav-sub-item').last().addClass('active');
			}
		  }
		} else {
			if (element.attr('href').indexOf(current) !== -1) {
				element.parents('.main-navbar .nav-item').last().addClass('active');
				if (element.parents('.main-navbar .nav-sub').length) {
				   element.parents('.main-navbar .nav-sub-item').last().addClass('active');
				}
			}
		}
	}

	if($('#login').length){
		$(document).on('keypress',function(e) {
			if(e.which == 13) {
				$('#login').click();
			}
		});

		$('#login').on('click', function(){
			var username = $('input[name=username]').val();
			var password = $('input[name=password]').val();
			var errorContainer = $('#error-container');

			if(username.length == 0 || password.length == 0){
				errorContainer.find("strong").text("Enter the required fields to continue.");
				errorContainer.show();
				setTimeout(hideErrorContainer, 6000);
			}else{
				$.ajax({
					method: 'POST',
					url: 'users/login',
					data: { username: username, password: password }
				})
					.done(function( data ) {
						var result = JSON.parse(data);

						if(result.response == true){
							location.reload();
						}else{
							errorContainer.find("strong").text(result.message);
							errorContainer.show();
							setTimeout(hideErrorContainer, 6000);
						}
					});
			}
		});
	}


	function hideErrorContainer(){
		var errorContainer = $('#error-container');
		errorContainer.find().text("");
		errorContainer.hide();
	}

	if ( $("#table-logs").length ) {
		$('#table-logs').DataTable({
			language: {
				searchPlaceholder: 'Search...',
				sSearch: '',
				lengthMenu: '_MENU_ items/page',
			},
			order: [[0, 'desc']]
		});
	}

	if ( $("#table-shelters-by-year").length ) {
		$('#table-shelters-by-year').DataTable({
			language: {
				searchPlaceholder: 'Search...',
				sSearch: '',
				lengthMenu: '_MENU_ items/page',
			},
			order: [[1, 'asc']]
		});
	}

	
	
	// ______________ SWITCHER-toggle ______________//
	
	/*Theme Layouts*/
	//$('body').addClass('theme-style');
	//$('body').addClass('light-theme');
	//$('body').addClass('dark-theme');

	/*Header Styles*/
	//$('body').addClass('color-header');
	//$('body').addClass('header-dark');
	
	/*Horizontal-menu Styles*/
	//$('body').addClass('light-horizontal');
	//$('body').addClass('color-horizontal');
	
	/*Left-menu Styles*/
	//$('body').addClass('light-leftmenu');
	//$('body').addClass('color-leftmenu');
	
	/*Leftmenu Icon-Style*/
	//$('body').addClass('icon-style');



});
