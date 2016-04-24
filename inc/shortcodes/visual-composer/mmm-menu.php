<?php

// VC [mmm_menu_wp]
$menus = get_nav_menu_locations();

$menu_locations = array();

foreach ( $menus as $location => $id ) {

	$menu_locations[$location] = $location;
}

vc_map(array(
   "name" 			=> __("Menu location"),
   "category" 		=> __('Menus'),
   "description"	=> __("Display Menu location"),
   "base" 			=> "mmm_menu_wp",
   "class" 			=> "",
   "icon" 			=> "mmm_menu_wp",
   
   "params" 	=> array(

		 array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("Menu Location slug"),
			"param_name"	=> "menu_location",
			"value"			=> $menu_locations,
			"std"			=> "desc",
		),
		
   )

  

  

   

   
));