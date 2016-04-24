<?php
/**
 * Load custom VC shortcodes
 */
if (class_exists('WPBakeryVisualComposerAbstract')) {

	// VC Templates
	$vc_templates_dir = get_template_directory() . '/shortcodes/visual-composer/vc_templates/';
	vc_set_template_dir($vc_templates_dir);
	
	// Add new Shop shortcodes to VC
	if (class_exists('WooCommerce')) {
		include_once('shortcodes/visual-composer/woo-recent-products.php');
		include_once('shortcodes/visual-composer/woo-featured-products.php');
		include_once('shortcodes/visual-composer/woo-products-by-category.php');
		include_once('shortcodes/visual-composer/woo-products-by-attribute.php');
		include_once('shortcodes/visual-composer/woo-product-by-id-sku.php');
		include_once('shortcodes/visual-composer/woo-products-by-ids-skus.php');
		include_once('shortcodes/visual-composer/woo-sale-products.php');
		include_once('shortcodes/visual-composer/woo-top-rated-products.php');
		include_once('shortcodes/visual-composer/woo-best-selling-products.php');
		include_once('shortcodes/visual-composer/woo-product-categories.php');
	}

	include_once('shortcodes/visual-composer/mmm-menu.php');

}

include_once('shortcodes/wp/recent-products-wp.php');
include_once('shortcodes/wp/featured-products-wp.php');
include_once('shortcodes/wp/sale-products-wp.php');
include_once('shortcodes/wp/best-selling-products-wp.php');
include_once('shortcodes/wp/products-by-category-wp.php');
include_once('shortcodes/wp/products-wp.php');
include_once('shortcodes/wp/products-by-attribute-wp.php');
include_once('shortcodes/wp/top-rated-products-wp.php');
include_once('shortcodes/wp/mmm-menu-wp.php');

?>