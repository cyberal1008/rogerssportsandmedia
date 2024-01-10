( function( $ ) {

	// Determine the correct object to use
	var notification = window.Notification || window.mozNotification || window.webkitNotification;

	// The user needs to allow this
	if (typeof notification.permission !== "undefined") {
		if (notification.permission != 'granted') {
			notification.requestPermission(function(permission){});
		}
	} 
	    
	// A function handler
	function Notify(titleText, bodyText)
	{

		if ('undefined' === typeof notification) {
	    	alert(titleText + " " + bodyText);
	        return;       //Not supported....
	    }

	    if (typeof notification.permission !== "undefined") {
			if (notification.permission != 'granted') {
				alert(titleText + " " + bodyText);
				return;
			}
		}
	    
	    var noty = new notification(
	        titleText, {
	            body: bodyText,
	            dir: 'auto', // or ltr, rtl
	            lang: 'EN', //lang used within the notification.
	            tag: 'notificationPopup', //An element ID to get/set the content
	            icon: 'http://goodlogo.com/images/logos/small/rogers_logo_3324.gif' //The URL of an image to be used as an icon
	        }
	    );
	    noty.onclick = function () {
	        console.log('notification.Click');
	    };
	    noty.onerror = function () {
	        console.log('notification.Error');
	    };
	    noty.onshow = function () {
	        console.log('notification.Show');
	    };
	    noty.onclose = function () {
	        console.log('notification.Close');
	    };
	    return true;
	}


	$(document).on('click', '.debug_bar_flush_cache a', function(){

		var nonce = $('#_wpnonce_debug_bar_console_flush').val();
		console.log("sdfds", nonce);
		$.get( ajaxurl, {
			action: 'debug_bar_console_flush',
			nonce:  nonce
		}, function( rdata ) {
			console.log("rdata", rdata);
			if (typeof rdata.success === "undefined"){
				Notify('Flush failed','Could not flush the cache');
				return;
			} 

			Notify('Flush Complete','Successfully flushed the cache');

		});
		return false;
	});

} )( jQuery );