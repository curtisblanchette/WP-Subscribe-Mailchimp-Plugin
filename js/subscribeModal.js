jQuery(document).ready(function($) {
	// A enhancement of Jack Moore's modal technique
	// http://www.jacklmoore.com/notes/jquery-modal-tutorial/
	// Author: Curtis Blanchette
	// AuthorURI: http://www.blanchettedesigns.com
	
	var modal = (function(){
		var method = {},
			$modal,
			$content,
			$close;

		// add the blur transition class to the page content
		$('#thmlvContent').addClass('transition-blur');

		//center the modal
		method.center = function () {
		    var top, left;

		    top = Math.max($(window).height() - $modal.outerHeight(), 0) / 2;
		    left = Math.max($(window).width() - $modal.outerWidth(), 0) / 2;

		    $modal.css({
		        top:top + $(window).scrollTop(), 
		        left:left + $(window).scrollLeft(),
		        height: $(window).height()
		    });

		};

		//open the Modal
		method.open = function(settings) {
			$content.empty().append(settings.content);
			$modal.css({
				width: settings.width || '100%',
				height: settings.height || '100%'
			});
			$modal.css('top', '0');

			method.center();
			$(window).bind('resize.modal', method.center);

			$('#thmlvContent').addClass('blur');
			$('.subscribeToggle').css('opacity', 0);
			disable_scroll();
		};

		//close the modal 
		method.close = function() {
			$modal.css('top', '-100%');
			//$content.empty();
			$(window).unbind('resize.modal');
			$('#thmlvContent').removeClass('blur');
			$('.subscribeToggle').css('opacity', 1);
			enable_scroll();
			
		};

		//append the HTML
		$modal = $('<div id="subscribeContainer"></div>');
		$content = $('<div id="subscribeContent"></div>');
		$close = $('<a id="closeModal" href="#"><i class="fa fa-close"></i></a>');

		$modal.append($content, $close);

		$(document).ready(function(){
			$('body').append($modal);						
		});
		$close.click(function(e) {
			e.preventDefault();
			method.close();
		});

		return method;
	}());
	
	var $var_1 = curts_vars.setting_1,
		$var_2 = curts_vars.setting_2;

	var $subHeader = "<h1 class='subscribe-head'>" + $var_1 + "</h1>",
		$subBody = "<p class='subscribe-body'>" + $var_2 + "</p>",
		$subForm = "<form class='subscribe-form' id='subscribe' name='mc-embedded-subscribe-form' action='"+self.location.href+"' method='get'><span id='response'><? require_once('mailchimp-api/inc/store-address.php'); if($_GET['submit']){ echo storeAddress(); } ?></span><input type='email' id='email' name='email' style='width:75%; margin-right:5%;' placeholder='Email Address' name='email'/><input name='submit' type='submit' style='width:20%;' value='Subscribe'/></form>";

	$('.subscribeToggle').click(function(e){
		modal.open({content: $subHeader + $subBody + $subForm});
		e.preventDefault();
		
		//only ajax if the form exists in the modal(which happens when the form is appended on toggle)
		$('#subscribe').submit(function(e) {
			// update user interface
			e.preventDefault();
			$('#response').html('Adding email address...');
			
			// Prepare query string and send AJAX request
			$.ajax({
				url: 'wp-content/plugins/curts-modal-overlay/mailchimp-api/inc/store-address.php',
				data: 'ajax=true&email=' + escape($('#email').val()),
				success: function(msg) {
					$('#response').html(msg);
				}
			});
		
			return false;
		});

	});

	// Helper functions to disable scrolling
	// left: 37, up: 38, right: 39, down: 40,
	// spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
	var keys = [37, 38, 39, 40];

	function preventDefault(e) {
	  e = e || window.event;
	  if (e.preventDefault) {
	      e.preventDefault();
	  }
	  e.returnValue = false;  
	}

	function keydown(e) {
	    for (var i = keys.length; i--;) {
	        if (e.keyCode === keys[i]) {
	            preventDefault(e);
	            return;
	        }
	    }
	}

	function wheel(e) {
	  preventDefault(e);
	}

	function disable_scroll() {
	  if (window.addEventListener) {
	      window.addEventListener('DOMMouseScroll', wheel, false);
	  }
	  window.onmousewheel = document.onmousewheel = wheel;
	  document.onkeydown = keydown;
	}

	function enable_scroll() {
	    if (window.removeEventListener) {
	        window.removeEventListener('DOMMouseScroll', wheel, false);
	    }
	    window.onmousewheel = document.onmousewheel = document.onkeydown = null;  
	}

});
