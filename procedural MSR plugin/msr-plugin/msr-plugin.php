<?php

/*
 * Plugin Name:       My Basics Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            John Smith
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       msr-plugin
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!defined('MSR_PLUGIN_VERSION')){
    define('MSR_PLUGIN_VERSION', '1.0.0');
}

if( ! defined('MSR_PLUGIN_DIR_URL')){
    define('MSR_PLUGIN_DIR_URL', plugin_dir_url(__FILE__) );
}

if( ! defined('MSR_PLUGIN_DIR_PATH')){
    define( 'MSR_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__) );
}

if( ! defined('MSR_PLUGIN_DB_VERSION')){
    define( 'MSR_PLUGIN_DB_VERSION', '1.0.2' );
}

// Includes scripts and style
require_once MSR_PLUGIN_DIR_PATH . 'inc/script.php';

// Action and filters
require_once MSR_PLUGIN_DIR_PATH . 'inc/hooks.php';

// Include CPT taxonomy, and metaboxes
require_once MSR_PLUGIN_DIR_PATH . 'inc/cpt.php';
require_once MSR_PLUGIN_DIR_PATH . 'inc/taxonomy.php';
require_once MSR_PLUGIN_DIR_PATH . 'inc/metaboxes.php';
/*
// Include shortcodes
$shortcode = get_option('msr_enable_shortcodes');
if($shortcode == 'yes'){
    require_once MSR_PLUGIN_DIR_PATH . 'inc/shortcodes.php'; 
}
*/

// Admin menu and pages
require_once MSR_PLUGIN_DIR_PATH . 'inc/admin-menu.php'; 
require_once MSR_PLUGIN_DIR_PATH . 'inc/admin-page.php'; 
require_once MSR_PLUGIN_DIR_PATH . 'inc/admin-settings.php'; 


// require_once MSR_PLUGIN_DIR_PATH . 'inc/wpmagic-admin-menu.php'; 
// require_once MSR_PLUGIN_DIR_PATH . 'inc/wpmagic-admin-page.php'; 
// require_once MSR_PLUGIN_DIR_PATH . 'inc/wpmagic-settings.php'; 

// Database
require_once MSR_PLUGIN_DIR_PATH . 'inc/db.php'; 
register_activation_hook( __FILE__, 'msr_reactions_table' );