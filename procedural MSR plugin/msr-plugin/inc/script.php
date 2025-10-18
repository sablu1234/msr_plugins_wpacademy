<?php




function msr_plugin_admin_scripts(){
wp_enqueue_style( 'msr-plugin-admin-css', MSR_PLUGIN_DIR_URL . 'admin/css/admin.css', '', MSR_PLUGIN_VERSION );
wp_enqueue_script( 'msr-plugin-admin-js', MSR_PLUGIN_DIR_URL . 'admin/js/admin.js', '', MSR_PLUGIN_VERSION, true );
}
add_action( 'admin_enqueue_scripts', 'msr_plugin_admin_scripts' );

function msr_plugin_public_scripts(){
wp_enqueue_style( 'msr-plugin-public-css', MSR_PLUGIN_DIR_URL . 'public/css/public.css', '', MSR_PLUGIN_VERSION );
wp_enqueue_script( 'msr-plugin-public-js', MSR_PLUGIN_DIR_URL . 'public/js/public.js', '', MSR_PLUGIN_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'msr_plugin_public_scripts' );