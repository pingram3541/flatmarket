<?php

// VC [product_categories_grid]

vc_map(array(
   "name"			=> __("Product Categories Grid"),
   "category"		=> __('Shop Shortcodes'),
   "description"	=> __("Description"),
   "base"			=> "product_categories_grid",
   "class"			=> "",
   "icon"			=> "product_categories_grid",
   
   "params" 	=> array(
      
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("Number"),
			//"description"	=> __(""),
			"param_name"	=> "number",
			"value"			=> "",
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("Order By"),
			//"description"	=> __(""),
			"param_name"	=> "orderby",
			"value"			=> array(
				"None"			=> "none",
				"ID"			=> "ID",
				"Name"			=> "name",
				"Date"			=> "date",
				"Menu Order"	=> "menu_order",
				"Rand"			=> "rand"
			),
			"std"			=> "date",
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("Order"),
			//"description"	=> __(""),
			"param_name"	=> "order",
			"value"			=> array(
				"Desc"	=> "desc",
				"Asc"	=> "asc"
			),
			"std"			=> "desc",
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("Hide Empty"),
			//"description"	=> __(""),
			"param_name"	=> "hide_empty",
			"value"			=> array(
				"Yes"	=> "1",
				"No"	=> "0"
			),
			"std"			=> "1",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("Parent"),
			"description"	=> __("Set the parent paramater to 0 to only display top level categories."),
			"param_name"	=> "parent",
			"value"			=> "",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("IDs"),
			"description"	=> __("Set ids to a comma separated list of category ids to only show those."),
			"param_name"	=> "ids",
			"value"			=> "",
		),
   )
   
));