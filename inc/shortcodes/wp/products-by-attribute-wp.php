<?php

// Shortcode [products_by_attribute_wp]
function shortcode_products_by_attribute_wp($atts, $content = null) {
	extract(shortcode_atts(array(
		'title' => '',
		'attribute' => '',
		'filter' => '',
		'per_page'  => '10',
        'orderby' => 'date',
        'order' => 'desc',
		'columns' => '5'
	), $atts));
	ob_start();

	if ($title != '') {
		echo '<h2 class="sc_title">' . $title . '</h2>';
	}
	echo do_shortcode('[product_attribute attribute="'.$attribute.'" filter="'.$filter.'" per_page="'.$per_page.'" columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'"]');

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("products_by_attribute_wp", "shortcode_products_by_attribute_wp");