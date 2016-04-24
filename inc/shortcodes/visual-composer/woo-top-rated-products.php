<?php

// VC [top_rated_products_wp]

vc_map(array(
   "name" 			=> __("Top Rated Products"),
   "category" 		=> __('Products'),
   "description"	=> __("Display WooCommerce products"),
   "base" 			=> "top_rated_products_wp",
   "class" 			=> "",
   "icon" 			=> "top_rated_products_wp",
   
   "params" 	=> array(
      
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("Title"),
			"param_name"	=> "title"	
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("Products Per Page"),
			"param_name"	=> "per_page",
			"value"			=> "10",
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("Order By"),
			"param_name"	=> "orderby",
			"value"			=> array(
				"None"	=> "none",
				"ID"	=> "ID",
				"Title"	=> "title",
				"Date"	=> "date",
				"Rand"	=> "rand"
			),
			"std"			=> "date",
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("Order"),
			"param_name"	=> "order",
			"value"			=> array(
				"Desc"	=> "desc",
				"Asc"	=> "asc"
			),
			"std"			=> "desc",
		),
   )
   
));