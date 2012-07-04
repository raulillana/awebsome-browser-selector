<?php
/*
	Plugin Name: Awebsome! Browser Selector
	Plugin URI: http://plugins.awebsome.com
	Description: Empower your CSS selectors. Write specific CSS code for each OS/Browser the right way.
	Version: 1.0
	Author: Capt. WordPress - Awebsome! <cpt.wp@awebsome.com>
	Author URI: http://awebsome.com/services/wordpress
	License: GPLv2
	Credits: This is a WordPress plugin port from PHP CSS Browser Selector of Bastian Allgeier (http://bastian-allgeier.de/css_browser_selector) ported from Rafael Lima's original Javascript CSS Browser Selector (http://rafael.adm.br/css_browser_selector)
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
	elseif( strstr($ua, 'iphone') )	$b[] = 'iphone';
	elseif( strstr($ua, 'ipod') )		$b[] = 'ipod';		
	elseif( strstr($ua, 'mac') )		$b[] = 'mac';
	elseif( strstr($ua, 'darwin') )	$b[] = 'mac';
	elseif( strstr($ua, 'webtv') )	$b[] = 'webtv';
	elseif( strstr($ua, 'win') )		$b[] = 'win';
	elseif( strstr($ua, 'freebsd') )	$b[] = 'freebsd';
	elseif( strstr($ua, 'x11') || 
			  strstr($ua, 'linux') )	$b[] = 'linux';
	
	// browsers
	if( !preg_match('/opera|webtv/i', $ua) 
		&& preg_match('/msie\s(\d)/', $ua, $array) )	$b[] = 'ie ie' . $array[1];
	elseif( strstr($ua, 'firefox/2') )					$b[] = $g . ' ff2';
	elseif( strstr($ua, 'firefox/3.5') )				$b[] = $g . ' ff3 ff3_5';
	elseif( strstr($ua, 'firefox/3') )					$b[] = $g . ' ff3';
	elseif( strstr($ua, 'firefox/3') )					$b[] = $g . ' ff4';
	elseif( strstr($ua, 'firefox/3') )					$b[] = $g . ' ff5';
	elseif( strstr($ua, 'gecko/') )						$b[] = $g;
	elseif( preg_match('/opera(\s|\/)(\d+)/', 
				$ua, $array) )									$b[] = 'opera opera' . $array[2];
	elseif( strstr($ua, 'konqueror') )					$b[] = 'konqueror';
	elseif( strstr($ua, 'chrome') )						$b[] = $w . ' ' . $s . ' chrome';
	elseif( strstr($ua, 'iron') )							$b[] = $w . ' ' . $s . ' iron';
	elseif( strstr($ua, 'applewebkit/') )				$b[] = (preg_match('/version\/(\d+)/i', $ua, $array)) ? 
																				$w . ' ' . $s . ' ' . $s . $array[1] : 
																				$w . ' ' . $s;
	elseif( strstr($ua, 'mozilla/') )					$b[] = $g;
	
	return join(' ', $b);
}

// Add filter hook
add_filter('body_class','awebsome_browsel_class_names');

?>