<?php

	add_action( 'wp_enqueue_scripts', 'mg_enqueue_styles', '999' );

	function mg_enqueue_styles( ) {
		// remove later
		global $theme_options;

		if ( function_exists( 'is_multisite' ) && is_multisite() ){
			$cache_file_name = 'cache.skin.b' . get_current_blog_id();
		} else {
			$cache_file_name = 'cache.skin';
		}

        $ipanel_saved_date = get_option( 'ipanel_saved_date', 1 );
        $cache_saved_date = get_option( 'cache_css_saved_date', 0 );

		if( file_exists( get_stylesheet_directory() . '/cache/' . $cache_file_name . '.css' ) ) {
			$cache_status = 'exist';

            if($ipanel_saved_date > $cache_saved_date) {
                $cache_status = 'no-exist';
            }

		} else {
			$cache_status = 'no-exist';
		}

        if ( defined('DEMO_MODE') ) {
            $cache_status = 'no-exist';
        }

		if ( $cache_status == 'exist' ) {

			wp_register_style( $cache_file_name, get_stylesheet_directory_uri() . '/cache/' . $cache_file_name . '.css', array(), $cache_saved_date);
			wp_enqueue_style( $cache_file_name );

		} else {
			
			$out = '';

			$generated = microtime(true);

			$out = mg_get_css();
	
			$out = str_replace( array( "\t", "
", "\n", "  ", "   ", ), array( "", "", " ", " ", " ", ), $out );

			$out .= '/* CSS Generator Execution Time: ' . floatval( ( microtime(true) - $generated ) ) . ' seconds */';

			$cache_file = @fopen( get_stylesheet_directory() . '/cache/' . $cache_file_name . '.css', 'w' );

			if ( @fwrite( $cache_file, $out ) ) {
			
				wp_register_style( $cache_file_name, get_stylesheet_directory_uri() . '/cache/' . $cache_file_name . '.css', array(), $cache_saved_date);
				wp_enqueue_style( $cache_file_name );

                // Update save options date
                $option_name = 'cache_css_saved_date';
                
                $new_value = microtime(true) ;

                if ( get_option( $option_name ) !== false ) {

                    // The option already exists, so we just update it.
                    update_option( $option_name, $new_value );

                } else {

                    // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
                    $deprecated = null;
                    $autoload = 'no';
                    add_option( $option_name, $new_value, $deprecated, $autoload );
                }
			}
		
		}
	}

	function mg_get_css () {
		global $theme_options;
		// ===
		ob_start();
    ?>

    <?php if(isset($theme_options['shop_secondimage_onhover']) && $theme_options['shop_secondimage_onhover']): ?>
    .product-item-box .flip-container:hover .flipper {
        transform: rotateY(180deg);
        -webkit-transform: rotateY(180deg);
    }
    <?php endif; ?>
    <?php if(isset($theme_options['woocommerce_show_cat_search']) && !$theme_options['woocommerce_show_cat_search']): ?>
    .search-bar .yith-ajaxsearchform-container .select2-container {
        display: none;
    }
    <?php endif; ?>
    <?php if(isset($theme_options['header_logo_center']) && $theme_options['header_logo_center']): ?>
        header .col-md-6 {
            padding-left: 0;
            padding-right: 0;
            width: 100%;
        }
        header .col-md-6:nth-child(2) {
            display: none;
        }
        header .logo {
            display: table;
            float: none;
            margin: 30px auto;
        }
        header .logo-info-text {
            display: none;
        }
        .shopping-cart {
            display: none;
        }
    <?php endif; ?>
    <?php if(isset($theme_options['megamenu_strip']) && $theme_options['megamenu_strip']): ?>
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li:nth-child(2n+1) {
        background: rgba(0,0,0,0.08);
    }
    <?php endif; ?>
    <?php if(isset($theme_options['enable_parallax']) && $theme_options['enable_parallax']): ?>
        .fullwidth-section.parallax {
            background-attachment: fixed;
        }
    <?php endif; ?>
    <?php if(isset($theme_options['shop_show_more_enable']) && $theme_options['shop_show_more_enable']): ?>
    .woocommerce .products ul, .woocommerce ul.products, .woocommerce-page .products ul, .woocommerce-page ul.products {
        margin-left: 0;
        margin-right: 0;
    }
    .products-module .woocommerce ul.products li.product {
        border:0!important;
        margin-left: 12px;
        margin-right: 13px;
    }
    .products-module .woocommerce ul.products li.product:hover {
        border:0;
    }
    .products-module .woocommerce-page.columns-5 ul.products li.product, 
    .products-module .woocommerce.columns-5 ul.products li.product {
        width: auto;
    }
    .products-module .woocommerce ul.products li.first, 
    .products-module .woocommerce-page ul.products li.first {
        clear: none;
        float: none;
    }
    .products-module .woocommerce ul.products li, 
    .products-module .woocommerce-page ul.products li {
        clear: none;
        float: none;
    }
    .products-module .woocommerce ul.products li.product {
        padding-bottom: 0;
    }
    .products-module .woocommerce ul.products li.product, 
    .products-module .woocommerce-page ul.products li.product  {
        margin-bottom: 0;
    }
    .products-module .woocommerce:not(.compare-button) {
        margin-left: -12px;
        margin-right: -13px;
    }
    .products-module .woocommerce:not(.compare-button) {
        height: 0;
        overflow: hidden;
    }
    .products-module .woocommerce .products ul, .products-module .woocommerce ul.products, .products-module .woocommerce-page .products ul, .products-module .woocommerce-page ul.products {
        margin-bottom: 0;
    }

    <?php endif; ?>
    <?php if(isset($theme_options['shop_catalog_mode_enable']) && $theme_options['shop_catalog_mode_enable']): ?>
    .anim_add_to_cart_button,
    .single_add_to_cart_button, 
    .quantity,
    .link-checkout,
    .add_to_cart {
        display: none!important;
    }
    <?php endif; ?>

    <?php if(isset($theme_options['shop_hide_wishlist']) && $theme_options['shop_hide_wishlist']): ?>
    .yith-wcwl-add-to-wishlist,
    .link-wishlist {
        display: none!important;
    }
    <?php endif; ?>

    <?php if(isset($theme_options['shop_hide_compare']) && $theme_options['shop_hide_compare']): ?>
    .woocommerce .shop-product .summary .compare.button,
    .woocommerce .product-item-box .product-buttons .compare-button {
        display: none!important;
    }
    <?php endif; ?>

    <?php if(isset($theme_options['shop_hide_qv']) && $theme_options['shop_hide_qv']): ?>
    .woocommerce .product-item-box .jckqvBtn {
        display: none!important;
    }

    <?php endif; ?>
    
    <?php if(isset($theme_options['shop_products_per_row'])) { 

        $product_per_row = $theme_options['shop_products_per_row'];

    } else { 

        $product_per_row = 5; 
    } 
    if ( isset( $_GET['product_per_row'] ) ) {
        $product_per_row = intval($_GET['product_per_row']);
    }
    
    if($product_per_row == 5) {
        $woo_catalog_product_width = 20;
    }
    if($product_per_row == 4) {
        $woo_catalog_product_width = 25;
    }
    if($product_per_row == 3) {
        $woo_catalog_product_width = 33.3333;
    }
    if($product_per_row == 2) {
        $woo_catalog_product_width = 50;
    }
    ?>
    .woocommerce ul.products li.product, .woocommerce-page ul.products li.productб
    .woocommerce .col-md-9 ul.products li.product, 
    .woocommerce-page .col-md-9 ul.products li.product {
        width: <?php echo $woo_catalog_product_width; ?>%;
    }

    /**
    * Custom CSS
    **/
    <?php if(isset($theme_options['custom_css_code'])) { echo $theme_options['custom_css_code']; } ?>
    
    
    /** 
    * Theme Google Font
    **/
    
    h1, h2, h3, h4, h5, h6,
    .woocommerce ul.products li.product .price,
    .flatmarket-button a,
    .shop-content .entry-summary .price,
    #jckqv h1,
    #jckqv .price,
    .simple.single_add_to_cart_button,
    .woocommerce .shop-product .summary .anim_add_to_cart_button .text {
        font-family: '<?php echo str_replace("+"," ", $theme_options['header_font']['font-family']); ?>';
    }
    h1 {
        font-size: <?php echo $theme_options['header_font']['font-size']; ?>px;
    }
    body {
        font-family: '<?php echo str_replace("+"," ", $theme_options['body_font']['font-family']); ?>';
        font-size: <?php echo $theme_options['body_font']['font-size']; ?>px;
    }
    /**
    * Colors and color skins
    */
    <?php
    if(!isset($theme_options['color_skin_name'])) {
        $color_skin_name = 'none';
    }
    else {
        $color_skin_name = $theme_options['color_skin_name'];
    }
    // Use panel settings
    if($color_skin_name == 'none') {

        $theme_body_color = $theme_options['theme_body_color'];
        $theme_text_color = $theme_options['theme_text_color'];
        $theme_links_color = $theme_options['theme_links_color'];
        $theme_links_hover_color = $theme_options['theme_links_hover_color'];
        $theme_main_color = $theme_options['theme_main_color'];
        $theme_hover_color = $theme_options['theme_hover_color'];
        $theme_header_bg_color = $theme_options['theme_header_bg_color'];
        $theme_header_link_color = $theme_options['theme_header_link_color'];
        $theme_cat_menu_bg_color = $theme_options['theme_cat_menu_bg_color'];
        $theme_cat_menu_link_color = $theme_options['theme_cat_menu_link_color'];
        $theme_cat_submenu_1lvl_bg_color = $theme_options['theme_cat_submenu_1lvl_bg_color'];
        $theme_cat_submenu_1lvl_link_color = $theme_options['theme_cat_submenu_1lvl_link_color'];
        $theme_product_background_color = $theme_options['theme_product_background_color'];
        $theme_footer_color = $theme_options['theme_footer_color'];
        $theme_footer_link_color = $theme_options['theme_footer_link_color'];
        $theme_footer_header_color = $theme_options['theme_footer_header_color'];
        $theme_footer_text_color = $theme_options['theme_footer_text_color'];
        $theme_title_color = $theme_options['theme_title_color'];
        $theme_widget_title_color = $theme_options['theme_widget_title_color'];
        $theme_productpage_border_color = $theme_options['theme_productpage_border_color'];
        $theme_content_bg_color = $theme_options['theme_content_bg_color'];
        $theme_carticon_bg_color = $theme_options['theme_carticon_bg_color'];
        $theme_cartcounter_bg_color = $theme_options['theme_cartcounter_bg_color'];
        $theme_productbuttons_hover_color = $theme_options['theme_productbuttons_hover_color'];
        $theme_copyfooter_bg_color = $theme_options['theme_copyfooter_bg_color'];
        $theme_salebadge_bg_color = $theme_options['theme_salebadge_bg_color'];

    }
    // Default skin
    if($color_skin_name == 'default') {
        
        $theme_body_color = '#ffffff';
        $theme_text_color = '#393232';
        $theme_links_color = '#000000';
        $theme_links_hover_color = '#008c8d';
        $theme_main_color = '#008c8d';
        $theme_hover_color = '#535353';
        $theme_header_bg_color = '#eef0f0';
        $theme_header_link_color = '#868686';
        $theme_cat_menu_bg_color = '#535353';
        $theme_cat_menu_link_color = '#ffffff';
        $theme_cat_submenu_1lvl_bg_color = '#f8f8f8';
        $theme_cat_submenu_1lvl_link_color = '#000000';
        $theme_product_background_color = '#535353';
        $theme_footer_color = '#2f2e2e';
        $theme_footer_link_color = '#ffffff';
        $theme_footer_header_color = '#ffffff';
        $theme_footer_text_color = '#ffffff';
        $theme_title_color = '#252727';
        $theme_widget_title_color = '#252727';
        $theme_productpage_border_color = '#e8e5e5';
        $theme_content_bg_color = '#F8F8F8';
        $theme_carticon_bg_color = '#00AFB3';
        $theme_cartcounter_bg_color = '#FFC32C';
        $theme_productbuttons_hover_color = '#afe0e1';
        $theme_copyfooter_bg_color = '#181818';
        $theme_salebadge_bg_color = '#f64f57';

    }
    // Green skin
    if($color_skin_name == 'green') {
        
        $theme_body_color = '#ffffff';
        $theme_text_color = '#393232';
        $theme_links_color = '#2ba86e';
        $theme_links_hover_color = '#00BC8F';
        $theme_main_color = '#00BC8F';
        $theme_hover_color = '#535353';
        $theme_header_bg_color = '#eef0f0';
        $theme_header_link_color = '#868686';
        $theme_cat_menu_bg_color = '#069e78';
        $theme_cat_menu_link_color = '#ffffff';
        $theme_cat_submenu_1lvl_bg_color = '#f8f8f8';
        $theme_cat_submenu_1lvl_link_color = '#000000';
        $theme_product_background_color = '#069e78';
        $theme_footer_color = '#2f2e2e';
        $theme_footer_link_color = '#ffffff';
        $theme_footer_header_color = '#ffffff';
        $theme_footer_text_color = '#ffffff';
        $theme_title_color = '#252727';
        $theme_widget_title_color = '#252727';
        $theme_productpage_border_color = '#e8e5e5';
        $theme_content_bg_color = '#F8F8F8';
        $theme_carticon_bg_color = '#069e78';
        $theme_cartcounter_bg_color = '#FFC32C';
        $theme_productbuttons_hover_color = '#14ddad';
        $theme_copyfooter_bg_color = '#181818';
        $theme_salebadge_bg_color = '#f64f57';
    }
    // Blue skin
    if($color_skin_name == 'blue') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#393232';
        $theme_links_color = '#617F9B';
        $theme_links_hover_color = '#4b6a85';
        $theme_main_color = '#617F9B';
        $theme_hover_color = '#57728a';
        $theme_header_bg_color = '#eef0f0';
        $theme_header_link_color = '#57728a';
        $theme_cat_menu_bg_color = '#57728a';
        $theme_cat_menu_link_color = '#ffffff';
        $theme_cat_submenu_1lvl_bg_color = '#f8f8f8';
        $theme_cat_submenu_1lvl_link_color = '#000000';
        $theme_product_background_color = '#57728a';
        $theme_footer_color = '#617F9B';
        $theme_footer_link_color = '#ffffff';
        $theme_footer_header_color = '#ffffff';
        $theme_footer_text_color = '#ffffff';
        $theme_title_color = '#252727';
        $theme_widget_title_color = '#252727';
        $theme_productpage_border_color = '#e8e5e5';
        $theme_content_bg_color = '#F8F8F8';
        $theme_carticon_bg_color = '#57728a';
        $theme_cartcounter_bg_color = '#FFC32C';
        $theme_productbuttons_hover_color = '#9fbbd5';
        $theme_copyfooter_bg_color = '#57728a';
        $theme_salebadge_bg_color = '#f64f57';

    }
    // Red skin
    if($color_skin_name == 'red') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#393232';
        $theme_links_color = '#e33039';
        $theme_links_hover_color = '#e86f75';
        $theme_main_color = '#e86f75';
        $theme_hover_color = '#d13a42';
        $theme_header_bg_color = '#eef0f0';
        $theme_header_link_color = '#868686';
        $theme_cat_menu_bg_color = '#e33039';
        $theme_cat_menu_link_color = '#ffffff';
        $theme_cat_submenu_1lvl_bg_color = '#f8f8f8';
        $theme_cat_submenu_1lvl_link_color = '#000000';
        $theme_product_background_color = '#535353';
        $theme_footer_color = '#2f2e2e';
        $theme_footer_link_color = '#ffffff';
        $theme_footer_header_color = '#ffffff';
        $theme_footer_text_color = '#ffffff';
        $theme_title_color = '#252727';
        $theme_widget_title_color = '#252727';
        $theme_productpage_border_color = '#e8e5e5';
        $theme_content_bg_color = '#F8F8F8';
        $theme_carticon_bg_color = '#e33039';
        $theme_cartcounter_bg_color = '#FFC32C';
        $theme_productbuttons_hover_color = '#fec4c4';
        $theme_copyfooter_bg_color = '#181818';
        $theme_salebadge_bg_color = '#f64f57';

    }
    // Black skin
    if($color_skin_name == 'black') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#393232';
        $theme_links_color = '#000000';
        $theme_links_hover_color = '#cacaca';
        $theme_main_color = '#535353';
        $theme_hover_color = '#000000';
        $theme_header_bg_color = '#eef0f0';
        $theme_header_link_color = '#868686';
        $theme_cat_menu_bg_color = '#000000';
        $theme_cat_menu_link_color = '#ffffff';
        $theme_cat_submenu_1lvl_bg_color = '#f8f8f8';
        $theme_cat_submenu_1lvl_link_color = '#000000';
        $theme_product_background_color = '#000000';
        $theme_footer_color = '#F8F8F8';
        $theme_footer_link_color = '#535353';
        $theme_footer_header_color = '#000000';
        $theme_footer_text_color = '#535353';
        $theme_title_color = '#252727';
        $theme_widget_title_color = '#252727';
        $theme_productpage_border_color = '#e8e5e5';
        $theme_content_bg_color = '#F8F8F8';
        $theme_carticon_bg_color = '#000000';
        $theme_cartcounter_bg_color = '#FFC32C';
        $theme_productbuttons_hover_color = '#cacaca';
        $theme_copyfooter_bg_color = '#535353';
        $theme_salebadge_bg_color = '#f64f57';

    }

    // Pink/Violet skin
    if($color_skin_name == 'pink') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#393232';
        $theme_links_color = '#000000';
        $theme_links_hover_color = '#f098d2';
        $theme_main_color = '#ed6cc1';
        $theme_hover_color = '#f098d2';
        $theme_header_bg_color = '#eef0f0';
        $theme_header_link_color = '#868686';
        $theme_cat_menu_bg_color = '#f098d2';
        $theme_cat_menu_link_color = '#ffffff';
        $theme_cat_submenu_1lvl_bg_color = '#f8f8f8';
        $theme_cat_submenu_1lvl_link_color = '#000000';
        $theme_product_background_color = '#e066b6';
        $theme_footer_color = '#F8F8F8';
        $theme_footer_link_color = '#535353';
        $theme_footer_header_color = '#000000';
        $theme_footer_text_color = '#535353';
        $theme_title_color = '#252727';
        $theme_widget_title_color = '#252727';
        $theme_productpage_border_color = '#e8e5e5';
        $theme_content_bg_color = '#F8F8F8';
        $theme_carticon_bg_color = '#f098d2';
        $theme_cartcounter_bg_color = '#FFC32C';
        $theme_productbuttons_hover_color = '#fea0f0';
        $theme_copyfooter_bg_color = '#181818';
        $theme_salebadge_bg_color = '#f64f57';

    }

    // Orange skin
    if($color_skin_name == 'orange') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#393232';
        $theme_links_color = '#000000';
        $theme_links_hover_color = '#fac170';
        $theme_main_color = '#faa732';
        $theme_hover_color = '#fac170';
        $theme_header_bg_color = '#eef0f0';
        $theme_header_link_color = '#868686';
        $theme_cat_menu_bg_color = '#fac170';
        $theme_cat_menu_link_color = '#ffffff';
        $theme_cat_submenu_1lvl_bg_color = '#f8f8f8';
        $theme_cat_submenu_1lvl_link_color = '#000000';
        $theme_product_background_color = '#fac170';
        $theme_footer_color = '#2f2e2e';
        $theme_footer_link_color = '#ffffff';
        $theme_footer_header_color = '#ffffff';
        $theme_footer_text_color = '#ffffff';
        $theme_title_color = '#252727';
        $theme_widget_title_color = '#252727';
        $theme_productpage_border_color = '#e8e5e5';
        $theme_content_bg_color = '#F8F8F8';
        $theme_carticon_bg_color = '#fac170';
        $theme_cartcounter_bg_color = '#FFC32C';
        $theme_productbuttons_hover_color = '#fbddb4';
        $theme_copyfooter_bg_color = '#181818';
        $theme_salebadge_bg_color = '#f64f57';

    }
    // Fencer skin
    if($color_skin_name == 'fencer') {
        
        $theme_body_color = '#ffffff';
        $theme_text_color = '#393232';
        $theme_links_color = '#26cdb3';
        $theme_links_hover_color = '#000000';
        $theme_main_color = '#26cdb3';
        $theme_hover_color = '#232b33';
        $theme_header_bg_color = '#eef0f0';
        $theme_header_link_color = '#868686';
        $theme_cat_menu_bg_color = '#232b33';
        $theme_cat_menu_link_color = '#ffffff';
        $theme_cat_submenu_1lvl_bg_color = '#f8f8f8';
        $theme_cat_submenu_1lvl_link_color = '#000000';
        $theme_product_background_color = '#232b33';
        $theme_footer_color = '#2d363a';
        $theme_footer_link_color = '#ffffff';
        $theme_footer_header_color = '#26cdb3';
        $theme_footer_text_color = '#a3a8a9';
        $theme_title_color = '#252727';
        $theme_widget_title_color = '#252727';
        $theme_productpage_border_color = '#e8e5e5';
        $theme_content_bg_color = '#F8F8F8';
        $theme_carticon_bg_color = '#232b33';
        $theme_cartcounter_bg_color = '#FFC32C';
        $theme_productbuttons_hover_color = '#afe0e1';
        $theme_copyfooter_bg_color = '#3c4448';
        $theme_salebadge_bg_color = '#f64f57';

        ?>
     
        <?php
    }
    // Perfectum skin
    if($color_skin_name == 'perfectum') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#393232';
        $theme_links_color = '#F2532F';
        $theme_links_hover_color = '#000000';
        $theme_main_color = '#F2532F';
        $theme_hover_color = '#000000';
        $theme_header_bg_color = '#eef0f0';
        $theme_header_link_color = '#868686';
        $theme_cat_menu_bg_color = '#000000';
        $theme_cat_menu_link_color = '#ffffff';
        $theme_cat_submenu_1lvl_bg_color = '#f8f8f8';
        $theme_cat_submenu_1lvl_link_color = '#000000';
        $theme_product_background_color = '#000000';
        $theme_footer_color = '#FAFAFA';
        $theme_footer_link_color = '#F2532F';
        $theme_footer_header_color = '#000000';
        $theme_footer_text_color = '#000000';
        $theme_title_color = '#252727';
        $theme_widget_title_color = '#252727';
        $theme_productpage_border_color = '#e8e5e5';
        $theme_content_bg_color = '#F8F8F8';
        $theme_carticon_bg_color = '#000000';
        $theme_cartcounter_bg_color = '#FFC32C';
        $theme_productbuttons_hover_color = '#fdc7bb';
        $theme_copyfooter_bg_color = '#ffffff';
        $theme_salebadge_bg_color = '#f64f57';
        ?>

        <?php

    }
    // Simplegreat skin
    if($color_skin_name == 'simplegreat') {
        
        $theme_body_color = '#ffffff';
        $theme_text_color = '#393232';
        $theme_links_color = '#C3A36B';
        $theme_links_hover_color = '#000000';
        $theme_main_color = '#C3A36B';
        $theme_hover_color = '#3D4445';
        $theme_header_bg_color = '#eef0f0';
        $theme_header_link_color = '#868686';
        $theme_cat_menu_bg_color = '#4A5456';
        $theme_cat_menu_link_color = '#ffffff';
        $theme_cat_submenu_1lvl_bg_color = '#f8f8f8';
        $theme_cat_submenu_1lvl_link_color = '#000000';
        $theme_product_background_color = '#4A5456';
        $theme_footer_color = '#4A5456';
        $theme_footer_link_color = '#a3a8a9';
        $theme_footer_header_color = '#ffffff';
        $theme_footer_text_color = '#ffffff';
        $theme_title_color = '#252727';
        $theme_widget_title_color = '#252727';
        $theme_productpage_border_color = '#e8e5e5';
        $theme_content_bg_color = '#F8F8F8';
        $theme_carticon_bg_color = '#3D4445';
        $theme_cartcounter_bg_color = '#EEF0F0';
        $theme_productbuttons_hover_color = '#fffae5';
        $theme_copyfooter_bg_color = '#363b3c';
        $theme_salebadge_bg_color = '#f64f57';

        ?>

        <?php
    }



    ?>
    body {
        background-color: <?php echo $theme_body_color; ?>;
        color: <?php echo $theme_text_color; ?>;
    }
    a.btn,
    .btn,
    .btn:focus,
    input[type="submit"],
    .btn-primary,
    .btn-primary:focus,
    .shopping-cart .shopping-cart-title,
    .shopping-cart .view-cart,
    #navbar .navbar-toggle,
    .nav .sub-menu li a:hover,
    .nav .children li a:hover,
    .blog-post .more-link,
    .widget_custom_box_right #custom_box_icon,
    #top-link,
    .navigation-paging a:hover,
    .sidebar .widget_product_categories .current-cat > a,
    .sidebar .widget_nav_menu .current-menu-item > a,
    .sidebar .widget_product_categories a:hover,
    .sidebar .widget_product_categories .children a:hover,
    .sidebar .widget_pages ul li a:hover,
    .sidebar .widget_meta ul li a:hover,
    .sidebar .widget_nav_menu a:hover,
    .content-block .widget_archive ul li:hover,
    .woocommerce-page .widget_archive ul li:hover,
    .woocommerce-page .widget_categories > ul > li:hover,
    .content-block .widget_categories > ul > li:hover,
    .woocommerce .widget_layered_nav ul li:hover,
    .woocommerce-page .widget_layered_nav ul li:hover,
    .woocommerce #content input.button,
    .woocommerce #respond input#submit,
    .woocommerce a.button,
    .woocommerce button.button,
    .woocommerce input.button,
    .woocommerce-page #content input.button,
    .woocommerce-page #respond input#submit,
    .woocommerce-page a.button,
    .woocommerce-page button.button,
    .woocommerce-page input.button,
    .woocommerce a.added_to_cart,
    .woocommerce-page a.added_to_cart,
    .woocommerce a.add_to_cart_button,
    .woocommerce #content input.button.alt:hover,
    .woocommerce #respond input#submit.alt:hover,
    .woocommerce a.button.alt:hover,
    .woocommerce button.button.alt:hover,
    .woocommerce input.button.alt:hover,
    .woocommerce-page #content input.button.alt:hover,
    .woocommerce-page #respond input#submit.alt:hover,
    .woocommerce-page a.button.alt:hover,
    .woocommerce-page button.button.alt:hover,
    .woocommerce-page input.button.alt:hover,
    .woocommerce .product-item-box a.add_to_cart_button,
    .woocommerce .product-item-box a.product_type_simple:not(.add_to_cart_button),
    .woocommerce .product-item-box a.product_type_grouped,
    .woocommerce .product-item-box .product-buttons .yith-wcwl-wishlistexistsbrowse a,
    .woocommerce .product-item-box .product-buttons .yith-wcwl-wishlistaddedbrowse a,
    .woocommerce .shop-product .summary .yith-wcwl-wishlistexistsbrowse a,
    .woocommerce .shop-product .summary .yith-wcwl-wishlistaddedbrowse a,
    .woocommerce .product-item-box .product-buttons .yith-wcwl-add-button a,
    .woocommerce .shop-product .summary .yith-wcwl-add-button a,
    .woocommerce .shop-product .summary .yith-wcwl-wishlistexistsbrowse a,
    .woocommerce .shop-product .summary .yith-wcwl-wishlistaddedbrowse a,
    .woocommerce .product-item-box .product-buttons .compare-button a,
    .woocommerce .shop-product .summary .compare.button,
    #jckqv_summary .simple.single_add_to_cart_button,
    .woocommerce .shop-product .summary .cart button:hover,
    .woocommerce .quantity .minus,
    .woocommerce .quantity .plus,
    .woocommerce div.product .woocommerce-tabs ul.tabs li:not(.active):hover,
    .woocommerce #content div.product .woocommerce-tabs ul.tabs li:not(.active):hover,
    .woocommerce-page div.product .woocommerce-tabs ul.tabs li:not(.active):hover,
    .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li:not(.active):hover,
    .woocommerce #content nav.woocommerce-pagination ul li a:focus,
    .woocommerce #content nav.woocommerce-pagination ul li a:hover,
    .woocommerce #content nav.woocommerce-pagination ul li span.current,
    .woocommerce nav.woocommerce-pagination ul li a:focus,
    .woocommerce nav.woocommerce-pagination ul li a:hover,
    .woocommerce nav.woocommerce-pagination ul li span.current,
    .woocommerce-page #content nav.woocommerce-pagination ul li a:focus,
    .woocommerce-page #content nav.woocommerce-pagination ul li a:hover,
    .woocommerce-page #content nav.woocommerce-pagination ul li span.current,
    .woocommerce-page nav.woocommerce-pagination ul li a:focus,
    .woocommerce-page nav.woocommerce-pagination ul li a:hover,
    .woocommerce-page nav.woocommerce-pagination ul li span.current,
    .flatmarket-button a,
    #jckqv .button:hover,
    .woocommerce .product-item-box a.add_to_cart_button:hover,
    .woocommerce .product-item-box a.product_type_simple:not(.add_to_cart_button):hover,
    .woocommerce .product-item-box a.product_type_grouped:hover,
    .navbar .nav > li > a:hover,
    body .select2-results .select2-highlighted,
    .shopping-cart .shopping-cart-icon:hover,
    .woocommerce .product-item-box .product-buttons,
    .homepage .vc_call_to_action .vc_btn {
        background-color: <?php echo $theme_main_color; ?>;
    }
    .btn:hover,
    input[type="submit"]:hover,
    .btn:active,
    .btn-primary:hover,
    .btn-primary:active,
    .shopping-cart .view-cart:hover,
    #navbar .navbar-toggle:hover,
    .yith-wcwl-add-button a:hover,
    .blog-post .more-link:hover,
    .blog-post .format-quote blockquote,
    .products-module .bx-wrapper .bx-controls-direction a,
    .footer-container .line,
    #top-link:hover,
    .navigation-paging a,
    .sidebar .widget_calendar th,
    .sidebar .widget_calendar tfoot td,
    .sidebar .widget_product_categories a,
    .sidebar .widget_pages ul li a,
    .sidebar .widget_meta ul li a,
    .sidebar .widget_nav_menu a,
    .woocommerce .widget_layered_nav ul li.chosen a,
    .woocommerce-page .widget_layered_nav ul li.chosen a,
    .woocommerce .widget_layered_nav_filters ul li a,
    .woocommerce-page .widget_layered_nav_filters ul li a,
    .content-block .widget_archive ul li,
    .woocommerce-page .widget_archive ul li,
    .woocommerce-page .widget_categories ul li,
    .content-block .widget_categories ul li,
    .content-block .widget_layered_nav ul,
    .woocommerce-page .widget_layered_nav ul,
    .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
    .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle,
    .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
    .woocommerce-page .widget_price_filter .ui-slider .ui-slider-range,
    .woocommerce #content input.button.alt,
    .woocommerce #respond input#submit.alt,
    .woocommerce a.button.alt,
    .woocommerce button.button.alt,
    .woocommerce input.button.alt,
    .woocommerce-page #content input.button.alt,
    .woocommerce-page #respond input#submit.alt,
    .woocommerce-page a.button.alt,
    .woocommerce-page button.button.alt,
    .woocommerce-page input.button.alt,
    .woocommerce #content input.button:hover,
    .woocommerce #respond input#submit:hover,
    .woocommerce a.button:hover,
    .woocommerce button.button:hover,
    .woocommerce input.button:hover,
    .woocommerce-page #content input.button:hover,
    .woocommerce-page #respond input#submit:hover,
    .woocommerce-page a.button:hover,
    .woocommerce-page button.button:hover,
    .woocommerce-page input.button:hover,
    .woocommerce .product-item-box .jckqvBtn,
    .woocommerce .shop-product .summary .yith-wcwl-wishlistexistsbrowse a:hover,
    .woocommerce .shop-product .summary .yith-wcwl-wishlistaddedbrowse a:hover,
    .woocommerce .shop-product .summary .yith-wcwl-add-button a:hover,
    .woocommerce .shop-product .summary .compare.button:hover,
    #jckqv_summary .simple.single_add_to_cart_button:hover,
    .woocommerce .shop-product .summary .cart button,
    .woocommerce .quantity .plus:hover,
    .woocommerce .quantity .minus:hover,
    .woocommerce #content nav.woocommerce-pagination ul li,
    .woocommerce nav.woocommerce-pagination ul li,
    .woocommerce-page #content nav.woocommerce-pagination ul li,
    .woocommerce-page nav.woocommerce-pagination ul li,
    .flatmarket-button a:hover,
    .tp-leftarrow:hover,
    .tp-rightarrow:hover,
    .jckqvBtn:hover,
    #jckqv .button,
    .comment-meta .reply a,
    .search-bar #searchform #searchsubmit:hover,
    .products-module .wpb_content_element .wpb_tabs_nav li.ui-tabs-active,
    body .owl-theme .owl-controls .owl-buttons div,
    .mgwoocommercebrands.brands-slider > .owl-theme .owl-controls .owl-buttons div,
    .homepage .vc_call_to_action .vc_btn:hover {
        background-color: <?php echo $theme_hover_color; ?>;
    }
    .sidebar .widget_calendar tbody td a,
    .woocommerce .widget_layered_nav ul li.chosen a,
    .woocommerce-page .widget_layered_nav ul li.chosen a,
    .woocommerce .widget_layered_nav_filters ul li a,
    .woocommerce-page .widget_layered_nav_filters ul li a,
    blockquote {
        border-color: <?php echo $theme_hover_color; ?>;
    }
    .header-menu-bg {
        background-color: <?php echo $theme_header_bg_color; ?>;
    }
    .header-menu li a,
    .header-info-text {
        color: <?php echo $theme_header_link_color; ?>;
    }
    .navbar .container {
        background-color: <?php echo $theme_cat_menu_bg_color; ?>;
    }
    .navbar .nav > li > a {
        color: <?php echo $theme_cat_menu_link_color; ?>;
    }
    
    a,
    .sidebar .widget_product_categories .children a,
    .sidebar .widget_pages ul li li a,
    .sidebar .widget_nav_menu ul li li a,
    .woocommerce .woocommerce-breadcrumb a,
    .woocommerce ul.products li.product.product-category h3 {
        color: <?php echo $theme_links_color; ?>;
    }
    a:hover,
    a:focus,
    .homepage-latest-posts .post-title a:hover,
    .woocommerce .shop-product .summary .product_meta .post-social a:hover,
    .footer-social a:hover,
    .woocommerce .shop-product div.product .summary span.price,
    .woocommerce .shop-product div.product .summary p.price,
    .woocommerce .shop-product #content div.product .summary span.price,
    .woocommerce .shop-product  #content div.product .summary p.price,
    .woocommerce-page .shop-product div.product .summary span.price,
    .woocommerce-page .shop-product div.product .summary p.price,
    .woocommerce-page .shop-product #content div.product .summary span.price,
    .woocommerce-page .shop-product #content div.product .summary p.price,
    .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
    #jckqv .price ins,
    #jckqv .price,
    .container .tp-caption.testimonial-author,
    .wpml-lang #lang_sel ul ul a:hover,
    .woocommerce ul.products li.product.product-category h3:hover {
        color: <?php echo $theme_links_hover_color; ?>;
    }
    .widget_tag_cloud .tagcloud a:hover,
    .widget_product_tag_cloud .tagcloud a:hover {
        background-color: <?php echo $theme_links_hover_color; ?>;
    }
    .widget_tag_cloud .tagcloud a:hover,
    .widget_product_tag_cloud .tagcloud a:hover {
        border-color: <?php echo $theme_links_hover_color; ?>;
    }
    .header-menu li a,
    .wpml-lang #lang_sel a,
    .wpml-lang #lang_sel a:hover,
    .wpml-currency .wcml_currency_switcher .select2-choice {
        color: <?php echo $theme_header_link_color; ?>;
    }
    .navbar .nav > li > a {
        color: <?php echo $theme_cat_menu_link_color; ?>;
    }
    .nav .sub-menu li a, 
    .nav .children li a,
    .nav .sub-menu li li a, 
    .nav .children li li a {
        background-color: <?php echo $theme_cat_submenu_1lvl_bg_color; ?>;
    }
    .nav .sub-menu li a, 
    .nav .children li a {
        color: <?php echo $theme_cat_submenu_1lvl_link_color; ?>;
    }
    .woocommerce ul.products li.product .product-item-box {
        background-color: <?php echo $theme_product_background_color; ?>;
    }
    .footer-sidebar-2-wrapper {
        background-color: <?php echo $theme_footer_color; ?>;
    }
    .footer-container a,
    footer a {
        color: <?php echo $theme_footer_link_color; ?>;
    }
    .widget_tag_cloud .tagcloud a,
    .widget_product_tag_cloud .tagcloud a {
        border-color: <?php echo $theme_footer_link_color; ?>;
    }
    .footer-container h2.widgettitle {
        color: <?php echo $theme_footer_header_color; ?>;
    }
    .footer-container,
    footer {
        color: <?php echo $theme_footer_text_color; ?>;
    }
    .woocommerce .page-title,
    .page-item-title h1,
    #jckqv h1,
    .products-module h2,
    .wpb_heading.wpb_teaser_grid_heading {
        color: <?php echo $theme_title_color; ?>;
    }
    .sidebar .widgettitle,
    .woocommerce .upsells h2, .woocommerce .related h2 {
        color: <?php echo $theme_widget_title_color; ?>;
    }
    .post-social,
    .post-social a,
    .woocommerce .shop-product .summary .yith-wcwl-add-to-wishlist,
    .woocommerce .shop-product .summary .cart,
    .woocommerce .shop-product .short-description,
    body .select2-container .select2-choice,
    body .select2-drop-active,
    .wpml-lang #lang_sel ul ul,
    body .select2-results {
        border-color: <?php echo $theme_productpage_border_color; ?>;
    }
    .blog-post .post-content,
    .shopping-cart .shopping-cart-content,
    .homepage-latest-posts .isotope-inner,
    .author-bio,
    .widget_facebook_right .facebook_box,
    .widget_custom_box_right .custom_box,
    .sidebar .widget_calendar tbody td.pad,
    .sidebar .widget_calendar tfoot td.pad,
    .sidebar .widget_product_categories .children a,
    .sidebar .widget_pages ul li li a,
    .sidebar .widget_nav_menu ul li li a,
    .woocommerce-page div.product .woocommerce-tabs .panel,
    .woocommerce div.product .woocommerce-tabs ul.tabs li,
    .woocommerce #content div.product .woocommerce-tabs ul.tabs li,
    .woocommerce-page div.product .woocommerce-tabs ul.tabs li,
    .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li,
    .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
    .shop-content .entry-summary,
    .comment-body,
    body .select2-drop,
    .page article,
    .widget_twitter_right .twitter_box,
    .woocommerce .woocommerce-message, .woocommerce .woocommerce-error, .woocommerce .woocommerce-info, .woocommerce-page .woocommerce-message, .woocommerce-page .woocommerce-error, .woocommerce-page .woocommerce-info {
        background-color: <?php echo $theme_content_bg_color; ?>;
    }
    @media (max-width: 767px) {
        #menu-categories {
            background-color: <?php echo $theme_content_bg_color; ?>;
        }
        .navbar .nav .sub-menu li a:hover {
            color: <?php echo $theme_links_hover_color; ?>;;
        }
        .navbar .nav li a {
            color: <?php echo $theme_links_color; ?>;
        }
    }
    .shopping-cart .shopping-cart-icon {
        background-color: <?php echo $theme_carticon_bg_color; ?>;
    }
    .shopping-cart .shopping-cart-count {
        background-color: <?php echo $theme_cartcounter_bg_color; ?>;
    }
    .woocommerce .product-item-box a.add_to_cart_button:hover,
    .woocommerce .product-item-box a.product_type_simple:hover,
    .woocommerce .product-item-box a.product_type_grouped:hover,
    .woocommerce .product-item-box .product-buttons .yith-wcwl-wishlistexistsbrowse a:hover,
    .woocommerce .product-item-box .product-buttons .yith-wcwl-wishlistaddedbrowse a:hover,
    .woocommerce .product-item-box .product-buttons .yith-wcwl-add-button a:hover,
    .woocommerce .product-item-box .product-buttons .compare-button a:hover,
    .woocommerce .shop-product .summary .compare-button a:hover {
        color: <?php echo $theme_productbuttons_hover_color; ?>;
    }
    footer {
        background-color: <?php echo $theme_copyfooter_bg_color; ?>;
    }
    .woocommerce ul.products li.product .onsale, 
    .woocommerce-page ul.products li.product .onsale, 
    .woocommerce span.onsale, .woocommerce-page span.onsale,
    #jckqv .onsale,
    .woocommerce ul.products li.product .product-item-box .ob_warpper.ob_categories,
    .woocommerce .shop-product .ob_warpper.ob_product_detal .widget_product_detail { 
        background-color: <?php echo $theme_salebadge_bg_color; ?>;
    }
    <?php if(isset($theme_options['megamenu_override']) && $theme_options['megamenu_override']): ?>
    /* 
    *   Mega menu styles overrides
     */
    #mega_main_menu.primary > .menu_holder > .mmm_fullwidth_container {
        background: none;
    }
    #mega_main_menu.primary {
        min-height: 69px;
    }
    /* Reset - current/hover item */
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li:hover > .item_link, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link:hover, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link:focus, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-item > .item_link {
        background: none;
        color: <?php echo $theme_cat_menu_link_color; ?>;
    }
    /* Current top menu item */
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link *, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-item > .item_link * {
        color: <?php echo $theme_cat_menu_link_color; ?>;
    }
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-item {
        background-color: <?php echo $theme_main_color; ?>;
    }
    /* Hover top menu item text */
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li:hover > .item_link, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link:hover, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link:focus, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li:hover > .item_link *, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link * {
        color: <?php echo $theme_cat_menu_link_color; ?>;
    }
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li:not(.nav_search_box):hover {
        background-color: <?php echo $theme_main_color; ?>;
    }
    /* Menu items */
    #mega_main_menu.primary > .menu_holder > .menu_inner > .nav_logo > .mobile_toggle > .mobile_button, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link .link_text, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.nav_search_box *, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .post_details > .post_title, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .post_details > .post_title > .item_link {
        font-weight: bold;
        font-size: 13px;
        text-transform: uppercase;
    }
    #mega_main_menu.primary ul li .mega_dropdown > li > .item_link, #mega_main_menu.primary ul li .mega_dropdown > li > .item_link .link_text, 
    #mega_main_menu.primary ul li .mega_dropdown, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .post_details > .post_description {
        font-size: 14px;
    }
    /* Reset - all items */
    #mega_main_menu.primary.primary_style-buttons > .menu_holder > .menu_inner > .nav_logo > .mobile_toggle, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link {
        background: none;
    }
    #mega_main_menu.primary > .menu_holder > .menu_inner > .nav_logo > .mobile_toggle > .mobile_button, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link * {
        color: <?php echo $theme_cat_menu_link_color; ?>;
        text-transform: uppercase;
        font-weight: bold;
    }
    /* Item separator */
    #mega_main_menu.direction-horizontal > .menu_holder > .menu_inner > ul > li {
        padding-top: 9px;
        padding-bottom: 10px;
    }
    #mega_main_menu.direction-horizontal > .menu_holder > .menu_inner .nav_logo {
        padding-top: 9px;
        padding-bottom: 10px;
    }
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.nav_search_box {
        margin-top: 9px;
    }
    #mega_main_menu.direction-horizontal > .menu_holder > .menu_inner > ul > li:first-child {
        border-left: 0;
    }
    #mega_main_menu.direction-horizontal > .menu_holder > .menu_inner > ul > li.nav_search_box {
        border: 0;
        color: <?php echo $theme_cat_menu_link_color; ?>;
    }
    #mega_main_menu.direction-horizontal > .menu_holder > .menu_inner > ul > li > .item_link:before, 
    #mega_main_menu.direction-horizontal > .menu_holder > .menu_inner > .nav_logo:before, 
    #mega_main_menu.direction-horizontal > .menu_holder > .menu_inner > ul > li.nav_search_box:before {
        background-image: none;
    }
   
    /* Text and links color */
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .post_details > .post_icon > i, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown .item_link *, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown a, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown a *, 
    #mega_main_menu.primary ul li.default_dropdown .mega_dropdown > li > .item_link *, #mega_main_menu.primary ul li.multicolumn_dropdown .mega_dropdown > li > .item_link,
    #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li > .item_link *, #mega_main_menu.primary ul li li .post_details a {
        color: inherit;
    }
     /* Submenu Item hover */
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown .item_link:hover, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown .item_link:focus, 
    #mega_main_menu.primary ul li.default_dropdown .mega_dropdown > li:hover > .item_link, 
    #mega_main_menu.primary ul li.default_dropdown .mega_dropdown > li.current-menu-item > .item_link, 
    #mega_main_menu.primary ul li.multicolumn_dropdown .mega_dropdown > li > .item_link:hover, 
    #mega_main_menu.primary ul li.multicolumn_dropdown .mega_dropdown > li.current-menu-item > .item_link, 
    #mega_main_menu.primary ul li.post_type_dropdown .mega_dropdown > li:hover > .item_link, 
    #mega_main_menu.primary ul li.post_type_dropdown .mega_dropdown > li > .item_link:hover, 
    #mega_main_menu.primary ul li.post_type_dropdown .mega_dropdown > li.current-menu-item > .item_link, 
    #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li:hover > .processed_image, 
    #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li:hover > .item_link, 
    #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li > .item_link:hover, 
    #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li.current-menu-item > .item_link, 
    #mega_main_menu.primary ul li.post_type_dropdown .mega_dropdown > li > .processed_image:hover {
       background: none;
       background-color: <?php echo $theme_main_color; ?>;
    }

    #mega_main_menu > .menu_holder > .menu_inner > ul > li.widgets_dropdown .mega_dropdown > li > .item_link, 
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.multicolumn_dropdown .mega_dropdown > li > .item_link {
        border: none;
    }
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown .item_link *, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown .item_link *, 
    #mega_main_menu.primary ul li.default_dropdown .mega_dropdown > li > .item_link *, 
    #mega_main_menu.primary ul li.default_dropdown .mega_dropdown > li.current-menu-item > .item_link *, 
    #mega_main_menu.primary ul li.multicolumn_dropdown .mega_dropdown > li > .item_link *, 
    #mega_main_menu.primary ul li.multicolumn_dropdown .mega_dropdown > li.current-menu-item > .item_link *, 
    #mega_main_menu.primary ul li.post_type_dropdown .mega_dropdown > li > .item_link *, 
    #mega_main_menu.primary ul li.post_type_dropdown .mega_dropdown > li.current-menu-item > .item_link *, 
    #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li > .item_link *, 
    #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li a *, 
    #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li.current-menu-item > .item_link *, 
    #mega_main_menu.primary ul li.post_type_dropdown .mega_dropdown > li > .processed_image > .cover > a > i,
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.default_dropdown.drop_to_right .mega_dropdown li > .item_link:before {
        color: <?php echo $theme_cat_submenu_1lvl_link_color; ?>;
    }
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown * {
        color: <?php echo $theme_cat_submenu_1lvl_link_color; ?>;
    }
    /* Submenu hover color */
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown .item_link:hover *, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown .item_link:focus *, 
    #mega_main_menu.primary ul li.default_dropdown .mega_dropdown > li:hover > .item_link *, 
    #mega_main_menu.primary ul li.default_dropdown .mega_dropdown > li.current-menu-item > .item_link *,
    #mega_main_menu.primary ul li.multicolumn_dropdown .mega_dropdown > li > .item_link:hover *, 
    #mega_main_menu.primary ul li.multicolumn_dropdown .mega_dropdown > li.current-menu-item > .item_link *, 
    #mega_main_menu.primary ul li.post_type_dropdown .mega_dropdown > li:hover > .item_link *, 
    #mega_main_menu.primary ul li.post_type_dropdown .mega_dropdown > li.current-menu-item > .item_link *, 
    #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li:hover > .item_link *, 
    #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li a:hover *, 
    #mega_main_menu.primary ul li.grid_dropdown .mega_dropdown > li.current-menu-item > .item_link *, 
    #mega_main_menu.primary ul li.post_type_dropdown .mega_dropdown > li > .processed_image:hover > .cover > a > i {
        color: <?php echo $theme_cat_menu_link_color; ?>;
    }

    /* Drop down menus */
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.default_dropdown > ul, 
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.default_dropdown li > ul, 
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.multicolumn_dropdown > ul, 
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.widgets_dropdown > ul, 
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.post_type_dropdown > ul, 
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.grid_dropdown > ul, 
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.post_type_dropdown .mega_dropdown > li.post_item .post_details, 
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.grid_dropdown .mega_dropdown > li .post_details {
        box-shadow: none;
    }
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.default_dropdown .mega_dropdown, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .mega_dropdown, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .mega_dropdown > li .post_details {
        background-color: <?php echo $theme_cat_submenu_1lvl_bg_color; ?>;
    }
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.default_dropdown:not(.multicolumn_dropdown) .mega_dropdown .mega_dropdown, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li:not(.multicolumn_dropdown) > .mega_dropdown .mega_dropdown, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li:not(.multicolumn_dropdown) .mega_dropdown .mega_dropdown > li:not(.multicolumn_dropdown) .post_details {
        background-color: <?php echo $theme_cat_submenu_1lvl_bg_color; ?>;
    }
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.default_dropdown .mega_dropdown > li > .item_link {
        border: none;
        padding: 10px 15px;
    }
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.multicolumn_dropdown .mega_dropdown > li > .item_link {
        padding: 8px 15px;
    }
    /* Search box */
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.nav_search_box > #mega_main_menu_searchform {
        background-color: <?php echo $theme_main_color; ?>;
    }
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.default_dropdown.drop_to_right .mega_dropdown li:hover > .item_link:before {
        color: <?php echo $theme_cat_menu_link_color; ?>;
    }
    #mega_main_menu > .menu_holder > .menu_inner > .mega_main_menu_ul > li.multicolumn_dropdown > .mega_dropdown > .menu-item-object-product_cat > a > .link_content > .link_text,
    #mega_main_menu > .menu_holder > .menu_inner > .mega_main_menu_ul > li.multicolumn_dropdown > .mega_dropdown > .menu-item > .item_link > .link_content > .link_text  {
        font-weight: bold;
    }
    .navbar {
        padding-bottom: 0!important;
    }
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.nav_search_box .field, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.nav_search_box *, 
    #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li .icosearch {
        color: inherit;
    }
    @media (max-width: 767px)  {
        #mega_main_menu.primary {
            background-color: <?php echo $theme_cat_menu_bg_color; ?>;
        }
        #mega_main_menu > .menu_holder > .menu_inner > ul > li > .item_link:after {
            right: 10px;
        }
    }
    /*************************
    * Vertical menu overrides 
    *************************/
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li > .item_link:after {
        content: "";
        font-family: "Fontawesome";
        right: 10px;
    }
    #mega_main_menu.direction-vertical > .menu_holder > .menu_inner > ul > li > .item_link:before, 
    #mega_main_menu.direction-vertical > .menu_holder > .menu_inner > ul > li.nav_search_box:before {
        background-image: none;
    }
    #mega_main_menu.direction-vertical.icons-left > .menu_holder > .menu_inner > ul > li > .item_link > .link_content {
        margin-left: 0;
    }
    #mega_main_menu.left > .menu_holder > .mmm_fullwidth_container {
        background: none;
    }
    #mega_main_menu > .menu_holder > .menu_inner {
        background-color: <?php echo $theme_cat_menu_bg_color; ?>;
    }
    /* Reset - current/hover item */
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li:hover > .item_link, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li > .item_link:hover, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li > .item_link:focus, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li.current-menu-item > .item_link {
        background: none;
        color: <?php echo $theme_cat_menu_link_color; ?>;
    }
    /* Current top menu item */
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link *, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li.current-menu-item > .item_link * {
        color: <?php echo $theme_cat_menu_link_color; ?>;
    }
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li.current-menu-item {
        background-color: <?php echo $theme_main_color; ?>;
    }
    /* Hover top menu item text */
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li:hover > .item_link, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li > .item_link:hover, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li > .item_link:focus, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li:hover > .item_link *, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link * {
        color: <?php echo $theme_cat_menu_link_color; ?>;
    }
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li:not(.nav_search_box):hover {
        background-color: <?php echo $theme_main_color; ?>;
    }
    /* Menu items */
    #mega_main_menu.left > .menu_holder > .menu_inner > .nav_logo > .mobile_toggle > .mobile_button, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li > .item_link, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li > .item_link .link_text, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li.nav_search_box *, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li .post_details > .post_title, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li .post_details > .post_title > .item_link {
        font-weight: bold;
        font-size: 13px;
        text-transform: uppercase;
    }
    #mega_main_menu.left ul li .mega_dropdown > li > .item_link, #mega_main_menu.left ul li .mega_dropdown > li > .item_link .link_text, 
    #mega_main_menu.left ul li .mega_dropdown, #mega_main_menu.left > .menu_holder > .menu_inner > ul > li .post_details > .post_description {
        font-size: 14px;
    }
    /* Reset - all items */
    #mega_main_menu.left.primary_style-buttons > .menu_holder > .menu_inner > .nav_logo > .mobile_toggle, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li > .item_link {
        background: none;
    }
    #mega_main_menu.left > .menu_holder > .menu_inner > .nav_logo > .mobile_toggle > .mobile_button, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li > .item_link, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li > .item_link * {
        color: <?php echo $theme_cat_menu_link_color; ?>;
        text-transform: uppercase;
        font-weight: bold;
    }
   
    /* Text and links color */
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li .post_details > .post_icon > i, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li .mega_dropdown .item_link *, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li .mega_dropdown a, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li .mega_dropdown a *, 
    #mega_main_menu.left ul li.default_dropdown .mega_dropdown > li > .item_link *, 
    #mega_main_menu.left ul li.multicolumn_dropdown .mega_dropdown > li > .item_link 
    #mega_main_menu.left ul li.grid_dropdown .mega_dropdown > li > .item_link *, 
    #mega_main_menu.left ul li li .post_details a {
        color: inherit;
    }
     /* Submenu Item hover */
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li .mega_dropdown .item_link:hover, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li .mega_dropdown .item_link:focus, 
    #mega_main_menu.left ul li.default_dropdown .mega_dropdown > li:hover > .item_link, 
    #mega_main_menu.left ul li.default_dropdown .mega_dropdown > li.current-menu-item > .item_link, 
    #mega_main_menu.left ul li.multicolumn_dropdown .mega_dropdown > li > .item_link:hover, 
    #mega_main_menu.left ul li.multicolumn_dropdown .mega_dropdown > li.current-menu-item > .item_link, 
    #mega_main_menu.left ul li.post_type_dropdown .mega_dropdown > li:hover > .item_link, 
    #mega_main_menu.left ul li.post_type_dropdown .mega_dropdown > li > .item_link:hover, 
    #mega_main_menu.left ul li.post_type_dropdown .mega_dropdown > li.current-menu-item > .item_link, 
    #mega_main_menu.left ul li.grid_dropdown .mega_dropdown > li:hover > .processed_image, 
    #mega_main_menu.left ul li.grid_dropdown .mega_dropdown > li:hover > .item_link, 
    #mega_main_menu.left ul li.grid_dropdown .mega_dropdown > li > .item_link:hover, 
    #mega_main_menu.left ul li.grid_dropdown .mega_dropdown > li.current-menu-item > .item_link, 
    #mega_main_menu.left ul li.post_type_dropdown .mega_dropdown > li > .processed_image:hover {
       background: none;
       background-color: <?php echo $theme_main_color; ?>;
    }

    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li .mega_dropdown .item_link *, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li .mega_dropdown .item_link *, 
    #mega_main_menu.left ul li.default_dropdown .mega_dropdown > li > .item_link *, 
    #mega_main_menu.left ul li.default_dropdown .mega_dropdown > li.current-menu-item > .item_link *, 
    #mega_main_menu.left ul li.multicolumn_dropdown .mega_dropdown > li > .item_link *, 
    #mega_main_menu.left ul li.multicolumn_dropdown .mega_dropdown > li.current-menu-item > .item_link *, 
    #mega_main_menu.left ul li.post_type_dropdown .mega_dropdown > li > .item_link *, 
    #mega_main_menu.left ul li.post_type_dropdown .mega_dropdown > li.current-menu-item > .item_link *, 
    #mega_main_menu.left ul li.grid_dropdown .mega_dropdown > li > .item_link *, #mega_main_menu.left ul li.grid_dropdown .mega_dropdown > li a *, 
    #mega_main_menu.left ul li.grid_dropdown .mega_dropdown > li.current-menu-item > .item_link *, 
    #mega_main_menu.left ul li.post_type_dropdown .mega_dropdown > li > .processed_image > .cover > a > i,
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li.default_dropdown.drop_to_right .mega_dropdown li > .item_link:before {
        color: <?php echo $theme_cat_submenu_1lvl_link_color; ?>;
    }
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li .mega_dropdown * {
        color: <?php echo $theme_cat_submenu_1lvl_link_color; ?>;
    }
    /* Submenu hover color */
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li .mega_dropdown .item_link:hover *, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li .mega_dropdown .item_link:focus *, 
    #mega_main_menu.left ul li.default_dropdown .mega_dropdown > li:hover > .item_link *, 
    #mega_main_menu.left ul li.default_dropdown .mega_dropdown > li.current-menu-item > .item_link *, 
    #mega_main_menu.left ul li.multicolumn_dropdown .mega_dropdown > li > .item_link:hover *, 
    #mega_main_menu.left ul li.multicolumn_dropdown .mega_dropdown > li.current-menu-item > .item_link *, 
    #mega_main_menu.left ul li.post_type_dropdown .mega_dropdown > li:hover > .item_link *, 
    #mega_main_menu.left ul li.post_type_dropdown .mega_dropdown > li.current-menu-item > .item_link *, 
    #mega_main_menu.left ul li.grid_dropdown .mega_dropdown > li:hover > .item_link *, 
    #mega_main_menu.left ul li.grid_dropdown .mega_dropdown > li a:hover *, 
    #mega_main_menu.left ul li.grid_dropdown .mega_dropdown > li.current-menu-item > .item_link *, 
    #mega_main_menu.left ul li.post_type_dropdown .mega_dropdown > li > .processed_image:hover > .cover > a > i {
        color: <?php echo $theme_cat_menu_link_color; ?>;
    }

    /* Drop down menus */
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li.default_dropdown .mega_dropdown, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li > .mega_dropdown, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li .mega_dropdown > li .post_details {
        background-color: <?php echo $theme_cat_submenu_1lvl_bg_color; ?>;
    }
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li.default_dropdown:not(.multicolumn_dropdown) .mega_dropdown .mega_dropdown, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li:not(.multicolumn_dropdown) > .mega_dropdown .mega_dropdown, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li:not(.multicolumn_dropdown) .mega_dropdown .mega_dropdown > li:not(.multicolumn_dropdown) .post_details {
        background-color: <?php echo $theme_cat_submenu_1lvl_bg_color; ?>;
    }
    /* Search box */
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li.nav_search_box > #mega_main_menu_searchform {
        background-color: <?php echo $theme_main_color; ?>;
    }
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li.nav_search_box .field, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li.nav_search_box *, 
    #mega_main_menu.left > .menu_holder > .menu_inner > ul > li .icosearch {
        color: inherit;
    }
    @media (max-width: 767px)  {
        #mega_main_menu.left {
            background-color: <?php echo $theme_cat_menu_bg_color; ?>;
        }
    }
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.nav_search_box #mega_main_menu_searchform .icosearch, 
    #mega_main_menu > .menu_holder > .menu_inner > ul > li.nav_search_box #mega_main_menu_searchform .submit {
        color: #fff;
    }
    <?php endif; ?>
    <?php

    	$out = ob_get_clean();

		$out .= ' /*' . date("Y-m-d H:i") . '*/';
		/* RETURN */
		return $out;
	}

?>