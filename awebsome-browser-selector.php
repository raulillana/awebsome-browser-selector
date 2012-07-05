<?php
/*
	Plugin Name: Awebsome! Browser Selector
	Plugin URI: http://plugins.awebsome.com
	Description: Empower your CSS selectors. Write specific CSS code for each OS/Browser the right way.
	Version: 1.2
	Author: Raul Illana <r@awebsome.com>
	Author URI: http://raulillana.com
	License: GPLv2
*/

/**
 * Add specific CSS classes to body tag by filter
 * 
 * @uses awebsome_browsel_filter_UA for parsing UA classes
 * @return array CSS classes for body tag
 * 
 * @since 1.0
 */
function awebsome_browsel_class_names( $classes )
{
	$classes[] = awebsome_browsel_filter_UA();
	
	return $classes;
}

/**
 * Parses the User Agent (UA)
 * 
 * @param $ua string Server User Agent
 * @return string CSS classes for specific OS/Browser
 * 
 * @since 1.0
 */
function awebsome_browsel_filter_UA( $ua=null )
{
	$ua = ($ua) ? strtolower($ua) : strtolower($_SERVER['HTTP_USER_AGENT']);		
	$g  = 'gecko';
	$w  = 'webkit';
	$s  = 'safari';
	$b  = array();
	
	// platforms (SO)			
	if( strstr($ua, 'j2me') )			$b[] = 'mobile';
	elseif( strstr($ua, 'iphone') )		$b[] = 'iphone';
	elseif( strstr($ua, 'ipod') )		$b[] = 'ipod';		
	elseif( strstr($ua, 'mac') )		$b[] = 'mac';
	elseif( strstr($ua, 'darwin') )		$b[] = 'mac';
	elseif( strstr($ua, 'webtv') )		$b[] = 'webtv';
	elseif( strstr($ua, 'win') )		$b[] = 'win';
	elseif( strstr($ua, 'freebsd') )	$b[] = 'freebsd';
	elseif( strstr($ua, 'x11') || 
			strstr($ua, 'linux') )		$b[] = 'linux';
	
	// browsers
	if( !preg_match('/opera|webtv/i', $ua) 
		&& preg_match('/msie\s(\d)/', $ua, $array) )			$b[] = 'ie ie' . $array[1];
	elseif( strstr($ua, 'firefox/2') )							$b[] = $g . ' ff2';
	elseif( strstr($ua, 'firefox/3.5') )						$b[] = $g . ' ff3 ff3_5';
	elseif( strstr($ua, 'firefox/3') )							$b[] = $g . ' ff3';
	elseif( strstr($ua, 'firefox/3') )							$b[] = $g . ' ff4';
	elseif( strstr($ua, 'firefox/3') )							$b[] = $g . ' ff5';
	elseif( strstr($ua, 'gecko/') )								$b[] = $g;
	elseif( preg_match('/opera(\s|\/)(\d+)/', $ua, $array) )	$b[] = 'opera opera' . $array[2];
	elseif( strstr($ua, 'konqueror') )							$b[] = 'konqueror';
	elseif( strstr($ua, 'chrome') )								$b[] = $w . ' ' . $s . ' chrome';
	elseif( strstr($ua, 'iron') )								$b[] = $w . ' ' . $s . ' iron';
	elseif( strstr($ua, 'applewebkit/') )						$b[] = (preg_match('/version\/(\d+)/i', $ua, $array)) ? 
																		$w . ' ' . $s . ' ' . $s . $array[1] : 
																		$w . ' ' . $s;
	elseif( strstr($ua, 'mozilla/') )							$b[] = $g;
	
	return join(' ', $b);
}

/**
 * Starts the plugin on init
 * 
 * @since 1.2
 */
function awebsome_init_check_cache()
{
	include_once(ABSPATH .'wp-admin/includes/plugin.php');
	
	$res = false;
	$bp = 'buddypress/buddypress.php';
	$plugins = array(
		'wp-super-cache/wp-cache.php',
		'w3-total-cache/w3-total-cache.php'
	);
	
	foreach( $plugins as $plugin ) if( !is_plugin_active($plugin) ) $res == true;
	
	// caching is disabled
	if( $res )
	{
		add_filter('body_class','awebsome_browsel_class_names');
		if( is_plugin_active($bp) ) add_filter('bp_get_the_body_class','awebsome_browsel_class_names'); // BuddyPress support!
	}
	else // caching is enabled - add browser classes using AJAX calls
	{
		add_action('init', 'enqueue_awebsome_browsel_scripts'); // this does the ajax request
			
		// allow both logged in and not logged in users to send this AJAX request
		add_action('wp_ajax_nopriv_awebsome-browsel', 'awebsome_browsel_ajax');
		add_action('wp_ajax_awebsome-browsel', 'awebsome_browsel_ajax');
	}
}
add_action('init', 'awebsome_init_check_cache');

/**
 * Wrapper function for the AJAX call
 * 
 * @since 1.1
 */
function awebsome_browsel_ajax()
{
	print awebsome_browsel_filter_UA();
	exit();
}

/**
 * Inits AJAX scripts
 * 
 * @since 1.1
 */
function enqueue_awebsome_browsel_scripts()
{
	$ajaxurl = admin_url('admin-ajax.php');
	$ajaxurl = array_filter(explode('/', $ajaxurl));
	array_shift($ajaxurl);
	array_shift($ajaxurl);
	$ajaxurl = '/'. implode('/',$ajaxurl);
	
	wp_enqueue_script('awebsome_browsel-ajax', plugin_dir_url(__FILE__) .'js/helper-ajax.js', array('jquery'));
	wp_localize_script('awebsome_browsel-ajax', 'AwebsomeBrowserSelector', array('ajaxurl' => $ajaxurl));
}

/**
 * Prints scripts
 * 
 * @since 1.1
 */
function print_awebsome_browsel_scripts()
{
	wp_print_scripts('awebsome_browsel');
}

?>