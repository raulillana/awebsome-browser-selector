# Awebsome! Browser Selector  
Contributors: raulillana  
Tags: awebsome, browser, selector, specific, CSS  
Requires at least: 3.0  
Tested up to: 3.4.1  
Stable tag: trunk  
License: GPLv2  
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=G442YSKBRKTJ2  

**Empower your CSS selectors!**  
Write specific CSS code for each OS/Browser the right way.

## Description  
Modifies the body tag classes adding some OS/Browser codes, so you can add quick and clean CSS patches.

### Based in  
* [PHP CSS Browser Selector](http://bastian-allgeier.de/css_browser_selector "PHP CSS Browser Selector") from [Bastian Allgeier](http://bastian-allgeier.de "Bastian Allgeier")
* [JS CSS Browser Selector](http://rafael.adm.br/css_browser_selector) from [Rafael Lima](http://rafael.adm.br "Rafael Lima")

### Available OS Codes  
* **win** - Microsoft Windows (all versions)
* **vista** - Microsoft Windows Vista
* **linux** - x11 and Linux distros
* **mac** - MacOS
* **freebsd** - FreeBSD
* **mobile** - All mobile devices
* **android** - Google Android
* **iphone** - iPhone
* **ipod** - iPod Touch
* **ipad** - iPad
* **webtv** - WebTV
* **j2me** - J2ME Devices (like Opera mini)
* **blackberry** - Blackberry

### Available Browser Codes  
* **ie** - Internet Explorer (All Versions)
* **ie5** - Internet Explorer 5.x
* **ie6** - Internet Explorer 6.x
* **ie7** - Internet Explorer 7.x
* **ie8** - Internet Explorer 8.x
* **ie9** - Internet Explorer 9.x
* **gecko** - Mozilla, Firefox (All Versions), Camino
* **ff2** - Firefox 2
* **ff3** - Firefox 3
* **ff3_5** - Firefox 3.5
* **ff3_6** - Firefox 3.6
* **ff4** - Firefox 4
* **ff5** - Firefox 5
* **opera** - Opera (All Versions)
* **opera8** - Opera 8.x
* **opera9** - Opera 9.x
* **opera10** - Opera 10.x
* **webkit** - Safari, NetNewsWire, OmniWeb, Shiira, Google Chrome
* **safari** - Safari, NetNewsWire, OmniWeb, Shiira, Google Chrome
* **safari3** - Safari 3.x
* **chrome** - Google Chrome
* **konqueror** - Konqueror
* **iron** - SRWare Iron

## Installation  

Go easy!  
Upload, activate and enjoy developing.

## Frequently Asked Questions

### Where should I write my CSS specific code?  
At the end of your theme CSS file will be fine.

### How can I apply a patch for specific OS/Browser?  
1. Filtering by OS: `.mac`
1. Filtering by Browser: `.opera`
1. Filtering by OS and Browser: `.win.ie7`

  .OS.Browser #element .class { display:block; }

So, this way you can apply CSS3 patches seamlessly...

	/* fallback/image non-cover color & fallback image & W3C Markup */  
	#element { background-color: #1a82f7; background-image: url(images/fallback-gradient.png); background-image: linear-gradient(to bottom, #FFFFFF 0%, #00A3EF 100%); }
	
	/* Safari 4+, Chrome 1-9 & Safari 5.1+, Mobile Safari, Chrome 10+ */  
	.webkit #element { background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#2F2727), to(#1a82f7)); background-image: -webkit-linear-gradient(top, #2F2727, #1a82f7); }
	
	/* Firefox 3.6+ */  
	.gecko #element { background-image: -moz-linear-gradient(top, #2F2727, #1a82f7); }
	
	/* Opera 11.10+ */  
	.opera #element { background-image: -o-linear-gradient(top, #2F2727, #1a82f7); }
	
	/* IE 10+ & IE7+ */  
	.ie #element { background-image: -ms-linear-gradient(top, #2F2727, #1a82f7); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#2F2727', endColorstr='#1a82f7', gradientType='0'); }

## Changelog

### Future Release  
Revamped code using WP API's and OOPHP.  
Codes managing UI.

### 1.1  
Updated readme.txt.  
Fixed BuddyPress support (kudos [@landwire](http://profiles.wordpress.org/landwire/ "@landwire")!).  
Fixed caching bug for WP Super Cache and W3 Total Cache incompatibility (kudos [@jrevillini] (http://profiles.wordpress.org/jrevillini/ "@jrevillini")!).  

### 1.0.1  
Updated descriptions.

### 1.0  
Born with basic functionality and docs.

## Upgrade Notice

### 1.1  
BuddyPress and cache plugin issues fixed. Update required!

### 1.0.1  
Updated descriptions. No Update required!