// JavaScript Document for Grepfrut
jQuery(document).ready(function($) {

	// Use strict 
	"use strict";
	
	//Tooltip
	$('body').popover({
		selector: '[data-toggle="popover"]'
	});
	$('body').tooltip({
		selector: 'a[rel="tooltip"], [data-toggle="tooltip"]'
	});
 
	//Smooth menu for grepfrut
	ddsmoothmenu.init({
		mainmenuid: "smoothmenu", //menu DIV id
		orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
		classname: 'ddsmoothmenu', //class added to menu's outer DIV
		contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
	})
	
	// Dropdown nav for responsive
	selectnav('nav', {
		label: '',
		nested: true,
		indent: '-'
	});
	
	// Fitvids
	$(".video-wrapper").fitVids();
	
	//Thumbnail hover effect for portfolio
	$('.folio-thumb').hover(function () {
		$(this).find(".icon-zoom-img, .icon-link-img, .icon-zoom-only").fadeTo("fast", 1);
	}, function () {
		$(this).find(".icon-zoom-img, .icon-link-img, .icon-zoom-only").fadeTo("fast", 0);
	});

	// Isotope - Portfolio 	
	$(function(){	
		var $container = $('.filter-content');
		$container.imagesLoaded(function () {
			$container.isotope({
				itemSelector: '.isotope-item',
				layoutMode : 'fitRows',
				//  masonry: {}
			});
		});
		$('.filter_nav li a').click(function () {
			$('.filter_nav li a').removeClass('active');
			$(this).addClass('active');
			var selector = $(this).attr('data-filter');
			$container.isotope({
				filter: selector
			});
			return false;
		});
	});
	
		
	// Isotope - Search
	$(function(){	
		var $container_search = $('.mssearch-content');
		$container_search.imagesLoaded(function () {
			$container_search.isotope({
				itemSelector: '.mssearch-item',
				// layoutMode : 'fitRows',
				 masonry: {}
			});
		});
	});

	//prettyPhoto
	$('a[data-rel]').each(function () {
		$(this).attr('rel', $(this).data('rel'));
	});
	$("a[rel^='prettyPhoto'],a[rel^='prettyPhoto[gallery]']").prettyPhoto({
		animation_speed: 'fast',
		slideshow: 5000,
		autoplay_slideshow: false,
		opacity: 0.80,
		show_title: false,
		theme: 'pp_default',
		/* light_rounded / dark_rounded / light_square / dark_square / facebook */
		overlay_gallery: false,
		social_tools: false,
		changepicturecallback: function () {
			var $pp = $('.pp_default');
			if (parseInt($pp.css('left')) < 0) {
				$pp.css('left', 0);
			}
		}
	});

	// Owl carousel for recent posts
	$(".recentpost-carousel").owlCarousel({
		transitionStyle : false, // fade, backSlide, goDown
		navigation: false, // Show next and prev buttons
		navigationText : false,
		pagination: true,
		slideSpeed: 300,
    	paginationSpeed: 400,
    	items: 3, // Increase this if need more than 3 items
 	 // itemsDesktop : false,
 	 // itemsDesktopSmall : false,
 	 // itemsTablet: false,
 	 // itemsMobile : false,
	 	theme: 'tcsn-theme',
	});
	
	// Owl carousel for portfolio
	$(".portfolio-carousel").owlCarousel({
		transitionStyle : false, // fade, backSlide, goDown
		navigation: true, // Show next and prev buttons
		navigationText : false,
		pagination: false,
	 	slideSpeed: 300,
		paginationSpeed: 400,
		items: 3, // Increase this if need more than 2 items
	 // itemsDesktop : false,
	 // itemsDesktopSmall : false,
     // itemsTablet: false,
     // itemsMobile : false,
	 	theme: 'tcsn-theme',
	});

	// Elastislide carousel (for backward compatibility)
	$('.es-carousel').each(function(){
		$(this).elastislide( {
			imageW: 300,
			margin: 20,
			border: 0,
			easing: ''
		});
	})
}); // Close document ready

