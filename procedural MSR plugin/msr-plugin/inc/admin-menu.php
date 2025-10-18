<?php

function msr_plugin_menus(){
    add_menu_page(
    'MSR Plugin',
    'MSR',
    'manage_options',
    'msrplugin',
    'msr_plugin_page',
    'dashicons-admin-settings',
    10
);

add_submenu_page(
	'msrplugin',
	'MSR PLUGIN Sub-Menu',
	'Sub-Menu',
	'manage_options',
	'msr_plugin_sub',
	'msr_plugin_sub_page'
);

}
add_action('admin_menu', 'msr_plugin_menus');


