<?php

function msr_plugin_menus(){
    add_menu_page(
    'MSR Plugin',
    'MSR',
    'manage_options',
    'msrplugin',
    'msr_options_page',
    'dashicons-admin-settings',
    10
);

}
add_action('admin_menu', 'msr_plugin_menus');


