<?php

// VC [best_selling_products_wp]

vc_map(array(
   "name" 			=> __("Best Selling Products"),
   "category" 		=> __('Products'),
   "description"	=> __("Display WooCommerce products"),
   "base" 			=> "best_selling_products_wp",
   "class" 			=> "",
   "icon" 			=> "best_selling_products_wp",
   
   "params" 	=> array(
      
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("Title"),
			"param_name"	=> "title",
			"value" => "Best Sellers"
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("Number of Products"),
			"param_name"	=> "per_page",
			"value"			=> "10",
		),
		
   )
   
));