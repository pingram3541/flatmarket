<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

global $theme_options;

if ( ! empty( $tabs ) ) : ?>
	<div class="woocommerce-tabs  wc-tabs-wrapper">
		<ul class="tabs wc-tabs">

			<?php foreach ( $tabs as $key => $tab ) : ?>

				<li class="<?php echo $key ?>_tab">
					<a href="#tab-<?php echo $key ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
				</li>

			<?php endforeach; ?>

 <?php if(isset($theme_options['shop_product_custom_tab_enable']) && $theme_options['shop_product_custom_tab_enable']): ?>
				<li class="product_custom_tab">
					<a href="#tab-product_custom"><?php echo $theme_options['shop_product_custom_tab_title']; ?></a>
				</li> 
 <?php endif; ?>

		</ul>
		<?php foreach ( $tabs as $key => $tab ) : ?>

			<div class="panel entry-content wc-tab" id="tab-<?php echo $key ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ) ?>
			</div>

		<?php endforeach; ?>
 <?php if(isset($theme_options['shop_product_custom_tab_enable']) && $theme_options['shop_product_custom_tab_enable']): ?>
			<div class="panel entry-content" id="tab-product_custom">
				<?php echo $theme_options['shop_product_custom_tab_text']; ?>
			</div>
 <?php endif; ?>
	</div>

<?php endif; ?>