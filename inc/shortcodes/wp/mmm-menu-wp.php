<?php

// Shortcode [mmm_menu_wp]
function shortcode_mmm_menu_wp($atts, $content = null) {
	extract(shortcode_atts(array(
		'menu_location' => 'left'
	), $atts));
	ob_start();

	echo wp_nav_menu( array( "theme_location" => $menu_location ) );

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("mmm_menu_wp", "shortcode_mmm_menu_wp");