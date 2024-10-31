<?php
/*
Plugin Name: qrcode_hoerandl
Plugin URI: http://www.hoerandl.com/blog/item/qr-code-wordpress-shortcode-plugin
Version: 1.0
Author: Günther Hörandl
Author URI: http://www.hoerandl.com/
Description: Shortcode to generate customised QR-Codes
*/

/*
How to use:

Simple (to get an QR-Code contents the current URL):
  [qrcode_hoerandl]
  
Customised:
[qrcode_hoerandl content="Hello World!" color="000000" bgcolor="FFFFFF" size="100" margin="1" align="right" class="image" alt="QR-Code"]

more Info on http://www.hoerandl.com/blog/item/wordpress-qrcode
*/


/* Shortcode function */
  function qrcode_hoerandl_shortcode($atts) {
    extract(shortcode_atts(array(
	  'content' => '',
    'color' => '000000',
	  'bgcolor' => 'FFFFFF',
	  'size' => '200',
	  'margin' => '1',
	  'align' => '',
	  'class' => '',
	  'alt' => 'QR-Code',
    ), $atts));
	
	$current_uri = 'http://'.$_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI].'';
	
	if ($content=="") {
	  $content = urlencode($current_uri);
	} else {
	  $content = urlencode(strip_tags(trim($content)));
	}
	
	if ($color=="") {
	  $color="000000";
	} else {
	  $color = strip_tags(trim($color));
	}
	
	if ($bgcolor=="") {
	  $bgcolor = "FFFFFF";
	} else {
	  $bgcolor = strip_tags(trim($bgcolor));
	}
	
	if ($size=="") {
	  $size = "200";
	} else {
	  $size = strip_tags(trim($size));
	}
	
	if ($margin=="") {
	  $margin = "1";
	} else {
	  $margin = strip_tags(trim($margin));
	}
	
	if ($align!="") {
	  $align = strip_tags(trim($align));
	}
	
	if ($class!="") {
	  $class = strip_tags(trim($class));
	}
	
	if ($alt=="") {
	  $alt="QR-Code";
	} else {
	  $alt = strip_tags(trim($alt));
	}
	
    $output = "";
	$image = 'http://api.qrserver.com/v1/create-qr-code/?data='.$content.'&size='.$size.'x'.$size.'&color='.$color.'&bgcolor='.$bgcolor.'&margin='.$margin;
    if ($align=="right") { $align = ' align="right"'; }
    if ($align=="left") { $align = ' align="left"'; }
    if ($class!="") { $class = ' class="'.$class.'"'; }
	
	$output = '<img src="'.$image.'" alt="'.$alt.'" width="'.$size.'" height="'.$size.'"'.$align.$class.' />';
	
    return $output;
  }

/* Add Shortcode */
  add_shortcode('qrcode_hoerandl', 'qrcode_hoerandl_shortcode');

?>