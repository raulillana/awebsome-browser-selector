/**
 * AJAX Helper to fetch body classes on cached pages
 * 
 * Kudos to @jrevillini [@jrevillini](http://profiles.wordpress.org/jrevillini/
 **/
jQuery(function($){$.get(AwebsomeBrowserSelector.ajaxurl,{action:'awebsome-browsel'},function(response){$('body').addClass(response);});});