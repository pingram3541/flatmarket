<?php

// Shortcode [products_wp]
function shortcode_products_wp($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => '',
        'orderby' => 'date',
        'order' => 'desc',
		'ids' => '',
		'columns' => '5'
	), $atts));
	ob_start();

	if ($title != '') {
		echo '<h2 class="sc_title">' . $title . '</h2>';
	}
	echo do_shortcode('[products orderby="'.$orderby.'" columns="'.$columns.'" order="'.$order.'" ids="'.$ids.'"]');

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("products_wp", "shortcode_products_wp");