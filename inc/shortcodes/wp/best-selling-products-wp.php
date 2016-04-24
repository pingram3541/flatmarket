<?php

// Shortcode [best_selling_products_wp]

function shortcode_best_selling_products_wp($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => '',
		'per_page'  => '10',
		'columns' =>'5'
	), $atts));
	ob_start();

 
	if ($title != '') {
		echo '<h2 class="sc_title">' . $title . '</h2>';
	}
	echo do_shortcode('[best_selling_products per_page="'.$per_page.'" columns="'.$columns.'"]');

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("best_selling_products_wp", "shortcode_best_selling_products_wp");