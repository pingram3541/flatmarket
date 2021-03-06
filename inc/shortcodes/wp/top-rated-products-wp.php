<?php

// Shortcode [top_rated_products_wp]
function shortcode_top_rated_products_wp($atts, $content = null) {
	extract(shortcode_atts(array(
		'title' => '',
		'per_page'  => '10',
        'orderby' => 'date',
        'order' => 'desc',
		'columns' => '5'
	), $atts));
	ob_start();

	if ($title != '') {
		echo '<h2 class="sc_title">' . $title . '</h2>';
	}
	echo do_shortcode('[top_rated_products per_page="'.$per_page.'" columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'"]');

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("top_rated_products_wp", "shortcode_top_rated_products_wp");