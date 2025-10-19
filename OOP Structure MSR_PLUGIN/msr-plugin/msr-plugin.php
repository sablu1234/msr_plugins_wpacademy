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
    define( 'MSR_PLUGIN_DB_VERSION', '1.0.3' );
}

// main plugin class
require_once MSR_PLUGIN_DIR_PATH . 'inc/plugin.php';

// Database
register_activation_hook( __FILE__, 'msr_reactions_table' );