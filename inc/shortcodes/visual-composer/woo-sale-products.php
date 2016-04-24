<?php

// VC [sale_products_wp]

vc_map(array(
   "name" 			=> __("Sale Products"),
   "category" 		=> __('Products'),
   "description"	=> __("Display WooCommerce products"),
   "base" 			=> "sale_products_wp",
   "class" 			=> "",
   "icon" 			=> "sale_products_wp",
   
   "params" 	=> array(
      
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("Title"),
			"param_name"	=> "title",
			"value"			=> "Sales",			
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