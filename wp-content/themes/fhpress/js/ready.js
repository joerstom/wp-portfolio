// add general-use js/jquery here
// anything within the ready function can safely access jQuery via $
jQuery(document).ready(function($) {


	// bxslider call
	/* $('.slideshow').bxSlider({
		pager: false,
		prevSelector: '.slideshow-nav.prev',
		nextSelector: '.slideshow-nav.next'
	}); */
	
	// equal height columns
	$.fn.setAllToMaxHeight = function(){
		return this.height( Math.max.apply(this, $.map( this , function(e){ return $(e).height() }) ) );
	}
	
	$('.pull-down .main-navigation .toggle').bind('click', function(e) {
		e.preventDefault();
		$('.site').toggleClass('nav-open');
		console.log('nav-open');
	});
	
	

	// DOM manipulation 
	/* set your main breakpoint. this is generally
	   the same value as the media query that
	   activates the grid in style.css - default: 800 */
	var breakpoint = 800;
	var winwidth = $(this).width();
	var	winheight = $(this).height();
	
	$(window).on('scroll', function() {
		if(winwidth > breakpoint){
    	var scrollPosition = $(this).scrollTop();
    	var bgPosition = -(( scrollPosition * 0.4 ) + (winheight * 0.1 ));
		if (scrollPosition >= 0 || scrollPosition <= winheight) {
    	     $('.home .header .bg').css({
		    	 top:bgPosition
	    	 });
	    	 console.log(bgPosition);
    	} else {
	    	 $('.home .header .bg').css({
		    	 top:0
	    	 })
    	}
    	}
	});
	
	// load and resizeEnd - put anything here that needs the resizeEnd function
	$(window).bind('load', function() {
			
		console.log("loaded");

		switch( true ){
			case( winwidth > breakpoint ):
				// do wider screen stuffs
				console.log( 'widescreen' );
				$('.equalheight').setAllToMaxHeight();
			break;
			default:
				//do mobile stuffs by default
				console.log( 'mobile/default' );
			break;
		}
	});
	
	$(window).bind('resizeEnd', function() {
			
		console.log("resized");

		switch( true ){
			case( winwidth > breakpoint ):
				// do wider screen stuffs
				console.log( 'widescreen' );
				$('.equalheight').setAllToMaxHeight();
			break;
			default:
				//do mobile stuffs by default
				console.log( 'mobile/default' );
			break;
		}
	});

	// responsive videos - maintains aspect ratio on load and resize for fluid videos
	var	$allVideos = $("iframe[src^='http://www.youtube.com']"),
		$fluidEl = $("body");

	// Figure out and save aspect ratio for each video
	$allVideos.each(function() {
		$(this)
			.data('aspectRatio', this.height / this.width)
			.removeAttr('height')
			.removeAttr('width');
	});

	// When the window is resized
	$(window).resize(function() {
		var newWidth = $fluidEl.width();

		// Resize all videos according to their own aspect ratio
		$allVideos.each(function() {
			var $el = $(this);
			$el.width(newWidth)
				.height(newWidth * $el.data('aspectRatio'));
		});

	// Kick off one resize to fix all videos on page load
	}).resize();



	/* wow! much konami! very code! */
	var kkeys = [], konami = "38,38,40,40,37,39,37,39,66,65";
	$(document).keydown(function(e) {
		kkeys.push( e.keyCode );
		if ( kkeys.toString().indexOf( konami ) >= 0 ){
			$(document).unbind('keydown',arguments.callee);
			console.log( '30 lives!!' );
		}
	});
	
	
});